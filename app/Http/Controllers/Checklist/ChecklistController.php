<?php

namespace App\Http\Controllers\Checklist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checklist\StoreUpdateChecklistRequest;
use App\Models\Checklist\Checklist;
use App\Models\Configuracao\Os\CategoriaOs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChecklistController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:checklist', ['only'=> 'index']);
        $this->middleware('permission:checklist_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:checklist_show', ['only'=> 'show']);
        $this->middleware('permission:checklist_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:checklist_destroy', ['only'=> 'destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checklists = Checklist::paginate(100);
        return view('checklist.index', compact('checklists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('checklist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateChecklistRequest $request)
    {
        DB::beginTransaction();
        try {
            $checklist = new Checklist();
            $checklist->name = $request->checklist_name;
            $checklist->categoria_id = $request->categoria_id;
            $checklist->descricao = $request->descricao;
            $checklist->user_id = Auth::id();
            $checklist->checklist = $request->checklist;
            $checklist->save();
            DB::commit();
            return redirect()->route('checklist.index')
            ->with('success', 'Checklist cadastrado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;

        }
    }




    /**
     * Display the specified resource.
     */
    public function show(Checklist $checklist)
    {
        return view('checklist.show', compact('checklist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Checklist $checklist)
    {
        return view('checklist.edit', compact('checklist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateChecklistRequest $request, Checklist $checklist)
    {
        DB::beginTransaction();
        try {
            $checklist->name = $request->checklist_name;
            $checklist->categoria_id = $request->categoria_id;
            $checklist->descricao = $request->descricao;
            $checklist->user_id = Auth::id();
            $checklist->checklist = $request->checklist;
            $checklist->save();
            DB::commit();
            return redirect()->route('checklist.index')
            ->with('success', 'Checklist Atualizado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Checklist $checklist)
    {
        try {
            if (CategoriaOs::where('checklist_id', $checklist->id)->count() > 0) {
                return redirect()->route('checklist.index')
                ->with('warning', 'Checklist está sendo usado em alguma categoria!');
            }
            $checklist->delete();
            return redirect()->route('checklist.index')
                ->with('success', 'Checklist excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function getOpcoes($checklist) : array {
        foreach (json_decode($checklist) as $key => $value) {
            $opcoes[$key]['name'] =  (isset($value->name)) ? $value->name : null ;
            $opcoes[$key]['type'] =  (isset($value->type)) ? $value->type : null ;
            $opcoes[$key]['user_id'] = auth()->id();
            $opcoes[$key]['opcao'] = json_encode($value);
        }
        return $opcoes;
    }
}
