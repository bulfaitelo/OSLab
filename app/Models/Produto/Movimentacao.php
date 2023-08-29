<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;


    protected $fillable = [
        'quantidade_movimentada',
        'tipo_movimentacao',
        'estoque_antes',
        'valor_custo',
        'estoque_apos',
        'os_id',
        'venda_id',
        'descricao',
        'os_produto_id',
    ];

    /**
     * Retornar o valor formatado em BRL
     *
     * @return Attribute
     **/
    protected function valorCusto() : Attribute {
        return Attribute::make(
            get: fn ($value) => ($value) ?  number_format($value,2,",",".") : ''
        );
    }

    /**
     * Retornar o tipo de movimentação em Texto
     *
     * @return Attribute
     **/
    protected function tipoMovimentacao() : Attribute {
        return Attribute::make(
            get: fn ($value) => ($value == 1) ? "Entrada" : "Saída"
        );
    }
}
