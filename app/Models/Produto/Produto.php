<?php

namespace App\Models\Produto;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;


    public function movimentacao() {
        return $this->hasMany(Movimentacao::class);
    }

    protected function valorCusto() : Attribute {
        return Attribute::make(
            get: fn (string $value) => number_format($value,2,",",".")
        );
    }

    protected function valorVenda() : Attribute {
        return Attribute::make(
            get: fn (string $value) => number_format($value,2,",",".")
        );
    }

}
