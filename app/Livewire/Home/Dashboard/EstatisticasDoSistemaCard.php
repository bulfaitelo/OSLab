<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Checklist\Checklist;
use App\Models\Cliente\Cliente;
use App\Models\Os\Os;
use App\Models\Produto\Produto;
use App\Models\Servico\Servico;
use App\Models\Wiki\Wiki;
use Livewire\Component;

class EstatisticasDoSistemaCard extends Component
{
    public function render()
    {
        $osCount = Os::count();
        $clienteCount = Cliente::count();
        $produtoCount = Produto::count();
        $servicoCount = Servico::count();
        $wikiCount = Wiki::count();
        $checklistCount = Checklist::count();

        return view('livewire.home.dashboard.estatisticas-do-sistema-card', [
            'osCount' => $osCount,
            'clienteCount' => $clienteCount,
            'produtoCount' => $produtoCount,
            'servicoCount' => $servicoCount,
            'wikiCount' => $wikiCount,
            'checklistCount' => $checklistCount,
        ]);
    }
}
