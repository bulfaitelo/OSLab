<?php

namespace App\Models\Configuracao\Parametro;

use App\Models\Checklist\Checklist;
use App\Models\Configuracao\Financeiro\CentroCusto;
use App\Models\Configuracao\Garantia\Garantia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    /**
     * Retorna a garantia.
     *
     * @var array
     */
    public function garantia()
    {
        return $this->belongsTo(Garantia::class);
    }

    /**
     * Retorna a o checklist.
     *
     * @var array
     */
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    /**
     * Retorna a o centroCusto.
     *
     * @var array
     */
    public function centroCusto()
    {
        return $this->belongsTo(CentroCusto::class);
    }
}
