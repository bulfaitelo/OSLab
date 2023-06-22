<?php

namespace App\Models\Configuracao\Os;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaOs extends Model
{
    use HasFactory;




    /**
     * Retorna o nome do usuário
     *
     * @var array
     */
    public function garantia() {
        return $this->belongsTo(Garantia::class);
    }
}
