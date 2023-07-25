<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'vencimento' => 'date',
    // ];

    protected $fillable = [
        'forma_pagamento_id',
        'user_id',
        'valor',
        'vencimento',
        'data_pagamento',
        'parcela',
    ];
}
