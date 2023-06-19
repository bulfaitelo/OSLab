<?php

namespace App\Http\Controllers\Configuracao\Financeiro;

use App\Http\Controllers\Controller;
use App\Models\Configuracao\Financeiro\CentroCusto;
use Illuminate\Http\Request;

class CentroCustoController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_financeiro_centro_custo', ['only'=> 'index']);
        $this->middleware('permission:config_financeiro_centro_custo_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:config_financeiro_centro_custo_show', ['only'=> 'show']);
        $this->middleware('permission:config_financeiro_centro_custo_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:config_financeiro_centro_custo_destroy', ['only'=> 'destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centroCusto = CentroCusto::paginate(100);

        return view('configuracoes.financeiro.centro_custo.index',compact('centroCusto'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('configuracoes.financeiro.centro_custo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'receita' => 'required_without:despesa|in:1,null',
            'despesa' => 'required_without:receita|in:1,null'
        ]);

        $centroCusto = new CentroCusto();
        $centroCusto->name = $request->name;
        $centroCusto->descricao = $request->descricao;
        $centroCusto->receita = $request->receita;
        $centroCusto->despesa = $request->despesa;
        if($centroCusto->save()){
            toastr()->error('Oops! Something went wrong!');
            return redirect()->route('configuracoes.financeiro.centro_custo.index');
            // ->with('success', 'Centro de custo atualizado');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(CentroCusto $centroCusto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentroCusto $centroCusto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CentroCusto $centroCusto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentroCusto $centroCusto)
    {
        //
    }
}
