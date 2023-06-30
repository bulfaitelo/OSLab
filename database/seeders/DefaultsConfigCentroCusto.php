<?php

namespace Database\Seeders;

use App\Models\Configuracao\Financeiro\CentroCusto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'decricao' => 'Investimentos em Cursos de qualificação',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Remuneração',
                'decricao' => 'Pagamento de funcionário',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Tributos e Contribuições',
                'decricao' => 'Pagamento de Impostos e Contribuições',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 4,
                'name' => 'Insumos',
                'decricao' => 'Insumos de uso, pasta térmica, cola e etc.',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 5,
                'name' => 'Materiais',
                'decricao' => 'Material utilizados nas Os, Telas, placas e etc.',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 6,
                'name' => 'Legais e Judiciais',
                'decricao' => '',
                'receita' => 0,
                'despesa' => 1,
            ],
            [
                'id' => 7,
                'name' => 'Manutenção Dispositivo Móvel',
                'decricao' => 'Manutenções Celulares Tablet e afins',
                'receita' => 1,
                'despesa' => 0,
            ],
            [
                'id' => 8,
                'name' => 'Manutenção PC',
                'decricao' => 'Manutenção em PCs notebooks e etc.',
                'receita' => 1,
                'despesa' => 0,
            ],
            [
                'id' => 9,
                'name' => 'Acesso Remoto',
                'decricao' => 'Acesso remoto para configuração de DVR, HelpDek e etc.',
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
                    'name'  => $value['name'],
                    'description' => $value['description'],

                ]
            );
        }
    }
}



// Investimentos: 	R$ 0,00 	R$ 0,00
// Bens Imóveis: 	R$ 330.000,00 	R$ 642.488,40
// Bens Móveis: 	R$ 291.000,00 	R$ 276.514,46
// Remuneração: 	R$ 4.318.000,00 	R$ 4.238.292,64
// Encargos: 	R$ 1.564.000,00 	R$ 1.580.558,61
// Benefícios: 	R$ 3.348.000,00 	R$ 3.336.149,58
// Aprendiz: 	R$ 17.000,00 	R$ 10.470,00
// Serviços de Terceiros: 	R$ 1.718.397,25 	R$ 1.562.520,57
// Materiais: 	R$ 1.817.300,00 	R$ 1.450.945,63
// Legais e Judiciais: 	R$ 50.000,00 	R$ 186.450,19
// Tributos e Contribuições: 	R$ 33.000,00 	R$ 51.074,30
// Utilidades e Serviços: 	R$ 1.187.000,00 	R$ 1.210.432,24
// Despesas Financeiras: 	R$ 57.000,00 	R$ 58.762,10
// Contas Interdepartamentais (Ativas): 	R$ 14.500,00 	R$ 14.418,36
// Total 	R$ 14.745.197,25 	R$ 14.619.077,08

// Crédito Previsto
// Item 	Valor Previsto
// Mensalidades, Joias e Outros: 	R$ 5.925.700,00
// Cessão, Espaços e Outros: 	R$ 239.800,00
// Atividades Diversas: 	R$ 78.000,00
// Cessão, Espaços e Outros: 	R$ 96.000,00
// Eventos: 	R$ 170.200,00
// Atividades: 	R$ 40.300,00
// Contas Interdepartamentais (Passivas): 	R$ 4.575.000,00
// Total
