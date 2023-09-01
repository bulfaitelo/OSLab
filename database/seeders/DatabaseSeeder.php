<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente\Cliente;
use Database\Factories\ClienteFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(DefaultsUsers::class);
        $this->call(DefaultsServicos::class);
        $this->call(DefaultsConfigRoles::class);
        $this->call(DatabaseDefaultPermissionsUpdate::class);


        // Factory
        Cliente::factory()->count(200)->create();

    }
}
