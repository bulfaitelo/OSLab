<?php

namespace App\Models\Produto;

use App\Models\Os\OsProduto;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * Retornar as movimentações dos Produtos
     *
     * Retorna as movimentações relacionadas aos produtos.
     * @return hasMany Movimentações
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


}
