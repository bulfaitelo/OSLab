<?php

namespace App\Livewire\Os\Informacoes;

use App\Models\Os\OsInformacao;
use Livewire\Component;

class VisualizarModal extends Component
{

    public $item;

    protected $listeners = ['open' => 'loadVisualizarModal'];


    function loadVisualizarModal($id) {
        $this->item = OsInformacao::findOrFail($id);
        $this->dispatch('toggleVisualizarModal');
        if($this->item->tipo_informacao == 'padrao') {
            $this->dispatch('senhaPadrao', senha:$this->item->informacao);
        }
    }

    public function render()
    {
        return view('livewire.os.informacoes.visualizar-modal', [
            'item' => $this->item
        ]);
    }
}
