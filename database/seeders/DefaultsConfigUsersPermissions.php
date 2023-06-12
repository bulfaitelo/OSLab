<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultsConfigUsersPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // permissões
         $insert = [
            [
                // Acesso a configuração de Usuários
                'name' => 'config_users',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Acesso a configuração de Usuários',
            ],
            [
                // Criar Usuários
                'name' => 'config_users_create',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Criar Usuários',
            ],
            [
                // Editar usuários
                'name' => 'config_users_edit',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Editar Usuários',
            ],
            [
                // Editar permissões de usuários
                'name' => 'config_users_permissions_edit',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Editar permissões de Usuários',
            ],
            [
                // Visualizar usuários
                'name' => 'config_users_show',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Visualizar Usuários',
            ],
            [
                // Excluir usuários
                'name' => 'config_users_destroy',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Excluir Usuários',
            ],
            [
                // Acesso ao Módulo De Perfis
                'name' => 'config_roles',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Acesso ao Módulo De Perfis',
            ],
            [
                // Criar novo Perfil
                'name' => 'config_roles_create',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Criar novo Perfil',
            ],
            [
                // Editar Perfil e atribuir permissões
                'name' => 'config_roles_edit',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Editar Perfil e atribuir permissões ',
            ],
            [
                // Editar perfis e atribuir Permissões
                'name' => 'config_roles_assign',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Editar perfis e atribuir Permissões',
            ],
            [
                // Visualizar Perfil
                'name' => 'config_roles_show',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Visualizar Perfil',
            ],
            [
                // Excluir Perfil
                'name' => 'config_roles_destroy',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => ' Excluir Perfil',
            ],
            [
                // Acesso ao Módulo de Permissões
                'name' => 'config_permissions',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Acesso ao Módulo de Permissões',
            ],
            [
                // Criar novo Permissões
                'name' => 'config_permissions_create',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Criar novo Permissões',
            ],
            [
                // Editar Permissões e atribuir permissões
                'name' => 'config_permissions_edit',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Editar Permissões e atribuir permissões ',
            ],
            [
                // Visualizar Permissões
                'name' => 'config_permissions_show',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Visualizar Permissões',
            ],
            [
                // Excluir Permissões
                'name' => 'config_permissions_destroy',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => ' Excluir Perfil',
            ],
            [
                //Acesso ao módulo de configurações de Setores
                'name' => 'config_user_setor',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Acesso ao módulo de configurações de Setores',
            ],
            [
                //botão Editar no módulo de configurações de Setores
                'name' => 'config_user_setor_edit',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'botão Editar no módulo de configurações de Setores',
            ],
            [
                //botão Criar no módulo de configurações de Setores
                'name' => 'config_user_setor_create',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'botão Criar no módulo de configurações de Setores',
            ],
            [
                //botão Excluir no módulo de configurações de Setores
                'name' => 'config_user_setor_destroy',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'botão Excluir no módulo de configurações de Departamentos',
            ],
            // [
            //     //Acesso ao módulo de test
            //     'name' => 'config_test',
            //     'guard_name' => 'web',
            //     'group_id' => 1,
            //     'description' => 'Acesso ao módulo de test',
            // ],
            [
                // Acesso as URL`s de Desenvolvimento
                'name' => 'config_url',
                'guard_name' => 'web',
                'group_id' => 1,
                'description' => 'Acesso as URL`s de Desenvolvimento',
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
