<?php

namespace App\Http\Livewire\Os;

use App\Models\Produto\Produto;
use App\Models\User;
use Livewire\Component;

class Produtos extends Component
{

    protected $listeners = ['GetProdutoId'];

    public $valor_custo, $valor_venda, $quantidade, $produto_id;

    protected $rules = [
        'produto_id' => 'required',
        'valor_venda' => 'required',
        'valor_custo' => 'required',
        'quantidade' => 'required',
    ];

    public function GetProdutoId($selectedValue)
    {
        $produto = Produto::findOrFail($selectedValue);
        $this->valor_custo = $produto->valor_custo;
        $this->valor_venda = $produto->valor_venda;

    }

    function addProduto() {
        $teste = $this->validate();
        dd($teste);
    }

    public function render()
    {
        $users = User::limit(6)->get()->transform(fn($user) => [
            'id' => $user->id,
            'title' => $user->name,
            'subtitle' => $user->email
         ]);

        return view('livewire.os.produtos', [
           'valor_custo' => $this->valor_custo,
           'valor_venda' => $this->valor_venda,
           'users' => $users
        ]);
    }



}
