<?php

namespace App\Http\Controllers\Configuracao\Emitente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Emitente\StoreEmitenteRequest;
use App\Http\Requests\Configuracao\Emitente\UpdateEmitenteRequest;
use App\Models\Configuracao\Sistema\Emitente;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {
            $emitente = new Emitente();
            $emitente->cnpj = $request->registro;
            $emitente->name = $request->name;
            $emitente->fantasia = $request->fantasia;
            $emitente->inscricao_estadual = $request->inscricao_estadual;
            $emitente->porte = $request->porte;
            $emitente->email = $request->email;
            $emitente->telefone = $request->telefone;
            $emitente->cep = $request->cep;
            $emitente->logradouro = $request->logradouro;
            $emitente->numero = $request->numero;
            $emitente->bairro = $request->bairro;
            $emitente->cidade = $request->cidade;
            $emitente->uf = $request->uf;
            $emitente->complemento = $request->complemento;
            $emitente->save();
            DB::commit();
            return redirect()->route('configuracao.emitente.edit', [$emitente])
            ->with('success', 'Emitente cadastrado com sucesso.');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

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
        return view('configuracao.emitente.edit', compact('emitente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmitenteRequest $request, Emitente $emitente)
    {
        DB::beginTransaction();
        try {
            $emitente->cnpj = $request->registro;
            $emitente->name = $request->name;
            $emitente->fantasia = $request->fantasia;
            $emitente->inscricao_estadual = $request->inscricao_estadual;
            $emitente->porte = $request->porte;
            $emitente->email = $request->email;
            $emitente->telefone = $request->telefone;
            $emitente->cep = $request->cep;
            $emitente->logradouro = $request->logradouro;
            $emitente->numero = $request->numero;
            $emitente->bairro = $request->bairro;
            $emitente->cidade = $request->cidade;
            $emitente->uf = $request->uf;
            $emitente->complemento = $request->complemento;
            $emitente->save();
            DB::commit();
            return redirect()->route('configuracao.emitente.edit', [$emitente])
            ->with('success', 'Emitente atualizado com sucesso.');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emitente $emitente)
    {
        //
    }
}
