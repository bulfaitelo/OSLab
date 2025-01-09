<?php

namespace Tests\Feature;

use App\Models\Cliente\Cliente;
use App\Models\User;
use App\Services\Venda\VendaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class VendaCreateTest extends TestCase
{
    use RefreshDatabase;

    private $vendaService;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        Cliente::factory()->count(10)->create();
        $this->vendaService = new VendaService;
        $this->user = User::find(1);
        $this->actingAs($this->user);
    }

    #[DataProvider('vendaCreateData')]
    public function testVendaCreate(array $data, array $dataExpected): void
    {
        $this->user->hasPermissionTo('venda_create');
        $response = $this->post(route('venda.store'), $data);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('vendas', $dataExpected);
    }

    /**
     * DadaProvider.
     */
    public static function vendaCreateData(): array
    {
        $data['venda_001'] = [
            // Send
            [
                'cliente_id' => 10,
                'vendedor_id' => 1,
                'status_id' => 10,
                'termo_garantia_id' => 1,
                'data_saida' => now()->format('Y-m-d'),
                'descricao' => 'Updataed Descrição',
            ],
            // Expected
            [
                'cliente_id' => 10,
                'vendedor_id' => 1,
                'status_id' => 10,
                'termo_garantia_id' => 1,
                'data_saida' => now()->format('Y-m-d').' 00:00:00',
                'descricao' => 'Updataed Descrição',
            ],
        ];
        $data['venda_002'] = [
            // Send
            [
                'cliente_id' => 1,
                'vendedor_id' => 1,
                'status_id' => 1,
                'termo_garantia_id' => 1,
                'data_saida' => now()->format('Y-m-d'),
                'descricao' => '<b>Updataed Descrição3432e!@#$$%$%¨%$</b>',
            ],
            // Expected
            [
                'cliente_id' => 1,
                'vendedor_id' => 1,
                'status_id' => 1,
                'termo_garantia_id' => 1,
                'data_saida' => now()->format('Y-m-d').' 00:00:00',
                'descricao' => '<b>Updataed Descrição3432e!@#$$%$%¨%$</b>',
            ],
        ];

        return $data;
    }
}
