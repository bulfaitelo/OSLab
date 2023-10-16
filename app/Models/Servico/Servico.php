<?php

namespace App\Models\Servico;

use App\Models\Os\OsServico;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servico extends Model
{
    use HasFactory;



    /**
     * Retornar as Os dos Produtos
     *
     * Retorna as Os relacionadas aos produtos.
     * @return hasMany OS
     **/
    public function os() : HasMany {
        return $this->hasMany(OsServico::class);
    }

    /**
     * Retornar o valor formatado em BRL
     *
     * @return Attribute
     **/
    protected function valorServico() : Attribute {
        return Attribute::make(
            get: fn (string $value) => number_format($value,2,",",".")
        );
    }
}
