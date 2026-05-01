<?php

// 1. Lógica para buscar a versão do seu arquivo gerado
$versionPath = base_path('version.env');
$appVersion = 'v0.1-dev'; // Versão de fallback

if (file_exists($versionPath)) {
    $envContent = file_get_contents($versionPath);
    if (preg_match('/^APP_VERSION=(.*)$/m', $envContent, $matches)) {
        $appVersion = trim($matches[1]);
    }
}

return [
    /*
    |--------------------------------------------------------------------------
    | Exibir Versão
    |--------------------------------------------------------------------------
    | Define se a versão do sistema deve ficar visível para os usuários.
    | O padrão é 'true', mas pode ser sobrescrito no arquivo .env
    */
    'show' => env('SHOW_VERSION', true),

    /*
    |--------------------------------------------------------------------------
    | Número da Versão
    |--------------------------------------------------------------------------
    */
    'number' => $appVersion,
];
