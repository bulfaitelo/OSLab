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
                'description' => 'Acesso a Ordem de serviço',
                'name' => 'venda',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Criar Ordem de Serviço',
                'name' => 'venda_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Editar Ordem de Serviço',
                'name' => 'venda_edit',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Visualizar Ordem de Serviço',
                'name' => 'venda_show',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Visualizar Impressão Ordem de Serviço',
                'name' => 'venda_print',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Faturar Ordem de Serviço',
                'name' => 'venda_faturar',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Cancelar Faturamento Ordem de Serviço',
                'name' => 'venda_cancelar_faturar',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Adicionar Receita a Ordem de Serviço',
                'name' => 'venda_receita_pagamento_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Adicionar Despesa a Ordem de Serviço',
                'name' => 'venda_despesa_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Excluir Ordem de Serviço',
                'name' => 'venda_destroy',
                'guard_name' => 'web',
                'group_id' => 3,
            ],

            [
                'description' => 'Acesso a configuração de Garantias',
                'name' => 'config_venda_garantia',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Criar Garantia',
                'name' => 'config_venda_garantia_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Editar Garantia',
                'name' => 'config_venda_garantia_edit',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Visualizar Garantia',
                'name' => 'config_venda_garantia_show',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Excluir Garantia',
                'name' => 'config_venda_garantia_destroy',
                'guard_name' => 'web',
                'group_id' => 3,
            ],

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

            [
                'description' => 'Acesso a configuração de Status de Os',
                'name' => 'config_venda_status',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Criar Status de Os',
                'name' => 'config_venda_status_create',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Editar Status de Os',
                'name' => 'config_venda_status_edit',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Visualizar Status de Os',
                'name' => 'config_venda_status_show',
                'guard_name' => 'web',
                'group_id' => 3,
            ],
            [
                'description' => 'Excluir Status de Os',
                'name' => 'config_venda_status_destroy',
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
