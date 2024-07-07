<?php

namespace App\Livewire\Configuracao\Backup;

use Livewire\Component;
use Spatie\Backup\BackupDestination\Backup as SpatieBackup;
use Spatie\Backup\Helpers\Format;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

class Backup extends Component
{
    public $readyToLoad = false;

    public function loadBackups()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        return view('livewire.configuracao.backup.backup', [
            'backupInfo' => $this->readyToLoad
                ? $this->getBackupInfo()
                : [],
        ]);
    }

    /**
     * Retorna a lista de backup.
     */
    private function getBackupInfo(): array
    {
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

    protected function getFormattedBackupDate(SpatieBackup $backup = null)
    {
        return is_null($backup)
            ? 'No backups present'
            : Format::ageInDays($backup->date());
    }

    /**
     * Retorna o caminho no backup com base no disco e arquivo.
     *
     * @param  string  $disk  Disco onde está o arquivo
     * @param  string  $fileName  nome do arquivo
     * @return string|false retorna o caminho completo ou false caso nao exista
     */
    protected function getFilePAth($disk, $fileName): string|false
    {
        $path = 'filesystems.disks.'.$disk.'.root';
        $filePath = config($path).'/'.$fileName;
        if (file_exists($filePath)) {
            return $filePath;
        }

        return false;
    }
}
