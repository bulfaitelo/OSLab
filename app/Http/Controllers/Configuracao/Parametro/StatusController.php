<?php

namespace App\Http\Controllers\Configuracao\Parametro;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Parametro\StoreUpdateStatusRequest;
use App\Models\Configuracao\Parametro\Status;

class StatusController extends Controller
{
    public $corArray;

    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_status', ['only' => 'index']);
        $this->middleware('permission:config_status_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_status_show', ['only' => 'show']);
        $this->middleware('permission:config_status_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_status_destroy', ['only' => 'destroy']);

        $this->corArray = [
            'bg-primary',
            'bg-secondary',
            'bg-info',
            'bg-success',
            'bg-warning',
            'bg-danger',
            'bg-indigo',
            'bg-lightblue',
            'bg-navy',
            'bg-purple',
            'bg-fuchsia',
            'bg-pink',
            'bg-maroon',
            'bg-orange',
            'bg-lime',
            'bg-teal',
            'bg-olive',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = Status::paginate(100);

        return view('configuracao.parametro.status.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cor_array = $this->corArray;

        return view('configuracao.parametro.status.create', compact('cor_array'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateStatusRequest $request)
    {
        try {
            $status = new Status();
            $status->name = $request->name;
            $status->descricao = $request->descricao;
            $status->color = $request->color;
            $status->ativar_email = $request->ativar_email;
            $status->prazo_email = $request->prazo_email;
            $status->ativar_rastreio = $request->ativar_rastreio;
            $status->garantia = $request->garantia;
            $status->os = $request->os;
            $status->venda = $request->venda;
            $status->save();

            return redirect()->route('configuracao.parametro.status.index')
            ->with('success', 'Status criado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        $cor_array = $this->corArray;

        return view('configuracao.parametro.status.show', compact('status', 'cor_array'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        $cor_array = $this->corArray;

        return view('configuracao.parametro.status.edit', compact('status', 'cor_array'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateStatusRequest $request, Status $status)
    {
        try {
            $status->name = $request->name;
            $status->descricao = $request->descricao;
            $status->color = $request->color;
            $status->ativar_email = $request->ativar_email;
            $status->prazo_email = $request->prazo_email;
            $status->ativar_rastreio = $request->ativar_rastreio;
            $status->garantia = $request->garantia;
            $status->os = $request->os;
            $status->venda = $request->venda;
            $status->save();

            return redirect()->route('configuracao.parametro.status.index')
            ->with('success', 'Status atualizado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        try {
            $status->delete();

            return redirect()->route('configuracao.parametro.status.index')
                ->with('success', 'Status excluído com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
