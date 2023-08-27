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
    ];

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
}
