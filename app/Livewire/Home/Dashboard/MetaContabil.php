<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Financeiro\MetaContabil as MetaContabilModel;
use Livewire\Component;

class MetaContabil extends Component
{
    public function render()
    {
        $metaContabil = MetaContabilModel::getDataTable(dashboard:true, itensPorPagina:6, colunaOrdenacao: 'porcentagem_executada', ordenacao:'desc');

        return view('livewire.home.dashboard.meta-contabil', [
            'metaContabil' => $metaContabil,
        ]);
    }
}
