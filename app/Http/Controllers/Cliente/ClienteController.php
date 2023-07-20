<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use App\Models\Cliente\Cliente;
use Illuminate\Http\Request;


class ClienteController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:cliente', ['only'=> ['index', 'apiClientSelect']]);
        $this->middleware('permission:cliente_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:cliente_show', ['only'=> 'show']);
        $this->middleware('permission:cliente_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:cliente_destroy', ['only'=> 'destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate(100);
        return view ('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view( 'cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request)
    {
        try {
            $cliente = new Cliente();
            $cliente->registro = $request->registro;
            if(strlen($request->registro) > 14 ){ // definido que é um CNPJ
                $cliente->pessoa_juridica = 1;
            }
            $cliente->name = $request->name;
            $cliente->email = $request->email;
            $cliente->celular = $request->celular;
            $cliente->telefone = $request->telefone;
            $cliente->password = $request->password;
            $cliente->cep = $request->cep;
            $cliente->logradouro = $request->logradouro;
            $cliente->numero = $request->numero;
            $cliente->bairro = $request->bairro;
            $cliente->cidade = $request->cidade;
            $cliente->estado = $request->estado;
            $cliente->complemento = $request->complemento;
            $cliente->save();
            return redirect()->route('cliente.index')
            ->with('success', 'Cliente cadastrado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        try {
            $cliente->registro = $request->registro;
            if(strlen($request->registro) > 14 ){ // definido que é um CNPJ
                $cliente->pessoa_juridica = 1;
            }
            $cliente->name = $request->name;
            $cliente->email = $request->email;
            $cliente->celular = $request->celular;
            $cliente->telefone = $request->telefone;
            $cliente->password = $request->password;
            $cliente->cep = $request->cep;
            $cliente->logradouro = $request->logradouro;
            $cliente->numero = $request->numero;
            $cliente->bairro = $request->bairro;
            $cliente->cidade = $request->cidade;
            $cliente->estado = $request->estado;
            $cliente->complemento = $request->complemento;
            $cliente->save();
            return redirect()->route('cliente.index')
            ->with('success', 'Cliente atualizado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('cliente.index')
                ->with('success', 'Cliente excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function apiClientSelect (Request $request) {
        try {
            $cliente = Cliente::where('name', 'LIKE', '%'. $request->q . '%');
            $cliente->orderBy('name');
            $cliente->limit(10);
            $response = [];
            foreach ($cliente->get() as $value) {
                if ($value->pessoa_juridica == 1) {
                    $textoSelect = '[PJ] ';
                } else {
                    $textoSelect = '[PF] ';
                }

                $response[] = [
                    'id' => $value->id,
                    'text' => $textoSelect .  $value->name,
                ];
            }
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            return response()->json($th, 403);
        }
    }
}
