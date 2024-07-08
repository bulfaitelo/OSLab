<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsCliente extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões
        $insert = [
            [
                'description' => 'Acesso a listagem de clientes',
                'name' => 'cliente',
                'guard_name' => 'web',
                'group_id' => 6,
            ],
            [
                'description' => 'Cadastrar Cliente',
                'name' => 'cliente_create',
                'guard_name' => 'web',
                'group_id' => 6,
            ],
            [
                'description' => 'Editar Cliente',
                'name' => 'cliente_edit',
                'guard_name' => 'web',
                'group_id' => 6,
            ],
            [
                'description' => 'Visualizar Cliente',
                'name' => 'cliente_show',
                'guard_name' => 'web',
                'group_id' => 6,
            ],
            [
                'description' => 'Excluir Cliente',
                'name' => 'cliente_destroy',
                'guard_name' => 'web',
                'group_id' => 6,
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
