<?php

namespace App\Http\Controllers\Configuracao\Os;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Os\StoreUpdateOsCategoriaRequest;
use App\Models\Configuracao\Os\OsCategoria;
use Illuminate\Support\Facades\Auth;

class OsCategoriaController extends Controller
{

    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_os_categoria', ['only' => 'index']);
        $this->middleware('permission:config_os_categoria_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_os_categoria_show', ['only' => 'show']);
        $this->middleware('permission:config_os_categoria_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_os_categoria_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoria = OsCategoria::with('garantia')
                ->with('centroCusto')
                ->paginate(100);

        return view('configuracao.os.categoria.index', compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.os.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateOsCategoriaRequest $request)
    {
        try {
            $categoria = new OsCategoria();
            $categoria->name = $request->name;
            $categoria->descricao = $request->descricao;
            $categoria->user_id = Auth::id();
            $categoria->garantia_id = $request->garantia_id;
            $categoria->centro_custo_id = $request->centro_custo_id;
            $categoria->checklist_id = $request->checklist_id;
            $categoria->checklist_required = $request->checklist_required;
            $categoria->save();

            return redirect()->route('configuracao.os.categoria.index')
            ->with('success', 'Categoria criada com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OsCategoria $categoria)
    {
        return view('configuracao.os.categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OsCategoria $categoria)
    {
        return view('configuracao.os.categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOsCategoriaRequest $request, OsCategoria $categoria)
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

            return redirect()->route('configuracao.os.categoria.index')
            ->with('success', 'Categoria atualizada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OsCategoria $categoria)
    {
        try {
            $categoria->delete();
            return redirect()->route('configuracao.os.categoria.index')
                ->with('success', 'Categoria excluida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
