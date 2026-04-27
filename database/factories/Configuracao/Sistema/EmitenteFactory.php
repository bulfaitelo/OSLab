<?php

namespace Database\Factories\Configuracao\Sistema;

use App\Models\Configuracao\Sistema\Emitente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Configuracao\Sistema\Emitente>
 */
class EmitenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Configuracao\Sistema\Emitente>
     */
    protected $model = Emitente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cnpj' => $this->faker->regexify('\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}'),
            'name' => $this->faker->company(),
            'fantasia' => $this->faker->word(),
            'porte' => $this->faker->randomElement(['MEI', 'Microempresa', 'Pequena Empresa', 'Média Empresa', 'Grande Empresa']),
            'inscricao_estadual' => $this->faker->regexify('\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}'),
            'cep' => $this->faker->postcode(),
            'logradouro' => $this->faker->streetName(),
            'numero' => $this->faker->buildingNumber(),
            'bairro' => $this->faker->word(),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->stateAbbr(),
            'telefone' => $this->faker->phoneNumber(),
            'site_url' => $this->faker->url(),
            'email' => $this->faker->unique()->companyEmail(),
            'complemento' => $this->faker->optional()->text(50),
            'logo_url' => null,
        ];
    }

    /**
     * Indica que o emitente é a empresa principal (ID = 1).
     */
    public function principal(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'id' => 1,
                'name' => 'Empresa Principal',
                'fantasia' => 'Empresa Principal LTDA',
            ];
        });
    }
}
