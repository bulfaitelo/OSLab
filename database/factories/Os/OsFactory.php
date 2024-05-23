<?php

namespace Database\Factories\Os;

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Os\OsCategoria;
use App\Models\Configuracao\Os\OsStatus;
use App\Models\Os\Os;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Os\Os>
 */
class OsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Os::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'cliente_id' => factory('App\Models\Cliente\Cliente')->create(),
            // 'tecnico_id' => factory('App\Models\User')->create(),
            // 'status_id' => factory('App\Models\Configuracao\Os\OsStatus')->create(),
            // 'data_entrada' => now(),
            // 'categoria_id' => factory('App\Models\Configuracao\Os\OsCategoria')->create(),

            'cliente_id' => Cliente::all('id')->random(),
            'tecnico_id' => User::all('id')->random(),
            'user_id' => User::all('id')->random(),
            'status_id' => OsStatus::all('id')->random(),
            'data_entrada' => now(),
            'categoria_id' => OsCategoria::all('id')->random(),
        ];
    }
}
