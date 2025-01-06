<?php

namespace App\Livewire\Venda;

use Livewire\Component;

class DetalhesTab extends Component
{
    public $venda;
    public function render()
    {
        return view('livewire.venda.detalhes-tab', [
            'venda' => $this->venda,
        ]);
    }
}
