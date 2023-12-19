<?php

namespace App\Http\Controllers\Configuracao\Sistema;

use App\Http\Controllers\Controller;

use App\Http\Requests\Configuracao\Sistema\StoreSistemaConfigRequest;
use App\Http\Requests\Configuracao\Sistema\UpdateSistemaConfigRequest;
use App\Models\Configuracao\Sistema\SistemaConfig;
use Illuminate\Support\Facades\DB;

class SistemaConfigController extends Controller
{


    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:config_sistema', ['only'=> 'index']);
        $this->middleware('permission:config_sistema_edit', ['only'=> ['store', ]]);

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configuracoes = SistemaConfig::get();
        return view('configuracao.sistema.index', compact('configuracoes'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(StoreSistemaConfigRequest $request)
    {
        dd($request->input());
        DB::beginTransaction();
        try {
            foreach ($request->sistema as $key => $value) {
                SistemaConfig::updateOrCreate(
                    [
                        'key' => $key
                    ],
                    [
                        'value' => $value
                    ]
                );
            }
            DB::commit();
            return redirect()->route('configuracao.sistema.index')
            ->with('success', 'Configurações de sistema atualizadas com sucesso!');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(SistemaConfig $sistemaConfig)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(SistemaConfig $sistemaConfig)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateSistemaConfigRequest $request, SistemaConfig $sistemaConfig)
    // {
    //     dd($request);
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(SistemaConfig $sistemaConfig)
    // {
    //     //
    // }
}
