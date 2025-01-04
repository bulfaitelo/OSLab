<?php

namespace App\Http\Controllers\Venda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Venda\StoreVendaRequest;
use App\Http\Requests\Venda\UpdateVendaRequest;
use App\Models\Venda\Venda;

class VendaController extends Controller
{
    public function __construct() {
        // ACL DE PERMISSÕES
        $this->middleware('permission:venda', ['only' => ['index']]);
        $this->middleware('permission:venda_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:venda_show', ['only' => ['show', 'print', 'printPdf']]);
        $this->middleware('permission:venda_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:venda_destroy', ['only' => 'destroy']);
        $this->middleware('permission:venda_faturar', ['only' => 'faturar']);
        $this->middleware('permission:venda_cancelar_faturar', ['only' => 'cancelarFaturamento']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('index');
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
    public function store(StoreVendaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Venda $venda)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function print(Venda $venda)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function printPdf(Venda $venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function faturar(Venda $venda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function cancelarFaturamento(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendaRequest $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venda $venda)
    {
        //
    }

}
