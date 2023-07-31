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
                'description' => 'Acesso as Despesas',
                'name' => 'financeiro_despesa',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Criar Despesa',
                'name' => 'financeiro_despesa_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Editar Despesa',
                'name' => 'financeiro_despesa_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Visualizar Despesa',
                'name' => 'financeiro_despesa_show',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Despesa',
                'name' => 'financeiro_despesa_destroy',
                'guard_name' => 'web',
                'group_id' => 5,
            ],

            [
                'description' => 'Criar Pagamento Despesa',
                'name' => 'financeiro_despesa_pagamento_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'editar Pagamento Despesa',
                'name' => 'financeiro_despesa_pagamento_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Pagamento Despesa',
                'name' => 'financeiro_despesa_pagamento_destroy',
                'guard_name' => 'web',
                'group_id' => 5,
            ],

            [
                'description' => 'Acesso as Receitas',
                'name' => 'financeiro_receita',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Criar Receita',
                'name' => 'financeiro_receita_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Editar Receita',
                'name' => 'financeiro_receita_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Visualizar Receita',
                'name' => 'financeiro_receita_show',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Receita',
                'name' => 'financeiro_receita_destroy',
                'guard_name' => 'web',
                'group_id' => 5,
            ],

            [
                'description' => 'Criar Pagamento Receita',
                'name' => 'financeiro_receita_pagamento_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'editar Pagamento Receita',
                'name' => 'financeiro_receita_pagamento_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Pagamento Receita',
                'name' => 'financeiro_receita_pagamento_destroy',
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
