<?php

namespace App\Livewire\Home\Dashboard;

use Livewire\Component;
use \App\Models\Financeiro\MetaContabil as MetaContabilModel;

class MetaContabil extends Component
{
    public function render()
    {
        $metaContabil = MetaContabilModel::getDataTable(dashboard:true, itensPorPagina:6);
        
        return view('livewire.home.dashboard.meta-contabil', [
            'metaContabil' => $metaContabil,
        ]);
    }
}
