<?php

namespace Database\Seeders;

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
            [
                'description' => 'Acesso ao Relatório Receita e Despesa Financeira',
                'name' => 'relatorio_financeiro_receita_despesa',
                'guard_name' => 'web',
                'group_id' => 2,
            ],
            [
                'description' => 'Acesso ao Relatório Financeiro de Contas Em aberto',
                'name' => 'relatorio_financeiro_conta_aberta',
                'guard_name' => 'web',
                'group_id' => 2,
            ],
            [
                'description' => 'Acesso ao relatório de Logs do sistema',
                'name' => 'relatorio_sistema_log',
                'guard_name' => 'web',
                'group_id' => 2,
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
