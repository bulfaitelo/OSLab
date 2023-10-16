<?php

namespace App\Http\Controllers\Produto;

use App\Http\Controllers\Controller;
use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Models\Produto\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    function __construct()
    {
        // ACL DE PERMISSÕES
        $this->middleware('permission:produto', ['only'=> ['index', 'apiProdutoSelect']]);
        $this->middleware('permission:produto_create', ['only'=> ['create', 'store']]);
        $this->middleware('permission:produto_show', ['only'=> 'show']);
        $this->middleware('permission:produto_edit', ['only'=> ['edit', 'update']]);
        $this->middleware('permission:produto_destroy', ['only'=> 'destroy']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::paginate(100);
        return view('produto.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutoRequest $request)
    {
        DB::beginTransaction();
        try {
            $produto = new Produto();
            $produto->name = $request->name;
            $produto->descricao = $request->descricao;
            $produto->valor_custo = $request->valor_custo;
            $produto->valor_venda = $request->valor_venda;
            $produto->estoque = $request->estoque;
            $produto->estoque_minimo = $request->estoque_minimo;
            $produto->centro_custo_id = $request->centro_custo_id;
            $produto->modelo_id = $request->modelo_id;
            $produto->save();

            if ($request->estoque > 0) {
                $produto->movimentacao()->create([
                        'quantidade_movimentada' => $request->estoque,
                        'tipo_movimentacao' => 1,
                        'valor_custo' => $request->valor_custo,
                        'estoque_antes' => 0,
                        'estoque_apos' => $request->estoque,
                    ]);
            }
            DB::commit();
            return redirect()->route('produto.index')
            ->with('success', 'Produto cadastrado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view ('produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        return view ('produto.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        DB::beginTransaction();
        try {
            $produto->name = $request->name;
            $produto->descricao = $request->descricao;
            $produto->valor_custo = $request->valor_custo;
            $produto->valor_venda = $request->valor_venda;
            $produto->estoque_minimo = $request->estoque_minimo;
            $produto->centro_custo_id = $request->centro_custo_id;
            $produto->modelo_id = $request->modelo_id;
            $produto->save();

            DB::commit();
            return redirect()->route('produto.index')
            ->with('success', 'Produto atualizado com sucesso.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        try {
            $produtoCount = $produto->os->count();
            if ($produtoCount > 0) {
                return redirect()->route('produto.index')
                ->with('warning', 'O produto não pode ser excluído pois está sendo usado em: '. $produtoCount. ' Os');
            }
            $produto->delete();
            return redirect()->route('produto.index')
                ->with('success', 'Produto excluído com sucesso.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }




    /**
     * Select Produto
     *
     * Retorna o select com os Produtos via Json.
     *
     * @param Request $request Request da variável Busca,
     * @return response, json Retorna o json para ser montado.
     **/
    public function apiProdutoSelect (Request $request) {
        try {
            $select = Produto::where('name', 'LIKE', '%'. $request->q . '%');
            $select->orderBy('name');
            $select->limit(10);
            $response = [];
            foreach ($select->get() as $value) {
                $response[] = [
                    'id' => $value->id,
                    'name' => $value->name,
                    'valor_custo' => $value->valor_custo,
                    'valor_venda' => $value->valor_venda,
                    'estoque' => $value->estoque,
                ];
            }

            return response()->json($response, 200);

        } catch (\Throwable $th) {
            return response()->json($th, 403);
        }
    }
}
