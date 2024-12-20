<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreMetaContabilRequest;
use App\Http\Requests\Financeiro\UpdateMetaContabilRequest;
use App\Models\Financeiro\MetaContabil;

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
    public function index()
    {
        $metaContabil = MetaContabil::paginate(20);

        return view('financeiro.meta_contabil.index', compact('metaContabil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financeiro.meta_contabil.create', [
            'intervalo' => $this->intervalo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMetaContabilRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaContabil $metaContabil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaContabil $metaContabil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMetaContabilRequest $request, MetaContabil $metaContabil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaContabil $metaContabil)
    {
        //
    }
}
