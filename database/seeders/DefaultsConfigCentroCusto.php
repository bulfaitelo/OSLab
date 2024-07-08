<?php

namespace Database\Seeders;

use App\Models\Configuracao\Financeiro\CentroCusto;
use Illuminate\Database\Seeder;

class DefaultsConfigCentroCusto extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Investimentos',
                'descricao' => 'Investimentos em Cursos de qualificação',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Remuneração',
                'descricao' => 'Pagamento de funcionário',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Tributos e Contribuições',
                'descricao' => 'Pagamento de Impostos e Contribuições',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Insumos',
                'descricao' => 'Insumos de uso, pasta térmica, cola e etc.',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Materiais',
                'descricao' => 'Material utilizados nas Os, Telas, placas e etc.',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Legais e Judiciais',
                'descricao' => 'Processo e despesas judiciais',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 7,
                'name' => 'Manutenção Dispositivo Móvel',
                'descricao' => 'Manutenções Celulares Tablet e afins',
                'receita' => 1,
                'despesa' => 0,
            ],
            [
                'id' => 8,
                'name' => 'Manutenção PC',
                'descricao' => 'Manutenção em PCs notebooks e etc.',
                'receita' => 1,
                'despesa' => 0,
            ],
            [
                'id' => 9,
                'name' => 'Acesso Remoto',
                'descricao' => 'Acesso remoto para configuração de DVR, HelpDek e etc.',
                'receita' => 1,
                'despesa' => 0,
            ],
            [
                'id' => 9,
                'name' => 'Manutenção Console',
                'descricao' => 'Manutenção em Consoles em geral',
                'receita' => 1,
                'despesa' => 0,
            ],

        ];

        foreach ($insert as $key => $value) {
            CentroCusto::updateOrCreate(
                [
                    'id' => $value['id'],
                ],
                [
                    'name' => $value['name'],
                    'descricao' => $value['descricao'],
                    'receita' => $value['receita'],
                    'despesa' => $value['despesa'],

                ]
            );
        }
    }
}
