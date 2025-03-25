<?php

namespace App\Livewire\Financeiro;

use Livewire\Attributes\On;
use Livewire\Component;

class BalanceteTab extends Component
{
    public $os;

    public $venda;

    public $showDisplay;

    #[On('showBalanceteTab')]
    public function showBalanceteTab()
    {
        $this->showDisplay = true;
    }

    public function render()
    {
        return view('livewire.financeiro.balancete-tab', [
            'balancete' => $this->modelSelector()->balancete(),
        ]);
    }

    /**
     * Retorna o modelo com base no que é previamente passado no componente.
     *
     * @return mixed
     */
    private function modelSelector()
    {
        return $this->os ?: $this->venda ?: null;
    }
}
