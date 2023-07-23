<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Financeiro\StoreContasRequest;
use App\Http\Requests\Financeiro\UpdateContasRequest;
use App\Models\Financeiro\Contas;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contas = Contas::paginate();
        return view('financeiro.despesa.index', compact('contas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('financeiro.despesa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContasRequest $request)
    {
        dd($request->input());
    }

    /**
     * Display the specified resource.
     */
    public function show(Contas $contas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contas $contas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContasRequest $request, Contas $contas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contas $contas)
    {
        //
    }
}
