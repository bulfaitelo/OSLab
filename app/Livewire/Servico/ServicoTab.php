<?php

namespace App\Livewire\Servico;

use App\Models\Os\Os;
use App\Models\Servico\Servico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ServicoTab extends Component
{
    public $os;
    public $valor_servico;
    public $servico_id;
    public $quantidade;

    protected function rules()
    {
        return [
            'servico_id' => 'required|exists:servicos,id',
            'quantidade' => 'required|numeric|min:0|not_in:0',
            'valor_servico' => 'required|numeric|min:0|not_in:0',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation($attributes)
    {
        $attributes['valor_servico'] = str_replace(',', '.', str_replace('.', '', $attributes['valor_servico']));

        return $attributes;
    }

    public function render()
    {
        $os_servico = $this->os->servicos()->get();

        return view('livewire.servico.servico-tab', [
            'os_servico' => $os_servico,
        ]);
    }

    /**
     * Carrega no componente os valores para os campos Valor e quantidade.
     */
    public function getServicoData(): void
    {
        if ($servico = Servico::find($this->servico_id)) {
            $this->valor_servico = $servico->valor_servico;
            $this->quantidade = 1;
        }
    }

    public function create(): void
    {
        $servico = $this->validate();
        if ($this->os->conta_id) {
            // Apagando o produto digitado.
            $this->dispatch('clear');
            flash()->addError('Serviço não pode ser adicionado a uma os Faturada.');
        } else {
            $this->createOsServico($servico);

            $this->quantidade = null;
            $this->valor_servico = null;
            $this->servico_id = null;

            // Apagando o serviço digitado.
            $this->dispatch('clear');
            flasher('Serviço adicionado com sucesso.');
        }
    }

    public function delete($id)
    {
        try {
            if ($this->os->conta_id) {
                // Apagando o produto digitado.
                $this->dispatch('clear');
                flash()->addError('Serviço não pode ser apagado a uma os Faturada.');
            } else {
                $osServico = $this->os->servicos()->find($id);
                $osServico->delete();
                flasher('Serviço removido com sucesso.');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function createOsServico($servico): object
    {
        DB::beginTransaction();
        try {
            $servico['valor_servico_total'] = $servico['valor_servico'] * $servico['quantidade'];
            $servico['user_id'] = Auth::id();
            $osServico = $this->os->servicos()->create(
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
