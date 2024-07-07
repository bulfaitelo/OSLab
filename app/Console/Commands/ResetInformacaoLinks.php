<?php

namespace App\Console\Commands;

use App\Models\Os\OsInformacao;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetInformacaoLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-informacao-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executa a rotina de apagar os links para as informações após expirar. ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            OsInformacao::where('validade_link', '<', now())
                ->update([
                    'uuid'          => null,
                    'validade_link' => null,
                    'status'        => 2,
                ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
