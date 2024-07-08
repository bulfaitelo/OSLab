<?php

namespace Database\Factories\Produto;

use App\Models\Configuracao\Financeiro\CentroCusto;
use App\Models\Produto\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'valor_custo' => '10.00',
            'valor_venda' => '20.00',
            'estoque' => '10',
            'centro_custo_id' => CentroCusto::all('id')->random(),
        ];
    }
}
