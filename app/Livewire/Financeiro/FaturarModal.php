<?php

namespace App\Livewire\Financeiro;

use Google\Service\Sheets\BooleanRule;
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
            if ($this->checkChecklist()) {
                return view('livewire.financeiro.faturar-modal', [
                    'item' => $this->modelSelector(),
                    'itemValorTotal' => $this->valorTotal,
                    'tipo' => $this->typeSelector(),
                ]);
            } else {
                return view('livewire.financeiro.erro-faturar-modal', [
                    'item' => $this->modelSelector(),
                    'itemValorTotal' => $this->valorTotal,
                    'tipo' => $this->typeSelector(),
                ]);
            }
        }
        if ($this->typeSelector() === 'venda') {
            return view('livewire.financeiro.faturar-modal', [
                'item' => $this->modelSelector(),
                'itemValorTotal' => $this->valorTotal,
                'tipo' => $this->typeSelector(),
            ]);
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

    /**
     * Verifica se o checklist está preenchido e se é obrigatório.
     *
     * @return bool true para pode ser faturada, false pendente faturamento.
     **/
    private function checkChecklist()
    {
        $checklistRequired = $this->os->categoria->checklist_required;
        $checklistIsDone = $this->os->getHtmlChecklist()?->checklistIsDone();

        if ((($checklistRequired) && ($checklistIsDone)) || ($checklistRequired == false)) {
            return true;
        } else {
            return false;
        }
    }
}
