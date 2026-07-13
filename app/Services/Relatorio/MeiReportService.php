<?php

declare(strict_types=1);

namespace App\Services\Relatorio;

use App\Models\Financeiro\Pagamentos;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class MeiReportService
{
    public const TYPE_MONTHLY = 'monthly';

    public const TYPE_YEARLY = 'yearly';

    private const MONTH_NAMES = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Marco',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro',
    ];

    /**
     * @return array<int>
     */
    public function availableYears(): array
    {
        $yearExpr = $this->yearExpression('contas_pagamentos.data_pagamento');

        $years = Pagamentos::query()
            ->join('contas', 'contas.id', '=', 'contas_pagamentos.conta_id')
            ->where('contas.tipo', 'R')
            ->whereNotNull('contas_pagamentos.data_pagamento')
            ->selectRaw('DISTINCT '.$yearExpr.' as ano')
            ->orderByDesc('ano')
            ->pluck('ano')
            ->map(static fn ($year): int => (int) $year)
            ->values()
            ->all();

        $currentYear = (int) now()->format('Y');
        if (! in_array($currentYear, $years, true)) {
            $years[] = $currentYear;
        }

        rsort($years);

        return $years;
    }

    /**
     * @return array{
     *     records: array<int, array{period: string, commerce: float, service: float, total: float}>,
     *     totals: array{commerce: float, service: float, total: float}
     * }
     */
    public function getReportData(string $type, int $year): array
    {
        $normalizedType = $type === self::TYPE_YEARLY ? self::TYPE_YEARLY : self::TYPE_MONTHLY;

        $aggregatedRows = $this->buildBaseQuery($year, $normalizedType)->get();

        $records = $normalizedType === self::TYPE_YEARLY
            ? $this->buildYearlyRecords($aggregatedRows, $year)
            : $this->buildMonthlyRecords($aggregatedRows, $year);

        return [
            'records' => $records,
            'totals' => $this->calculateTotals($records),
        ];
    }

    private function buildBaseQuery(int $year, string $type): Builder
    {
        $periodColumn = $type === self::TYPE_YEARLY
            ? $this->yearExpression('cp.data_pagamento')
            : $this->monthExpression('cp.data_pagamento');
        $yearFilterColumn = $this->yearExpression('cp.data_pagamento');
        $serviceClassification = $this->serviceClassificationSql();

        return Pagamentos::query()
            ->from('contas_pagamentos as cp')
            ->join('contas as c', 'c.id', '=', 'cp.conta_id')
            ->leftJoin('centro_custos as cc', 'cc.id', '=', 'c.centro_custo_id')
            ->where('c.tipo', 'R')
            ->whereNotNull('cp.data_pagamento')
            ->whereRaw($yearFilterColumn.' = ?', [$year])
            ->selectRaw($periodColumn.' AS period_key')
            ->selectRaw('SUM(CASE WHEN '.$serviceClassification.' THEN cp.valor ELSE 0 END) AS service_amount')
            ->selectRaw('SUM(CASE WHEN NOT('.$serviceClassification.') THEN cp.valor ELSE 0 END) AS commerce_amount')
            ->groupByRaw($periodColumn)
            ->orderBy('period_key');
    }

    /**
     * @param  iterable<object>  $rows
     * @return array<int, array{period: string, commerce: float, service: float, total: float}>
     */
    private function buildMonthlyRecords(iterable $rows, int $year): array
    {
        $indexed = [];
        foreach ($rows as $row) {
            $indexed[(int) $row->period_key] = $row;
        }

        $records = [];
        for ($month = 1; $month <= 12; $month++) {
            $row = $indexed[$month] ?? null;
            $service = round((float) ($row->service_amount ?? 0), 2);
            $commerce = round((float) ($row->commerce_amount ?? 0), 2);

            $records[] = [
                'period' => self::MONTH_NAMES[$month].'/'.$year,
                'commerce' => $commerce,
                'service' => $service,
                'total' => round($commerce + $service, 2),
            ];
        }

        return $records;
    }

    /**
     * @param  iterable<object>  $rows
     * @return array<int, array{period: string, commerce: float, service: float, total: float}>
     */
    private function buildYearlyRecords(iterable $rows, int $year): array
    {
        $service = 0.0;
        $commerce = 0.0;

        foreach ($rows as $row) {
            $service += (float) ($row->service_amount ?? 0);
            $commerce += (float) ($row->commerce_amount ?? 0);
        }

        $service = round($service, 2);
        $commerce = round($commerce, 2);

        return [[
            'period' => (string) $year,
            'commerce' => $commerce,
            'service' => $service,
            'total' => round($commerce + $service, 2),
        ]];
    }

    /**
     * @param  array<int, array{period: string, commerce: float, service: float, total: float}>  $records
     * @return array{commerce: float, service: float, total: float}
     */
    private function calculateTotals(array $records): array
    {
        $commerce = round((float) array_sum(array_column($records, 'commerce')), 2);
        $service = round((float) array_sum(array_column($records, 'service')), 2);

        return [
            'commerce' => $commerce,
            'service' => $service,
            'total' => round($commerce + $service, 2),
        ];
    }

    private function serviceClassificationSql(): string
    {
        $centerCostText = $this->concatCenterCostTextSql();

        return "\n            CASE\n                WHEN c.os_id IS NOT NULL THEN 1\n                WHEN c.venda_id IS NOT NULL THEN 0\n                WHEN LOWER(".$centerCostText.") LIKE '%servi%' THEN 1\n                WHEN LOWER(".$centerCostText.") LIKE '%prest%' THEN 1\n                WHEN LOWER(".$centerCostText.") LIKE '%assist%' THEN 1\n                WHEN LOWER(".$centerCostText.") LIKE '%manut%' THEN 1\n                ELSE 0\n            END = 1\n        ";
    }

    private function yearExpression(string $column): string
    {
        return $this->isSqlite()
            ? "CAST(strftime('%Y', ".$column.") AS INTEGER)"
            : 'YEAR('.$column.')';
    }

    private function monthExpression(string $column): string
    {
        return $this->isSqlite()
            ? "CAST(strftime('%m', ".$column.") AS INTEGER)"
            : 'MONTH('.$column.')';
    }

    private function concatCenterCostTextSql(): string
    {
        if ($this->isSqlite()) {
            return "COALESCE(cc.name, '') || ' ' || COALESCE(cc.descricao, '')";
        }

        return "CONCAT(COALESCE(cc.name, ''), ' ', COALESCE(cc.descricao, ''))";
    }

    private function isSqlite(): bool
    {
        return DB::connection()->getDriverName() === 'sqlite';
    }
}
