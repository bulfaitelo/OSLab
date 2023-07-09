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
        $this->call(DefaultsConfigPermissionsGroup::class);
        $this->call(DefaultsConfigPermissionsUsers::class);
        $this->call(DefaultsConfigPermissionsFinanceiro::class);
        $this->call(DefaultsConfigSetores::class);
        $this->call(DefaultsConfigPermissionsOs::class);
        $this->call(DefaultsConfigPermissionsCliente::class);
        $this->call(DefaultsConfigPermissionsServico::class);
        $this->call(DefaultsConfigPermissionsProduto::class);
        $this->call(DefaultsConfigPermissionsWiki::class);
        $this->call(DefaultsConfigCentroCusto::class);
        $this->call(DefaultsConfigStatusOs::class);
        $this->call(DefaultsConfigGarantiaOs::class);
        $this->call(DefaultsConfigCategoriaOs::class);
        $this->call(DefaultsConfigFabricante::class);

    }
}
