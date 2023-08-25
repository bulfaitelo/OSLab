<?php

namespace App\Models\Os;

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Os\CategoriaOs;
use App\Models\Configuracao\Os\StatusOs;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Os extends Model
{
    use HasFactory;

    protected $casts = [
        'data_entrada' => 'date',
        'data_saida' => 'date',
    ];

    /**
     * Retornar o técnico
     *
     * Retorna o técnico relacionado
     * @return BelongsTo Técnico
     **/
    public function tecnico() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar o Cliente
     *
     * Retorna o Cliente relacionado
     * @return BelongsTo Cliente
     **/
    public function cliente() : BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Retornar o Status
     *
     * Retorna o Status relacionado
     * @return BelongsTo Status
     **/
    public function status() : BelongsTo
    {
        return $this->belongsTo(StatusOs::class);
    }

    /**
     * Retornar o Status
     *
     * Retorna o Status relacionado
     * @return BelongsTo Status
     **/
    public function modelo() : BelongsTo
    {
        return $this->belongsTo(Modelo::class);
    }

    /**
     * Retornar o Categoria
     *
     * Retorna o Categoria relacionado
     * @return BelongsTo Categoria
     **/
    public function categoria() : BelongsTo
    {
        return $this->belongsTo(CategoriaOs::class);
    }

    /**
     * Retornar os Produtos da OS
     *
     * Retorna os produtos relacionado a os
     * @return hasMany Produtos
     **/
    public function produtos() : HasMany
    {
        return $this->hasMany(OsProduto::class);
    }

    /**
     * Retorna id e nome do Cliente.
     *
     * Retorna um vetor com o o id e o Cliente para ser usado no Select2
     * @return array Categoria
     **/
    public function getClienteForSelect() : array {
        if ($this->cliente_id) {
            return [$this->cliente_id => $this->cliente->name];
        } else {
            return [] ;
        }
    }

    /**
     * Retorna id e nome do Técnico.
     *
     * Retorna um vetor com o o id e o técnico para ser usado no Select2
     * @return array Categoria
     **/
    public function getTecnicoForSelect() : array {
        if ($this->tecnico_id) {
            return [$this->tecnico_id => $this->tecnico->name];
        } else {
            return [] ;
        }
    }

    /**
     * Retorna id e nome do Modelo.
     *
     * Retorna um vetor com o o id e o Modelo para ser usado no Select2
     * @return array Categoria
     **/
    public function getModeloForSelect() : array {
        if ($this->modelo_id) {
            return [$this->modelo_id => $this->modelo->name];
        } else {
            return [] ;
        }
    }

}
