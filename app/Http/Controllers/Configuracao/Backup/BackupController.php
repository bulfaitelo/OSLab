<?php

namespace App\Http\Controllers\Configuracao\Backup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Spatie\Backup\Helpers\Format;
use Spatie\Backup\BackupDestination\Backup;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('configuracao.backup.index', [
            'backupInfo' => $this->getBackupInfo()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
                    // 'path' => storage_path($backup->path()),
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

    // $path = storage_path('app/OsLab/OsLab_2023-02-19-14-36-53.zip');
    //         return response()->download($path);
}
