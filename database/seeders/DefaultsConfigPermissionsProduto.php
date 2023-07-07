<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsProduto extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // permissões
        $insert = [
            [
                'description' => 'Acesso a listagem de Produtos',
                'name' => 'produto',
                'guard_name' => 'web',
                'group_id' => 8,
            ],
            [
                'description' => 'Cadastrar Produto',
                'name' => 'produto_create',
                'guard_name' => 'web',
                'group_id' => 8,
            ],
            [
                'description' => 'Editar Produto',
                'name' => 'produto_edit',
                'guard_name' => 'web',
                'group_id' => 8,
            ],
            [
                'description' => 'Visualizar Produto',
                'name' => 'produto_show',
                'guard_name' => 'web',
                'group_id' => 8,
            ],
            [
                'description' => 'Excluir Produto',
                'name' => 'produto_destroy',
                'guard_name' => 'web',
                'group_id' => 8,
            ],

            [
                'description' => 'Acesso a listagem de Movimentações de produto',
                'name' => 'produto_movimentacao',
                'guard_name' => 'web',
                'group_id' => 8,
            ],
            [
                'description' => 'Adicionar produto ao Estoque',
                'name' => 'produto_movimentacao_create',
                'guard_name' => 'web',
                'group_id' => 8,
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
