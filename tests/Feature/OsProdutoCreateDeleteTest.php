<?php

namespace Tests\Feature;

use App\Livewire\Produto\ProdutoTab;
use App\Models\Cliente\Cliente;
use App\Models\Os\Os;
use App\Models\Produto\Produto;
use App\Models\User;
use App\Services\Os\OsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Tests\TestCase;

class OsProdutoCreateDeleteTest extends TestCase
{
    use RefreshDatabase;

    private $osService;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        Cliente::factory()->count(10)->create();
        Os::factory()->count(10)->create();
        Produto::factory()->count(10)->create();
        $this->osService = new OsService;
        $this->user = User::find(1);
        $this->actingAs($this->user);
    }

    #[DataProvider('osProdutoData')]
    public function test_create_produto(array $data, array $expected): void
    {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os])
            ->set('produto_id', $data['produto_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_custo', $data['valor_custo'])
            ->set('valor_venda', $data['valor_venda'])
            ->call('create')
            ->assertHasNoErrors()
            ->assertStatus(200)
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('os_produtos', $expected);
        $osProduto = $os->produtos()->where('produto_id', $data['produto_id'])->sole();
        $this->assertEquals($osProduto->valor_custo_total, $expected['valor_custo'] * $expected['quantidade']);
        $this->assertEquals($osProduto->valor_venda_total, $expected['valor_venda'] * $expected['quantidade']);
    }

    #[Depends('test_create_produto')]
    #[DataProvider('osProdutoData')]
    public function test_delete_produto($data, $expected): void
    {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os])
            ->set('produto_id', $data['produto_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_custo', $data['valor_custo'])
            ->set('valor_venda', $data['valor_venda'])
            ->call('create')
            ->assertHasNoErrors();
        $produto_id = $os->produtos()->where('produto_id', $data['produto_id'])->sole()->id;
        Livewire::test(ProdutoTab::class, ['os' => $os])
            ->call('delete', $produto_id)
            ->assertHasNoErrors();
        $produtoCount = $os->produtos()->where('produto_id', $data['produto_id'])->count();
        $this->assertEquals(0, $produtoCount);
        $this->assertDatabaseMissing('os_produtos', $expected);
    }

    #[Depends('test_create_produto')]
    #[DataProvider('osProdutoData')]
    public function test_create_produto_faturado($data): void
    {
        $response = $this->put(
            route('os.faturar', $data['os_id']),
            $data['fatura']
        );
        $response->assertStatus(302);
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os])
            ->set('produto_id', $data['produto_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_custo', $data['valor_custo'])
            ->set('valor_venda', $data['valor_venda'])
            ->call('create')
            ->assertStatus(200);

        $osProduto = $os->produtos()->where('produto_id', $data['produto_id'])->count();
        $this->assertEquals(0, $osProduto);
    }

    #[Depends('test_create_produto')]
    #[DataProvider('osProdutoData')]
    public function test_delete_produto_faturado($data, $expected): void
    {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os])
            ->set('produto_id', $data['produto_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_custo', $data['valor_custo'])
            ->set('valor_venda', $data['valor_venda'])
            ->call('create')
            ->assertHasNoErrors();

        $response = $this->put(
            route('os.faturar', $data['os_id']),
            $data['fatura']
        );
        $response->assertStatus(302);
        $os = Os::findOrFail($data['os_id']);

        $produto_id = $os->produtos()->where('produto_id', $data['produto_id'])->sole()->id;
        Livewire::test(ProdutoTab::class, ['os' => $os])
            ->call('delete', $produto_id)
            ->assertHasNoErrors();
        $produtoCount = $os->produtos()->where('produto_id', $data['produto_id'])->count();
        $this->assertEquals(1, $produtoCount);

        // $this->assertDatabaseMissing('os_produtos', $expected);
    }

    public static function osProdutoData(): array
    {
        $data['001'] = [
            // $data
            [
                'os_id' => 2,
                'produto_id' => 2,
                'quantidade' => 2,
                'valor_custo' => 20,
                'valor_venda' => 200,
                'fatura' => [
                    'descricao' => 'Fatura OS Nº: #2',
                    'centro_custo_id' => 2,
                    'data_entrada' => now()->format('Y-m-d'),
                    'valor' => '65000',
                    'data_recebimento' => now()->format('Y-m-d'),
                ],
            ],
            // $expected
            [
                'os_id' => 2,
                'produto_id' => 2,
                'quantidade' => 2,
                'valor_custo' => 20,
                'valor_venda' => 200,
            ],
        ];

        $data['002'] = [
            // $data
            [
                'os_id' => 8,
                'produto_id' => 3,
                'quantidade' => 9,
                'valor_custo' => '90,99',
                'valor_venda' => '12,45',
                'fatura' => [
                    'descricao' => 'Fatura OS Nº: #8',
                    'centro_custo_id' => '3',
                    'data_entrada' => now()->format('Y-m-d'),
                    'valor' => '65000',
                    'data_recebimento' => now()->format('Y-m-d'),
                ],
            ],
            // $expected
            [
                'os_id' => 8,
                'produto_id' => 3,
                'quantidade' => 9,
                'valor_custo' => 90.99,
                'valor_venda' => 12.45,
            ],
        ];

        return $data;
    }
}
