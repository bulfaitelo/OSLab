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
        $conta = $this->os->contas()->where('tipo', 'R')->first();

        return view('livewire.os.add-pagamento-modal', [
            'os' => $this->os,
            'conta' => $conta,
        ]);
    }

    function pagamentoCreate() : void {

    }

}
