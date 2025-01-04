<?php

namespace App\Livewire\Financeiro;

use Livewire\Component;

class FaturarModal extends Component
{
    public $os;
    protected $listeners = ['faturarOs' => 'loadFaturarModal'];

    public $valorTotal;

    public function loadFaturarModal()
    {
        $this->valorTotal = $this->os->valorTotal();
        $this->dispatch('toggleFaturarModal');
    }

    public function render()
    {
        return view('livewire.financeiro.faturar-modal', [
            'os' => $this->os,
            'osValorTotal' => $this->valorTotal,
        ]);
    }
}
