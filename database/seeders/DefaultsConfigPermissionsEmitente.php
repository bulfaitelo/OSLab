<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsEmitente extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões
        $insert = [
            [
                'description' => 'Acesso a listagem de Emitentes',
                'name' => 'config_emitente',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Cadastrar Emitente',
                'name' => 'config_emitente_create',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Editar Emitente',
                'name' => 'config_emitente_edit',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Visualizar Emitente',
                'name' => 'config_emitente_show',
                'guard_name' => 'web',
                'group_id' => 7,
            ],
            [
                'description' => 'Excluir Emitente',
                'name' => 'config_emitente_destroy',
                'guard_name' => 'web',
                'group_id' => 7,
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
