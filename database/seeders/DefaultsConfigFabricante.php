<?php

namespace Database\Seeders;

use App\Models\Configuracao\Wiki\Fabricante;
use Illuminate\Database\Seeder;

class DefaultsConfigFabricante extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'id' => 1,
                'name' => 'Apple',
                'descricao' => 'Fabricante do iPhone e do MacBook.',
            ],
            [
                'id' => 2,
                'name' => 'Samsung',
                'descricao' => 'Conhecida por sua linha Galaxy de smartphones e notebooks.',
            ],
            [
                'id' => 3,
                'name' => 'Huawei',
                'descricao' => 'Fabricante chinesa de smartphones e notebooks.',
            ],
            [
                'id' => 4,
                'name' => 'Lenovo',
                'descricao' => 'Fabricante chinesa que produz smartphones e notebooks, incluindo a linha ThinkPad.',
            ],
            [
                'id' => 5,
                'name' => 'Dell',
                'descricao' => 'Conhecida por seus notebooks e desktops de alta qualidade.',
            ],
            [
                'id' => 6,
                'name' => 'HP',
                'descricao' => 'Fabricante de notebooks e desktops populares.',
            ],
            [
                'id' => 7,
                'name' => 'Asus',
                'descricao' => 'Fabricante conhecida por suas placas-mãe, notebooks e smartphones.',
            ],
            [
                'id' => 8,
                'name' => 'Xiaomi',
                'descricao' => 'Fabricante chinesa que produz smartphones e notebooks com bom custo-benefício.',
            ],
            [
                'id' => 9,
                'name' => 'Microsoft',
                'descricao' => 'Fabricante do Surface, uma linha de dispositivos 2-em-1.',
            ],
            [
                'id' => 10,
                'name' => 'Acer',
                'descricao' => 'Fabricante de notebooks, desktops e monitores.',
            ],

        ];

        foreach ($insert as $key => $value) {
            Fabricante::updateOrCreate(
                // DB::table('permissions')->updateOrInsert(
                ['id' => $value['id'],
                ],
                [
                    'name' => $value['name'],
                    'descricao' => $value['descricao'],
                ]
            );
        }
    }
}
