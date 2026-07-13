<?php

declare(strict_types=1);

namespace App\Livewire\Financeiro;

use App\Services\Relatorio\MeiReportService;
use Livewire\Component;

class DeclaracaoMeiReport extends Component
{
    public string $type = MeiReportService::TYPE_MONTHLY;

    public int $year;

    /**
     * @var array<int, array{period: string, commerce: float, service: float, total: float}>
     */
    public array $records = [];

    /**
     * @var array{commerce: float, service: float, total: float}
     */
    public array $totals = [
        'commerce' => 0.0,
        'service' => 0.0,
        'total' => 0.0,
    ];

    /**
     * @var array<int>
     */
    public array $availableYears = [];

    public function mount(MeiReportService $reportService): void
    {
        $this->year = (int) now()->format('Y');
        $this->availableYears = $reportService->availableYears();

        if (! in_array($this->year, $this->availableYears, true)) {
            $this->availableYears[] = $this->year;
            rsort($this->availableYears);
        }

        $this->loadReportData($reportService);
    }

    public function updatedType(string $value): void
    {
        $this->type = in_array($value, [MeiReportService::TYPE_MONTHLY, MeiReportService::TYPE_YEARLY], true)
            ? $value
            : MeiReportService::TYPE_MONTHLY;

        $this->loadReportData(app(MeiReportService::class));
    }

    public function updatedYear($value): void
    {
        $this->year = (int) $value;
        $this->loadReportData(app(MeiReportService::class));
    }

    public function getPrintUrlProperty(): string
    {
        return route('relatorio.financeiro.declaracao_mei.pdf', [
            'type' => $this->type,
            'year' => $this->year,
        ]);
    }

    public function render()
    {
        return view('livewire.financeiro.declaracao-mei-report');
    }

    private function loadReportData(MeiReportService $reportService): void
    {
        $data = $reportService->getReportData($this->type, $this->year);
        $this->records = $data['records'];
        $this->totals = $data['totals'];
    }
}
