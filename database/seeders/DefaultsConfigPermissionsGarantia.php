<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsGarantia extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permissões
        $insert = [
            [
                'description' => 'Acesso a configuração de Garantias',
                'name' => 'config_garantia',
                'guard_name' => 'web',
                'group_id' => 14,
            ],
            [
                'description' => 'Criar Garantia',
                'name' => 'config_garantia_create',
                'guard_name' => 'web',
                'group_id' => 14,
            ],
            [
                'description' => 'Editar Garantia',
                'name' => 'config_garantia_edit',
                'guard_name' => 'web',
                'group_id' => 14,
            ],
            [
                'description' => 'Visualizar Garantia',
                'name' => 'config_garantia_show',
                'guard_name' => 'web',
                'group_id' => 14,
            ],
            [
                'description' => 'Excluir Garantia',
                'name' => 'config_garantia_destroy',
                'guard_name' => 'web',
                'group_id' => 14,
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
