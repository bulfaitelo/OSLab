<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreContaRequest;
use App\Http\Requests\Financeiro\UpdateContaRequest;
use App\Models\Financeiro\Contas;
use App\Models\Os\Os;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DespesaController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:financeiro_despesa', ['only' => 'index']);
        $this->middleware('permission:financeiro_despesa_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:financeiro_despesa_show', ['only' => 'show']);
        $this->middleware('permission:financeiro_despesa_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:financeiro_despesa_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dataHoje = Carbon::now()->format('Y-d-m');
        $queryDespesa = Contas::query();
        $queryDespesa->where('tipo', 'D');
        $queryDespesa->with([
            'centroCusto',
            'cliente',
        ]);
        if ($request->busca) {
            $queryDespesa->where(function ($query) use ($request) {
                $query->whereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
                $query->orWhere('name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('observacoes', 'LIKE', '%'.$request->busca.'%');
            });
        }
        if ($request->centro_custo) {
            $queryDespesa->where('centro_custo_id', $request->centro_custo);
        }
        if ($request->data_inicial || $request->data_final) {
            ($request->data_inicial) ? $dataInicial = $request->data_inicial : $dataInicial = $dataHoje;
            ($request->data_final) ? $dataFinal = $request->data_final : $dataFinal = $dataHoje;
            $queryDespesa->where(function ($query) use ($dataInicial, $dataFinal) {
                $query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                $query->orWhereHas('pagamentos', function ($query) use ($dataInicial, $dataFinal) {
                    $query->whereBetween('vencimento', [$dataInicial, $dataFinal]);
                });
                $query->orWhereBetween('data_quitacao', [$dataInicial, $dataFinal]);
            });
        }
        if ($request->status == 'quitado') {
            $queryDespesa->WhereNotNull('data_quitacao');
        } elseif ($request->status == 'aberto') {
            $queryDespesa->WhereNull('data_quitacao');
        }
        $queryDespesa->orderBy('id', 'desc');
        $despesas = $queryDespesa->paginate(100);

        return view('financeiro.despesa.index', compact('despesas', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Os $os)
    {
        return view('financeiro.despesa.create', ['os' => $os]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContaRequest $request)
    {
        // dd($request->input());
        DB::beginTransaction();
        try {
            if ($request->os_id) {
                $os = Os::findOrFail($request->os_id);
            }
            $despesa = new Contas();
            $despesa->tipo = 'D'; //despesa
            $despesa->user_id = Auth::id();
            $despesa->name = $request->name;
            $despesa->centro_custo_id = $request->centro_custo_id;
            if ($request->os_id) {
                $despesa->cliente_id = $os->cliente_id;
                $despesa->os_id = $os->id;
            } else {
                $despesa->cliente_id = $request->cliente_id;
            }
            $despesa->observacoes = $request->observacoes;
            $despesa->valor = $request->valor;
            $despesa->parcelas = $request->parcelas;
            $despesa->save();

            if ($request->parcelas > 1) {
                $vencimento = new Carbon($request->vencimento);

                $valorParcela = floor($request->valor / $request->parcelas * 100) / 100;
                $valorResto = $request->valor - ($valorParcela * $request->parcelas);

                for ($i = 1; $i <= $request->parcelas; $i++) {
                    if ($i == 1) {
                        $valor = $valorParcela + $valorResto;
                    } else {
                        $valor = $valorParcela;
                    }

                    if ($request->parcelado_pago) {
                        $data_pagamento = $vencimento->format('Y-m-d');
                    } else {
                        $data_pagamento = null;
                    }

                    $pagamento[] = [
                        'forma_pagamento_id' => $request->forma_pagamento_id,
                        'user_id' => Auth::id(),
                        'valor' => $valor,
                        'vencimento' => $vencimento->format('Y-m-d'),
                        'data_pagamento' => $data_pagamento,
                        'parcela' => $i,
                    ];
                    if ($i != $request->parcelas) {
                        $vencimento->addMonth();
                    }
                }
                if ($request->parcelado_pago) {
                    $despesa->data_quitacao = $vencimento->format('Y-m-d');
                    $despesa->save();
                }
            } else {
                $pagamento[] = [
                    'forma_pagamento_id' => $request->forma_pagamento_id,
                    'user_id' => Auth::id(),
                    'valor' => $request->avista_valor,
                    'vencimento' => $request->vencimento,
                    'data_pagamento' => $request->data_pagamento,
                    'parcela' => 1,
                ];
                if ($request->avista_valor >= $request->valor) {
                    $despesa->data_quitacao = $request->data_pagamento;
                    $despesa->save();
                }
            }
            $despesa->pagamentos()->createMany($pagamento);
            DB::commit();

            return redirect()->route('financeiro.despesa.index')
            ->with('success', 'Despesa cadastrada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contas $despesa)
    {
        return view('financeiro.despesa.show', compact('despesa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contas $despesa)
    {
        return view('financeiro.despesa.edit', compact('despesa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContaRequest $request, Contas $despesa)
    {
        try {
            $despesa->user_id = Auth::id();
            $despesa->name = $request->name;
            $despesa->centro_custo_id = $request->centro_custo_id;
            if (! $despesa->os_id) {
                $despesa->cliente_id = $request->cliente_id;
            }
            $despesa->observacoes = $request->observacoes;
            $despesa->valor = $request->valor;
            $despesa->parcelas = $request->parcelas;
            $despesa->save();

            return redirect()->route('financeiro.despesa.index')
            ->with('success', 'Despesa Atualizada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contas $despesa)
    {
        try {
            $despesa->delete();

            return redirect()->route('financeiro.despesa.index')
                ->with('success', 'Despesa excluída com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
