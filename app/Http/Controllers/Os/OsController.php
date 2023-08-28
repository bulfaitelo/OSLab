<?php

namespace App\Http\Controllers\Os;

use App\Http\Controllers\Controller;
use App\Http\Requests\Os\StoreOsRequest;
use App\Http\Requests\Os\UpdateOsRequest;
use App\Models\Os\Os;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OsController extends Controller
{

    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:os', ['only'=> 'index']);
        $this->middleware('permission:os_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:os_show', ['only'=> 'show']);
        $this->middleware('permission:os_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:os_destroy', ['only'=> 'destroy']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dataHoje = Carbon::now()->format('Y-d-m');
        $queryOs = Os::query();
        $queryOs->with('cliente');
        $queryOs->with('tecnico');
        $queryOs->with('categoria');
        if ($request->busca) {
            $queryOs->where(function ($query) use ($request){
                $query->whereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->busca . '%');
                });
                $query->orWhere('descricao', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('defeito', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('observacoes', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('laudo', 'LIKE', '%' . $request->busca . '%');
                $query->orWhereHas('modelo', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->busca . '%');
                });
            });
        }
        if ($request->categoria_id) {
            $queryOs->where('categoria_id', $request->categoria_id);
        }
        if (($request->data_inicial) || ($request->data_final)) {
            ($request->data_inicial) ? $dataInicial = $request->data_inicial : $dataInicial = $dataHoje;
            ($request->data_final) ? $dataFinal = $request->data_final : $dataFinal = $dataHoje;
            $queryOs->where(function ($query) use ($dataInicial, $dataFinal) {
                $query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_entrada', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_saida', [$dataInicial, $dataFinal]);
            });
        }
        if ($request->status_id) {
            $queryOs->where('status_id', $request->status_id);
        }
        $queryOs->orderBy('id', 'desc');
        $os = $queryOs->paginate(100);
        return view('os.index', compact('os', 'request'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('os.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOsRequest $request)
    {
        // dd($request->input());
        DB::beginTransaction();
        try {
            $os = new Os();
            $os->user_id = Auth::id();
            $os->cliente_id = $request->cliente_id;
            $os->tecnico_id = $request->tecnico_id;
            $os->categoria_id = $request->categoria_id;
            $os->modelo_id = $request->modelo_id;
            $os->status_id = $request->status_id;
            $os->data_entrada = $request->data_entrada;
            $os->data_saida = $request->data_saida;
            $os->descricao = $request->descricao;
            $os->defeito = $request->defeito;
            $os->observacoes = $request->observacoes;
            $os->laudo = $request->laudo;
            $os->save();

            DB::commit();
            return redirect()->route('os.edit', $os->id)
            ->with('success', 'Os cadastrada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Os $os)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Os $os)
    {
        return view('os.edit', compact('os'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOsRequest $request, Os $os)
    {
        // dd($request->input());
        DB::beginTransaction();
        try {
            $os->user_id = Auth::id();
            $os->cliente_id = $request->cliente_id;
            $os->tecnico_id = $request->tecnico_id;
            $os->categoria_id = $request->categoria_id;
            $os->modelo_id = $request->modelo_id;
            $os->status_id = $request->status_id;
            $os->data_entrada = $request->data_entrada;
            $os->data_saida = $request->data_saida;
            $os->descricao = $request->descricao;
            $os->defeito = $request->defeito;
            $os->observacoes = $request->observacoes;
            $os->laudo = $request->laudo;
            $os->save();

            DB::commit();
            return redirect()->route('os.edit', $os->id)
            ->with('success', 'Os Atualizada com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Os $os)
    {
        //
    }
}
