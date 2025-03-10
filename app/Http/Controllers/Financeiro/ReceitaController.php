<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreContaRequest;
use App\Http\Requests\Financeiro\UpdateContaRequest;
use App\Models\Financeiro\Contas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceitaController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:financeiro_receita', ['only' => 'index']);
        $this->middleware('permission:financeiro_receita_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:financeiro_receita_show', ['only' => 'show']);
        $this->middleware('permission:financeiro_receita_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:financeiro_receita_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dataHoje = Carbon::now()->format('Y-d-m');
        $queryReceita = Contas::query();
        $queryReceita->where('tipo', 'R');
        $queryReceita->with([
            'centroCusto',
            'cliente',
            'pagamentos',
        ]);
        if ($request->busca) {
            $queryReceita->where(function ($query) use ($request) {
                $query->whereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
                $query->orWhere('name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('observacoes', 'LIKE', '%'.$request->busca.'%');
            });
        }
        if ($request->centro_custo) {
            $queryReceita->where('centro_custo_id', $request->centro_custo);
        }
        if ($request->data_inicial || $request->data_final) {
            ($request->data_inicial) ? $dataInicial = $request->data_inicial : $dataInicial = $dataHoje;
            ($request->data_final) ? $dataFinal = $request->data_final : $dataFinal = $dataHoje;
            $queryReceita->where(function ($query) use ($dataInicial, $dataFinal) {
                $query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                $query->orWhereHas('pagamentos', function ($query) use ($dataInicial, $dataFinal) {
                    $query->whereBetween('vencimento', [$dataInicial, $dataFinal]);
                });
                $query->orWhereBetween('data_quitacao', [$dataInicial, $dataFinal]);
            });
        }
        if ($request->status == 'quitado') {
            $queryReceita->WhereNotNull('data_quitacao');
        } elseif ($request->status == 'aberto') {
            $queryReceita->WhereNull('data_quitacao');
        }
        $queryReceita->orderBy('id', 'desc');
        $receitas = $queryReceita->paginate(100);

        return view('financeiro.receita.index', compact('receitas', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financeiro.receita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContaRequest $request)
    {
        DB::beginTransaction();
        try {
            if ($request->os_id) {
                $os = Os::findOrFail($request->os_id);
            }
            $receita = new Contas();
            $receita->tipo = 'R'; //Receita
            $receita->user_id = Auth::id();
            $receita->name = $request->name;
            $receita->centro_custo_id = $request->centro_custo_id;
            if ($request->os_id) {
                $receita->cliente_id = $os->cliente_id;
                $receita->os_id = $os->id;
            } else {
                $receita->cliente_id = $request->cliente_id;
            }
            $receita->observacoes = $request->observacoes;
            $receita->valor = $request->valor;
            $receita->parcelas = $request->parcelas;
            $receita->save();

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
                    $receita->data_quitacao = $vencimento->format('Y-m-d');
                    $receita->save();
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
                    $receita->data_quitacao = $request->data_pagamento;
                    $receita->save();
                }
            }
            $receita->pagamentos()->createMany($pagamento);

            DB::commit();

            return redirect()->route('financeiro.receita.index')
            ->with('success', 'receita cadastrada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contas $receita)
    {
        return view('financeiro.receita.show', compact('receita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contas $receita)
    {
        return view('financeiro.receita.edit', compact('receita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContaRequest $request, Contas $receita)
    {
        try {
            $receita->user_id = Auth::id();
            $receita->name = $request->name;
            $receita->centro_custo_id = $request->centro_custo_id;
            if (! $receita->os_id) {
                $receita->cliente_id = $request->cliente_id;
            }
            $receita->observacoes = $request->observacoes;
            $receita->valor = $request->valor;
            $receita->parcelas = $request->parcelas;
            $receita->save();

            return redirect()->route('financeiro.receita.index')
            ->with('success', 'receita Atualizada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contas $receita)
    {
        try {
            if ($receita->os_id || $receita->venda_id) {
                return redirect()->route('financeiro.receita.index')
                ->with('warning', 'Não é possível excluir essa Receita, pois esta vinculada a uma OS ou Venda!');
            }
            $receita->delete();

            return redirect()->route('financeiro.receita.index')
                ->with('success', 'receita excluída com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
