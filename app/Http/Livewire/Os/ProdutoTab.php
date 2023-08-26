<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use App\Models\Produto\Produto;
use Livewire\Component;

class ProdutoTab extends Component
{

    public $valor_custo;
    public $valor_venda;
    public $quantidade;
    public $produto_id;
    public $os_id;


    protected function rules() : array {
        return [
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|numeric|min:0|not_in:0',
            'valor_custo' => 'required|numeric|min:0|not_in:0',
            'valor_venda' => 'required|numeric|min:0|not_in:0',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation($attributes) {
        $attributes['valor_custo'] = str_replace(',', '.', str_replace('.','', $attributes['valor_custo']));
        $attributes['valor_venda'] = str_replace(',', '.', str_replace('.','', $attributes['valor_venda']));
        return $attributes;
    }


    public function render()
    {
        if ($produto = Produto::find($this->produto_id)) {
            $this->valor_custo = $produto->valor_custo;
            $this->valor_venda = $produto->valor_venda;
        }
        $os_produto = Os::find($this->os_id)->produtos;
        return view('livewire.os.produto-tab', [
            'os_produto' => $os_produto
        ]);
    }



    public function create() {
        $produto = $this->validate();

        $this->createOsProduto($produto);



    }


    public function createOsProduto($produto) {
        // $produtoData = Produto::find($produto['produto_id']);
        $produto['valor_custo_total'] = $produto['valor_custo'] * $produto['quantidade'];
        $produto['valor_venda_total'] = $produto['valor_venda'] * $produto['quantidade'];
        $produto['user_id'] = auth()->id();
        // dd($produto);
        Os::find($this->os_id)->produtos()->create(
            $produto
        );
    }
}
