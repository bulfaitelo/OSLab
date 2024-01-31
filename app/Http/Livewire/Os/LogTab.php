<?php

namespace App\Http\Livewire\Os;

use Livewire\Component;

class LogTab extends Component
{

    public $os;
    public $showDisplay;

    protected $listeners = ['showLogTab'];

    public function showLogTab($display) {
        $this->showDisplay = $display;
    }
    public function render()
    {
        return view('livewire.os.log-tab', [
            'os' => $this->os,
            'showDisplay' => $this->showDisplay,
        ]);
    }
}
