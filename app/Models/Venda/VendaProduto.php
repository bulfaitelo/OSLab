<?php

namespace App\Models\Venda;

use App\Models\Produto\Produto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendaProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_custo',
        'valor_venda',
        'quantidade',
        'valor_custo_total',
        'valor_venda_total',
        'produto_id',
        'user_id',
    ];

    /**
     * Retornar o Produto.
     *
     * Retorna o Produto relacionado
     *
     * @return BelongsTo Produto
     **/
    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
