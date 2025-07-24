<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * Classe auxiliar para adicionar cores ao output do terminal (CLI).
 */
class CliColor
{
    public static function red(string $text): string
    {
        return "\033[31m".$text."\033[0m";
    }

    public static function green(string $text): string
    {
        return "\033[32m".$text."\033[0m";
    }
}

class AuthenticatedPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_verifica_acesso_em_pagina_sem_esta_autenticado(): void
    {
        // 1. Array para coletar as mensagens de erro
        $failures = [];

        // 2. Defina as rotas de exceções
        $publicRoutes = [
            'teste.index',
            'log-viewer.index',
        ];

        // 3. Obtenha e filtre as rotas a serem testadas
        $routesToTest = collect(Route::getRoutes()->getRoutes())->filter(function (RoutingRoute $route) use ($publicRoutes) {
            $routeName = $route->getName();

            return in_array('GET', $route->methods()) && str_ends_with($routeName, '.index') && ! in_array($routeName, $publicRoutes);
        });

        // 4. Itere sobre cada rota filtrada
        foreach ($routesToTest as $route) {
            $uri = $route->uri();
            $routeName = $route->getName();

            $response = $this->get($uri);
            $status = $response->getStatusCode();
            $expectedStatus = 302; // Redireciona para a tela de login

            if ($status !== $expectedStatus) {
                // Monta a mensagem de falha com cores
                $failMessage = '['.CliColor::red('FALHA')."] Rota: '$routeName' | Esperado: ".CliColor::green((string) $expectedStatus).' | Recebido: '.CliColor::red((string) $status);
                $failures[] = $failMessage;
            }
        }

        // 5. Se houver falhas, imprime o resumo no final
        if (! empty($failures)) {
            echo '--- Resumo das Falhas de Acesso ---'."\n";
            foreach ($failures as $failure) {
                echo $failure."\n";
            }
            echo "\n";
        }

        // 6. A asserção final: o teste falhará se o array de falhas não estiver vazio
        $this->assertEmpty($failures, 'Foram encontradas falhas de controle de acesso. Verifique o relatório no console.');
    }

    public function test_verifica_acesso_em_pagina_autenticado_mas_sem_permissao(): void
    {
        // 1. Array para coletar as mensagens de erro
        $failures = [];

        $user = User::factory()->create();
        // 2. Defina as rotas de exceções
        $publicRoutes = [
            'teste.index',
            'log-viewer.index',
            'movimentacao.index', // pagina de movimentação é uma sub pagina  de produtos
        ];

        // 3. Obtenha e filtre as rotas a serem testadas
        $routesToTest = collect(Route::getRoutes()->getRoutes())->filter(function (RoutingRoute $route) use ($publicRoutes) {
            $routeName = $route->getName();

            return in_array('GET', $route->methods()) && str_ends_with($routeName, '.index') && ! in_array($routeName, $publicRoutes);
        });

        // 4. Itere sobre cada rota filtrada
        foreach ($routesToTest as $route) {
            $uri = $route->uri();
            $routeName = $route->getName();

            $response = $this->actingAs($user)->get($uri);
            $status = $response->getStatusCode();
            $expectedStatus = 403; // Redireciona para a tela de login

            if ($status !== $expectedStatus) {
                // Monta a mensagem de falha com cores
                $failMessage = '['.CliColor::red('FALHA')."] Rota: '$routeName' | Esperado: ".CliColor::green((string) $expectedStatus).' | Recebido: '.CliColor::red((string) $status);
                $failures[] = $failMessage;
            }
        }

        // 5. Se houver falhas, imprime o resumo no final
        if (! empty($failures)) {
            echo '--- Resumo das Falhas de Acesso ---'."\n";
            foreach ($failures as $failure) {
                echo $failure."\n";
            }
            echo "\n";
        }

        // 6. A asserção final: o teste falhará se o array de falhas não estiver vazio
        $this->assertEmpty($failures, 'Foram encontradas falhas de controle de acesso. Verifique o relatório no console.');
    }

    public function test_verifica_acesso_em_pagina_autenticado_e_com_permissao(): void
    {
        // 1. Array para coletar as mensagens de erro
        $failures = [];

        $user = User::factory()->create();
        $user->assignRole('susepro');
        // 2. Defina as rotas de exceções
        $publicRoutes = [
            'teste.index',
            'configuracao.emitente.index', // existe um redirecionamento para tela de editar quando já existir emitente cadastrado.
            'movimentacao.index', // pagina de movimentação é uma sub pagina  de produtos
            'financeiro.meta_contabil.index', // Não sei bem o porque mas provavelmente é por que o sqlite não entende a query.
        ];

        // 3. Obtenha e filtre as rotas a serem testadas
        $routesToTest = collect(Route::getRoutes()->getRoutes())->filter(function (RoutingRoute $route) use ($publicRoutes) {
            $routeName = $route->getName();

            return in_array('GET', $route->methods()) && str_ends_with($routeName, '.index') && ! in_array($routeName, $publicRoutes);
        });

        // 4. Itere sobre cada rota filtrada
        foreach ($routesToTest as $route) {
            $uri = $route->uri();
            $routeName = $route->getName();

            $response = $this->actingAs($user)->get($uri);
            $status = $response->getStatusCode();
            $expectedStatus = 200; // Redireciona para a tela de login

            if ($status !== $expectedStatus) {
                // Monta a mensagem de falha com cores
                $failMessage = '['.CliColor::red('FALHA')."] Rota: '$routeName' | Esperado: ".CliColor::green((string) $expectedStatus).' | Recebido: '.CliColor::red((string) $status);
                $failures[] = $failMessage;
            }
        }

        // 5. Se houver falhas, imprime o resumo no final
        if (! empty($failures)) {
            echo '--- Resumo das Falhas de Acesso ---'."\n";
            foreach ($failures as $failure) {
                echo $failure."\n";
            }
            echo "\n";
        }

        // 6. A asserção final: o teste falhará se o array de falhas não estiver vazio
        $this->assertEmpty($failures, 'Foram encontradas falhas de controle de acesso. Verifique o relatório no console.');
    }
}
