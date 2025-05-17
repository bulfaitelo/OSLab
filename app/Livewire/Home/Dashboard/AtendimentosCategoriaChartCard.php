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
        $os->join('status', 'status.id', '=', 'os.status_id');
        $os->where('status.garantia', 1); // somente finalizados com garantia
        $os->whereYear('os.created_at', now()->year);
        $os->groupBy('categoria');
        $os->groupByRaw('MONTH(os.created_at)');
        $os->orderBy('mes');
        $os->orderBy('categoria');

        $dadosBrutos = $os->get();

        // Descobrir os meses únicos com dados
        $mesesComDados = [];

        foreach ($dadosBrutos as $row) {
            $mes = (int) $row->mes;
            $mesesComDados[$mes] = $this->meses[$mes];
        }

        ksort($mesesComDados); // Garante ordem cronológica
        $labels = array_values($mesesComDados); // Apenas nomes dos meses com dados

        // Montar os dados das categorias
        $dataPorCategoria = [];

        foreach ($dadosBrutos as $row) {
            $categoria = $row->categoria;
            $mes = (int) $row->mes;

            if (! isset($dataPorCategoria[$categoria])) {
                // Inicializa apenas os meses com dados como null
                $dataPorCategoria[$categoria] = array_fill_keys(array_keys($mesesComDados), null);
            }

            $dataPorCategoria[$categoria][$mes] = (int) $row->quantidade;
        }

        // Montar datasets no formato esperado
        $datasets = [];

        foreach ($dataPorCategoria as $categoria => $valoresPorMes) {
            $datasets[] = [
                'label' => $categoria,
                'data' => array_values($valoresPorMes), // Em ordem dos labels
                'tension' => 0.4,
                'spanGaps' => true,
            ];
        }

        return [
            'labels' => json_encode($labels),
            'data' => json_encode($datasets),
        ];
    }
}
