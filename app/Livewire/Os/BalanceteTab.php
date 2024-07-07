<?php

namespace App\Livewire\Os;

use Livewire\Attributes\On;
use Livewire\Component;

class BalanceteTab extends Component
{
    public $os;
    public $showDisplay;

    #[On('showBalanceteTab')]
    public function showBalanceteTab()
    {
        $this->showDisplay = true;
    }

    public function render()
    {
        return view('livewire.os.balancete-tab', [
            'balancete' => $this->os->balancete(),
        ]);
    }
}
