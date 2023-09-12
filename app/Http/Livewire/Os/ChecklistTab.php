<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use Illuminate\Http\Request;
use Livewire\Component;


class ChecklistTab extends Component
{

    public $os_id;
    public $checklistForm;
    public $form ;



    public function render()
    {
        $os = Os::find($this->os_id);
        $checklist = $os->categoria->checklist;

        return view('livewire.os.checklist-tab', [
            'os' => $os,
            'checklist'=> $checklist,
        ]);
    }


    public function create(Request $request): void {
        dd($this->form);
    }
}
