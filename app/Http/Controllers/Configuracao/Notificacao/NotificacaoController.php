<?php

namespace App\Http\Controllers\Configuracao\Notificacao;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificacaoRequest;
use App\Http\Requests\UpdateNotificacaoRequest;
use App\Models\Configuracao\Notificacao\Notificacao;

class NotificacaoController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_notificacao', ['only' => 'index']);
        $this->middleware('permission:config_notificacao_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config_notificacao_show', ['only' => 'show']);
        $this->middleware('permission:config_notificacao_edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config_notificacao_destroy', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notificacao = Notificacao::paginate(100);

        return view('configuracao.notificacao.index', [
            'notificacao' => $notificacao,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('configuracao.notificacao.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificacaoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notificacao $notificacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notificacao $notificacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificacaoRequest $request, Notificacao $notificacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificacao $notificacao)
    {
        //
    }
}
