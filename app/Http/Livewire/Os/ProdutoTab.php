<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use App\Models\Os\OsProduto;
use App\Models\Produto\Produto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use tidy;

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
        $this->updateProdutoQuantidadeEstoque();

        $this->quantidade = null;
        $this->valor_custo = null;
        $this->valor_venda = null;
        $this->produto_id = null;

        // pra apagar o produto
        session()->flash('clear', 'clear');
        flasher('Produto adicionado com sucesso.');

    }

    public function delete($id) {
        try {
            $osProduto = Os::findOrFail($this->os_id)->produtos()->find($id);
            $produto = Produto::find($osProduto->produto_id);
            dd($produto, $osProduto);

            $osProduto->delete();

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    private function createOsProduto($produto) : void {
        DB::beginTransaction();
        try {
            $produto['valor_custo_total'] = $produto['valor_custo'] * $produto['quantidade'];
            $produto['valor_venda_total'] = $produto['valor_venda'] * $produto['quantidade'];
            $produto['user_id'] = auth()->id();
            Os::find($this->os_id)->produtos()->create(
                $produto
            );
            // $this->updateProdutoQuantidadeEstoque();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function updateProdutoQuantidadeEstoque() : void {
        try {
            $produto = Produto::find($this->produto_id);
            $estoque = $produto->estoque;
            if ($produto->estoque >= $this->quantidade) {
                $produto->estoque = $produto->estoque - $this->quantidade;
                $produto->save();
                $this->insertSaidaMovimentacaoProduto($estoque, $this->quantidade);

            } else {
                $quantidadeEntrada = $this->quantidade - $produto->estoque;
                $this->insertEntradaMovimentacaoProduto($quantidadeEntrada);
                $this->insertSaidaMovimentacaoProduto($this->quantidade, $this->quantidade);
                $produto->estoque = 0;
                $produto->save();

                # é this por quant, a sobra e gerado uma entrada e depois uma saida do valor total da quantidade
            }


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function insertSaidaMovimentacaoProduto($estoque, $quantidade): void {
        try {
            $produto = Produto::find($this->produto_id);
            $produto->movimentacao()->create([
                'quantidade_movimentada' => $quantidade,
                'estoque_antes' => $estoque,
                'descricao' =>  'OS: #'. $this->os_id,
                'estoque_apos' => $estoque - $quantidade,
                'valor_custo' => $this->getValorCusto(),
                'os_id' => $this->os_id,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function insertEntradaMovimentacaoProduto($quantidade): void {
        try {
            $produto = Produto::find($this->produto_id);
            $produto->movimentacao()->create([
                'quantidade_movimentada' => $quantidade,
                'tipo_movimentacao' => 1,
                'descricao' =>  'OS: #'. $this->os_id,
                'estoque_antes' => $produto->estoque,
                'estoque_apos' => 0,
                'valor_custo' => $this->getValorCusto(),
                'os_id' => $this->os_id,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private  function getValorCusto()
    {
        return str_replace(',', '.', str_replace('.','', $this->valor_custo));
    }
}
