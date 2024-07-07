<?php

namespace Tests\Feature;

use App\Livewire\Os\ServicoTab;
use App\Models\Cliente\Cliente;
use App\Models\Os\Os;
use App\Models\User;
use App\Services\Os\OsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use Tests\TestCase;

class OsServicoCreateDeleteTest extends TestCase
{
    use RefreshDatabase;

    private $osService;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        Cliente::factory()->count(10)->create();
        Os::factory()->count(10)->create();
        $this->osService = new OsService;
        $this->user = User::find(1);
        $this->actingAs($this->user);
    }

    #[DataProvider('osServicoData')]
    public function testCreateServico(array $data, array $expected): void
    {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ServicoTab::class, ['os' => $os])
            ->set('servico_id', $data['servico_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_servico', $data['valor_servico'])
            ->call('create')
            ->assertHasNoErrors()
            ->assertStatus(200)
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('os_servicos', $expected);
        $osServico = $os->servicos()->where('servico_id', $data['servico_id'])->sole();
        $this->assertEquals($osServico->valor_servico_total, $expected['valor_servico'] * $expected['quantidade']);
    }

    #[Depends('testCreateServico')]
    #[DataProvider('osServicoData')]
    public function testDeleteServico($data, $expected): void
    {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ServicoTab::class, ['os' => $os])
            ->set('servico_id', $data['servico_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_servico', $data['valor_servico'])
            ->call('create')
            ->assertHasNoErrors();
        $servico_id = $os->servicos()->where('servico_id', $data['servico_id'])->sole()->id;
        Livewire::test(ServicoTab::class, ['os' => $os])
            ->call('delete', $servico_id)
            ->assertHasNoErrors();
        $produtoCount = $os->servicos()->where('servico_id', $data['servico_id'])->count();
        $this->assertEquals(0, $produtoCount);
        $this->assertDatabaseMissing('os_servicos', $expected);
    }

    #[Depends('testCreateServico')]
    #[DataProvider('osServicoData')]
    public function testCreateServicoFaturado($data): void
    {
        $os = Os::findOrFail($data['os_id']);
        $os->fatura_id = 1;
        $os->save();
        Livewire::test(ServicoTab::class, ['os' => $os])
            ->set('servico_id', $data['servico_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_servico', $data['valor_servico'])
            ->call('create')
            ->assertStatus(200);

        $osServico = $os->servicos()->where('servico_id', $data['servico_id'])->count();
        $this->assertEquals(0, $osServico);
    }

    #[Depends('testCreateServico')]
    #[DataProvider('osServicoData')]
    public function testDeleteServicoFaturado($data, $expected): void
    {
        $os = Os::findOrFail($data['os_id']);
        Livewire::test(ServicoTab::class, ['os' => $os])
            ->set('servico_id', $data['servico_id'])
            ->set('quantidade', $data['quantidade'])
            ->set('valor_servico', $data['valor_servico'])
            ->call('create')
            ->assertHasNoErrors();
        $os->fatura_id = 1;
        $os->save();
        $servico_id = $os->servicos()->where('servico_id', $data['servico_id'])->sole()->id;
        Livewire::test(ServicoTab::class, ['os' => $os])
            ->call('delete', $servico_id)
            ->assertHasNoErrors();
        $produtoCount = $os->servicos()->where('servico_id', $data['servico_id'])->count();
        $this->assertEquals(1, $produtoCount);

        // $this->assertDatabaseMissing('os_servicos', $expected);
    }

    public static function osServicoData(): array
    {
        $data['001'] = [
            // $data
            [
                'os_id' => 2,
                'servico_id' => 2,
                'quantidade' => 2,
                'valor_servico' => 200,
            ],
            // $expected
            [
                'os_id' => 2,
                'servico_id' => 2,
                'quantidade' => 2,
                'valor_servico' => 200,
            ],
        ];

        $data['002'] = [
            // $data
            [
                'os_id' => 8,
                'servico_id' => 3,
                'quantidade' => 9,
                'valor_servico' => '12,45',
            ],
            // $expected
            [
                'os_id' => 8,
                'servico_id' => 3,
                'quantidade' => 9,
                'valor_servico' => 12.45,
            ],
        ];

        return $data;
    }
}
