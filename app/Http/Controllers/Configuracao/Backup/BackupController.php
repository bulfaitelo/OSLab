<?php

namespace App\Http\Controllers\Configuracao\Backup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupController extends Controller
{

    private $recorrenciaBackup = [
        'd' => 'Diario',
        'w' => 'Semanal',
        'm' => 'Mensal',
        'y' => 'Anual'
    ];
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_backup', ['only' => 'index']);
        $this->middleware('permission:config_backup_download', ['only' => ['download', ]]);
        $this->middleware('permission:config_backup_destroy', ['only' => ['destroy', ]]);

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('configuracao.backup.index', [
        ]);
    }


    /**
     * Baixa o arquivo.
     */
    public function download(Request $request)
    {
        if(file_exists($request->path)){
            return response()->download($request->path);
        }
        return false;
    }

    /**
     * Baixa o arquivo.
     */
    public function destroy(Request $request)
    {

        if(file_exists($request->path)){
            try {
                unlink($request->path);
                return redirect()->route('configuracao.backup.index')
                ->with('success', 'Backup Excluído com sucesso.');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return redirect()->route('configuracao.backup.index')
            ->with('danger', 'Houve um erro na exclusão od arquivo');

    }



}
