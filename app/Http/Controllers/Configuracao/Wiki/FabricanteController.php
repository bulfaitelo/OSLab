<?php

namespace App\Http\Controllers\Configuracao\Wiki;

use App\Http\Controllers\Controller;

use App\Http\Requests\Configuracao\Wiki\StoreFabricanteRequest;
use App\Http\Requests\Configuracao\Wiki\UpdateFabricanteRequest;
use App\Models\Configuracao\Wiki\Fabricante;

class FabricanteController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_wiki_fabricante', ['only' => 'index']);
        $this->middleware('permission:config_wiki_fabricante_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_wiki_fabricante_show', ['only' => 'show']);
        $this->middleware('permission:config_wiki_fabricante_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_wiki_fabricante_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fabricantes = Fabricante::paginate(100);

        return view('configuracao.wiki.fabricante.index', compact('fabricantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.wiki.fabricante.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFabricanteRequest $request)
    {
        try {
            $fabricante = new Fabricante();
            $fabricante->name = $request->name;
            $fabricante->descricao = $request->descricao;
            $fabricante->save();

            return redirect()->route('configuracao.wiki.fabricante.index')
            ->with('success', 'Fabricante cadastrado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fabricante $fabricante)
    {
        return view('configuracao.wiki.fabricante.show', compact('fabricante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fabricante $fabricante)
    {
        return view('configuracao.wiki.fabricante.edit', compact('fabricante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFabricanteRequest $request, Fabricante $fabricante)
    {
        try {
            $fabricante->name = $request->name;
            $fabricante->descricao = $request->descricao;
            $fabricante->save();

            return redirect()->route('configuracao.wiki.fabricante.index')
            ->with('success', 'Fabricante atualizado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fabricante $fabricante)
    {
        try {
            $fabricante->delete();

            return redirect()->route('configuracao.wiki.fabricante.index')
                ->with('success', 'Fabricante excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
