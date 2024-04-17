<?php

namespace App\Services\Os;

use App\Contracts\Services\Os\OsServiceInterface;
use App\Models\Os\Os;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * undocumented class
 */
class OsService implements OsServiceInterface
{


    public function create(Request $request) : Os {
        DB::beginTransaction();
        try {
            $os = new Os();
            $os->user_id = \Auth::id();
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
}
