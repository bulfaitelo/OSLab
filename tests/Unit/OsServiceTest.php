<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Os\Os;
use App\Models\User;
use App\Services\Os\OsService;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OsServiceTest extends TestCase
{
    use RefreshDatabase;

    private $osService;
    private $os;
    // private $osArray;


    public function setUp() : void
    {
        // Preparando Banco de Dados
        parent::setUp();
        $this->artisan('migrate --seed');
        Auth::loginUsingId(1);
        $this->osService = new OsService;



    }


    public function testCreateOs()
    {
        foreach ($this->osRequestData() as $key => $request) {
            $messageKey = 'Looping:' . $key;
            $os = $this->osService->store($request);
            $this->assertEquals($request->descricao, $os->descricao, $messageKey);
            $this->assertEquals($request->defeito, $os->defeito, $messageKey);
            $this->assertEquals($request->observacoes, $os->observacoes, $messageKey);
            $this->assertEquals($request->laudo, $os->laudo, $messageKey);
            $this->assertEquals($request->serial, $os->serial, $messageKey);
            $osArray[$key] = $os;
        }
        return $osArray;
    }

    /**
     * @depends testCreateOs
     */
    public function testCreateProtudoOs(array $os) {
        $this->assertNotEmpty($os);
    }




    public static function osRequestData() : array {
        $request_1 = new Request();
        $request_1->merge([
            'cliente_id' => 123,
            'tecnico_id' => 1,
            'categoria_id' => 1,
            'status_id' => 1,
            'data_entrada' =>  now() ,
            'data_saida' => now() ,
            'descricao' => 'Descrição',
            'defeito' => 'Defeito',
            'observacoes' => 'Observações',
            'laudo' => 'Laudo',
            'serial' => 'Serial--123',
        ]);

        $request_2 = new Request();
        $request_2->merge([
            'cliente_id' => 1,
            'tecnico_id' => 123,
            'categoria_id' => 1,
            'status_id' => 1,
            'data_entrada' =>  now() ,
            'data_saida' => now() ,
            'descricao' => 'Descrição3432e!@#$$%$%¨%$',
            'defeito' => 'Defeito',
            'observacoes' => 'Observações',
            'laudo' => 'Laudo',
            'serial' => 'Serial--123#!@#@#',
        ]);
        return [
            'os_001' => $request_1,
            'os_002' => $request_2,
        ];
    }

    // public static function osProductData() : array {

    // }




}
