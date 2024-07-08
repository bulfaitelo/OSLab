<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultsConfigRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Perfis
        \DB::table('roles')->insert([
            [
                // SUPER USER
                'id' => 1,
                'name' => 'susepro',
                'guard_name' => 'web',
                'description' => 'all permissions',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        // Atrinbundo super user ao usuario 1
        \DB::table('model_has_roles')->insert([
            [
                // SUPER USER
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
        ]);
    }
}
