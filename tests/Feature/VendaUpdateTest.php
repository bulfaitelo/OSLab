<?php

namespace Tests\Feature;

use App\Models\Cliente\Cliente;
use App\Models\User;
use App\Models\Venda\Venda;
use App\Services\Venda\VendaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class VendaUpdateTest extends TestCase
{
    use RefreshDatabase;

    private $vendaService;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        Cliente::factory()->count(10)->create();
        Venda::factory()->count(10)->create();
        $this->vendaService = new VendaService;
        $this->user = User::find(1);
        $this->actingAs($this->user);
    }

    #[DataProvider('vendaCreateData')]
    public function test_venda_update(array $data, array $dataExpected): void
    {
        $this->user->hasPermissionTo('venda_edit');
        $response = $this->put(route('venda.update', $data['id']), $data);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('vendas', $dataExpected);
    }

    // #[Depends('test_venda_update')]
    // #[DataProvider('vendaCreateData')]
    // public function testStatusLog($data): void
    // {
    //     $os = Venda::find($data['id']);
    //     $this->put(route('venda.update', $data['id']), $data);
    //     $osUpdated = Venda::find($data['id']);
    //     if ($os->status_id == $data['status_id']) {
    //         $this->assertCount(1, $osUpdated->statusLogs);
    //     } else {
    //         $this->assertCount(2, $osUpdated->statusLogs);
    //     }
    //     $statusLogLastId = Venda::find($data['id'])->statusLogs()->orderByDesc('id')->first()->status_id;
    //     $this->assertEquals($data['status_id'], $statusLogLastId);
    // }

    /**
     * DadaProvider.
     */
    public static function vendaCreateData(): array
    {
        $data['venda_001'] = [
            // Send
            [
                'id' => 1,
                'cliente_id' => 10,
                'vendedor_id' => 1,
                'status_id' => 10,
                'termo_garantia_id' => 1,
                'data_saida' => now()->format('Y-m-d'),
                'descricao' => 'Updataed Descrição',
            ],
            // Expected
            [
                'id' => 1,
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
                'id' => 10,
                'cliente_id' => 1,
                'vendedor_id' => 1,
                'status_id' => 1,
                'termo_garantia_id' => 1,
                'data_saida' => now()->format('Y-m-d'),
                'descricao' => '<b>Updataed Descrição3432e!@#$$%$%¨%$</b>',
            ],
            // Expected
            [
                'id' => 10,
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
