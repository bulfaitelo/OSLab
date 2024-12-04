<?php

namespace App\Http\Controllers\Configuracao\Os;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Os\StoreUpdateOsStatusRequest;
use App\Models\Configuracao\Os\OsStatus;

class OsStatusController extends Controller
{
    public $corArray;

    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_os_status', ['only' => 'index']);
        $this->middleware('permission:config_os_status_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_os_status_show', ['only' => 'show']);
        $this->middleware('permission:config_os_status_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_os_status_destroy', ['only' => 'destroy']);

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
        $status = OsStatus::paginate(100);

        return view('configuracao.os.status.index', compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cor_array = $this->corArray;

        return view('configuracao.os.status.create', compact('cor_array'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateOsStatusRequest $request)
    {
        try {
            $status = new OsStatus();
            $status->name = $request->name;
            $status->descricao = $request->descricao;
            $status->color = $request->color;
            $status->ativar_email = $request->ativar_email;
            $status->prazo_email = $request->prazo_email;
            $status->ativar_rastreio = $request->ativar_rastreio;
            $status->garantia = $request->garantia;
            $status->save();

            return redirect()->route('configuracao.os.status.index')
            ->with('success', 'Status criado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OsStatus $status)
    {
        $cor_array = $this->corArray;

        return view('configuracao.os.status.show', compact('status', 'cor_array'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OsStatus $status)
    {
        $cor_array = $this->corArray;

        return view('configuracao.os.status.edit', compact('status', 'cor_array'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateOsStatusRequest $request, OsStatus $status)
    {
        try {
            $status->name = $request->name;
            $status->descricao = $request->descricao;
            $status->color = $request->color;
            $status->ativar_email = $request->ativar_email;
            $status->prazo_email = $request->prazo_email;
            $status->ativar_rastreio = $request->ativar_rastreio;
            $status->garantia = $request->garantia;
            $status->save();

            return redirect()->route('configuracao.os.status.index')
            ->with('success', 'Status atualizado com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OsStatus $status)
    {
        try {
            $status->delete();

            return redirect()->route('configuracao.os.status.index')
                ->with('success', 'Status excluído com sucesso.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
