<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsSistema extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões
        $insert = [
            [
                'description' => 'Acesso as configurações de sistema',
                'name' => 'config_sistema',
                'guard_name' => 'web',
                'group_id' => 11,
            ],
            [
                'description' => 'Editar configurações de sistema',
                'name' => 'config_sistema_edit',
                'guard_name' => 'web',
                'group_id' => 11,
            ],

        ];

        foreach ($insert as $key => $value) {
            Permission::updateOrCreate(
                ['name' => $value['name'],
                    'guard_name' => $value['guard_name'],
                ],
                [
                    'group_id' => $value['group_id'],
                    'description' => $value['description'],
                ]
            );
        }
    }
}
