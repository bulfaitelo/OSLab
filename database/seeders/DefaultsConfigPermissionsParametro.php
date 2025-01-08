<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsParametro extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões
        $insert = [
            [
                'description' => 'Acesso a configuração de Categoria',
                'name' => 'config_categoria',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Criar Categoria',
                'name' => 'config_categoria_create',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Editar Categoria',
                'name' => 'config_categoria_edit',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Visualizar Categoria',
                'name' => 'config_categoria_show',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Excluir Categoria',
                'name' => 'config_categoria_destroy',
                'guard_name' => 'web',
                'group_id' => 15,
            ],

            [
                'description' => 'Acesso a configuração de Status',
                'name' => 'config_status',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Criar Status',
                'name' => 'config_status_create',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Editar Status',
                'name' => 'config_status_edit',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Visualizar Status',
                'name' => 'config_status_show',
                'guard_name' => 'web',
                'group_id' => 15,
            ],
            [
                'description' => 'Excluir Status',
                'name' => 'config_status_destroy',
                'guard_name' => 'web',
                'group_id' => 15,
            ],

        ];

        foreach ($insert as $key => $value) {
            Permission::updateOrCreate(
                // DB::table('permissions')->updateOrInsert(
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
