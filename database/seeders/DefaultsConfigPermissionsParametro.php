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
                'description' => 'Acesso a configuração de Categoria de Os',
                'name' => 'config_categoria',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Criar Categoria de Os',
                'name' => 'config_categoria_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Editar Categoria de Os',
                'name' => 'config_categoria_edit',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Visualizar Categoria de Os',
                'name' => 'config_categoria_show',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Excluir Categoria de Os',
                'name' => 'config_categoria_destroy',
                'guard_name' => 'web',
                'group_id' => 3,
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
