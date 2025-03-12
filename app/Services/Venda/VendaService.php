<?php

namespace App\Services\Venda;

use App\Contracts\Services\Venda\VendaServiceInterface;
use App\Models\Configuracao\Garantia\Garantia;
use App\Models\Produto\Produto;
use App\Models\Venda\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Classe de serviço de Venda.
 */
class VendaService implements VendaServiceInterface
{
    public function __construct(

    ) {}

    /**
     * Retorna o objeto pra modelagem da tabela de Venda.
     *
     * @param  Request  $request  default null
     * @param  int  $itensPorPagina  default 100
     * @param  string  $colunaOrdenacao  default null
     * @param  string  $ordenacao  default desc
     */
    public static function getDataTable(Request $request, int $itensPorPagina = 100, $colunaOrdenacao = null, $ordenacao = 'desc')
    {
        $dataHoje = Carbon::now()->format('Y-d-m');
        $vendaListagemPadrao = getConfig('venda_listagem_padrao');

        $queryVenda = Venda::with(['cliente', 'vendedor']);

        if ($request->busca) {
            $queryVenda->where(function ($query) use ($request) {
                $query->whereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
                $query->orWhere('descricao', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('id', $request->busca);
            });
        }
        if ($request->data_inicial || $request->data_final) {
            ($request->data_inicial) ? $dataInicial = $request->data_inicial : $dataInicial = $dataHoje;
            ($request->data_final) ? $dataFinal = $request->data_final : $dataFinal = $dataHoje;
            $queryVenda->where(function ($query) use ($dataInicial, $dataFinal) {
                $query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_entrada', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_saida', [$dataInicial, $dataFinal]);
            });
        }
        if ($request->status_id) {
            $queryVenda->where('status_id', $request->status_id);
        }
        if (! $request->input()) {
            if ($vendaListagemPadrao) {
                $queryVenda->whereIn('status_id', $vendaListagemPadrao);
            }
        }
        if ($colunaOrdenacao) {
            $queryVenda->orderBy($colunaOrdenacao, $ordenacao);
        } else {
            $queryVenda->orderBy('id', 'desc');
        }

        return $queryVenda->paginate($itensPorPagina);
    }

    public function store(Request $request): Venda
    {
        DB::beginTransaction();
        try {
            $venda = new Venda;
            $venda->user_id = Auth::id();
            $venda->cliente_id = $request->cliente_id;
            $venda->vendedor_id = $request->vendedor_id;
            $venda->status_id = $request->status_id;
            $venda->data_saida = $request->data_saida;
            $venda->termo_garantia_id = $request->termo_garantia_id;
            $venda->descricao = $request->descricao;
            $venda->save();
            DB::commit();

            return $venda;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(Request $request, Venda $venda): Venda
    {
        DB::beginTransaction();
        try {
            $venda->user_id = Auth::id();
            $venda->cliente_id = $request->cliente_id;
            $venda->vendedor_id = $request->vendedor_id;
            $venda->status_id = $request->status_id;
            $venda->data_saida = $request->data_saida;
            $venda->termo_garantia_id = $request->termo_garantia_id;
            $venda->descricao = $request->descricao;
            if (isset($request->data_saida)) {
                $venda->prazo_garantia = $this->addDayGarantia($request->data_saida, $request->termo_garantia_id);
            } else {
                $venda->prazo_garantia = null;
            }
            $venda->save();
            DB::commit();

            return $venda;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(Venda $venda): bool
    {
        try {
            return $venda->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     *  Fatura a Venda.
     *
     * @param  Venda  $venda  venda
     */
    public function faturar(Request $request, Venda $venda): Venda
    {
        DB::beginTransaction();
        try {
            // Gerando despesas Referente a produtos.
            // Gerando atualizações de estoque .
            foreach ($venda->produtos as $vendaProduto) {
                // Adicionando despesa,
                $venda->contas()->create([
                    'tipo' => 'D',
                    'name' => 'Venda: #'.$venda->id.', Prod.:'.$vendaProduto->produto->name.', Qtd.: '.$vendaProduto->quantidade,
                    'venda_id' => $venda->id,
                    'user_id' => Auth::id(),
                    'centro_custo_id' => $vendaProduto->produto->centro_custo_id,
                    'cliente_id' => $venda->cliente_id,
                    'valor' => $vendaProduto->valor_custo_total,
                    'data_quitacao' => $request->data_entrada,
                    'parcelas' => 1,
                ])->pagamentos()->create([
                    'forma_pagamento_id' => getConfig('default_venda_faturar_produto_despesa'),
                    'user_id' => Auth::id(),
                    'valor' => $vendaProduto->valor_custo_total,
                    'vencimento' => $request->data_entrada,
                    'data_pagamento' => $request->data_entrada,
                    'parcela' => 1,
                ]);

                // Adicionando movimentação de estoque
                $produto = Produto::find($vendaProduto->produto->id);
                // Com estoque
                if ($produto->estoque >= $vendaProduto->quantidade) {
                    $produto->estoque = ($produto->estoque - $vendaProduto->quantidade);
                    $produto->save();
                    $produto->movimentacao()->create([
                        'quantidade_movimentada' => $vendaProduto->quantidade,
                        'tipo_movimentacao' => 0,
                        'valor_custo' => $vendaProduto->valor_custo,
                        'estoque_antes' => ($produto->estoque + $vendaProduto->quantidade),
                        'estoque_apos' => $produto->estoque,
                        'venda_id' => $venda->id,
                        'venda_produto_id' => $vendaProduto->id,
                        'descricao' => 'Venda Nº: #'.$venda->id,
                    ]);
                } else {
                    // Sem estoque
                    $entrada = (-1 * ($produto->estoque - $vendaProduto->quantidade));
                    $produto->movimentacao()->create([
                        'quantidade_movimentada' => $entrada,
                        'tipo_movimentacao' => 1,
                        'valor_custo' => $vendaProduto->valor_custo,
                        'estoque_antes' => $produto->estoque,
                        'estoque_apos' => ($produto->estoque + $entrada),
                        'venda_id' => $venda->id,
                        'venda_produto_id' => $vendaProduto->id,
                        'descricao' => 'Venda Nº: #'.$venda->id,
                    ]);
                    $produto->movimentacao()->create([
                        'quantidade_movimentada' => $vendaProduto->quantidade,
                        'tipo_movimentacao' => 0,
                        'valor_custo' => $vendaProduto->valor_custo,
                        'estoque_antes' => ($produto->estoque + $vendaProduto->quantidade),
                        'estoque_apos' => $produto->estoque,
                        'venda_id' => $venda->id,
                        'venda_produto_id' => $vendaProduto->id,
                        'descricao' => 'Venda Nº: #'.$venda->id,
                    ]);
                    $produto->estoque = 0;
                    $produto->valor_custo = $vendaProduto->valor_custo;
                    $produto->valor_venda = $vendaProduto->valor_venda;
                    $produto->save();
                }
            }

            // Adicionando receita
            // com pagamento recebido
            if ($request->recebido) {
                if ($venda->valorTotal() <= $request->valor_recebido) {
                    $dataQuitacao = $request->data_recebimento;
                } else {
                    $dataQuitacao = null;
                }
                $conta = $venda->contas()->create([
                    'tipo' => 'R',
                    'name' => 'Venda Nº: #'.$venda->id,
                    'venda_id' => $venda->id,
                    'user_id' => Auth::id(),
                    'centro_custo_id' => $request->centro_custo_id,
                    'cliente_id' => $venda->cliente_id,
                    'valor' => $venda->valorTotal(),
                    'data_quitacao' => $dataQuitacao,
                    'parcelas' => 1,
                ])->pagamentos()->create([
                    'forma_pagamento_id' => getConfig('default_venda_faturar_produto_despesa'),
                    'user_id' => Auth::id(),
                    'valor' => $request->valor_recebido,
                    'vencimento' => $request->data_entrada,
                    'data_pagamento' => $request->data_recebimento,
                    'parcela' => 1,
                ]);
                $conta_id = $conta->conta_id;
            } else {
                // Sem pagamento
                $conta = $venda->contas()->create([
                    'tipo' => 'R',
                    'name' => 'Venda Nº: #'.$venda->id,
                    'venda_id' => $venda->id,
                    'user_id' => Auth::id(),
                    'centro_custo_id' => $request->centro_custo_id,
                    'cliente_id' => $venda->cliente_id,
                    'valor' => $venda->valorTotal(),
                    'parcelas' => 1,
                ]);
                $conta_id = $conta->id;
            }

            if (isset($dataQuitacao) && ! empty($dataQuitacao)) {
                if (getConfig('default_venda_faturar_pagto_quitado') != '') {
                    $venda->status_id = getConfig('default_venda_faturar_pagto_quitado');
                }
            } else {
                if (! $request->recebido) {
                    if (getConfig('default_venda_faturar') != '') {
                        $venda->status_id = getConfig('default_venda_faturar');
                    }
                } elseif (getConfig('default_venda_faturar_pagto_parcial') != '') {
                    $venda->status_id = getConfig('default_venda_faturar_pagto_parcial');
                }
            }
            $venda->valor_total = $venda->valorTotal();
            if (! $venda->data_saida) {
                $venda->data_saida = now();
            }
            $venda->conta_id = $conta_id;
            $venda->prazo_garantia = $this->addDayGarantia($request->data_entrada, $venda->termo_garantia_id);
            $venda->save();
            DB::commit();

            return $venda;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Cancela uma Venda Faturada.
     *
     * @param  Venda  $venda  venda
     **/
    public function cancelarFaturamento(Venda $venda): Venda
    {
        DB::beginTransaction();
        try {
            foreach ($venda->produtos as $vendaProduto) {
                $produto = Produto::find($vendaProduto->produto->id);
                $movimentacoesModel = $produto->movimentacao()->where('os_produto_id', $vendaProduto->id);
                $movimentacoes = $movimentacoesModel->get();
                foreach ($movimentacoes as $movimentacao) {
                    if ($movimentacoes->count() > 1) {
                        $produto->estoque = ($produto->estoque + $movimentacao->estoque_antes);
                        break;
                    }
                    if ($movimentacoes->count() == 1) {
                        $produto->estoque = ($produto->estoque + $movimentacao->quantidade_movimentada);
                        break;
                    }
                }
                $produto->save();
                $movimentacoesModel->delete();
            }
            $venda->conta_id = null;
            $venda->valor_total = null;
            $venda->status_id = getConfig('default_venda_create_status');
            $venda->save();
            $venda->contas()->delete();
            DB::commit();

            return $venda;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Retorna o dia de vencimento com base na categoria selecionada.
     *
     * @param  string  $data_saida  Data de saída da os
     * @param  int  $termo_garantia_id  id da do termo de garantia
     * @return string|null retorna o dia de vendimento ou null caso nao exista
     *
     **/
    private function addDayGarantia($data_saida, $termo_garantia_id): ?string
    {
        $prazoEmDias = Garantia::find($termo_garantia_id)->prazo_garantia;
        if ($prazoEmDias) {
            $dataGarantia = Carbon::createFromFormat('Y-m-d', $data_saida);

            return $dataGarantia->addDays($prazoEmDias)->format('Y-m-d');
        }

        return null;
    }
}
