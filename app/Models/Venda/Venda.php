<?php

namespace App\Models\Venda;

use App\Models\Cliente\Cliente;
use App\Models\Financeiro\Contas;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venda extends Model
{
    protected $casts = [
        'data_saida' => 'date',
        'prazo_garantia' => 'date',
    ];

    /**
     * Retornar o técnico.
     *
     * Retorna o técnico relacionado
     *
     * @return BelongsTo Vendedor
     **/
    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar o usuário.
     *
     * Retorna o usuário relacionado
     *
     * @return BelongsTo User
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar o Cliente.
     *
     * Retorna o Cliente relacionado
     *
     * @return BelongsTo Cliente
     **/
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Retorna as despesas e receitas da Vendas.
     *
     * Retorna as despesas e receitas da Vendas.
     *
     * @return BelongsTo conta
     **/
    public function contas(): HasMany
    {
        return $this->hasMany(Contas::class);
    }
}
