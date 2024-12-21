<?php

namespace App\Models\Financeiro;

use App\Models\Configuracao\Financeiro\CentroCusto;
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
}
