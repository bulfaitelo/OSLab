<?php

namespace App\Livewire\Os;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddPagamentoModal extends Component
{
    public $os;
    public $pagamento_valor;
    public $data_pagamento;
    public $forma_pagamento_id;
    protected $listeners = ['adicionarPagamento' => 'loadAdicionarPagamento'];

    /**
     * Rules.
     */
    protected function rules(): array
    {
        return [
            'pagamento_valor' => 'required|numeric|min:0|not_in:0',
            'data_pagamento' => 'required|date',
            'forma_pagamento_id' => 'required|exists:forma_pagamentos,id',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation($attributes)
    {
        $attributes['pagamento_valor'] = str_replace(',', '.', str_replace('.', '', $attributes['pagamento_valor']));

        return $attributes;
    }

    /**
     * Carrega Model de Adicionar Pagamento.
     */
    public function loadAdicionarPagamento()
    {
        // dd($this->os->contas->where('tipo', 'R'));
        $this->dispatch('toggleAddPagamentoModal');
    }

    public function mount()
    {
        $this->data_pagamento = now()->format('Y-m-d');
    }

    public function render()
    {
        $conta = $this->os->contas()->where('tipo', 'R')->first();
        $pagamentos = $conta?->pagamentos()->with('formaPagamento')->get();

        return view('livewire.os.add-pagamento-modal', [
            'os' => $this->os,
            'osQuitada' => $this->os->osQuitada(),
            'conta' => $conta,
            'pagamentos' => $pagamentos,
        ]);
    }

    /**
     * Método para adicionar pagamento a receita relacionada a Os.
     */
    public function pagamentoCreate(): void
    {
        $pagamentoRequest = $this->validate();
        if ($this->os->osQuitada()) {
            flash()->addError('a OS ja foi Quitada!');

            return;
        }
        $conta = $this->os->contas()->where('tipo', 'R')->first();
        $parcela = $conta->pagamentos()->latest()->first()?->parcela;
        DB::beginTransaction();
        try {
            $pagamento = [
                'forma_pagamento_id' => $this->forma_pagamento_id,
                'user_id' => auth()->id(),
                'valor' => $pagamentoRequest['pagamento_valor'],
                'vencimento' => $pagamentoRequest['data_pagamento'],
                'data_pagamento' => $pagamentoRequest['data_pagamento'],
                'parcela' => ((! $parcela) ? 0 : $parcela) + 1,
            ];
            $conta->pagamentos()->create($pagamento);
            if ($conta->parcelas < $conta->pagamentos->count()) {
                $conta->parcelas = $conta->parcelas + 1;
            }
            if (($conta->pagamentos->sum('valor') + $pagamentoRequest['pagamento_valor']) >= $conta->valor) {
                $conta->data_quitacao = $pagamentoRequest['data_pagamento'];
                if (getConfig('default_os_faturar_pagto_quitado') != '') {
                    $this->os->status_id = getConfig('default_os_faturar_pagto_quitado');
                    $this->os->save();
                }
            }
            $conta->save();
            $this->pagamento_valor = null;
            $this->data_pagamento = now()->format('Y-m-d');
            $this->forma_pagamento_id = null;
            DB::commit();
            flasher('Pagamento adicionado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
