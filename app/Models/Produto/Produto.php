<?php

namespace App\Models\Produto;

use App\Models\Configuracao\Financeiro\CentroCusto;
use App\Models\Os\OsProduto;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;


    /**
     * Retornar as movimentações dos Produtos
     *
     * Retorna as movimentações relacionadas aos produtos.
     * @return hasMany Movimentações
     **/
    public function movimentacao() : HasMany {
        return $this->hasMany(Movimentacao::class);
    }

    /**
     * Retornar o centro de custo do Produtos
     *
     * Retorna o centro de custo do produto.
     * @return BelongsTo Centro de Custo
     **/
    public function centroCusto(): BelongsTo {
        return $this->belongsTo(CentroCusto::class);
    }

    /**
     * Retornar as Os dos Produtos
     *
     * Retorna as Os relacionadas aos produtos.
     * @return hasMany OS
     **/
    public function os() : HasMany {
        return $this->hasMany(OsProduto::class);
    }


    /**
     * Retornar o valor formatado em BRL
     *
     * @return Attribute
     **/
    protected function valorCusto() : Attribute {
        return Attribute::make(
            get: fn (string $value) => number_format($value,2,",",".")
        );
    }

    /**
     * Retornar o valor formatado em BRL
     *
     * @return Attribute
     **/
    protected function valorVenda() : Attribute {
        return Attribute::make(
            get: fn (string $value) => number_format($value,2,",",".")
        );
    }

    /**
     * Retorna o objeto pra modelagem da tabela de Produtos
     *
     * @param Request $request
     * @param int $itensPorPagina default 100
     */
    static public function getDataTable(Request $request, int $itensPorPagina = 100) : object {
        $queryProduto = self::query();
        $queryProduto->with('centroCusto');
        if ($request->busca) {
            $queryProduto->Where('name', 'LIKE', '%' . $request->busca . '%');
        }
        if ($request->centro_custo_id){
            $queryProduto->where('centro_custo_id', $request->centro_custo_id);
        }
        return $queryProduto->paginate($itensPorPagina);
    }


}
