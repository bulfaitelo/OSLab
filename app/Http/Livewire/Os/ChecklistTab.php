<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Http\Controllers\Checklist\ChecklistHtmlForm;

class ChecklistTab extends Component
{

    public $os_id;
    public $checklistForm;



    public function render()
    {
        $checklist = Os::find($this->os_id)->categoria->checklist;
        $html = new ChecklistHtmlForm;
        return view('livewire.os.checklist-tab', [
            'checklist'=> $checklist,
            'html' => $html,
        ]);
    }


    public function create(Request $request): void {
        dd($request->input());
    }
}
