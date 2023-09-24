<?php

namespace App\Models\Os;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OsInformacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo',
        'descricao',
        'tipo_informacao',
        'informacao',

    ];


    function getTipo() : string {
        $tipo = [
            1 => 'Anotação',
            2=> 'Senha',
            3=> 'Arquivo',
        ];
        return $tipo[$this->tipo];
    }
}
