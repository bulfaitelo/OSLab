<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsRelatorio extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // permissões
        $insert = [
            [
                'description' => 'Acesso ao Relatório Balancete Financeiro',
                'name' => 'relatorio_financeiro_balancete',
                'guard_name' => 'web',
                'group_id' => 2,
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
