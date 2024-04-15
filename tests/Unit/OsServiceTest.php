<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Os\Os;
use App\Models\User;
use App\Services\OsService\OsService;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OsServiceTest extends TestCase
{
    use RefreshDatabase;

    private $osService;

    public function setUp() : void
    {
        // Preparando Banco de Dados
        parent::setUp();
        $this->artisan('db:seed');
        Auth::loginUsingId(1);
        $this->osService = new OsService;

    }

    /**
     * @dataProvider osRequestData
     */
    public function testCreateOs(Request $request): void
    {
        $os = $this->osService->create($request);
        $this->assertEquals(1, $os->id);
        $this->assertEquals('Descrição', $os->descricao);
        $this->assertEquals('Defeito', $os->defeito);
        $this->assertEquals('Observações', $os->observacoes);
        $this->assertEquals('Laudo', $os->laudo);
        $this->assertEquals('Serial--123', $os->serial);

    }


    public static function osRequestData() : array {
        $request = new Request ();
        $request->merge([
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
        ]);
        return [
            'os_001' => [$request],
        ];
    }



}
