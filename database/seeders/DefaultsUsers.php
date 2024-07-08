<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DefaultsUsers extends Seeder
{
    /**
     * Run the database seeds.DefaultUsers.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'id' => 1,
                'ativo' => 1,
                'name' => 'Admin',
                'email' => 'admin@oslab.com.br',
                'password' => '$2y$10$DGNhLM9vN7A3ShzTIB0OPu2KaZ9jCemp0mPt4PdXQbV1s9Mf0JA6.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
