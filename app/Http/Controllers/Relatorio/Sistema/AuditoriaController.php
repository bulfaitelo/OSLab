<?php

namespace App\Http\Controllers\Relatorio\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditoriaController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:relatorio_sistema_auditoria', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the audit records.
     */
    public function index(Request $request)
    {
        $auditorias = Audit::query();
        $auditorias->with('user');

        // Filtro por modelo
        if ($request->filled('auditable_type')) {
            $auditorias->where('auditable_type', $request->auditable_type);
        }

        // Filtro por tipo de evento
        if ($request->filled('event')) {
            $auditorias->where('event', $request->event);
        }

        // Filtro por usuário
        if ($request->filled('user_id')) {
            $auditorias->where('user_id', $request->user_id);
        }

        // Filtro por ID do registro auditado
        if ($request->filled('auditable_id')) {
            $auditorias->where('auditable_id', $request->auditable_id);
        }

        // Filtro por data
        if ($request->filled('data_inicio')) {
            $auditorias->whereDate('created_at', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $auditorias->whereDate('created_at', '<=', $request->data_fim);
        }

        // Ordenação padrão
        $auditorias = $auditorias->latest('created_at')->paginate(50);

        // Obter lista de modelos auditados para o filtro
        $modelos = Audit::select('auditable_type')
            ->distinct()
            ->orderBy('auditable_type')
            ->pluck('auditable_type')
            ->toArray();

        $modelos = collect($modelos)
            ->mapWithKeys(fn ($type) => [$type => class_basename($type)])
            ->all();

        // Obter lista de usuários
        $usuarios = \App\Models\User::orderBy('name')->pluck('name', 'id');

        return view('relatorio.sistema.auditoria.index', [
            'auditorias' => $auditorias,
            'request' => $request,
            'modelos' => $modelos,
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * Display the specified audit record.
     */
    public function show(Audit $auditoria)
    {
        return view('relatorio.sistema.auditoria.show', [
            'auditoria' => $auditoria,
        ]);
    }
}
