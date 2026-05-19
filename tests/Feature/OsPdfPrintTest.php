<?php

namespace Tests\Feature;

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Sistema\Emitente;
use App\Models\Os\Os;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class OsPdfPrintTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->user = User::find(1);
        $this->actingAs($this->user);
    }

    public function test_os_pdf_renders_perfectly_without_warnings_or_silent_errors(): void
    {
        // 1. O PULO DO GATO: Desativa o tratador de erros do Laravel.
        // Se ocorrer qualquer warning de OpenSSL, file_get_contents ou erro de sintaxe no Blade,
        // o teste vai explodir imediatamente mostrando a linha exata do erro no seu terminal.
        $this->withoutExceptionHandling();

        // 2. Espiona o sistema de Logs para capturar avisos silenciosos do DomPDF
        $logSpy = Log::spy();

        // PREPARAÇÃO (Arrange)
        $cliente = Cliente::factory()->create();
        $os = Os::factory()->create([
            'cliente_id' => $cliente->id,
        ]);

        if (! Emitente::find(1)) {
            Emitente::factory()->create(['id' => 1]);
        }

        // AÇÃO (Act)
        $response = $this->get(route('os.print_pdf', $os->id));
        // ASSERÇÕES (Assert)

        // A. Garante que a requisição foi um sucesso e retornou um PDF
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
        $this->assertStringStartsWith('%PDF-', $response->getContent());

        // B. Validação de Ausência de Avisos (Warnings)
        // Garante que durante a geração daquele PDF, o PHP/DomPDF não registrou
        // nenhum erro ou alerta de CSS/Imagens faltando nos bastidores.
        $logSpy->shouldNotHaveReceived('warning');
        $logSpy->shouldNotHaveReceived('error');

        // C. Validação de Integridade por Peso (Tamanho em Bytes)
        // Um PDF em branco ou sem CSS pesa em torno de 1 a 3 KB (1000 a 3000 bytes).
        // Um PDF formatado com o layout da sua OS pesará muito mais.
        // Se o CSS quebrar, o arquivo perde peso e essa asserção falha.
        // (Ajuste o valor '9000' de acordo com o peso médio real do seu PDF gerado).
        $tamanhoDoPdfEmBytes = strlen($response->getContent());
        $this->assertGreaterThan(
            9000,
            $tamanhoDoPdfEmBytes,
            "O PDF foi gerado, mas está muito leve ({$tamanhoDoPdfEmBytes} bytes). Possivelmente o CSS ou imagens falharam ao carregar."
        );

        // D. Validação de Ausência de Erros Injetados
        // Se o display_errors do PHP estiver ativo, erros podem ser impressos dentro do binário.
        $this->assertStringNotContainsString(
            'Fatal error',
            $response->getContent(),
            'Um erro fatal do PHP foi injetado dentro do arquivo PDF.'
        );
        $this->assertStringNotContainsString(
            'Warning:',
            $response->getContent(),
            'Um warning do PHP vazou para dentro do arquivo PDF.'
        );
    }

    /**
     * Teste extra de isolamento: Garante que o problema não é a View (HTML)
     * antes de culpar o DomPDF.
     */
    public function test_os_pdf_blade_view_compiles_correctly()
    {
        $cliente = Cliente::factory()->create();
        $os = Os::factory()->create(['cliente_id' => $cliente->id]);
        $emitente = Emitente::factory()->create(['id' => 1]);

        // Tenta renderizar apenas o HTML puro. Se faltar variável ou tiver
        // erro de sintaxe no Blade, quebra aqui com uma mensagem muito mais clara
        // do que tentar debugar o erro vindo de dentro da classe do DomPDF.
        $view = view('os.pdf.print', compact('os', 'emitente'))->render();

        $this->assertNotEmpty($view);

        $this->assertStringContainsString($cliente->name, $view); // Verifica se os dados chegaram no HTML
    }
}
