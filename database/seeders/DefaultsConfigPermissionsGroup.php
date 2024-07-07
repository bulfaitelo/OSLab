<?php

namespace Database\Seeders;

use App\Models\Configuracao\User\PermissionsGroup;
use Illuminate\Database\Seeder;

class DefaultsConfigPermissionsGroup extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [

            ['id' => 1,
                'name' => 'Configuração',
            ],
            ['id' => 2,
                'name' => 'Relatórios',
            ],
            ['id' => 3,
                'name' => 'Ordem Serviço',
            ],
            ['id' => 4,
                'name' => 'Perfil',
            ],
            ['id' => 5,
                'name' => 'Financeiro',
            ],
            ['id' => 6,
                'name' => 'Clientes',
            ],
            ['id' => 7,
                'name' => 'Serviços',
            ],
            ['id' => 8,
                'name' => 'Serviços',
            ],
            ['id' => 9,
                'name' => 'Wiki',
            ],
            ['id' => 10,
                'name' => 'Checklist',
            ],
            ['id' => 11,
                'name' => 'Sistema',
            ],
            ['id' => 12,
                'name' => 'Backup',
            ],

        ];
        foreach ($insert as $key => $value) {
            PermissionsGroup::updateOrCreate(
                // DB::table('permissions')->updateOrInsert(
                ['id' => $value['id'],
                ],
                [
                    'name' => $value['name'],
                ]
            );
        }
    }
}
