<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsOs extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // permissões
        $insert = [
            [
                'description' => 'Acesso a configuração de Garantias',
                'name' => 'config_os_garantia',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Criar Garantia',
                'name' => 'config_os_garantia_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Editar Garantia',
                'name' => 'config_os_garantia_edit',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Visualizar Garantia',
                'name' => 'config_os_garantia_show',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Excluir Garantia',
                'name' => 'config_os_garantia_destroy',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Acesso a configuração de Categoria de Os',
                'name' => 'config_os_categoria',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Criar Categoria de Os',
                'name' => 'config_os_categoria_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Editar Categoria de Os',
                'name' => 'config_os_categoria_edit',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Visualizar Categoria de Os',
                'name' => 'config_os_categoria_show',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Excluir Categoria de Os',
                'name' => 'config_os_categoria_destroy',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
        ];


        foreach ($insert as $key => $value) {
            Permission::updateOrCreate(
            // DB::table('permissions')->updateOrInsert(
                [   'name' => $value['name'],
                    'guard_name' => $value['guard_name']
                ],
                [
                    'group_id'  => $value['group_id'],
                    'description' => $value['description'],
                ]
            );
        }
    }
}
