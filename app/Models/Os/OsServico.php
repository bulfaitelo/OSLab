<?php

namespace App\Models\Os;

use App\Models\Servico\Servico;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OsServico extends Model
{
    use HasFactory;

    protected $fillable = [
        'servico_id',
        'user_id',
        'quantidade',
        'valor_servico',
        'valor_servico_total',
    ];

    /**
     * Retornar o Serviço.
     *
     * Retorna o Serviço relacionado
     *
     * @return BelongsTo Serviço
     **/
    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }
}
