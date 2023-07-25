<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreContasRequest;
use App\Http\Requests\Financeiro\UpdateContasRequest;
use App\Models\Financeiro\Contas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Decimal;

class DespesaController extends Controller
{

    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:financeiro_despesa', ['only'=> 'index']);
        $this->middleware('permission:financeiro_despesa_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:financeiro_despesa_show', ['only'=> 'show']);
        $this->middleware('permission:financeiro_despesa_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:financeiro_despesa_destroy', ['only'=> 'destroy']);

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $despesas = Contas::Where('tipo', 'D')
            ->paginate();
        return view('financeiro.despesa.index', compact('despesas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financeiro.despesa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContasRequest $request)
    {
        DB::beginTransaction();
        try {
            $conta = new Contas();
            $conta->tipo = 'D'; //despesa
            $conta->user_id = Auth::id();
            $conta->name = $request->name;
            $conta->centro_custo_id = $request->centro_custo_id;
            $conta->cliente_id = $request->cliente_id;
            $conta->observacoes = $request->observacoes;
            $conta->valor = $request->valor;
            $conta->parcelas = $request->parcelas;
            $conta->save();

            if ($request->parcelas > 1) {
                $vencimento = new Carbon($request->vencimento);

                $valorParcela = floor($request->valor / $request->parcelas * 100) / 100;
                $valorResto = $request->valor - ($valorParcela * $request->parcelas);

                for ($i=1; $i <= $request->parcelas ; $i++) {
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


                    $pagamento[] =  [
                        'forma_pagamento_id' => $request->parcelado_forma_pagamento_id,
                        'user_id' => Auth::id(),
                        'valor' => $valor,
                        'vencimento' =>  $vencimento->format('Y-m-d'),
                        'data_pagamento' => $data_pagamento,
                        'parcela' => $i,
                        'forma_pagamento_id' => $request->parcelado_forma_pagamento_id,
                    ];
                    if($i != $request->parcelas){
                        $vencimento->addMonth(1);
                    }
                }
                if ($request->parcelado_pago) {
                    $conta->data_quitacao = $vencimento->format('Y-m-d');
                    $conta->save();
                }

            } else {
               $pagamento[] =  [
                    'forma_pagamento_id' => $request->avista_forma_pagamento_id,
                    'user_id' => Auth::id(),
                    'valor' => $request->avista_valor,
                    'vencimento' =>  $request->vencimento,
                    'data_pagamento' => $request->data_pagamento,
                    'parcela' => 1,
                ];


            }
            $conta->pagamentos()->createMany($pagamento);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contas $despesa)
    {
        dd($despesa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContasRequest $request, Contas $despesa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contas $despesa)
    {
        //
    }
}
