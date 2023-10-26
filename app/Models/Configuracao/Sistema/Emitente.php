<?php

namespace App\Models\Configuracao\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emitente extends Model
{
    use HasFactory;


    /**
     * Monta HTMl para exibição da empresa.
     *
     * Undocumented function long description
     *
     * @param int $id id do emitente
     * @return string
     **/
    public static function getHtmlEmitente($id)
    {
        return view ('oslab.header');
    }
}
