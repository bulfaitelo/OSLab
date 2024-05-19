<?php

namespace App\Livewire\Os;

use Livewire\Component;

class DetalhesTab extends Component
{

    public $os;

    public function render()
    {
        return view('livewire.os.detalhes-tab', [
            'os' => $this->os
        ]);
    }
}
