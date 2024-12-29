<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Os\Os;
use Livewire\Component;

class AtendimentosCategoriaChartCard extends Component
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
        $chartData = $this->getOsCategoriaData();

        return view('livewire.home.dashboard.atendimentos-categoria-chart-card', [
            'labels' => $chartData['labels'],
            'data' => $chartData['data'],
        ]);
    }

    /**
     * Retornar um array com dados para criação do chart.
     *
     * @return array Retorna o label e o data
     */
    private function getOsCategoriaData(): array
    {
        $os = Os::query();
        $os->selectRaw('
            categorias.name as categoria,
            MONTH(os.created_at) as mes,
            count(*) as quantidade
        ');
        $os->join('categorias', 'categorias.id', '=', 'os.categoria_id');
        $os->join('os_status', 'os_status.id', '=', 'os.status_id');
        $os->where('os_status.garantia', 1); // forma de garantia que vou contar apenas o que foi finalizado isso é com garantia.
        $os->whereRaw('YEAR(os.created_at) = '.now()->format('Y'));
        $os->groupBy('categoria');
        $os->groupByRaw('MONTH(os.created_at)');
        $os->orderBy('mes');
        $os->orderBy('categoria');

        $array = [];
        $arrayMes = [];
        foreach ($os->get() as $key => $value) {
            $array[$value->categoria]['label'] = $value->categoria;
            $array[$value->categoria]['data'][] = [
                'x' => $this->meses[$value->mes],
                'y' => $value->quantidade,
            ];
            $array[$value->categoria]['tension'] = 0.4;
            $arrayMes[$value->mes] = $this->meses[$value->mes];
        }
        foreach ($array as $key => $value) {
            $retunrArray[] = $value;
        }
        foreach ($arrayMes as $key => $value) {
            $retunrArrayMes[] = $value;
        }
        if (isset($retunrArray)) {
            return [
                'labels' => json_encode($retunrArrayMes),
                'data' => json_encode($retunrArray),
            ];
        }

        return [
            'labels' => json_encode(false),
            'data' => json_encode(false),
        ];
    }
}
