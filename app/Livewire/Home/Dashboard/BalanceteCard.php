<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Financeiro\Pagamentos;
use Livewire\Component;

class BalanceteCard extends Component
{
    private $meses = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
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

    public $mes_busca;

    public function render()
    {
        if (! $this->mes_busca) {
            $this->mes_busca = now()->format('n');

        }
        $balancete = $this->getSaldo($this->mes_busca);

        return view('livewire.home.dashboard.balancete-card', [
            'meses' => $this->meses,
            'mes_busca' => $this->mes_busca,
            'balancete' => $balancete,
        ]);
    }

    /**
     * Retorna o a receita, despesa e saldo do ano vigente e mes selecionado.
     *
     * @param  string  $mes_busca  Mes da busca.
     * @return object|null
     */
    private function getSaldo($mes_busca): object|null
    {
        $ano = now()->format('Y');
        $query = Pagamentos::query();
        $query->selectRaw('
            IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) AS receita,
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0) AS despesa,
            (IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) -
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0)) AS saldo
        ');
        $query->leftJoin('contas', 'contas_pagamentos.conta_id', '=', 'contas.id');
        $query->groupByRaw('YEAR(vencimento), MONTH(vencimento)');
        $query->whereRaw("MONTH(vencimento) = {$mes_busca} and YEAR(vencimento) = {$ano}");

        return $query->first();
    }
}
