<?php

namespace App\Http\Controllers\Configuracao\Garantia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Garantia\StoreUpdateGarantiaRequest;
use App\Models\Configuracao\Garantia\Garantia;
use Illuminate\Support\Facades\Auth;

class GarantiaController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_garantia', ['only' => 'index']);
        $this->middleware('permission:config_garantia_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_garantia_show', ['only' => 'show']);
        $this->middleware('permission:config_garantia_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_garantia_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garantias = Garantia::paginate(100);

        return view('configuracao.garantia.index', compact('garantias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.garantia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateGarantiaRequest $request)
    {
        try {
            $garantia = new Garantia();
            $garantia->name = $request->name;
            $garantia->prazo_garantia = $request->prazo_garantia;
            $garantia->garantia = $request->garantia;
            $garantia->user_id = Auth::id();
            $garantia->save();

            return redirect()->route('configuracao.garantia.index')
            ->with('success', 'Garantia criada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Garantia $garantia)
    {
        return view('configuracao.garantia.show', compact('garantia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Garantia $garantia)
    {
        return view('configuracao.garantia.edit', compact('garantia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateGarantiaRequest $request, Garantia $garantia)
    {
        try {
            $garantia->name = $request->name;
            $garantia->prazo_garantia = $request->prazo_garantia;
            $garantia->garantia = $request->garantia;
            $garantia->user_id = Auth::id();
            $garantia->save();

            return redirect()->route('configuracao.garantia.index')
            ->with('success', 'Garantia atualizada com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Garantia $garantia)
    {
        try {
            $garantia->delete();

            return redirect()->route('configuracao.garantia.index')
                ->with('success', 'Garantia excluida com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
