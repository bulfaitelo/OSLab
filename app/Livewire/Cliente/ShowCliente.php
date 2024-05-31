<?php

namespace App\Livewire\Cliente;

use Livewire\Component;

class ShowCliente extends Component
{
    public $cliente;
    public function render()
    {
        return view('livewire.cliente.show-cliente', [
            'cliente' => $this->cliente
        ]);
    }
}
