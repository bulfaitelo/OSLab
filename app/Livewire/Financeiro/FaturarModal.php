<?php

namespace App\Livewire\Financeiro;

use App\Models\Cliente\Cliente;
use Livewire\Component;

class FaturarModal extends Component
{
    public $os;

    public $venda;

    protected $listeners = ['faturarOs' => 'loadFaturarModal'];

    public $valorTotal;

    public function loadFaturarModal()
    {
        $this->valorTotal = $this->modelSelector()->valorTotal();
        $this->dispatch('toggleFaturarModal');
    }

    public function render()
    {
        if ($this->typeSelector() === 'os') {
            if ($this->modelSelector()->checkChecklist()) {
                return $this->returnView();
            } else {
                return view('livewire.financeiro.erro-checklist-faturar-modal', [
                    'item' => $this->modelSelector(),
                    'tipo' => $this->typeSelector(),
                ]);
            }
        }
        if ($this->typeSelector() === 'venda') {
            return $this->returnView();
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

    private function returnView()
    {
        $model = $this->modelSelector();
        $type = $this->typeSelector();

        if (! $model) {
            return view('livewire.financeiro.erro-valor-faturar-modal', [
                'item' => null,
                'tipo' => null,
            ]);
        }

        $this->valorTotal = $model->valorTotal(); // Certifique-se de que isso não está retornando null

        if ($this->valorTotal > 0) {
            $cliente = Cliente::find($model->cliente_id);

            return view('livewire.financeiro.faturar-modal', [
                'item' => $model,
                'itemValorTotal' => $this->valorTotal,
                'tipo' => $type,
                'debitosPendentes' => $cliente ? $cliente->hasPendingDebits() : false,
            ]);
        }

        return view('livewire.financeiro.erro-valor-faturar-modal', [
            'item' => $model,
            'tipo' => $type,
        ]);
    }
}
