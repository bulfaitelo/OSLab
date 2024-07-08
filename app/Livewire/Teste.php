<?php

namespace App\Livewire;

use App\Models\Configuracao\Financeiro\FormaPagamento;
use Livewire\Component;

class Teste extends Component
{
    public $texto;
    public $descricao;

    public function render()
    {
        $collection = FormaPagamento::get();

        return view('livewire.teste', [
            'collection' => $collection,
            'texto' => $this->texto,
            'descricao' => $this->texto,
        ]);
    }

    public function addTexto()
    {
        $formaPagamento = new FormaPagamento();
        $formaPagamento->name = $this->texto;
        $formaPagamento->descricao = $this->descricao;
        $formaPagamento->save();
    }
}
