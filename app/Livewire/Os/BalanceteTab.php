<?php

namespace App\Livewire\Os;

use Livewire\Component;

class BalanceteTab extends Component
{

    public $os;
    public $showDisplay;

    protected $listeners = ['showBalanceteTab'];

    public function showBalanceteTab($display) {
        $this->showDisplay = $display;
    }

    public function render()
    {
        return view('livewire.os.balancete-tab', [
            'balancete' => $this->os->balancete()     
        ]);
    }
}
