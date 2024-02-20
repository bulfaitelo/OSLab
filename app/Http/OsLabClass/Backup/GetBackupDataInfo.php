<?php

namespace App\Http\OsLabClass\Backup;
use Spatie\Backup\Commands\ListCommand;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;
use Illuminate\Support\Collection;
/**
 *
 *
 */

class GetBackupDataInfo extends ListCommand {

    public function teste() {
        // $statuses = BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'));

        // $this->displayOverview($statuses);
        // // $this->displayFailures($statuses);

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
                'count' => $backups->count(),
                'storageSpace' => $destination->usedStorage(),
                'backups' => [],
            ];
            foreach ($backups as $backup) {
                $destInfo['backups'][] = [
                    'path' => $backup->path(),
                    'date' => $backup->date(),
                    'size' => $backup->sizeInBytes(),
                ];
            }
            $info[] = $destInfo;
        }
        return $info;
    }



};

