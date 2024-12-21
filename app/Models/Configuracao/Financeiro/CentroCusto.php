<?php

namespace App\Models\Configuracao\Financeiro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroCusto extends Model
{
    use HasFactory;

    /**
     * Retorna o array de opções de Centro de Custo
     *          
     **/
    public static function getSelectCentroCusto()
    {
        $arrayCentroCusto = [];
        $centroCusto = self::orderBy('name')->get();
        
        foreach ($centroCusto as $key => $value) {
            if (($value->receita == 1) && ($value->despesa == 1)) {
                $arrayCentroCusto[$value->id] = '[ RECEITA / DESPESA ] '.$value->name;                
            } else {
                if ($value->receita == 1) {
                    $arrayCentroCusto[$value->id] = '[ RECEITA ] '.$value->name;
                } else {
                    $arrayCentroCusto[$value->id] = '[ DESPESA ] '.$value->name;
                }                
            }
        }
        return $arrayCentroCusto;        
    }
}
