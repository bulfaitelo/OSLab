<?php

namespace App\Http\Controllers\Configuracao\Parametro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Parametro\StoreUpdateCategoriaRequest;
use App\Models\Configuracao\Parametro\Categoria;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_categoria', ['only' => 'index']);
        $this->middleware('permission:config_categoria_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_categoria_show', ['only' => 'show']);
        $this->middleware('permission:config_categoria_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_categoria_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = Categoria::with('garantia')
            ->with('centroCusto')
            ->paginate(100);

        return view('configuracao.parametro.categoria.index', compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.parametro.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCategoriaRequest $request)
    {
        try {
            $categoria = new Categoria;
            $categoria->name = $request->name;
            $categoria->descricao = $request->descricao;
            $categoria->user_id = Auth::id();
            $categoria->garantia_id = $request->garantia_id;
            $categoria->centro_custo_id = $request->centro_custo_id;
            $categoria->checklist_id = $request->checklist_id;
            $categoria->checklist_required = $request->checklist_required;
            $categoria->save();

            return redirect()->route('configuracao.parametro.categoria.index')
                ->with('success', 'Categoria criada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('configuracao.parametro.categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('configuracao.parametro.categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateCategoriaRequest $request, Categoria $categoria)
    {
        try {
            $categoria->name = $request->name;
            $categoria->descricao = $request->descricao;
            $categoria->user_id = Auth::id();
            $categoria->garantia_id = $request->garantia_id;
            $categoria->centro_custo_id = $request->centro_custo_id;
            $categoria->checklist_id = $request->checklist_id;
            $categoria->checklist_required = $request->checklist_required;
            $categoria->save();

            return redirect()->route('configuracao.parametro.categoria.index')
                ->with('success', 'Categoria atualizada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();

            return redirect()->route('configuracao.parametro.categoria.index')
                ->with('success', 'Categoria excluida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
