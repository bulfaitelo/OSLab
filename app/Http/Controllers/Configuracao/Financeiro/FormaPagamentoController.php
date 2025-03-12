<?php

namespace App\Http\Controllers\Configuracao\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Financeiro\StoreFormaPagamentoRequest;
use App\Http\Requests\Configuracao\Financeiro\UpdateFormaPagamentoRequest;
use App\Models\Configuracao\Financeiro\FormaPagamento;

class FormaPagamentoController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_financeiro_forma_pagamento', ['only' => 'index']);
        $this->middleware('permission:config_financeiro_forma_pagamento_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_financeiro_forma_pagamento_show', ['only' => 'show']);
        $this->middleware('permission:config_financeiro_forma_pagamento_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_financeiro_forma_pagamento_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formaPagamentos = FormaPagamento::paginate(100);

        return view('configuracao.financeiro.forma_pagamento.index', compact('formaPagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.financeiro.forma_pagamento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormaPagamentoRequest $request)
    {
        try {
            $formaPagamento = new FormaPagamento;
            $formaPagamento->name = $request->name;
            $formaPagamento->descricao = $request->descricao;
            $formaPagamento->save();

            return redirect()->route('configuracao.financeiro.forma_pagamento.index')
                ->with('success', 'Forma de pagamento criada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FormaPagamento $formaPagamento)
    {
        return view('configuracao.financeiro.forma_pagamento.show', compact('formaPagamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormaPagamento $formaPagamento)
    {
        return view('configuracao.financeiro.forma_pagamento.edit', compact('formaPagamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormaPagamentoRequest $request, FormaPagamento $formaPagamento)
    {
        try {
            $formaPagamento->name = $request->name;
            $formaPagamento->descricao = $request->descricao;
            $formaPagamento->save();

            return redirect()->route('configuracao.financeiro.forma_pagamento.index')
                ->with('success', 'Forma de pagamento atualizada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormaPagamento $formaPagamento)
    {
        try {
            $formaPagamento->delete();

            return redirect()->route('configuracao.financeiro.forma_pagamento.index')
                ->with('success', 'Forma de pagamento excluída com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
