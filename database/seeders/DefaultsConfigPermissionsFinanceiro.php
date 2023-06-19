<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class DefaultsConfigPermissionsFinanceiro extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // permissões
        $insert = [
            [
                'description' => 'Acesso a configuração Centro de custo Financeiro ',
                'name' => 'config_financeiro_centro_custo',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Criar Centro de custo',
                'name' => 'config_financeiro_centro_custo_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Editar Centro de custo',
                'name' => 'config_financeiro_centro_custo_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Editar permissões de Centro de custo',
                'name' => 'config_financeiro_centro_custo_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Visualizar Centro de custo',
                'name' => 'config_financeiro_centro_custo_show',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Centro de custo',
                'name' => 'config_financeiro_centro_custo_destroy',
                'guard_name' => 'web',
                'group_id' => 5,
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
