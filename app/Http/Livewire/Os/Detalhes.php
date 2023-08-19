<?php

namespace App\Http\Livewire\Os;

use Livewire\Component;

class Detalhes extends Component
{

    public $os;

    public function render()
    {

        return view('livewire.os.detalhes', [
            'os' => $this->os
        ]);
    }
}
