<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Os\Os;
use Livewire\Component;

class GarantiaCard extends Component
{
    public function render()
    {
        $os = Os::with('cliente', 'status');
        $os->join('os_status', 'os_status.id', '=', 'os.status_id');
        $os->whereNotNull('prazo_garantia');
        $os->where('os_status.garantia', 1); // forma de garantia que vou contar apenas o que foi finalizado isso é com garantia.
        $os->where('prazo_garantia', '>=', now()->format('Y-m-d'));
        $os->orderBy('prazo_garantia');
        $os->limit(6);
        $osReturn = $os->get();

        return view('livewire.home.dashboard.garantia-card', [
            'os' => $osReturn,
        ]);
    }
}
