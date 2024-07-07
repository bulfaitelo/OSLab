<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cliente\StoreClienteRequest;
use App\Http\Requests\Cliente\UpdateClienteRequest;
use App\Models\Cliente\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:cliente', ['only' => ['index', 'apiClientSelect']]);
        $this->middleware('permission:cliente_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cliente_show', ['only' => 'show']);
        $this->middleware('permission:cliente_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cliente_destroy', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $clientes = Cliente::getDataTable($request);
        return view('cliente.index', compact('clientes', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cliente.create');
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
            $cliente->uf = $request->uf;
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
            $cliente->uf = $request->uf;
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
            if($cliente->os->count() > 0){
                return redirect()->route('cliente.index')
                ->with('warning', 'Existem OS cadastradas para esse cliente!');
            }
            $cliente->delete();
            return redirect()->route('cliente.index')
                ->with('success', 'Cliente excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Select cliente
     *
     * Retorna o select com os dados dos clientes via Json.
     *
     * @param Request $request Request da variável Busca,
     * @return response, json Retorna o json para ser montado.
     **/
    public function apiClientSelect (Request $request) {
        try {
            $select = Cliente::where('name', 'LIKE', '%'. $request->q . '%');
            $select->with('os');
            $select->orderBy('name');
            $select->limit(10);
            $response = [];
            foreach ($select->get() as $value) {
                $response[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'tipo' => $value->getTipoCliente(),
                    'os_count' => $value->os->count(),
                ];
            }
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            return response()->json($th, 403);

        }
    }
}
