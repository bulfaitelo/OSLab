<?php

namespace Tests\Feature;

use App\Livewire\Os\ProdutoTab;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Cliente\Cliente;
use App\Models\Os\Os;
use App\Models\Produto\Produto;
use App\Models\User;
use App\Services\Os\OsService;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;

class OsProdutoCreateDeleteTest extends TestCase
{
    use RefreshDatabase;

    private $osService;
    private $user;

    public function setUp() : void
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
    public function testCreateProduto(array $data, array $expected) : void {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os ])
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
        $this->assertEquals($osProduto->valor_custo_total, ($expected['valor_custo'] * $expected['quantidade']));
        $this->assertEquals($osProduto->valor_venda_total, ($expected['valor_venda'] * $expected['quantidade']));
    }

    #[Depends('testCreateProduto')]
    #[DataProvider('osProdutoData')]
    public function testDeleteProduto($data, $expected) : void {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os ])
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

    #[Depends('testCreateProduto')]
    #[DataProvider('osProdutoData')]
    public function testCreateProdutoFaturado($data) : void {
        $os = Os::findOrFail($data['os_id']);
        $os->fatura_id = 1;
        $os->save();
        Livewire::test(ProdutoTab::class, ['os' => $os ])
            ->set('produto_id', $data['produto_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_custo', $data['valor_custo'])
            ->set('valor_venda', $data['valor_venda'])
            ->call('create')
            ->assertStatus(200);

        $osProduto = $os->produtos()->where('produto_id', $data['produto_id'])->count();
        $this->assertEquals(0, $osProduto);
    }

    #[Depends('testCreateProduto')]
    #[DataProvider('osProdutoData')]
    public function testDeleteProdutoFaturado($data, $expected) : void {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os ])
            ->set('produto_id', $data['produto_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_custo', $data['valor_custo'])
            ->set('valor_venda', $data['valor_venda'])
            ->call('create')
            ->assertHasNoErrors();
        $os->fatura_id = 1;
        $os->save();
        $produto_id = $os->produtos()->where('produto_id', $data['produto_id'])->sole()->id;
        Livewire::test(ProdutoTab::class, ['os' => $os])
            ->call('delete', $produto_id)
            ->assertHasNoErrors();
        $produtoCount = $os->produtos()->where('produto_id', $data['produto_id'])->count();
        $this->assertEquals(1, $produtoCount);

        // $this->assertDatabaseMissing('os_produtos', $expected);
    }

    public static function osProdutoData(): array {
        $data['001'] = [
            // $data
            [
                'os_id' => 2,
                'produto_id' => 2,
                'quantidade' => 2,
                'valor_custo' => 20,
                'valor_venda' => 200,
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
                'valor_custo' => "90,99",
                'valor_venda' => "12,45",
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
