<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Os\Os;
use Livewire\Component;

class GarantiaCard extends Component
{
    public function render()
    {
        $os = Os::select([
            'os.id as id',
            'clientes.name as name',
            'os.prazo_garantia as prazo_garantia',
            'status_id',
        ]);
        $os->with('status');
        $os->join('clientes', 'clientes.id', '=', 'os.cliente_id');
        $os->join('status', 'status.id', '=', 'os.status_id');
        $os->whereNotNull('prazo_garantia');
        $os->where('status.garantia', 1); // forma de garantia que vou contar apenas o que foi finalizado isso é com garantia.
        $os->where('prazo_garantia', '>=', now()->format('Y-m-d'));
        $os->orderBy('prazo_garantia');
        $os->limit(6);
        $osReturn = $os->get();

        return view('livewire.home.dashboard.garantia-card', [
            'os' => $osReturn,
        ]);
    }
}
