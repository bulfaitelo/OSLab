<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsVenda extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões
        $insert = [
            [
                'description' => 'Acesso a Vendas',
                'name' => 'venda',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Criar Venda',
                'name' => 'venda_create',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Editar Venda',
                'name' => 'venda_edit',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Visualizar Venda',
                'name' => 'venda_show',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Visualizar Impressão Venda',
                'name' => 'venda_print',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Faturar Venda',
                'name' => 'venda_faturar',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Cancelar Faturamento Venda',
                'name' => 'venda_cancelar_faturar',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Adicionar Receita a Venda',
                'name' => 'venda_receita_pagamento_create',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Adicionar Despesa a Venda',
                'name' => 'venda_despesa_create',
                'guard_name' => 'web',
                'group_id' => 13,
            ],
            [
                'description' => 'Excluir Venda',
                'name' => 'venda_destroy',
                'guard_name' => 'web',
                'group_id' => 13,
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
