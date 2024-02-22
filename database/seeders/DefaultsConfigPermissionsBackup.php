<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
                'group_id' => 12,
            ],
            [
                'description' => 'Pode baixar o backup?',
                'name' => 'config_backup_download',
                'guard_name' => 'web',
                'group_id' => 12,
            ],
            [
                'description' => 'Excluir Backup Checklist',
                'name' => 'config_backup_destroy',
                'guard_name' => 'web',
                'group_id' => 12,
            ],
            [
                'description' => 'Editar Configurações do backup',
                'name' => 'config_backup_edit',
                'guard_name' => 'web',
                'group_id' => 12,
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
