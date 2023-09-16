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
        $this->getValuesOsChecklist($os);
        return view('livewire.os.checklist-tab', [
            'os' => $os,
            'checklist'=> $checklist,
        ]);
    }


    public function create(Request $request): void {
        dd(json_encode($this->form['radio-group-1694520209244-0']));
    }


    private function getValuesOsChecklist($os)  {
        $checklist = $os->categoria->checklist;
        $opcoes = json_decode($checklist->checklist);
        foreach ($opcoes as $key => $value) {
            if (property_exists($value,'value')) {
                if ($osValue = $os->checklist()->where('name', $value->name)->first()) {
                    $this->form[$value->name] = $osValue->resposta;
                } else {
                    $this->form[$value->name] = $value->value;
                }
            }
        }
    }




}
