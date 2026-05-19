<?php

namespace Database\Seeders;

use App\Models\Configuracao\Sistema\Emitente;
use Illuminate\Database\Seeder;

class EmitenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria um emitente principal com ID = 1
        Emitente::factory()->principal()->create();
    }
}
