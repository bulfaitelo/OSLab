<?php

namespace App\Http\Controllers\Configuracao\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Financeiro\StoreUpdateCentroCustoRequest;
use App\Models\Configuracao\Financeiro\CentroCusto;
use Illuminate\Http\Request;

class CentroCustoController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_financeiro_centro_custo', ['only' => 'index']);
        $this->middleware('permission:config_financeiro_centro_custo_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_financeiro_centro_custo_show', ['only' => 'show']);
        $this->middleware('permission:config_financeiro_centro_custo_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_financeiro_centro_custo_destroy', ['only' => 'destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centroCusto = CentroCusto::paginate(100);

        return view('configuracao.financeiro.centro_custo.index',compact('centroCusto'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('configuracao.financeiro.centro_custo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCentroCustoRequest $request)
    {


        $centroCusto = new CentroCusto();
        $centroCusto->name = $request->name;
        $centroCusto->descricao = $request->descricao;
        $centroCusto->receita = $request->receita;
        $centroCusto->despesa = $request->despesa;
        if($centroCusto->save()){
            return redirect()->route('configuracao.financeiro.centro_custo.index')
            ->with('success', 'Centro de criado com sucesso.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(CentroCusto $centroCusto)
    {
        return view('configuracao.financeiro.centro_custo.show', compact('centroCusto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CentroCusto $centroCusto)
    {
        return view('configuracao.financeiro.centro_custo.edit', compact('centroCusto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCentroCustoRequest $request, CentroCusto $centroCusto)
    {
        $centroCusto->name = $request->name;
        $centroCusto->descricao = $request->descricao;
        $centroCusto->receita = $request->receita;
        $centroCusto->despesa = $request->despesa;
        if($centroCusto->save()){
            return redirect()->route('configuracao.financeiro.centro_custo.index')
            ->with('success', 'Centro de atualizado com sucesso.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CentroCusto $centroCusto)
    {

        // Tentar excluir o recurso
        try {
            $centroCusto->delete();
            return redirect()->route('configuracao.financeiro.centro_custo.index')
                ->with('success', 'Centro de custo excluído com sucesso.');
        } catch (\Exception $e) {
            // Tratar erros de exclusão
            return redirect()->back()
                ->with('error', 'Erro ao excluir o centro de custo. Por favor, tente novamente.')
                ->withErrors($e->getMessage());
        }
    }
}
