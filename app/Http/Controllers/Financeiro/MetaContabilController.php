<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreMetaContabilRequest;
use App\Http\Requests\Financeiro\UpdateMetaContabilRequest;
use App\Models\Configuracao\Financeiro\CentroCusto;
use App\Models\Financeiro\MetaContabil;
use Illuminate\Http\Request;

class MetaContabilController extends Controller
{
    private $intervalo = ['mes' => 'Mensal', 'ano' => 'Anual'];

    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:financeiro_meta_contabil', ['only' => 'index']);
        $this->middleware('permission:financeiro_meta_contabil_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:financeiro_meta_contabil_show', ['only' => 'show']);
        $this->middleware('permission:financeiro_meta_contabil_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:financeiro_meta_contabil_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $metaContabil = MetaContabil::getDataTable(request: $request, itensPorPagina: 100);

        return view('financeiro.meta_contabil.index', compact('metaContabil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centroCustoSelect = CentroCusto::getSelectCentroCusto();

        return view('financeiro.meta_contabil.create', [
            'intervalo' => $this->intervalo,
            'centroCustoSelect' => $centroCustoSelect,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMetaContabilRequest $request)
    {
        try {
            $metaContabil = new MetaContabil();
            $metaContabil->name = $request->name;
            $metaContabil->descricao = $request->descricao;
            $metaContabil->valor_meta = $request->valor_meta;
            $metaContabil->tipo_meta = $request->tipo_meta;
            $metaContabil->meta_liquida = $request->meta_liquida;
            $metaContabil->centro_custo_id = $request->centro_custo_id;
            $metaContabil->intervalo = $request->intervalo;
            $metaContabil->exibir_dashboard = $request->exibir_dashboard;
            $metaContabil->save();

            return redirect()->route('financeiro.meta_contabil.index')
            ->with('success', 'Meta Contábil cadastrada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaContabil $metaContabil)
    {
        $centroCustoSelect = CentroCusto::getSelectCentroCusto();
        // dd($metaContabil->getMetaExecutadaTable());

        return view('financeiro.meta_contabil.show', [
            'metaContabil' => $metaContabil,
            'intervalo' => $this->intervalo,
            'centroCustoSelect' => $centroCustoSelect,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaContabil $metaContabil)
    {
        $centroCustoSelect = CentroCusto::getSelectCentroCusto();

        return view('financeiro.meta_contabil.edit', [
            'metaContabil' => $metaContabil,
            'intervalo' => $this->intervalo,
            'centroCustoSelect' => $centroCustoSelect,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMetaContabilRequest $request, MetaContabil $metaContabil)
    {
        try {
            $metaContabil->name = $request->name;
            $metaContabil->descricao = $request->descricao;
            $metaContabil->valor_meta = $request->valor_meta;
            $metaContabil->meta_liquida = $request->meta_liquida;
            $metaContabil->centro_custo_id = $request->centro_custo_id;
            $metaContabil->intervalo = $request->intervalo;
            $metaContabil->exibir_dashboard = $request->exibir_dashboard;
            $metaContabil->save();

            return redirect()->route('financeiro.meta_contabil.index')
            ->with('success', 'Meta Contábil atualizada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaContabil $metaContabil)
    {
        try {
            $metaContabil->delete();

            return redirect()->route('financeiro.meta_contabil.index')
                ->with('success', 'Meta Contábil excluida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
