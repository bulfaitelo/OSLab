<?php

namespace App\Models\Financeiro;

use App\Models\Configuracao\Financeiro\CentroCusto;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class MetaContabil extends Model
{
    /**
     * Relacionamento com o Centro de Custo.
     */
    public function centroCusto()
    {
        return $this->belongsTo(CentroCusto::class);
    }

    /**
     * Retornar o valor formatado em BRL.
     *
     * @return Attribute
     **/
    protected function valor(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format($value, 2, ',', '.')
        );
    }

    /**
     * Retorna o intervalo para exibição
     *
     * @return Attribute
     **/
    protected function intervalo(): Attribute
    {
        return Attribute::make(
            get: function (string $value)  {
                if ($value == 'mes') {
                    return 'Mensal';
                }
                elseif ($value == 'ano') {
                    return 'Anual';
                }
            }
        );
    }



}
