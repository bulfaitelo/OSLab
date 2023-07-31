<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreDespesaPagamentoRequest;
use App\Http\Requests\Financeiro\UpdateDespesaPagamentoRequest;
use App\Http\Requests\Financeiro\UpdateDespesaRequest;
use App\Models\Financeiro\Contas;
use App\Models\Financeiro\Pagamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DespesaPagamentoController extends Controller
{


    function __construct()
    {
        // ACL DE PERMISSÕES

        $this->middleware('permission:financeiro_despesa_pagamento_create', ['only'=> ['store']]);
        $this->middleware('permission:financeiro_despesa_pagamento_edit', ['only'=> [ 'update']]);
        $this->middleware('permission:financeiro_despesa_pagamento_destroy', ['only'=> 'destroy']);

    }

    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Contas $despesa, StoreDespesaPagamentoRequest $request)
    {
        DB::beginTransaction();
        try {
            $pagamento[] =  [
                'forma_pagamento_id' => $request->parcelado_forma_pagamento_id,
                'user_id' => Auth::id(),
                'valor' => $request->pagamento_valor,
                'vencimento' =>  $request->vencimento,
                'data_pagamento' => $request->data_pagamento,
                'parcela' => $request->parcela,
                'forma_pagamento_id' => $request->forma_pagamento_id,
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

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {

    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDespesaRequest $request, Contas $despesa, Pagamentos $pagamento)
    {
        DB::beginTransaction();
        $pagamento = $despesa->pagamentos()->findOrFail($pagamento->id);
        try {
                $pagamento->forma_pagamento_id = $request->parcelado_forma_pagamento_id;
                $pagamento->user_id = Auth::id();
                $pagamento->valor = $request->pagamento_valor;
                $pagamento->vencimento =  $request->vencimento;
                $pagamento->data_pagamento = $request->data_pagamento;
                $pagamento->parcela = $request->parcela;
                $pagamento->forma_pagamento_id = $request->forma_pagamento_id;
                $pagamento->save();

            if (($despesa->pagamentos->sum('valor') + $request->pagamento_valor) >= $despesa->valor) {
                $despesa->data_quitacao = $request->data_pagamento;
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
        // $despesa::with('pagamentos')->findOrFail($despesa->id);
        $pagamento = $despesa->pagamentos()->findOrFail($pagamento->id);
        try {
            $pagamento->delete();
            return redirect()->route('financeiro.despesa.edit', $despesa)
                ->with('success', 'Pagamento excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
