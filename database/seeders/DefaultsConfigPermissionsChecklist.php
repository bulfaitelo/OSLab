<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class DefaultsConfigPermissionsChecklist extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // permissões
        $insert = [
            [
                'description' => 'Acesso a listagem de Checklist',
                'name' => 'checklist',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Cadastrar Checklist',
                'name' => 'checklist_create',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Editar Checklist',
                'name' => 'checklist_edit',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Visualizar Checklist',
                'name' => 'checklist_show',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Excluir Checklist',
                'name' => 'checklist_destroy',
                'guard_name' => 'web',
                'group_id' => 10,
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
