<?php

namespace App\Models\Financeiro;

use App\Models\Configuracao\Financeiro\FormaPagamento;
use App\Models\User;
use DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pagamentos extends Model
{
    use HasFactory;

    protected $casts = [
        'vencimento' => 'date',
        'data_pagamento' => 'date',
        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'forma_pagamento_id',
        'user_id',
        'valor',
        'vencimento',
        'data_pagamento',
        'parcela',
    ];



    /**
     * Retornar a Conta
     *
     * Retorna a Conta relacionada
     * @return BelongsTo Conta
     **/
    public function conta() : BelongsTo
    {
        return $this->belongsTo(Contas::class);
    }

    /**
     * Retornar o Usuário
     *
     * Retorna o Usuário relacionado
     * @return BelongsTo User
     **/
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar a forma de pagamento
     *
     * Retorna a forma de pagamento relacionado
     * @return BelongsTo FormaPagamento
     **/
    public function formaPagamento() : BelongsTo
    {
        return $this->belongsTo(FormaPagamento::class);
    }


    /**
     * Retorna um json para exibição do modal
     *
     * @return string Dados do modal
     */
    public function dataModal() : string {
        return json_encode([
            'id'=> $this->id,
            'parcela' => $this->parcela,
            'vencimento' => $this->vencimento?->format('Y-m-d'),
            'data_pagamento' => $this->data_pagamento?->format('Y-m-d'),
            'forma_pagamento_id' => $this->forma_pagamento_id,
            'valor' => number_format($this->valor, 2, ',', '.'),
        ]);
    }
}
