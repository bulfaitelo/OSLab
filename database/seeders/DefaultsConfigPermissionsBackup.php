<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultsConfigPermissionsBackup extends Seeder
{
 /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // permissões
        $insert = [
            [
                'description' => 'Acesso ao módulo de Backups',
                'name' => 'config_backup',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Cadastrar Checklist',
                'name' => 'config_backup_create',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Editar Checklist',
                'name' => 'config_backup_edit',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Visualizar Checklist',
                'name' => 'config_backup_show',
                'guard_name' => 'web',
                'group_id' => 10,
            ],
            [
                'description' => 'Excluir Checklist',
                'name' => 'config_backup_destroy',
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
