<?php

namespace Database\Factories\Venda;

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Parametro\Status;
use App\Models\User;
use App\Models\Venda\Venda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Os\Os>
 */
class VendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Venda::class;

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
            // 'status_id' => factory('App\Models\Configuracao\Parametro\Status')->create(),
            // 'data_entrada' => now(),
            // 'categoria_id' => factory('App\Models\Configuracao\Parametro\Categoria')->create(),

            'cliente_id' => Cliente::all('id')->random(),
            'vendedor_id' => User::all('id')->random(),
            'user_id' => User::all('id')->random(),
            'status_id' => Status::all('id')->random(),
            'termo_garantia_id' => 1,
        ];
    }
}
