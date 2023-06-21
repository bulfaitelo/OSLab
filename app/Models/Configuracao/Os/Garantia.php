<?php

namespace App\Models\Configuracao\Os;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garantia extends Model
{
    use HasFactory;




    /**
     * Retorna o nome do usuário
     *
     * @var array
     */
    public function user() {
        return $this->hasMany(User::class);
    }
}
