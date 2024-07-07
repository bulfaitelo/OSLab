<?php

namespace App\Services\Os;

use App\Contracts\Services\Os\OsServiceInterface;
use App\Models\Configuracao\Os\OsCategoria;
use App\Models\Os\Os;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * undocumented class
 */
class OsService implements OsServiceInterface
{
    public function __construct(

    ) { }

    static public function getDataTable(Request $request, int $itensPorPagina = 100) {

        $dataHoje = Carbon::now()->format('Y-d-m');
        $osListagemPadrao = getConfig('os_listagem_padrao');

        $queryOs = Os::with(['cliente', 'tecnico', 'categoria', 'status']);

        if ($request->busca) {
            $queryOs->where(function ($query) use ($request){
                $query->whereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->busca . '%');
                });
                $query->orWhere('descricao', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('defeito', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('observacoes', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('laudo', 'LIKE', '%' . $request->busca . '%');
                $query->orWhereHas('modelo', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->busca . '%');
                });
            });
        }
        if ($request->categoria_id) {
            $queryOs->where('categoria_id', $request->categoria_id);
        }
        if (($request->data_inicial) || ($request->data_final)) {
            ($request->data_inicial) ? $dataInicial = $request->data_inicial : $dataInicial = $dataHoje;
            ($request->data_final) ? $dataFinal = $request->data_final : $dataFinal = $dataHoje;
            $queryOs->where(function ($query) use ($dataInicial, $dataFinal) {
                $query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_entrada', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_saida', [$dataInicial, $dataFinal]);
            });
        }
        if ($request->status_id) {
            $queryOs->where('status_id', $request->status_id);
        }
        if (!$request->input()) {
            if ($osListagemPadrao){
                $queryOs->whereIn('status_id', $osListagemPadrao);
            }
        }
        $queryOs->orderBy('id', 'desc');
        return  $queryOs->paginate($itensPorPagina);
    }


    public function store(Request $request) : Os {
        DB::beginTransaction();
        try {
            $os = new Os();
            $os->user_id = Auth::id();
            $os->cliente_id = $request->cliente_id;
            $os->tecnico_id = $request->tecnico_id;
            $os->categoria_id = $request->categoria_id;
            $os->modelo_id = $request->modelo_id;
            $os->status_id = $request->status_id;
            $os->data_entrada = $request->data_entrada;
            $os->data_saida = $request->data_saida;
            // $os->prazo_garantia = $this->addDayGarantia($request->data_entrada, $request->categoria_id);
            $os->descricao = $request->descricao;
            $os->defeito = $request->defeito;
            $os->observacoes = $request->observacoes;
            $os->laudo = $request->laudo;
            $os->serial = $request->serial;
            $os->save();
            DB::commit();
            return $os;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(Request $request, Os $os) : Os {
        DB::beginTransaction();
        try {
            $os->user_id = Auth::id();
            $os->cliente_id = $request->cliente_id;
            $os->tecnico_id = $request->tecnico_id;
            $os->categoria_id = $request->categoria_id;
            $os->modelo_id = $request->modelo_id;
            $os->status_id = $request->status_id;
            $os->data_entrada = $request->data_entrada;
            $os->data_saida = $request->data_saida;
            if (isset($request->data_saida)) {
                $os->prazo_garantia = $this->addDayGarantia($request->data_saida, $request->categoria_id);
            } else {
                $os->prazo_garantia = null;
            }
            $os->descricao = $request->descricao;
            $os->defeito = $request->defeito;
            $os->observacoes = $request->observacoes;
            $os->laudo = $request->laudo;
            $os->serial = $request->serial;
            $os->save();
            DB::commit();
            return $os;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function destroy(Os $os) : bool {
        try {
            return $os->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }






    /**
     * Retorna o dia de vencimento com base na categoria selecionada
     *
     * @param string $data_saida Data de saida da os
     * @param int $categoria_id id da categoria da os para gera os dias de garantia
     * @return string|null retorna o dia de vendimento ou null caso nao exista

     **/
    private function addDayGarantia($data_saida, $categoria_id) : string|null {
        $prazoEmDias = OsCategoria::find($categoria_id)->garantia?->prazo_garantia;
        if ($prazoEmDias) {
            $dataGarantia = Carbon::createFromFormat('Y-m-d', $data_saida);
            return $dataGarantia->addDays($prazoEmDias)->format('Y-m-d');
        }
        return null;
    }

}
