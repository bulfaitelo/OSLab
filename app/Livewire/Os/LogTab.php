<?php

namespace App\Livewire\Os;

use Livewire\Attributes\On;
use Livewire\Component;

class LogTab extends Component
{
    public $os;
    public $showDisplay;

    // protected $listeners = ['showLogTab'];

    #[On('showLogTab')]
    public function showLogTab()
    {
        $this->showDisplay = true;
    }

    public function render()
    {
        return view('livewire.os.log-tab', [
            'os' => $this->os,
            'showDisplay' => $this->showDisplay,
        ]);
    }
}
