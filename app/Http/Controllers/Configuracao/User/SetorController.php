<?php

namespace App\Http\Controllers\Configuracao\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSetorRequest;
use App\Models\Configuracao\User\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SetorController extends Controller
{

    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_user_setor', ['only'=> 'index']);
        $this->middleware('permission:config_user_setor_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:config_user_setor_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:config_user_setor_destroy', ['only'=> 'destroy']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setores = Setor::paginate(50);
        return view ('configuracao.users.setores.index', compact('setores'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('configuracao.users.setores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSetorRequest $request)
    {

        DB::beginTransaction();

        try {
            $setor = new Setor;
            $setor->name = $request->setor;
            $setor->save();

            DB::commit();

            return redirect()->route('configuracao.user.setor.index')->with('success', 'Setor cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao cadastrar o setor. Por favor, tente novamente.');
        }
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Configuracao\Setor  $setor
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Setor $setor)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuracao\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function edit(Setor $setor)
    {
        return view ('configuracao.users.setores.edit', compact('setor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuracao\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setor $setor)
    {
        $request->validate([
            'setor' => 'required',
        ]);
        $setor->name = $request->setor;
        if($setor->save()){
            return redirect()->route('configuracao.user.setor.index')->with('success', 'Setor atualizado com sucesso!'); ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuracao\Setor  $setor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setor $setor)
    {
        if($setor->users->count() > 0){
            return redirect()->route('configuracao.user.setor.index')
            ->with('warning', 'Não é possível excluir um setor que existam usuários cadastrados nele!'); ;
        }
        else{
            if($setor->delete()) {
                return redirect()->route('configuracao.user.setor.index')
                ->with('success', 'Setor Excluído com Sucesso!'); ;
            }
        }

    }
}
