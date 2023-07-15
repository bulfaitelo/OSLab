<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsLancamento extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // permissões
        $insert = [
            [
                'description' => 'Acesso a listagem de Lançamentos',
                'name' => 'lancamento',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Cadastrar Lançamento',
                'name' => 'lancamento_create',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Editar Lançamento',
                'name' => 'lancamento_edit',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Visualizar Lançamento',
                'name' => 'lancamento_show',
                'guard_name' => 'web',
                'group_id' => 5,
            ],
            [
                'description' => 'Excluir Lançamento',
                'name' => 'lancamento_destroy',
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
