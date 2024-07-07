<?php

namespace App\Models\Configuracao\Sistema;

use App\Models\Os\Os;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
     * @param int $id id da Os
     * @return string
     **/
    public static function getHtmlEmitente($id, $os_id = null)
    {
        $emitente = self::where("id", $id)->first();
        $os = Os::where("id", $os_id)->first();
        return view('oslab.header', compact ('emitente', 'os'));
    }


}
