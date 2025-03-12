<?php

namespace App\Contracts\Services\Venda;

use App\Models\Venda\Venda;
use Illuminate\Http\Request;

interface VendaServiceInterface
{
    /**
     * Retorna o objeto pra modelagem da tabela de Venda.
     *
     * @param  int  $itensPorPagina  default 100
     */
    public static function getDataTable(Request $request);

    /**
     * Armazena uma nova Venda e retorna o objeto da mesma.
     *
     * @return Venda;
     */
    public function store(Request $request): Venda;

    /**
     * Atualiza uma Venda e retorna o objeto da mesma.
     *
     * @return Venda;
     */
    public function update(Request $request, Venda $venda): Venda;

    /**
     * Exclui uma Venda e retora os dados da mesma.
     *
     * @return bool True para excluído com sucesso;
     */
    public function destroy(Venda $venda): bool;
}
