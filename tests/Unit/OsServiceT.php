<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Http\Requests\Os\StoreOsRequest;
use App\Http\Requests\Os\UpdateOsRequest;
use App\Models\Cliente\Cliente;
use Tests\TestCase;
use App\Models\Os\Os;
use App\Models\User;
use App\Services\Os\OsService;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OsServiceT extends TestCase
{
    use RefreshDatabase;

    private $osService;
    private $os;
    private $request;
    private $osArray;


    public function setUp() : void
    {
        // Preparando Banco de Dados
        parent::setUp();
        $this->artisan('migrate --seed');
        Cliente::factory()->count(10)->create();
        Auth::loginUsingId(1);
        $this->osService = new OsService;
        $this->request = new Request;
    }

    /**
     * Testa a validação do request antes de enviar para criação da OS
     */
    public function testGetRequestToCreateOs() : void {
        foreach ($this->osRequestCreateData() as $key => $dataRequest) {
            $messageKey = 'Looping:' . $key;
            $request = new StoreOsRequest();
            $validator = Validator::make($dataRequest, $request->rules());
            $this->assertTrue($validator->passes(), $this->getErrorMessageRequest($validator, $request, $dataRequest, $messageKey));
        }
    }


    /**
     * Testa a validação do request antes de enviar para atualização da Os.
     */
    public function testGetRequestToUpdateOs() : void {
        foreach ($this->osRequestUpdateData() as $key => $dataRequest) {
            $messageKey = 'Looping:' . $key;
            $request = new UpdateOsRequest();
            $validator = Validator::make($dataRequest, $request->rules());
            $this->assertTrue($validator->passes(), $this->getErrorMessageRequest($validator, $request, $dataRequest, $messageKey));
        }
    }

    /**
     * @depends testGetRequestToCreateOs
     */
    public function testCreateOs()
    {
        $osArray = [];
        foreach ($this->osRequestCreateData() as $key => $dataRequest) {
            $messageKey = 'Looping:' . $key;
            $request = $this->request->merge($dataRequest);
            $osCreated = $this->osService->store($request);
            $this->assertEquals($request->descricao, $osCreated->descricao, $messageKey);
            $this->assertEquals($request->defeito, $osCreated->defeito, $messageKey);
            $this->assertEquals($request->observacoes, $osCreated->observacoes, $messageKey);
            $this->assertEquals($request->laudo, $osCreated->laudo, $messageKey);
            $this->assertEquals($request->serial, $osCreated->serial, $messageKey);
            $osArray[] = $osCreated;
        }
        return $osArray;
    }


    /**
     * @depends testCreateOs
     * @depends testGetRequestToCreateOs
     */
    // public function testUpdateOs($osArray)
    // {
    //     // dd(Os::find(1));
    //     foreach ($this->osRequestUpdateData() as $key => $dataRequest) {
    //         $messageKey = 'Looping:' . $key;
    //         $request = $this->request->merge($dataRequest);
    //         // $os = Os::find(1);
    //         // dd($os);
    //         $osUpdated = $this->osService->update($request, );
    //         $this->assertEquals($request->descricao, $osUpdated->descricao, $messageKey);
    //         $this->assertEquals($request->defeito, $osUpdated->defeito, $messageKey);
    //         $this->assertEquals($request->observacoes, $osUpdated->observacoes, $messageKey);
    //         $this->assertEquals($request->laudo, $osUpdated->laudo, $messageKey);
    //         $this->assertEquals($request->serial, $osUpdated->serial, $messageKey);
    //     }

    // }






    private static function osRequestCreateData() : array {
        $dataRequest['os_001'] = [
            'cliente_id' => 1,
            'tecnico_id' => 1,
            'categoria_id' => 1,
            'status_id' => 1,
            'data_entrada' =>  now() ,
            'data_saida' => now() ,
            'descricao' => 'Updataed Descrição',
            'defeito' => 'Updataed Defeito',
            'observacoes' => 'Updated Observações',
            'laudo' => '\n Updated Laudo ',
            'serial' => 'Serial--123',
        ];
        $dataRequest['os_002'] = [
            'cliente_id' => 10,
            'tecnico_id' => 1,
            'categoria_id' => 1,
            'status_id' => 1,
            'data_entrada' =>  now() ,
            'data_saida' => now() ,
            'descricao' => '<b>Updataed Descrição3432e!@#$$%$%¨%$</b>',
            'defeito' => 'Updataed Defeito',
            'observacoes' => 'Updated Observações',
            'laudo' => 'Updated Laudo ',
            'serial' => 'Serial--123#!@#@#',
        ];
        return $dataRequest;
    }


    private static function osRequestUpdateData() : array {
        $dataRequest['os_001'] = [
            'id' => 1,
            'cliente_id' => 1,
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
        ];
        $dataRequest['os_002'] = [
            'id' => 1,
            'cliente_id' => 10,
            'tecnico_id' => 1,
            'categoria_id' => 1,
            'status_id' => 1,
            'data_entrada' =>  now() ,
            'data_saida' => now() ,
            'descricao' => 'Descrição3432e!@#$$%$%¨%$',
            'defeito' => 'Defeito',
            'observacoes' => 'Observações',
            'laudo' => 'Laudo',
            'serial' => 'Serial--123#!@#@#',
        ];
        return $dataRequest;
    }

    // public static function osProductData() : array {

    // }


    /**
     * Cria uma mensagem de erro mais amigável para as rotas com erro.
     *
     * @param mixed $validator Validator validando os dados com as rules
     * @param mixed $rules Regras do request
     * @param array|null $dataRequest Dados do request
     */
    private function getErrorMessageRequest ($validator, $rules = null, $dataRequest = null, $messageKey = null) : string {
        $return = "";
        foreach ($validator->messages()->messages() as $key => $value) {
            $return.= $messageKey . "\n";
            $return.= "Input: ".  $key . ", Value: \"". $dataRequest[$key] . "\" - [Rules: " . $rules->rules()[$key] . "] \nMessage: "  . $value[0] . "\n";
        }
        return $return;
    }


}
