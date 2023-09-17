<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Js;
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
        // $this->getValuesOsChecklist($os);
        return view('livewire.os.checklist-tab', [
            'os' => $os,
            'checklist'=> $checklist,
        ]);
    }


    public function submit($formData): void {
        DB::beginTransaction();
        try {
            parse_str($formData, $dataArray);

            $os = Os::find($this->os_id);
            foreach ($dataArray as $key => $value) {
                $checklistFormData[$key]['name'] = $key;
                $checklistFormData[$key]['value'] = $this->prepareDataValue($key, $value);
                $checklistFormData[$key]['user_id'] = auth()->id();
                $checklistFormData[$key]['checklist_id'] = $os->categoria->checklist_id;
            }
            // dd($checklistFormData);
            $os->checklist()->delete();
            $os->checklist()->createMany($checklistFormData);
            DB::commit();
            flasher('Checklist atualizado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }

    /**
     * Prepara os dados para serem salvos.
     *
     * @param string $key nome do campo.
     * @param string,array  $value valor do campo.
     * @return string json tratado.
     */
    private function prepareDataValue($key, $value)  {


        if ((strpos($key, 'checkbox-group') !== false) || (strpos($key,'radio-group') !== false)) {
            if (!in_array('other', $value)) {
                unset($value['-other-value']);
            }
        }
        return json_encode($value);

    }




}
