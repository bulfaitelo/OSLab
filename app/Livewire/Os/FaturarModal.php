<?php

namespace App\Livewire\Os;

use Livewire\Component;

class FaturarModal extends Component
{
    public $os;
    protected $listeners = ['faturarOs' => 'loadFaturarModal'];

    public $valorTotal;

    function loadFaturarModal(){
        $this->valorTotal = $this->os->valorTotal();
        $this->dispatch('toggleFaturarModal');
    }
    public function render()
    {
        return view('livewire.os.faturar-modal',[
            'os' => $this->os,
            'osValorTotal' => $this->valorTotal,
        ]);
    }
}
