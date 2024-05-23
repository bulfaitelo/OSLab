<?php

namespace Tests\Unit;

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
    public function testCreateProtuto($data) : void {
        $os = Os::find($data['os_id']);
        Livewire::test(ProdutoTab::class, ['os' => $os ])
            ->set('produto_id', $data['produto_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_custo', $data['valor_custo'])
            ->set('valor_venda', $data['valor_venda'])
            ->call('create');
        dump($data['quantidade'], $os->produtos->toArray());
        // $this->assertDatabaseHas('os_produtos', $data );


    }



    public static function osProdutoData() : array {
        $data['001'] = [
            // $data
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
                'os_id' => 9,
                'produto_id' => 9,
                'quantidade' => 9,
                'valor_custo' => 90,
                'valor_venda' => 900,
            ],
        ];
        return $data;
    }

}
