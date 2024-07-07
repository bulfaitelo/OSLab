<?php

namespace App\Http\Controllers\Os;

use App\Http\Controllers\Controller;
use App\Models\Configuracao\Sistema\Emitente;
use App\Models\Os\Os;
use App\Models\Os\OsInformacao;
use Illuminate\Http\Request;

class OsPublicController extends Controller
{
    public function edit($uuid){
        $informacao = OsInformacao::where("uuid",$uuid)->firstOrfail();
        $emitente = Emitente::getHtmlEmitente(1);

        return view("os.public.edit",compact("informacao", "emitente"));
    }



    /**
     * Atualiza informações da OS com base no hash gerado
     *
     *
     *
     * @param $uuid Uuid
     **/
    public function update($uuid, Request $request){
        $informacao = OsInformacao::where("uuid",$uuid)->firstOrfail();
        $request->validate([
            'tipo' => 'required|integer',
            "informacao"=> "required",
        ]);
        // dd($request->input());
        try {
            $informacao->informacao = $request->informacao;
            $informacao->descricao = $request->descricao;
            $informacao->uuid = null;
            $informacao->status = 3;
            $informacao->save();
            return redirect()->route('os.public.updated')
            ->with('success', 'Os Atualizada com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }



    }

    public function updated() {
        $emitente = Emitente::getHtmlEmitente(1);

        return view('os.public.updated', compact('emitente'));
    }

}
