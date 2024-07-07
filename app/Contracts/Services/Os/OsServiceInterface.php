<?php

namespace App\Contracts\Services\Os;

use App\Models\Os\Os;
use Illuminate\Http\Request;

interface OsServiceInterface
{

    /**
     * Retorna o objeto pra modelagem da tabela de OS.
     *
     * @param  Request  $request
     * @param  int  $itensPorPagina default 100
     */
    public static function getDataTable(Request $request);


    /**
     * Armazena uma nova OS e retorna o objeto da mesma.
     *
     * @param  Request  $request
     * @return Os;
     */
    public function store(Request $request): Os;


    /**
     * Atualiza uma OS e retorna o objeto da mesma.
     *
     * @param  Request  $request
     * @param  Os  $os
     * @return Os;
     */
    public function update(Request $request, Os $os): Os;

    /**
     * Exclui uma OS e retora os dados da mesma
     *
     * @param  Os  $os
     * @return bool True para excluído com sucesso;
     */
    public function destroy(Os $os): bool;
}
