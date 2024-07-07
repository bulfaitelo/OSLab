<?php

use App\Models\Configuracao\Sistema\SistemaConfig;

/**
 *  Retorna o valor da chave de configuração.
 *
 *  Caso a chave exista ela retorna seu valor
 *  @param  string  $keyConfig Recebe a chave para buscar no banco
 *  @return string Retorna o valor correspondente a chave passada, ou "" caso não exista valor.
 *
 */
if (! function_exists('getConfig')) {
    function getConfig(string $keyConfig)
    {
        if($keyConfig) {
            return json_decode(SistemaConfig::where('key', $keyConfig)->value('value'));
        }
    }
}
