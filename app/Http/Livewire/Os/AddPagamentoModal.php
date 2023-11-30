<?php

namespace App\Http\Livewire\Os;

use Livewire\Component;

class AddPagamentoModal extends Component
{

    public $os;

    protected $listeners = ['adicionarPagamento' => 'loadAdicionarPagamento'];

    function loadAdicionarPagamento(){
        // dd($this->os->contas->where('tipo', 'R'));
        $this->emit('toggleAddPagamentoModal');
    }

    public function render()
    {
        return view('livewire.os.add-pagamento-modal', [
            'os' => $this->os
        ]);
    }
}
