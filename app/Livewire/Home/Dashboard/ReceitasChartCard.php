<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Financeiro\Contas;
use Livewire\Component;

class ReceitasChartCard extends Component
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

    public function render()
    {
        $data = self::getReceitaData();

        return view('livewire.home.dashboard.receitas-chart-card', [
            'data' => $data,
        ]);
    }

    private function getReceitaData()
    {

        $ano = now()->format('Y');
        $dataInicio = $ano.'-01-01';
        $dataFim = $ano.'-12-31';
        $receitas = Contas::RelatorioBalanceteMes($dataInicio, $dataFim);
        foreach ($receitas as $key => $value) {
            $labels[] = $this->meses[$value->mes];
            $data[] = $value->saldo;
        }

        $data = [
            'labels'=> $labels,
            'datasets'=> [
                [
                    'label' => 'Receitas R$',
                    'data' => $data,
                    'borderWidth' => 1,
                    'borderRadius' => 10,
                    'borderColor' => 'rgb(93, 82, 239)',
                    'backgroundColor' => 'rgb(93, 82, 239)',
                ],
            ],
        ];

        return $data;
    }
}
