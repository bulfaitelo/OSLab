<?php

namespace App\Livewire\Cliente;

use Livewire\Component;

class ShowCliente extends Component
{
    public $cliente;

    public $showTab = 'detalhes';
    public function render()
    {
        if ($this->showTab == 'detalhes') {
            return view('livewire.cliente.show-cliente', [
                'cliente' => $this->cliente,
                'showTab' => $this->showTab
            ]);
        } else if ($this->showTab == 'os') {
            return view('livewire.cliente.show-cliente-os', [
                'os' => $this->cliente->os,
                'showTab' => $this->showTab
            ]);
        }
    }

    public function tabChange($tab): void {
        $this->showTab = $tab;
    }
}
