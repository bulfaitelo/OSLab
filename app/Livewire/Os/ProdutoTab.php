<?php

namespace App\Livewire\Os;


use App\Models\Produto\Produto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ProdutoTab extends Component
{

    public $os;
    public $valor_custo;
    public $valor_venda;
    public $quantidade;
    public $produto_id;


    protected function rules(): array {
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
        $os_produto = $this->os->produtos()->get();
        return view('livewire.os.produto-tab', [
            'os_produto' => $os_produto,
            'os' => $this->os
        ]);
    }

    /**
     * Carrega no componente os valores para os campos Custo, Valor e quantidade.
     */
    public function getProdutoData() : void {
        if ($produto = Produto::find($this->produto_id)) {
            $this->valor_custo = $produto->valor_custo;
            $this->valor_venda = $produto->valor_venda;
            $this->quantidade = 1;
        }
    }



    public function create() {
        $produto = $this->validate();
        if ($this->os->fatura_id) {
            // Apagando o produto digitado.
            $this->dispatch('clear');
            flash()->addError('Produto não pode ser adicionado a uma os Faturada.');
        } else {
            $this->createOsProduto($produto);
            $this->quantidade = null;
            $this->valor_custo = null;
            $this->valor_venda = null;
            $this->produto_id = null;
            // Apagando o produto digitado.
            $this->dispatch('clear');
            flasher('Produto adicionado com sucesso.');
        }
    }

    public function delete($id) {
        try {
            if ($this->os->fatura_id) {
                // Apagando o produto digitado.
                $this->dispatch('clear');
                flash()->addError('Produto não pode ser removido a uma os Faturada.');
            } else {
                $osProduto = $this->os->produtos()->findOrFail($id);
                $osProduto->delete();
                flasher('Produto removido com sucesso.');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    private function createOsProduto($produto) {

        DB::beginTransaction();
        try {
            $produto['valor_custo_total'] = $produto['valor_custo'] * $produto['quantidade'];
            $produto['valor_venda_total'] = $produto['valor_venda'] * $produto['quantidade'];
            $produto['user_id'] = auth()->id();
            $osProduto = $this->os->produtos();
            if ($osProdutoTemp = $osProduto->where('produto_id', $produto['produto_id'])->first()) {
                $osProdutoTemp->valor_custo = $produto['valor_custo'];
                $osProdutoTemp->valor_venda = $produto['valor_venda'];
                $osProdutoTemp->valor_custo_total = ($produto['valor_custo_total'] + ($produto['valor_custo_total'] * $osProdutoTemp->quantidade));
                $osProdutoTemp->valor_venda_total = ($produto['valor_venda_total'] + ($produto['valor_venda_total'] * $osProdutoTemp->quantidade));
                $osProdutoTemp->increment('quantidade', $produto['quantidade']);
                $osProdutoReturn = $osProdutoTemp->save();
            } else{
                $osProdutoReturn = $osProduto->create(
                    $produto
                );
            }
            // $this->updateProdutoQuantidadeEstoque();
            DB::commit();
            return $osProdutoReturn;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    // private function updateProdutoQuantidadeEstoque($osProdutoId) : void {
    //     try {
    //         $produto = Produto::find($this->produto_id);
    //         $estoque = $produto->estoque;
    //         if ($produto->estoque >= $this->quantidade) {
    //             $produto->estoque = $produto->estoque - $this->quantidade;
    //             $produto->save();
    //             $this->insertSaidaMovimentacaoProduto($estoque, $this->quantidade, $osProdutoId);

    //         } else {
    //             $quantidadeEntrada = $this->quantidade - $produto->estoque;
    //             $this->insertEntradaMovimentacaoProduto($quantidadeEntrada, $osProdutoId);
    //             $this->insertSaidaMovimentacaoProduto($this->quantidade, $this->quantidade, $osProdutoId);
    //             $produto->estoque = 0;
    //             $produto->save();

    //             # é this por quant, a sobra e gerado uma entrada e depois uma saida do valor total da quantidade
    //         }


    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

    // private function insertSaidaMovimentacaoProduto($estoque, $quantidade, $osProdutoId): void {
    //     try {
    //         $produto = Produto::find($this->produto_id);
    //         $produto->movimentacao()->create([
    //             'quantidade_movimentada' => $quantidade,
    //             'estoque_antes' => $estoque,
    //             'descricao' =>  'OS: #'. $this->os_id,
    //             'estoque_apos' => $estoque - $quantidade,
    //             'valor_custo' => $this->getValorCusto(),
    //             'os_id' => $this->os_id,
    //             'os_produto_id' => $osProdutoId,
    //         ]);
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

    // private function insertEntradaMovimentacaoProduto($quantidade, $osProdutoId): void {
    //     try {
    //         $produto = Produto::find($this->produto_id);
    //         $produto->movimentacao()->create([
    //             'quantidade_movimentada' => $quantidade,
    //             'tipo_movimentacao' => 1,
    //             'descricao' =>  'OS: #'. $this->os_id,
    //             'estoque_antes' => $produto->estoque,
    //             'estoque_apos' => 0,
    //             'valor_custo' => $this->getValorCusto(),
    //             'os_id' => $this->os_id,
    //             'os_produto_id' => $osProdutoId,
    //         ]);
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

    private  function getValorCusto()
    {
        return str_replace(',', '.', str_replace('.','', $this->valor_custo));
    }
}
