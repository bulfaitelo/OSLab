<?php

namespace App\Models\Servico;

use App\Models\Os\OsServico;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Servico extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    /**
     * Retornar as Os dos Produtos.
     *
     * Retorna as Os relacionadas aos produtos.
     *
     * @return hasMany OS
     **/
    public function os(): HasMany
    {
        return $this->hasMany(OsServico::class);
    }

    /**
     * Retornar o valor formatado em BRL.
     *
     **/
    protected function valorServico(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format($value, 2, ',', '.')
        );
    }
}
