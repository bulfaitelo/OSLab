<?php

namespace App\Models\Produto;

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
    ];
}
