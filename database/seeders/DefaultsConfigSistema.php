<?php

namespace Database\Seeders;


use App\Models\Configuracao\Sistema\SistemaConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'value' => '1',

            ],
            [
                'key' => 'os_link_time_limit',
                'value' => '10',

            ],

            // [
            //     'key' => 'default_os_create_category',
            //     'value' => '',
            //     'descricao' => '',
            //     'model' => 'App\Models\Configuracao\Os\OsCategoria', // Caso seja true é um select
            //     'group_id' => 6
            // ],

        ];

        foreach ($insert as $key => $value) {
            SistemaConfig::updateOrCreate(
                [
                    'key' => $value['key'],
                ],
                [
                    'value'  => $value['value'],
                    // 'descricao'  => $value['descricao'],
                    // 'model'  => $value['model'],
                    // 'group_id'  => $value['group_id'],
                ]
            );
        }
    }
}
