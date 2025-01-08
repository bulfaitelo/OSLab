<?php

namespace Database\Seeders;

use App\Models\Configuracao\Sistema\SistemaConfig;
use Illuminate\Database\Seeder;

class DefaultsConfigSistema extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'key' => 'default_os_create_status',
                'value' => '"1"',
            ],
            [
                'key' => 'os_link_time_limit',
                'value' => '"10"',
            ],
            [
                'key' => 'default_os_faturar',
                'value' => '"3"',
            ],
            [
                'key' => 'default_os_faturar_pagto_parcial',
                'value' => '"10"',
            ],
            [
                'key' => 'default_os_faturar_pagto_quitado',
                'value' => '"6"',
            ],
            [
                'key' => 'default_os_faturar_produto_despesa',
                'value' => '"4"',
            ],

            [
                'key' => 'default_venda_create_status',
                'value' => '"1"',
            ],
            [
                'key' => 'default_venda_faturar',
                'value' => '"3"',
            ],
            [
                'key' => 'default_venda_faturar_pagto_parcial',
                'value' => '"10"',
            ],
            [
                'key' => 'default_venda_faturar_pagto_quitado',
                'value' => '"6"',
            ],
            [
                'key' => 'default_venda_faturar_produto_despesa',
                'value' => '"4"',
            ],
            [
                'key' => 'default_venda_create_garantia',
                'value' => '"1"',
            ],

            // [
            //     'key' => 'default_os_create_category',
            //     'value' => '',
            //     'descricao' => '',
            //     'model' => 'App\Models\Configuracao\Parametro\Categoria', // Caso seja true é um select
            //     'group_id' => 6
            // ],

        ];

        foreach ($insert as $key => $value) {
            SistemaConfig::updateOrCreate(
                [
                    'key' => $value['key'],
                ],
                [
                    'value' => $value['value'],
                    // 'descricao'  => $value['descricao'],
                    // 'model'  => $value['model'],
                    // 'group_id'  => $value['group_id'],
                ]
            );
        }
    }
}
