<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Configuracao\User\PermissionsGroup;


class DefaultsConfigGroupPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [

            [   'id' => 1,
                'name' => 'Configuração',
            ],

            [   'id' => 2,
                'name' => 'Relatórios',
            ],

            [   'id' => 3,
                'name' => 'Ordem Serviço',
            ],

        ];
        foreach ($insert as $key => $value) {
            PermissionsGroup::updateOrCreate(
            // DB::table('permissions')->updateOrInsert(
                [   'id' => $value['id'],
                ],
                [
                    'name'  => $value['name'],
                ]
            );
        }
    }
}