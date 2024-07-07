<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateDatabaseDefaults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update-defaults';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualizar as permissões e dados padrões do banco de dados com base na classe DatabaseDefaultPermissionsUpdate';

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
     *
     * @return int
     */
    public function handle()
    {
        // Artisan::run('db:seed --class DatabaseDefaultPermissionsUpdate');
        $output = null;
        $retval = null;
        exec('php artisan db:seed --class DatabaseDefaultPermissionsUpdate', $output, $retval);
        if ($retval == 1) {
            echo "\e[41mOCORREU UM ERRO\e[0m";
        }
        foreach ($output as $row) {
            echo  "$row\n";
        }
    }
}
