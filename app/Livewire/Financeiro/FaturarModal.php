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
        if ($this->os) {
            return $this->os;
        }
        if ($this->venda) {
            return $this->venda;
        }
    }

    /**
     * Retorna o tipo de requisição.
     *
     * Se é uma Venda ou uma Os
     *
     * @return mixed
     */
    private function typeSelector()
    {
        if ($this->os) {
            return 'os';
        }
        if ($this->venda) {
            return 'venda';
        }
    }

    private function returnView()
    {
        if ($this->valorTotal > 0) {
            return view('livewire.financeiro.faturar-modal', [
                'item' => $this->modelSelector(),
                'itemValorTotal' => $this->valorTotal,
                'tipo' => $this->typeSelector(),
                'debitosPendentes' => Cliente::find($this->modelSelector()->cliente_id)->hasPendingDebits(),
            ]);
        }

        return view('livewire.financeiro.erro-valor-faturar-modal', [
            'item' => $this->modelSelector(),
            'tipo' => $this->typeSelector(),
        ]);
    }
}
