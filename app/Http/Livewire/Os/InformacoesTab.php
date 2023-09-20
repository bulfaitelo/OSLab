<?php

namespace App\Http\Livewire\Os;

use Livewire\Component;

// use LivewireUI\Modal\ModalComponent;

class InformacoesTab extends Component
{

    public $anotacao;
    public $posts;


    public function render()
    {
        return view('livewire.os.informacoes-tab');
    }



    public function anotacaoCreate() : void {
        // $this->emit('alert("asdsd")');
        // dd($this->posts);


        // $this->emit('mostrarMensagemFoi');
        $this->dispatchBrowserEvent('exibirMensagemFoi');
        // $('#anotacaoModal').modal('hide')
    }
}
