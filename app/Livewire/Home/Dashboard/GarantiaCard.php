<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Os\Os;
use App\Services\Os\OsService;
use Livewire\Component;

class GarantiaCard extends Component
{
    public function render()
    {
        $os = Os::with('cliente');
        $os->limit(6);
        $os->whereNotNull('prazo_garantia');
        $os->where('prazo_garantia', '>=', now()->format('Y-m-d'));
        $os->orderBy('prazo_garantia');
        $osReturn = $os->get();

        return view('livewire.home.dashboard.garantia-card',[
            'os' => $osReturn,
        ]);
    }
}
