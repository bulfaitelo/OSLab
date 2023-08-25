<?php

namespace App\Http\Livewire\Os;

use App\Models\Os\Os;
use App\Models\Produto\Produto;
use App\Models\User;
use App\Rules\Os\ProdutoValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Produtos extends Component
{

    public $os;
    public $valor_custo, $valor_venda, $quantidade, $produto;

    function addProduto() {
        $osProduto = $this->validate([
            'produto' => ['required', new ProdutoValidation],
            'valor_custo' => 'required',
            'valor_venda' => 'required',
            'quantidade' => 'required|integer',
        ]);
        DB::beginTransaction();
        try {
            $osProduto['user_id'] = auth()->id();
            $osProduto['valor_custo'] = ($this->valor_custo) ? str_replace(',', '.', str_replace('.','', $this->valor_custo)) : null;
            $osProduto['valor_venda'] = ($this->valor_venda) ? str_replace(',', '.', str_replace('.','', $this->valor_venda)) : null;
            // se for numero só pegar o id caso não inserir no banco
            if ($this->checkTipeProduto($this->produto)) {
                $osProduto['produto_id'] = (int) $this->produto;
                unset($osProduto['produto']);
                $produto = Produto::find($osProduto['produto_id']);
                $produto->movimentacao()->create([
                    'quantidade_movimentada' => $this->quantidade,
                    'tipo_movimentacao' => 'SAÍDA na OS'. $this->os->id,
                    'valor_custo' => $osProduto['valor_custo'],
                    'estoque_antes' => $this->quantidade,
                    'estoque_apos' => 0,
                    'os_id' => $this->os->id,
                ]);
            } else {
                // Se não for eu crio o novo produto.
                $produto = new Produto();
                $produto->name = $this->produto;
                $produto->descricao = '';
                $produto->valor_custo = $osProduto['valor_custo'];
                $produto->valor_venda = $osProduto['valor_venda'];
                $produto->estoque = $this->quantidade;
                $produto->centro_custo_id = '5' ; // criar configuração pra isso.
                $produto->save();

                $produto->movimentacao()->createMany([
                    [
                        'quantidade_movimentada' => $this->quantidade,
                        'tipo_movimentacao' => 'ENTRADA na OS'. $this->os->id,
                        'valor_custo' => $osProduto['valor_custo'],
                        'estoque_antes' => 0,
                        'estoque_apos' => $this->quantidade,
                        'os_id' => $this->os->id,
                    ],
                    [
                        'quantidade_movimentada' => $this->quantidade,
                        'tipo_movimentacao' => 'SAÍDA na OS'. $this->os->id,
                        'valor_custo' => $osProduto['valor_custo'],
                        'estoque_antes' => $this->quantidade,
                        'estoque_apos' => 0,
                        'os_id' => $this->os->id,
                    ],
                ]);
                $osProduto['produto_id'] = $produto->id;
            }

            if ($this->quantidade > 1) {
                $osProduto['valor_custo_total'] = $osProduto['valor_custo'] * $this->quantidade;
                $osProduto['valor_venda_total'] = $osProduto['valor_venda'] * $this->quantidade;
            } else {
                $osProduto['valor_custo_total'] = $osProduto['valor_custo'];
                $osProduto['valor_venda_total'] = $osProduto['valor_venda'] ;
            }


            // dd($osProduto);
            $this->os->produtos()->create(
                $osProduto
            );

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }


    }



    public function render()
    {
        if ($produto = Produto::find($this->produto)) {
            $this->valor_custo = $produto->valor_custo;
            $this->valor_venda = $produto->valor_venda;
        }

        return view('livewire.os.produtos', [
            'valor_custo' => $this->valor_custo,
            'valor_venda' => $this->valor_venda,
            'produtos' => $this->os->produtos,
        ]);
    }


    private function checkTipeProduto($produto) {
        return is_numeric($produto);
    }


}
