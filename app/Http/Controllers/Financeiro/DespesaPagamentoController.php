<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreContaPagamentoRequest;
use App\Http\Requests\Financeiro\UpdateContaPagamentoRequest;
use App\Models\Financeiro\Contas;
use App\Models\Financeiro\Pagamentos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DespesaPagamentoController extends Controller
{

    public function __construct()
    {
        // ACL DE PERMISSÕES

        $this->middleware('permission:financeiro_despesa_pagamento_create', ['only' => ['store']]);
        $this->middleware('permission:financeiro_despesa_pagamento_edit', ['only' => [ 'update']]);
        $this->middleware('permission:financeiro_despesa_pagamento_destroy', ['only' => 'destroy']);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Contas $despesa, StoreContaPagamentoRequest $request)
    {
        DB::beginTransaction();
        try {
            $pagamento[] =  [
                'forma_pagamento_id' => $request->forma_pagamento_id,
                'user_id' => Auth::id(),
                'valor' => $request->pagamento_valor,
                'vencimento' =>  $request->vencimento,
                'data_pagamento' => $request->data_pagamento,
                'parcela' => $request->parcela,
            ];
            $despesa->pagamentos()->createMany($pagamento);
            if ($despesa->parcelas < $despesa->pagamentos->count()) {
                $despesa->parcelas = $despesa->parcelas + 1;
            }
            if (($despesa->pagamentos->sum('valor') + $request->pagamento_valor) >= $despesa->valor) {
                $despesa->data_quitacao = $request->data_pagamento;
            }
            $despesa->save();
            DB::commit();
            return redirect()->route('financeiro.despesa.edit', $despesa)
            ->with('success', 'Pagamento adicionado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContaPagamentoRequest $request, Contas $despesa, Pagamentos $pagamento)
    {
        DB::beginTransaction();
        $pagamento = $despesa->pagamentos()->findOrFail($pagamento->id);
        try {
            $pagamento->forma_pagamento_id = $request->forma_pagamento_id;
            $pagamento->user_id = Auth::id();
            $pagamento->vencimento =  $request->vencimento;
            $pagamento->parcela = $request->parcela;
            if ($request->pago) {
                $pagamento->valor = $request->pagamento_valor;
                $pagamento->data_pagamento = $request->data_pagamento;

            } else {
                $pagamento->valor = null;
                $pagamento->data_pagamento = null;

            }
            $pagamento->save();

            if ($request->pago) {
                if (($despesa->pagamentos->sum('valor') + $request->pagamento_valor) >= $despesa->valor) {
                    $despesa->data_quitacao = $request->data_pagamento;
                }
            } else {
                if (($despesa->pagamentos->sum('valor')) >= $despesa->valor) {
                    $despesa->data_quitacao = $request->data_pagamento;
                } else {
                    $despesa->data_quitacao = null;
                }
            }
            $despesa->save();
            DB::commit();
            return redirect()->route('financeiro.despesa.edit', $despesa)
            ->with('success', 'Pagamento editado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contas $despesa, Pagamentos $pagamento)
    {
        DB::beginTransaction();
        $pagamento = $despesa->pagamentos()->findOrFail($pagamento->id);
        try {
            $pagamento->delete();
            if (($despesa->pagamentos->sum('valor')) <= $despesa->valor) {
                $despesa->data_quitacao = null;
            }
            $despesa->save();
            DB::commit();
            return redirect()->route('financeiro.despesa.edit', $despesa)
                ->with('success', 'Pagamento excluído com sucesso.');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
