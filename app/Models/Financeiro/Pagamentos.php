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



    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }
}
