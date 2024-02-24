<?php

namespace App\Http\Controllers\Configuracao\Backup;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configuracao\Backup\StoreBackup;
use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Spatie\Backup\Helpers\Format;
use Spatie\Backup\BackupDestination\Backup;

class BackupController extends Controller
{

    private $recorrenciaBackup = [
        'd' => 'Diario',
        'w' => 'Semanal',
        'm' => 'Mensal',
        'y' => 'Anual'
    ];
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_backup', ['only'=> 'index']);        
        $this->middleware('permission:config_backup_download', ['only'=> ['download', ]]);
        $this->middleware('permission:config_backup_destroy', ['only'=> ['destroy', ]]);

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {        

        return view('configuracao.backup.index', [
            'backupInfo' => $this->getBackupInfo(),            
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




    /**
     * Retona a lista de backup
     *
     */
    private function getBackupInfo() : array {

        $statuses = BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'));
        $info = [];
        foreach ($statuses as $status) {
            $destination = $status->backupDestination();
            $backups = $destination->backups();
            $destInfo = [
                'name' => $destination->backupName(),
                'disk' => $destination->diskName(),
                'storageType' => $destination->filesystemType(),
                'reachable' => $destination->isReachable(),
                'healthy' => $status->isHealthy(),
                'newest' => $this->getFormattedBackupDate($destination->newestBackup()),
                'count' => $backups->count(),
                'storageSpace' => Format::humanReadableSize($destination->usedStorage()),
                'backups' => [],
            ];
            foreach ($backups as $backup) {
                $destInfo['backups'][] = [
                    'name' => explode($destination->backupName().'/', $backup->path())[1],
                    'path' => $this->getFilePAth($destination->diskName(), $backup->path()),
                    'date' => $backup->date(),
                    'size' => Format::humanReadableSize($backup->sizeInBytes()),
                ];
            }
            $info[] = $destInfo;
        }
        return $info;
    }

    protected function getFormattedBackupDate(Backup $backup = null)
    {
        return is_null($backup)
            ? 'No backups present'
            : Format::ageInDays($backup->date());
    }


    /**
     * Retorna o caminho no backup com base no disco e arquivo.
     * @param string $disk Disco onde está o arquivo
     * @param string $fileName nome do arquivo
     * @return string|false retorna o caminho completo ou false caso nao exista

    */
    protected function getFilePAth($disk, $fileName) : string|false {

        $path = 'filesystems.disks.'.$disk.'.root';
        $filePath = config($path).'/'.$fileName;
        if(file_exists($filePath)){
            return $filePath;
        }
        return false;
    }
}
