<?php

namespace App\Http\Controllers\Configuracao\Emitente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Emitente\StoreEmitenteRequest;
use App\Http\Requests\Configuracao\Emitente\UpdateEmitenteRequest;
use App\Models\Configuracao\Sistema\Emitente;

class EmitenteController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_emitente', ['only'=> ['index', 'apiClientSelect']]);
        $this->middleware('permission:config_emitente_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:config_emitente_show', ['only'=> 'show']);
        $this->middleware('permission:config_emitente_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:config_emitente_destroy', ['only'=> 'destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emitente = Emitente::find(1);
        // dd($emitente);
        if(!$emitente){
            return redirect()->route('configuracao.emitente.create');
        }
        return  redirect()->route('configuracao.emitente.edit', [$emitente]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.emitente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmitenteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Emitente $emitente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emitente $emitente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmitenteRequest $request, Emitente $emitente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emitente $emitente)
    {
        //
    }
}
