<?php

namespace App\Http\Controllers\Relatorio\Financeiro;

use App\Http\Controllers\Controller;
use App\Models\Financeiro\Contas;
use App\Models\Os\Os;
use Illuminate\Http\Request;

class BalanceteController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:relatorio_financeiro_balancete', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $osRelatorio = null;
        $mesRelatorio = null;
        $centroCustoRelatorio = null;
        if ($request->input()) {
            $validated = $request->validate([
                'data_inicio' => 'required|date',
                'data_fim' => 'required|date|after_or_equal:data_inicio',
                'tipo_de_agrupamento' => 'required|in:os,mes,centro_de_custo',
                'ordenacao' => 'required|in:data,nome,saldo',
            ]);
            if ($validated['tipo_de_agrupamento'] == 'os') {
                $osRelatorio = Os::RelatorioBalanceteOs($validated['data_inicio'], $validated['data_fim'], $validated['ordenacao']);
            }
            if ($validated['tipo_de_agrupamento'] == 'mes') {
                $mesRelatorio = Contas::RelatorioBalanceteMes($validated['data_inicio'], $validated['data_fim'], $validated['ordenacao']);
            }
            if ($validated['tipo_de_agrupamento'] == 'centro_de_custo') {
                $centroCustoRelatorio = Contas::RelatorioBalanceteCentroCusto($validated['data_inicio'], $validated['data_fim'], $validated['ordenacao']);
            }
        }

        return view('relatorio.financeiro.balancete.index', [
            'request' => $request,
            'osRelatorio' => $osRelatorio,
            'mesRelatorio' => $mesRelatorio,
            'centroCustoRelatorio' => $centroCustoRelatorio,
        ]);
    }
}
