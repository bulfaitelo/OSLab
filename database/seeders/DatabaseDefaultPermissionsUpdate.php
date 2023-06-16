<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseDefaultPermissionsUpdate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefaultsConfigRoles::class);
        $this->call(DefaultsConfigGroupPermissions::class);
        $this->call(DefaultsConfigUsersPermissions::class);
        $this->call(DefaultsConfigSetores::class);
    }
}
