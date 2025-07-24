<?php

namespace App\Livewire\Financeiro;

use App\Models\Configuracao\Parametro\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddPagamentoModal extends Component
{
    public $os;

    public $venda;

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
        // dd($this->modelSelector()->contas->where('tipo', 'R'));
        $this->dispatch('toggleAddPagamentoModal');
    }

    public function mount()
    {
        $this->data_pagamento = now()->format('Y-m-d');
    }

    public function render()
    {
        $conta = $this->modelSelector()->contas()->where('tipo', 'R')->first();
        $pagamentos = $conta?->pagamentos()->with('formaPagamento')->get();

        return view('livewire.financeiro.add-pagamento-modal', [
            'item' => $this->modelSelector(),
            'quitada' => $this->modelSelector()->quitada(),
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
        if ($this->modelSelector()->quitada()) {
            flash()->error('a OS ja foi Quitada!');

            return;
        }
        $conta = $this->modelSelector()->contas()->where('tipo', 'R')->first();
        $parcela = $conta->pagamentos()->latest()->first()?->parcela;
        DB::beginTransaction();
        try {
            $pagamento = [
                'forma_pagamento_id' => $this->forma_pagamento_id,
                'user_id' => Auth::id(),
                'valor' => $pagamentoRequest['pagamento_valor'],
                'vencimento' => $pagamentoRequest['data_pagamento'],
                'data_pagamento' => $pagamentoRequest['data_pagamento'],
                'parcela' => ((! $parcela) ? 0 : $parcela) + 1,
            ];
            $conta->pagamentos()->create($pagamento);
            if ($conta->parcelas < $conta->pagamentos->count()) {
                $conta->parcelas = $conta->parcelas + 1;
            }
            if ($conta->pagamentos->sum('valor') >= $conta->valor) {
                $conta->data_quitacao = $pagamentoRequest['data_pagamento'];
                if (getConfig('default_'.$this->typeSelector().'_faturar_pagto_quitado') != '') {
                    $this->modelSelector()->status_id = getConfig('default_'.$this->typeSelector().'_faturar_pagto_quitado');
                    $this->modelSelector()->save();
                }
            } else {
                if (getConfig('default_'.$this->typeSelector().'_faturar_pagto_parcial') != '') {
                    $this->modelSelector()->status_id = getConfig('default_'.$this->typeSelector().'_faturar_pagto_parcial');
                    $this->modelSelector()->save();
                }
            }
            $conta->save();
            $this->pagamento_valor = null;
            $this->data_pagamento = now()->format('Y-m-d');
            $this->forma_pagamento_id = null;
            DB::commit();
            self::disparaMensagemPosPagamento();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Função para notificar após pagamento, caso a os esteja finalizada também fecha a modal.
     */
    protected function disparaMensagemPosPagamento(): void
    {
        if ($this->modelSelector()->quitada()) {
            $this->dispatch('toggleAddPagamentoModal');
            if ($this->typeSelector() === 'os') {
                flash('Pagamento adicionado com sucesso, o status da Ordem de Serviço foi alterado para '.Status::find($this->modelSelector()->status_id)->name.'!');
            }
            if ($this->typeSelector() === 'venda') {
                flash('Pagamento adicionado com sucesso, o status da Venda foi alterado para '.Status::find($this->modelSelector()->status_id)->name.'!');
            }
        } else {
            flash('Pagamento adicionado com sucesso.');
        }
    }

    /**
     * Retorna o modelo com base no que é previamente passado no componente.
     *
     * @return mixed
     */
    private function modelSelector()
    {
        return $this->os ?: $this->venda ?: null;
    }

    /**
     * Retorna o tipo de requisição.
     *
     * Se é uma Venda ou uma Os
     */
    private function typeSelector(): string
    {
        return $this->os ? 'os' : ($this->venda ? 'venda' : 'desconhecido');
    }
}
