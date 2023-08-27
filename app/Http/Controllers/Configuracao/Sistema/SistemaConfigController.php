<?php

namespace App\Http\Controllers\Configuracao\Sistema;

use App\Http\Controllers\Controller;

use App\Http\Requests\Configuracao\Sistema\StoreSistemaConfigRequest;
use App\Http\Requests\Configuracao\Sistema\UpdateSistemaConfigRequest;
use App\Models\Configuracao\Sistema\SistemaConfig;


class SistemaConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configuracoes = SistemaConfig::get();
        return view('configuracao.sistema.index', compact('configuracoes'));
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
    public function store(StoreSistemaConfigRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SistemaConfig $sistemaConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SistemaConfig $sistemaConfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSistemaConfigRequest $request, SistemaConfig $sistemaConfig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SistemaConfig $sistemaConfig)
    {
        //
    }
}
