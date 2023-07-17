<?php

namespace App\Http\Controllers\Lancamento;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLancamentoRequest;
use App\Http\Requests\UpdateLancamentoRequest;
use App\Models\Lancamento\Lancamento;

class LancamentoController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:financeiro_lancamento', ['only'=> 'index']);
        $this->middleware('permission:financeiro_lancamento_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:financeiro_lancamento_show', ['only'=> 'show']);
        $this->middleware('permission:financeiro_lancamento_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:financeiro_lancamento_destroy', ['only'=> 'destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lancamentos = Lancamento::paginate(100);
        return view('lancamento.index', compact('lancamentos'));
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
    public function store(StoreLancamentoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lancamento $lancamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lancamento $lancamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLancamentoRequest $request, Lancamento $lancamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lancamento $lancamento)
    {
        //
    }
}
