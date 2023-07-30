<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreDespesaPagamento;
use App\Models\Financeiro\Contas;
use App\Models\Financeiro\Pagamentos;
use Illuminate\Http\Request;

class DespesaPagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Contas $despesa, StoreDespesaPagamento $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contas $despesa, Pagamentos $pagamento)
    {
        try {
            $pagamento->delete();
            return redirect()->route('financeiro.despesa.edit', $despesa)
                ->with('success', 'Pagamento excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
