<?php

namespace App\Services\Venda;

use App\Contracts\Services\Venda\VendaServiceInterface;
use App\Models\Configuracao\Parametro\Categoria;
use App\Models\Venda\Venda;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Classe de serviço de Venda.
 */
class VendaService implements VendaServiceInterface
{
    public function __construct(

    ) {
    }

    /**
     * Retorna o objeto pra modelagem da tabela de Venda.
     *
     * @param  Request  $request  default null
     * @param  int  $itensPorPagina  default 100
     * @param  string  $colunaOrdenacao  default null
     * @param  string  $ordenacao  default desc
     */
    public static function getDataTable(Request $request, int $itensPorPagina = 100, $colunaOrdenacao = null, $ordenacao = 'desc')
    {
        $dataHoje = Carbon::now()->format('Y-d-m');

        $queryVenda = Venda::with(['cliente', 'vendedor']);

        if ($request->busca) {
            $queryVenda->where(function ($query) use ($request) {
                $query->whereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
                $query->orWhere('descricao', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('id', $request->busca);
            });
        }
        if ($request->data_inicial || $request->data_final) {
            ($request->data_inicial) ? $dataInicial = $request->data_inicial : $dataInicial = $dataHoje;
            ($request->data_final) ? $dataFinal = $request->data_final : $dataFinal = $dataHoje;
            $queryVenda->where(function ($query) use ($dataInicial, $dataFinal) {
                $query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_entrada', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_saida', [$dataInicial, $dataFinal]);
            });
        }
        if ($colunaOrdenacao) {
            $queryVenda->orderBy($colunaOrdenacao, $ordenacao);
        } else {
            $queryVenda->orderBy('id', 'desc');
        }

        return  $queryVenda->paginate($itensPorPagina);
    }

    public function store(Request $request): Venda
    {
        DB::beginTransaction();
        try {
            $venda = new Venda();
            $venda->user_id = Auth::id();
            $venda->cliente_id = $request->cliente_id;
            $venda->vendedor_id = $request->vendedor_id;
            $venda->data_saida = $request->data_saida;
            $venda->descricao = $request->descricao;
            $venda->save();
            DB::commit();

            return $venda;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(Request $request, Venda $venda): Venda
    {
        DB::beginTransaction();
        try {
            $venda->user_id = Auth::id();
            $venda->cliente_id = $request->cliente_id;
            $venda->tecnico_id = $request->tecnico_id;
            $venda->categoria_id = $request->categoria_id;
            $venda->modelo_id = $request->modelo_id;
            $venda->status_id = $request->status_id;
            $venda->data_entrada = $request->data_entrada;
            $venda->data_saida = $request->data_saida;
            if (isset($request->data_saida)) {
                $venda->prazo_garantia = $this->addDayGarantia($request->data_saida, $request->categoria_id);
            } else {
                $venda->prazo_garantia = null;
            }
            $venda->descricao = $request->descricao;
            $venda->defeito = $request->defeito;
            $venda->observacoes = $request->observacoes;
            $venda->laudo = $request->laudo;
            $venda->serial = $request->serial;
            $venda->save();
            DB::commit();

            return $venda;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(Venda $venda): bool
    {
        try {
            return $venda->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Retorna o dia de vencimento com base na categoria selecionada.
     *
     * @param  string  $data_saida  Data de saida da os
     * @param  int  $categoria_id  id da categoria da os para gera os dias de garantia
     * @return string|null retorna o dia de vendimento ou null caso nao exista
     *
     **/
    private function addDayGarantia($data_saida, $categoria_id): string|null
    {
        $prazoEmDias = Categoria::find($categoria_id)->garantia?->prazo_garantia;
        if ($prazoEmDias) {
            $dataGarantia = Carbon::createFromFormat('Y-m-d', $data_saida);

            return $dataGarantia->addDays($prazoEmDias)->format('Y-m-d');
        }

        return null;
    }
}
