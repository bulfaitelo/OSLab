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

            [
                'description' => 'Acesso a configuração Forma de Pagamento',
                'name' => 'config_financeiro_forma_pagamento',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Criar Forma de Pagamento',
                'name' => 'config_financeiro_forma_pagamento_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Editar Forma de Pagamento',
                'name' => 'config_financeiro_forma_pagamento_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Visualizar Forma de Pagamento',
                'name' => 'config_financeiro_forma_pagamento_show',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Forma de Pagamento',
                'name' => 'config_financeiro_forma_pagamento_destroy',
                'guard_name' => 'web',
                'group_id' => 5,
            ],

            [
                'description' => 'Acesso aos Lançamentos',
                'name' => 'financeiro_lancamento',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Criar Lançamento',
                'name' => 'financeiro_lancamento_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Editar Lançamento',
                'name' => 'financeiro_lancamento_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Visualizar Lançamento',
                'name' => 'financeiro_lancamento_show',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Lançamento',
                'name' => 'financeiro_lancamento_destroy',
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
