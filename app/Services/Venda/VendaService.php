<?php

namespace App\Services\Venda;

use App\Contracts\Services\Venda\VendaServiceInterface;
use App\Models\Configuracao\Garantia\Garantia;
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
            $venda->termo_garantia_id = $request->termo_garantia_id;
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
            $venda->vendedor_id = $request->vendedor_id;
            $venda->data_saida = $request->data_saida;
            $venda->termo_garantia_id = $request->termo_garantia_id;
            $venda->descricao = $request->descricao;
            if (isset($request->data_saida)) {
                $venda->prazo_garantia = $this->addDayGarantia($request->data_saida, $request->termo_garantia_id);
            } else {
                $venda->prazo_garantia = null;
            }
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
     * @param  string  $data_saida  Data de saída da os
     * @param  int  $termo_garantia_id  id da do termo de garantia
     * @return string|null retorna o dia de vendimento ou null caso nao exista
     *
     **/
    private function addDayGarantia($data_saida, $termo_garantia_id): string|null
    {
        $prazoEmDias = Garantia::find($termo_garantia_id)->prazo_garantia;
        if ($prazoEmDias) {
            $dataGarantia = Carbon::createFromFormat('Y-m-d', $data_saida);

            return $dataGarantia->addDays($prazoEmDias)->format('Y-m-d');
        }

        return null;
    }
}
