<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreatesApplication;
use Tests\TestCase;

use App\Http\Requests\Os\StoreOsRequest;
use App\Http\Requests\Os\UpdateOsRequest;
use App\Models\Cliente\Cliente;
use App\Models\Os\Os;
use App\Models\User;
use App\Services\Os\OsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OsServiceCreateTest extends TestCase
{

    use RefreshDatabase;

    private $osService;
    private $request;
    private $user;

    public function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh --seed');
        Cliente::factory()->count(10)->create();
        $this->osService = new OsService;
        $this->request = new Request;
        $this->user = User::find(1);
    }

    /**
     * @dataProvider osCreateData
     */
    public function testCreateOs($data)
    {
        $this->actingAs($this->user);
        $this->user->hasPermissionTo('os_create');
        $response = $this->post(route('os.store'),  $data);
        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('os', $data );
    }

    public static function osCreateData() : array {
        $data['os_001'] = [
            [
                'cliente_id' => 10,
                'tecnico_id' => 1,
                'categoria_id' => 1,
                'status_id' => 10,
                'data_entrada' =>  now()->format('Y-m-d') . ' 00:00:00',
                'data_saida' => now()->format('Y-m-d') . ' 00:00:00',
                'descricao' => 'Updataed Descrição',
                'defeito' => 'Updataed Defeito',
                'observacoes' => 'Updated Observações',
                'laudo' => '\n Updated Laudo',
                'serial' => 'Serial--123',
            ],
        ];
        $data['os_002'] = [
            [
                'cliente_id' => 1,
                'tecnico_id' => 1,
                'categoria_id' => 1,
                'status_id' => 1,
                'data_entrada' =>  now()->format('Y-m-d') . ' 00:00:00',
                'data_saida' => now()->format('Y-m-d') . ' 00:00:00',
                'descricao' => '<b>Updataed Descrição3432e!@#$$%$%¨%$</b>',
                'defeito' => 'Updataed Defeito',
                'observacoes' => 'Updated Observações',
                'laudo' => 'Updated Laudo',
                'serial' => 'Serial--123#!@#@#',
            ]
        ];
        return $data;
    }
}
