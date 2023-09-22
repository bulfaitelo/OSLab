<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use App\Models\Os\OsServico;
use App\Models\Servico\Servico;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ServicoTab extends Component
{

    public $os_id;
    public $valor_servico;
    public $servico_id;
    public $quantidade;

    protected function rules() {
        return [
            'servico_id' => 'required|exists:servicos,id',
            'quantidade' => 'required|numeric|min:0|not_in:0',
            'valor_servico' => 'required|numeric|min:0|not_in:0',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation($attributes) {
        $attributes['valor_servico'] = str_replace(',', '.', str_replace('.','', $attributes['valor_servico']));
        return $attributes;
    }

    public function render()
    {
        if ($servico = Servico::find($this->servico_id)) {
            $this->valor_servico = $servico->valor_servico;
            $this->quantidade = 1;
        }
        $os_servico = Os::find($this->os_id)->servicos;

        return view('livewire.os.servico-tab', [
            'os_servico' => $os_servico
        ]);
    }

    public function create(): void {
        $servico = $this->validate();
        $this->createOsServico($servico);

        $this->quantidade = null;
        $this->valor_servico = null;
        $this->servico_id = null;

        // Apagando o serviço digitado.
        $this->dispatchBrowserEvent('clear');
        flasher('Serviço adicionado com sucesso.');
    }


    public function delete($id) {
        try {
            $osServico = Os::findOrFail($this->os_id)->servicos()->find($id);
            $osServico->delete();
            flasher('Serviço removido com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function createOsServico($servico) : object {
        DB::beginTransaction();
        try {
            $servico['valor_servico_total'] = $servico['valor_servico'] * $servico['quantidade'];
            $servico['user_id'] = auth()->id();
            $osServico = Os::find($this->os_id)->servicos()->create(
                $servico
            );

            DB::commit();
            return $osServico;
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
