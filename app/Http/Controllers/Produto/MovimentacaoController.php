<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Produto\StoreUpdateMovimentacaoRequest;
use App\Models\Produto\Produto;
use Illuminate\Support\Facades\DB;

class MovimentacaoController extends Controller
{
    public function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:produto_movimentacao', ['only' => 'index']);
        $this->middleware('permission:produto_movimentacao_create', ['only' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Produto $produto)
    {
        $movimentacoes = $produto->movimentacao()
                                 ->orderBy('created_at', 'DESC')
                                 ->paginate(100);

        return view('produto.movimentacao.index', compact('movimentacoes', 'produto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Produto $produto)
    {
        return view('produto.movimentacao.create', compact('produto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Produto $produto, StoreUpdateMovimentacaoRequest $request)
    {
        DB::beginTransaction();
        try {
            $estoqueTemp = $produto->estoque + $request->estoque;
            $produto->estoque = $estoqueTemp;
            $produto->save();

            $produto->movimentacao()->createMany([
                [
                    'quantidade_movimentada' => $request->estoque,
                    'tipo_movimentacao' => 1,
                    'valor_custo' => $request->valor_custo,
                    'estoque_antes' => $produto->estoque,
                    'estoque_apos' => $estoqueTemp,
                    'descricao' => $request->descricao,
                ],
            ]);
            DB::commit();

            return redirect()->route('movimentacao.index', $produto)
            ->with('success', 'Estoque Atualizado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Movimentacao $movimentacao)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Produto $produto)
    // {

    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Movimentacao $movimentacao)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Movimentacao $movimentacao)
    // {
    //     //
    // }
}
