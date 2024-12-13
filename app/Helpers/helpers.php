<?php

use App\Models\Configuracao\Sistema\SistemaConfig;
use App\Models\User\UserConfig;

/**
 * Retorna o valor da chave de configuração.
 *
 * Caso a chave exista ela retorna seu valor
 *
 * @param  string  $keyConfig  Recebe a chave para buscar no banco
 * @return string Retorna o valor correspondente a chave passada, ou "" caso não exista valor.
 */
if (! function_exists('getConfig')) {
    function getConfig(string $keyConfig)
    {
        if ($keyConfig) {
            return json_decode(SistemaConfig::where('key', $keyConfig)->value('value'));
        }
    }
}

/**
 * Define o valor da chave de configuração.
 *
 * Caso a chave exista ela Define seu valor caso não a cria.
 *
 * @param  string  $key  Recebe a chave para buscar no banco
 * @param  string  $keyValue  Recebe o valor para atualizar no banco
 * @return void
 */
if (! function_exists('setUserConfig')) {
    function setUserConfig(string $key, $keyValue): void
    {
        UserConfig::updateOrCreate(
            [
                'key' => $key,
                'user_id' => Auth::id(),
            ],
            [
                'value' => $keyValue,
            ]
        );
    }
}

/**
 * Retorna o valor da chave de configuração do usuário.
 *
 * Caso a chave exista ela retorna seu valor
 *
 * @param  string  $keyConfig  Recebe a chave para buscar no banco
 * @return string Retorna o valor correspondente a chave passada, ou "" caso não exista valor.
 */
if (! function_exists('getUserConfig')) {
    function getUserConfig(string $keyConfig)
    {
        if ($keyConfig) {
            return json_decode(
                UserConfig::where('key', $keyConfig)
                ->where('user_id', Auth::id())
                ->value('value')
            );
        }
    }
}
