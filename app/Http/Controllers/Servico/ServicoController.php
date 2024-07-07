<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use App\Http\Requests\Servico\StoreServicoRequest;
use App\Http\Requests\Servico\UpdateServicoRequest;
use App\Models\Servico\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:servico', ['only' => ['index', 'apiServicoSelect']]);
        $this->middleware('permission:servico_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:servico_show', ['only' => 'show']);
        $this->middleware('permission:servico_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:servico_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicos = Servico::paginate(100);

        return view('servico.index', compact('servicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('servico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicoRequest $request)
    {
        try {
            $servico = new Servico();
            $servico->name = $request->name;
            $servico->descricao = $request->descricao;
            $servico->valor_servico = $request->valor_servico;
            $servico->save();

            return redirect()->route('servico.index')
            ->with('success', 'Serviço cadastrado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        return view('servico.show', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        return view('servico.edit', compact('servico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicoRequest $request, Servico $servico)
    {
        try {
            $servico->name = $request->name;
            $servico->descricao = $request->descricao;
            $servico->valor_servico = $request->valor_servico;
            $servico->save();

            return redirect()->route('servico.index')
            ->with('success', 'Serviço Atualizado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        try {
            $servicoCount = $servico->os->count();
            if ($servicoCount > 0) {
                return redirect()->route('servico.index')
                ->with('warning', 'O servico não pode ser excluído pois está sendo usado em: '.$servicoCount.' Os');
            }
            $servico->delete();

            return redirect()->route('servico.index')
                ->with('success', 'Serviço excluído com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Select Serviço.
     *
     * Retorna o select com os Serviço s via Json.
     *
     * @param  Request  $request  Request da variável Busca,
     * @return response, json Retorna o json para ser montado.
     **/
    public function apiServicoSelect(Request $request)
    {
        try {
            $select = Servico::where('name', 'LIKE', '%'.$request->q.'%');
            $select->orderBy('name');
            $select->limit(10);
            $response = [];
            foreach ($select->get() as $value) {
                $response[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'valor_servico' => $value->valor_servico,
                    'descricao' => $value->descricao,
                ];
            }

            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return response()->json($th, 403);
        }
    }
}
