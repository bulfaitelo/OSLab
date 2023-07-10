<?php

namespace App\Http\Controllers\Configuracao\Wiki;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Wiki\StoreModeloRequest;
use App\Http\Requests\Configuracao\Wiki\UpdateModeloRequest;
use App\Models\Configuracao\Wiki\Modelo;
use Illuminate\Http\Request;


class ModeloController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_wiki_modelo', ['only'=> 'index']);
        $this->middleware('permission:config_wiki_modelo_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:config_wiki_modelo_show', ['only'=> 'show']);
        $this->middleware('permission:config_wiki_modelo_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:config_wiki_modelo_destroy', ['only'=> 'destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = Modelo::paginate(100);
        return view('configuracao.wiki.modelo.index', compact('modelos'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.wiki.modelo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModeloRequest $request)
    {
        try {
            $modelo = new Modelo();
            $modelo->name = \Str::upper($request->name);
            $modelo->wiki_id = $request->wiki_id;
            $modelo->save();
            return redirect()->route('configuracao.wiki.modelo.index')
            ->with('success', 'Modelo cadastrado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Modelo $modelo)
    {
        return view('configuracao.wiki.modelo.show', compact('modelo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modelo $modelo)
    {
        return view('configuracao.wiki.modelo.edit', compact('modelo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModeloRequest $request, Modelo $modelo)
    {
        try {
            $modelo->name = \Str::upper($request->name);
            $modelo->wiki_id = $request->wiki_id;
            $modelo->save();
            return redirect()->route('configuracao.wiki.modelo.index')
            ->with('success', 'Modelo atualizado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelo $modelo)
    {
        try {
            $modelo->delete();
            return redirect()->route('configuracao.wiki.modelo.index')
                ->with('success', 'Modelo excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}