<?php

namespace App\Models\Servico;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;



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
