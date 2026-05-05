<?php

namespace App\Models\Configuracao\Garantia;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Garantia extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    /**
     * Retorna o nome do usuário.
     *
     * @var array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
