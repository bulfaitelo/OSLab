<?php

namespace App\Http\Livewire\Os;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddPagamentoModal extends Component
{

    public $os;
    public $valor_pagamento, $data_pagamento, $forma_pagamento_id;

    protected $listeners = ['adicionarPagamento' => 'loadAdicionarPagamento'];

    /**
     * Rules
     */
    protected function rules() : array {
        return [
            'valor_pagamento' => 'required|numeric|min:0|not_in:0',
            'data_pagamento' => 'required|date',
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',

        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation($attributes) {
        $attributes['valor_pagamento'] = str_replace(',', '.', str_replace('.','', $attributes['valor_pagamento']));
        return $attributes;
    }


    /**
     * Carrega Model de Adicionar Pagamento
     */
    function loadAdicionarPagamento(){
        // dd($this->os->contas->where('tipo', 'R'));
        $this->emit('toggleAddPagamentoModal');
    }

    public function render()
    {
        $conta = $this->os->contas()->where('tipo', 'R')->first();
        return view('livewire.os.add-pagamento-modal', [
            'os' => $this->os,
            'conta' => $conta,
        ]);
    }

    /**
     * Método para adicionar pagamento a receita relacionada a Os
     */
    function pagamentoCreate() : void {
        $pagamentoRequest = $this->validate();
        $conta = $this->os->contas()->where('tipo', 'R')->first();
        $parcela = $conta->pagamentos()->latest()->first()?->parcela;
        DB::beginTransaction();
        try {
            $pagamento =  [
                'forma_pagamento_id' => $this->forma_pagamento_id,
                'user_id' => auth()->id(),
                'valor' => $pagamentoRequest['valor_pagamento'],
                'vencimento' =>  $pagamentoRequest['data_pagamento'],
                'data_pagamento' => $pagamentoRequest['data_pagamento'],
                'parcela' => ((!$parcela) ? 0 : $parcela) + 1,
            ];
            $conta->pagamentos()->create($pagamento);
            if ($conta->parcelas < $conta->pagamentos->count()) {
                $conta->parcelas = $conta->parcelas + 1;
            }
            if (($conta->pagamentos->sum('valor') + $pagamentoRequest['valor_pagamento']) >= $conta->valor) {
                $conta->data_quitacao = $pagamentoRequest['data_pagamento'];
                if (getConfig('default_os_faturar_pagto_quitado') != '') {
                    $this->os->status_id =  getConfig('default_os_faturar_pagto_quitado');
                    $this->os->save();
                }
            }
            $conta->save();
            $this->valor_pagamento = null;
            $this->data_pagamento = null;
            $this->forma_pagamento_id = null;
            DB::commit();
            flasher('Pagamento adicionado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}
