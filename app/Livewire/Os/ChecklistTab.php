<?php

namespace App\Livewire\Os;

use App\Models\Os\Os;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class ChecklistTab extends Component
{

    public $os;
    public $checklistForm;
    public $form ;



    public function render()
    {

        $checklist = $this->os->categoria->checklist;
        // $this->getValuesOsChecklist($os);
        return view('livewire.os.checklist-tab', [
            'os' => $this->os,
            'checklist'=> $checklist,
        ]);
    }


    public function submit($formData): void {
        DB::beginTransaction();
        try {
            parse_str($formData, $dataArray);


            foreach ($dataArray as $key => $value) {
                $checklistFormData[$key]['name'] = $key;
                $checklistFormData[$key]['value'] = $this->prepareDataValue($key, $value);
                $checklistFormData[$key]['user_id'] = auth()->id();
                $checklistFormData[$key]['checklist_id'] = $this->os->categoria->checklist_id;
            }
            // dd($checklistFormData);
            $this->os->checklist()->delete();
            $this->os->checklist()->createMany($checklistFormData);
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
