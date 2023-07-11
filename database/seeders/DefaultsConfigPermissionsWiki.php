<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigPermissionsWiki extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // permissões
        $insert = [
            [
                'description' => 'Acesso a Wiki',
                'name' => 'wiki',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Cadastrar Wiki',
                'name' => 'wiki_create',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Editar Wiki',
                'name' => 'wiki_edit',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Visualizar Wiki',
                'name' => 'wiki_show',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Excluir Wiki',
                'name' => 'wiki_destroy',
                'guard_name' => 'web',
                'group_id' => 9,
            ],

            [
                'description' => 'Cadastrar Links na Wiki',
                'name' => 'wiki_link_create',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Excluir Links da Wiki',
                'name' => 'wiki_link_destroy',
                'guard_name' => 'web',
                'group_id' => 9,
            ],

            [
                'description' => 'Acesso a Configuração de Fabricantes',
                'name' => 'config_wiki_fabricante',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Cadastrar Fabricante',
                'name' => 'config_wiki_fabricante_create',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Editar Fabricante',
                'name' => 'config_wiki_fabricante_edit',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Visualizar Fabricante',
                'name' => 'config_wiki_fabricante_show',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Excluir Fabricante',
                'name' => 'config_wiki_fabricante_destroy',
                'guard_name' => 'web',
                'group_id' => 9,
            ],

            [
                'description' => 'Acesso a Configuração de Modelos',
                'name' => 'config_wiki_modelo',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Cadastrar Modelo',
                'name' => 'config_wiki_modelo_create',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Editar Modelo',
                'name' => 'config_wiki_modelo_edit',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Visualizar Modelo',
                'name' => 'config_wiki_modelo_show',
                'guard_name' => 'web',
                'group_id' => 9,
            ],
            [
                'description' => 'Excluir Modelo',
                'name' => 'config_wiki_modelo_destroy',
                'guard_name' => 'web',
                'group_id' => 9,
            ],




        ];


        foreach ($insert as $key => $value) {
            Permission::updateOrCreate(
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
