<?php

namespace App\Http\Livewire\Os;

use Livewire\Component;

class LogTab extends Component
{

    public $os;
    public function render()
    {
        return view('livewire.os.log-tab', [
            'os' => $this->os
        ]);
    }
}
