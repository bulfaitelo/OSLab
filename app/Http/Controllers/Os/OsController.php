<?php

namespace App\Http\Controllers\Os;

use App\Http\Controllers\Controller;
use App\Http\Requests\Os\FaturarOsRequest;
use App\Http\Requests\Os\StoreOsRequest;
use App\Http\Requests\Os\UpdateOsRequest;
use App\Models\Configuracao\Parametro\Categoria;
use App\Models\Configuracao\Sistema\Emitente;
use App\Models\Os\Os;
use App\Models\Produto\Produto;
use App\Services\Os\OsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\LaravelPdf\Facades\Pdf;
class OsController extends Controller
{
    public function __construct(
        private readonly ?OsService $osService = null
    ) {
        // ACL DE PERMISSÕES
        $this->middleware('permission:os', ['only' => ['index']]);
        $this->middleware('permission:os_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:os_show', ['only' => ['show', 'print']]);
        $this->middleware('permission:os_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:os_destroy', ['only' => 'destroy']);
        $this->middleware('permission:os_faturar', ['only' => 'faturar']);
        $this->middleware('permission:os_cancelar_faturar', ['only' => 'cancelarFaturamento']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $os = $this->osService::getDataTable($request);

        return view('os.index', compact('os', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('os.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOsRequest $request)
    {
        $os = $this->osService->store($request);

        return redirect()->route('os.edit', $os->id)
        ->with('success', 'Os cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Os $os)
    {
        $emitente = Emitente::getHtmlEmitente(1, $os->id);

        return view('os.show', compact('os', 'emitente'));
    }

    /**
     * Tela de impressão da OS.
     */
    public function print(Os $os)
    {
        $emitente = Emitente::getHtmlEmitente(1, $os->id);

        // return view('os.print', compact('os', 'emitente'));

        return Pdf::view('os.print', compact('os', 'emitente'))
        ->format('a4')
        ->name('OSLab_'.$os->id.'_'.$os->cliente->titleName().'.pdf');

        // $pdf = Pdf::loadView('os.print', compact('os', 'emitente'));
        // $pdf->setPaper('a4');
        // $css = asset('vendor/adminlte/dist/css/adminlte.min.css');

        // return $pdf->stream('invoice.pdf');




    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Os $os)
    {
        return view('os.edit', compact('os'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOsRequest $request, Os $os)
    {
        // dd($request->input());
        $os = $this->osService->update($request, $os);

        return redirect()->route('os.edit', $os->id)
        ->with('success', 'Os Atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Os $os)
    {
        try {
            if ($os->fatura_id) {
                return redirect()->route('os.index')
                ->with('warning', 'Essa OS já está faturada, cancele a fatura antes de exclui-la!');
            }
            $this->osService->destroy($os);

            return redirect()->route('os.index')
            ->with('success', 'OS Excluida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     *  Fatura a OS.
     *
     * @param  FaturarOsRequest  $request
     * @param  OS  $os  os
     */
    public function faturar(FaturarOsRequest $request, Os $os)
    {
        if (! getConfig('default_os_faturar_produto_despesa')) {
            return redirect()->route('os.edit', $os->id)

            ->with('warning', 'Por favor vejas as configurações do sistema.');
        }

        if ($os->fatura_id) {
            return redirect()->route('os.edit', $os->id)
            ->with('warning', 'Esta Ordem de Serviço já está faturada.');
        }

        DB::beginTransaction();
        try {
            //Gerando despesas Referente a produtos.
            //Gerando atualizações de estoque .
            foreach ($os->produtos as $osProduto) {
                // Adicionando despesa,
                $os->contas()->create([
                    'tipo' => 'D',
                    'name' => 'OS: #'.$os->id.', Prod.:'.$osProduto->produto->name.', Qtd.: '.$osProduto->quantidade,
                    'os_id' => $os->id,
                    'user_id' => auth()->id(),
                    'centro_custo_id' => $osProduto->produto->centro_custo_id,
                    'cliente_id' => $os->cliente_id,
                    'valor' => $osProduto->valor_custo_total,
                    'data_quitacao' => $request->data_entrada,
                    'parcelas' => 1,
                ])->pagamentos()->create([
                    'forma_pagamento_id' => getConfig('default_os_faturar_produto_despesa'),
                    'user_id' => auth()->id(),
                    'valor' => $osProduto->valor_custo_total,
                    'vencimento' => $request->data_entrada,
                    'data_pagamento' => $request->data_entrada,
                    'parcela' => 1,
                ]);

                // Adicionando movimentação de estoque
                $produto = Produto::find($osProduto->produto->id);
                // Com estoque
                if ($produto->estoque >= $osProduto->quantidade) {
                    $produto->estoque = ($produto->estoque - $osProduto->quantidade);
                    $produto->save();
                    $produto->movimentacao()->create([
                        'quantidade_movimentada' => $osProduto->quantidade,
                        'tipo_movimentacao' => 0,
                        'valor_custo' => $osProduto->valor_custo,
                        'estoque_antes' => ($produto->estoque + $osProduto->quantidade),
                        'estoque_apos' => $produto->estoque,
                        'os_id' => $os->id,
                        'os_produto_id' => $osProduto->id,
                        'descricao' => 'OS Nº: #'.$os->id,
                    ]);
                // Sem estoque
                } else {
                    $entrada = (-1 * ($produto->estoque - $osProduto->quantidade));
                    $produto->movimentacao()->create([
                        'quantidade_movimentada' => $entrada,
                        'tipo_movimentacao' => 1,
                        'valor_custo' => $osProduto->valor_custo,
                        'estoque_antes' => $produto->estoque,
                        'estoque_apos' => ($produto->estoque + $entrada),
                        'os_id' => $os->id,
                        'os_produto_id' => $osProduto->id,
                        'descricao' => 'OS Nº: #'.$os->id,
                    ]);
                    $produto->movimentacao()->create([
                        'quantidade_movimentada' => $osProduto->quantidade,
                        'tipo_movimentacao' => 0,
                        'valor_custo' => $osProduto->valor_custo,
                        'estoque_antes' => ($produto->estoque + $osProduto->quantidade),
                        'estoque_apos' => $produto->estoque,
                        'os_id' => $os->id,
                        'os_produto_id' => $osProduto->id,
                        'descricao' => 'OS Nº: #'.$os->id,
                    ]);
                    $produto->estoque = 0;
                    $produto->valor_custo = $osProduto->valor_custo;
                    $produto->valor_venda = $osProduto->valor_venda;
                    $produto->save();
                }
            }

            // Adicionando receita
            // com pagamento recebido
            if ($request->recebido) {
                if ($os->valorTotal() <= $request->valor_recebido) {
                    $dataQuitacao = $request->data_recebimento;
                } else {
                    $dataQuitacao = null;
                }
                $fatura = $os->contas()->create([
                    'tipo' => 'R',
                    'name' => 'OS Nº: #'.$os->id,
                    'os_id' => $os->id,
                    'user_id' => auth()->id(),
                    'centro_custo_id' => $request->centro_custo_id,
                    'cliente_id' => $os->cliente_id,
                    'valor' => $os->valorTotal(),
                    'data_quitacao' => $dataQuitacao,
                    'parcelas' => 1,
                ])->pagamentos()->create([
                    'forma_pagamento_id' => getConfig('default_os_faturar_produto_despesa'),
                    'user_id' => auth()->id(),
                    'valor' => $request->valor_recebido,
                    'vencimento' => $request->data_entrada,
                    'data_pagamento' => $request->data_recebimento,
                    'parcela' => 1,
                ]);
                $fatura_id = $fatura->conta_id;

            // Sem pagamento
            } else {
                $fatura = $os->contas()->create([
                    'tipo' => 'R',
                    'name' => 'OS Nº: #'.$os->id,
                    'os_id' => $os->id,
                    'user_id' => auth()->id(),
                    'centro_custo_id' => $request->centro_custo_id,
                    'cliente_id' => $os->cliente_id,
                    'valor' => $os->valorTotal(),
                    'parcelas' => 1,
                ]);
                $fatura_id = $fatura->id;
            }

            if (isset($dataQuitacao) && ! empty($dataQuitacao)) {
                if (getConfig('default_os_faturar_pagto_quitado') != '') {
                    $os->status_id = getConfig('default_os_faturar_pagto_quitado');
                }
            } else {
                if (! $request->recebido) {
                    if (getConfig('default_os_faturar') != '') {
                        $os->status_id = getConfig('default_os_faturar');
                    }
                } elseif (getConfig('default_os_faturar_pagto_parcial') != '') {
                    $os->status_id = getConfig('default_os_faturar_pagto_parcial');
                }
            }
            $os->valor_total = $os->valorTotal();
            if (! $os->data_saida) {
                $os->data_saida = now();
            }
            $os->fatura_id = $fatura_id;
            $os->prazo_garantia = $this->addDayGarantia($request->data_entrada, $os->categoria_id);
            $os->save();
            DB::commit();

            return redirect()->route('os.edit', $os->id)
            ->with('success', 'Os Faturada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Cancela o faturamento da os.
     *
     * @param  OS  $os
     */
    public function cancelarFaturamento(Os $os)
    {
        DB::beginTransaction();
        try {
            foreach ($os->produtos as $osProduto) {
                $produto = Produto::find($osProduto->produto->id);
                $movimentacoesModel = $produto->movimentacao()->where('os_produto_id', $osProduto->id);
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
            $os->fatura_id = null;
            $os->valor_total = null;
            $os->status_id = getConfig('default_os_create_status');
            $os->save();
            $os->contas()->delete();
            DB::commit();

            return redirect()->route('os.edit', $os->id)
            ->with('success', 'Fatura cancelada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * REtorna o dia de vencimento com base na categoria selecionada.
     *
     * @param  string  $data_saida  Data de saida da os
     * @param  int  $categoria_id  id da categoria da os para gera os dias de garantia
     * @return string|null retorna o dia de vendimento ou null caso nao exista
     **/
    private function addDayGarantia($data_saida, $categoria_id): string|null
    {
        $prazoEmDias = Categoria::find($categoria_id)->garantia?->prazo_garantia;
        if ($prazoEmDias) {
            $dataGarantia = Carbon::createFromFormat('Y-m-d', $data_saida);

            return $dataGarantia->addDays($prazoEmDias)->format('Y-m-d');
        }

        return null;
    }
}
