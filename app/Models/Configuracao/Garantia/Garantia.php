<?php

namespace App\Models\Configuracao\Garantia;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory;

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
