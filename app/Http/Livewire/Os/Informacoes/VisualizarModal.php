<?php

namespace App\Http\Livewire\Os\Informacoes;

use Livewire\Component;

class VisualizarModal extends Component
{

    protected $listeners = ['open', 'loadVisualizarModal'];


    function loadVisualizarModal($id) {
        $this->emit('toggleVisualizarModal');
        dd($id);
    }

    public function render()
    {
        return view('livewire.os.informacoes.visualizar-modal');
    }
}
