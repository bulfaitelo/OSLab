<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Cliente\Cliente;
use App\Models\Os\Os;
use App\Models\User;
use App\Services\Os\OsService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;

class OsUpdateTest extends TestCase
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
        $this->osService = new OsService;
        $this->user = User::find(1);
        $this->actingAs($this->user);
    }

    #[DataProvider('osCreateData')]
    public function testOsUpdate(array $data, array $dataExpected) : void
    {
        $this->user->hasPermissionTo('os_edit');
        $response = $this->put(route('os.update', $data['id']),  $data);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('os', $dataExpected );
    }


    #[Depends('testOsUpdate')]
    #[DataProvider('osCreateData')]
    public function testOsStatusLog($data) : void {
        $os = Os::find($data['id']);
        $this->put(route('os.update', $data['id']),  $data);
        $osUpdated = Os::find($data['id']);
        if($os->status_id == $data['status_id']){
            $this->assertCount(1, $osUpdated->statusLogs);
        } else {
            $this->assertCount(2, $osUpdated->statusLogs);
        }
        $statusLogLastId = Os::find($data['id'])->statusLogs()->orderByDesc('id')->first()->status_id;
        $this->assertEquals($data['status_id'], $statusLogLastId);
    }

    /**
     * DadaProvider
     */
    public static function osCreateData() : array {
        $data['os_001'] = [
            // Send
            [
                'id' => 1,
                'cliente_id' => 10,
                'tecnico_id' => 1,
                'categoria_id' => 1,
                'status_id' => 9,
                'data_entrada' =>  now()->format('Y-m-d'),
                'data_saida' => now()->format('Y-m-d'),
                'descricao' => 'Updataed Descrição',
                'defeito' => 'Updataed Defeito',
                'observacoes' => 'Updated Observações',
                'laudo' => '\n Updated Laudo    ',
                'serial' => '    Serial--123',
            ],
            // Expected
            [
                'id' => 1,
                'cliente_id' => 10,
                'tecnico_id' => 1,
                'categoria_id' => 1,
                'status_id' => 9,
                'data_entrada' =>  now()->format('Y-m-d') . ' 00:00:00',
                'data_saida' => now()->format('Y-m-d') . ' 00:00:00',
                'descricao' => 'Updataed Descrição',
                'defeito' => 'Updataed Defeito',
                'observacoes' => 'Updated Observações',
                'laudo' => '\n Updated Laudo',
                'serial' => 'Serial--123',
            ]
        ];
        $data['os_002'] = [
            // Send
            [
                'id' => 10,
                'cliente_id' => 1,
                'tecnico_id' => 1,
                'categoria_id' => 1,
                'status_id' => 3,
                'data_entrada' =>  now()->format('Y-m-d'),
                'data_saida' => now()->format('Y-m-d'),
                'descricao' => '<b>Updataed Descrição3432e!@#$$%$%¨%$</b>',
                'defeito' => '  Updataed Defeito',
                'observacoes' => '  Updated Observações    ',
                'laudo' => '  Updated Laudo    ',
                'serial' => '  Serial--123#!@#@#   ',
            ],
            // Expected
            [
                'id' => 10,
                'cliente_id' => 1,
                'tecnico_id' => 1,
                'categoria_id' => 1,
                'status_id' => 3,
                'data_entrada' =>  now()->format('Y-m-d') . ' 00:00:00',
                'data_saida' => now()->format('Y-m-d') . ' 00:00:00',
                'descricao' => '<b>Updataed Descrição3432e!@#$$%$%¨%$</b>',
                'defeito' => 'Updataed Defeito',
                'observacoes' => 'Updated Observações',
                'laudo' => 'Updated Laudo',
                'serial' => 'Serial--123#!@#@#',
            ],
        ];
        return $data;
    }
}
