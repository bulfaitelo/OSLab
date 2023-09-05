<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use Livewire\Component;

class ChecklistTab extends Component
{

    public $os_id;

    public function render()
    {
        $checklist = Os::find($this->os_id)->categoria->checklist;

        return view('livewire.os.checklist-tab', [
            'checklist'=> $checklist,
        ]);
    }
}
