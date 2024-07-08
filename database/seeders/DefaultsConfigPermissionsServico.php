<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsServico extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões
        $insert = [
            [
                'description' => 'Acesso a listagem de Serviços',
                'name' => 'servico',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Cadastrar Serviço',
                'name' => 'servico_create',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Editar Serviço',
                'name' => 'servico_edit',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Visualizar Serviço',
                'name' => 'servico_show',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Excluir Serviço',
                'name' => 'servico_destroy',
                'guard_name' => 'web',
                'group_id' => 7,
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
