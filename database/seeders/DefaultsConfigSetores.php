<?php

namespace Database\Seeders;

use App\Models\Configuracao\User\Setor;
use Illuminate\Database\Seeder;

class DefaultsConfigSetores extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Técnico',
            ],
            [
                'id' => 2,
                'name' => 'Atendente',
            ],

        ];

        foreach ($insert as $key => $value) {
            Setor::updateOrCreate(
                // DB::table('permissions')->updateOrInsert(
                ['id' => $value['id'],
                ],
                [
                    'name' => $value['name'],
                ]
            );
        }
    }
}
