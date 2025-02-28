<?php

namespace App\Http\Controllers\Relatorio\Financeiro;

use App\Http\Controllers\Controller;
use App\Models\Financeiro\Contas;
use Illuminate\Http\Request;

class ContaAbertaController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:relatorio_financeiro_conta_aberta', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $relatorio = null;
        if ($request->input()) {            
            $request->validate([
                'financeiro' => 'nullable|in:receita,despesa',
                'centro_custo_id' => 'nullable|exists:centro_custos,id',                
                'data_inicio' => 'nullable|date',
                'data_fim' => 'nullable|date|after_or_equal:data_inicio',                
                // 'ordenacao' => 'required|in:data,nome,saldo',
            ]);
            $relatorio = Contas::RelatorioContasAbertas($request);            
        }

        return view('relatorio.financeiro.conta_aberta.index', [
            'request' => $request,
            'relatorio' => $relatorio,
        ]);
    }
}
