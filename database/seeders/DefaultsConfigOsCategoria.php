<?php

namespace Database\Seeders;

use App\Models\Configuracao\Os\OsCategoria;
use Illuminate\Database\Seeder;

class DefaultsConfigOsCategoria extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Smartphone',
                'descricao' => '',
                'garantia_id' => 1,
                'user_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Notebook',
                'descricao' => '',
                'garantia_id' => 1,
                'user_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Desktop',
                'descricao' => '',
                'garantia_id' => 1,
                'user_id' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Acesso Remoto',
                'descricao' => '',
                'garantia_id' => null,
                'user_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Console',
                'descricao' => '',
                'garantia_id' => 1,
                'user_id' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Outros',
                'descricao' => '',
                'garantia_id' => 1,
                'user_id' => 1,
            ],

        ];

        foreach ($insert as $key => $value) {
            OsCategoria::updateOrCreate(
                [
                    'id' => $value['id'],
                ],
                [
                    'name' => $value['name'],
                    'descricao' => $value['descricao'],
                    'garantia_id' => $value['garantia_id'],
                    'user_id' => $value['user_id'],

                ]
            );
        }
    }
}
