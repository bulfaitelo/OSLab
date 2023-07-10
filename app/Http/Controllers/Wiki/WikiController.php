<?php

namespace App\Http\Controllers\Wiki;

use App\Http\Controllers\Controller;
use App\Http\Requests\Wiki\StoreWikiRequest;
use App\Http\Requests\Wiki\UpdateWikiRequest;
use App\Models\Wiki\Wiki;
use App\Models\Configuracao\Wiki\Modelo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WikiController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:wiki', ['only'=> 'index']);
        $this->middleware('permission:wiki_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:wiki_show', ['only'=> 'show']);
        $this->middleware('permission:wiki_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:wiki_destroy', ['only'=> 'destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wikis = Wiki::paginate(100);
        return view('wiki.index',compact('wikis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wiki.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWikiRequest $request)
    {
        $wiki = new Wiki();
        $modelo = new Modelo();
        DB::beginTransaction();
        try {
            $wiki->name = $request->name;
            $wiki->fabricante_id = $request->fabricante_id;
            $wiki->categoria_id = $request->categoria_id;
            $wiki->user_id = Auth::id();
            $wiki->save();
            $modelo->name = \Str::upper($request->modelo);
            $modelo->wiki_id = $wiki->id;
            $modelo->save();
            DB::commit();
            return redirect()->route('wiki.show', $wiki->id)
            ->with('success', 'Wiki cadastrado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Wiki $wiki)
    {
        return view('wiki.show', compact('wiki'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wiki $wiki)
    {
        return view('wiki.edit', compact('wiki'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWikiRequest $request, Wiki $wiki)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wiki $wiki)
    {
        try {
            $wiki->delete();
            return redirect()->route('wiki.index')
                ->with('success', 'Wiki excluída com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
