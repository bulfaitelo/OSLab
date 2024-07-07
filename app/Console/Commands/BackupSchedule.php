<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class BackupSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza as rotinas de backup respeitando as configurações predefinas';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            if (getConfig('backup_local_store')) {
                Artisan::call('backup:run --only-to-disk=local --disable-notifications');
                Artisan::output();
            }
            if (getConfig('backup_gdrive_store')) {
                Artisan::call('backup:run --only-to-disk=google --disable-notifications');
                echo Artisan::output();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
