<?php

namespace Database\Seeders;

use App\Models\Servico\Servico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultsServicos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Manutenção Console',
                'descricao' => 'Realizamos manutenção em consoles de videogame, incluindo diagnóstico de problemas, reparo de hardware e software, e limpeza interna.',
                'valor_servico' => '130.00',
            ],
            [
                'id' => 2,
                'name' => 'Manutenção Notebook',
                'descricao' => 'Fazemos a manutenção de notebooks de todas as marcas e modelos, resolvendo problemas de hardware e software, substituindo peças defeituosas e otimizando o desempenho.',
                'valor_servico' => '130.00',
            ],
            [
                'id' => 3,
                'name' => 'Manutenção Pc Desktop',
                'descricao' => 'Oferecemos serviços de manutenção para computadores desktop, incluindo diagnóstico de problemas, substituição de componentes, formatação e reinstalação do sistema operacional.',
                'valor_servico' => '130.00',
            ],
            [
                'id' => 4,
                'name' => 'Manutenção Smartphone',
                'descricao' => 'Realizamos manutenção em smartphones de todas as marcas, incluindo troca de telas, substituição de baterias, reparo de botões e resolução de problemas de software.',
                'valor_servico' => '130.00',
            ],
            [
                'id' => 5,
                'name' => 'Manutenção Iphone',
                'descricao' => 'Especializados em reparos de iPhones, oferecemos serviços de conserto de tela, troca de bateria, reparo de câmera e solução de problemas de software para dispositivos Apple.',
                'valor_servico' => '230.00',
            ],
            [
                'id' => 6,
                'name' => 'Manutenção Macbook',
                'descricao' => 'Realizamos manutenção e reparo em MacBooks, incluindo substituição de peças, atualização de hardware, diagnóstico de problemas e formatação do sistema macOS.',
                'valor_servico' => '230.00',
            ],




        ];

        foreach ($insert as $key => $value) {
            Servico::updateOrCreate(
                [
                    'id' => $value['id'],
                    'name'  => $value['name'],
                ],
                [
                    'descricao' => $value['descricao'],
                    'valor_servico' => $value['valor_servico'],
                ]
            );
        }
    }
}
