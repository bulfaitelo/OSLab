<?php

namespace App\Livewire\Produto;

use App\Models\Produto\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProdutoTab extends Component
{
    public $os;

    public $venda;

    public $valor_custo;

    public $valor_venda;

    public $quantidade;

    public $produto_id;

    protected function rules(): array
    {
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
    protected function prepareForValidation($attributes)
    {
        $attributes['valor_custo'] = str_replace(',', '.', str_replace('.', '', $attributes['valor_custo']));
        $attributes['valor_venda'] = str_replace(',', '.', str_replace('.', '', $attributes['valor_venda']));

        return $attributes;
    }

    public function render()
    {
        return view('livewire.produto.produto-tab', [
            'produto' => $this->modelSelector()->produtos()->get(),
            'conta_id' => $this->modelSelector()->conta_id,
        ]);
    }

    /**
     * Carrega no componente os valores para os campos Custo, Valor e quantidade.
     */
    public function getProdutoData(): void
    {
        if ($produto = Produto::find($this->produto_id)) {
            $this->valor_custo = $produto->valor_custo;
            $this->valor_venda = $produto->valor_venda;
            $this->quantidade = 1;
        }
    }

    public function create()
    {
        $produto = $this->validate();

        if ($this->modelSelector()->conta_id) {
            // Apagando o produto digitado.
            $this->dispatch('clear');
            flash()->error('Produto não pode ser adicionado se Faturado.');
        } else {
            $this->createItemProduto($produto);
            $this->quantidade = null;
            $this->valor_custo = null;
            $this->valor_venda = null;
            $this->produto_id = null;
            // Apagando o produto digitado.
            $this->dispatch('clear');
            flash('Produto adicionado com sucesso.');
        }
    }

    public function delete($id)
    {
        try {
            if ($this->modelSelector()->conta_id) {
                // Apagando o produto digitado.
                $this->dispatch('clear');
                flash()->error('Produto não pode ser removido se Faturado.');
            } else {
                $itemProduto = $this->modelSelector()->produtos()->findOrFail($id);
                $itemProduto->delete();
                flash('Produto removido com sucesso.');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function createItemProduto($produto)
    {
        DB::beginTransaction();
        try {
            $produto['valor_custo_total'] = $produto['valor_custo'] * $produto['quantidade'];
            $produto['valor_venda_total'] = $produto['valor_venda'] * $produto['quantidade'];
            $produto['user_id'] = Auth::id();
            $itemProduto = $this->modelSelector()->produtos();
            $itemProdutoReturn = $itemProduto->create(
                $produto
            );

            DB::commit();

            return $itemProdutoReturn;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
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
}
