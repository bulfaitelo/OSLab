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
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'descricao',
        'defeito',
        'observacao',
        'laudo',
        'user_id',
        'garantia_id',
        'centro_custo_id',
        'checklist_id',
        'checklist_required',
    ];

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
