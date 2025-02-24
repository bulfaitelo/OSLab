<?php

namespace App\Http\Controllers\Relatorio\Financeiro;

use App\Http\Controllers\Controller;
use App\Models\Financeiro\Pagamentos;
use Illuminate\Http\Request;

class ReceitaDespesaController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:relatorio_financeiro_receita_despesa', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $relatorio = null;
        if ($request->input()) {
            $validated = $request->validate([
                'financeiro' => 'nullable|in:receita,despesa',
                'centro_custo_id' => 'nullable|exists:centro_custos,id',
                'tipo_data' => 'required|in:pagamento,vencimento',
                'data_inicio' => 'nullable|date',
                'data_fim' => 'nullable|date|after_or_equal:data_inicio',
                'forma_pagamento_id' => 'nullable|exists:forma_pagamentos,id',
                // 'ordenacao' => 'required|in:data,nome,saldo',
            ]);
            $relatorio = Pagamentos::RelatorioDespesasReceita($request);
        }

        return view('relatorio.financeiro.despesa.index', [
            'request' => $request,
            'relatorio' => $relatorio,
        ]);
    }
}
