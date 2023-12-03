<?php

namespace App\Models\Os;

use App\Models\Configuracao\Os\OsStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OsStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'conta_id',
        'user_id',
        'descricao',
    ];


    /**
     * Retornar o Status
     *
     * Retorna o Status relacionado
     * @return BelongsTo Status
     **/
    public function status() : BelongsTo
    {
        return $this->belongsTo(OsStatus::class);
    }

}
