<?php

namespace App\Models\Configuracao\Os;

use App\Models\Checklist\Checklist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaOs extends Model
{
    use HasFactory;


    /**
     * Retorna a garantia
     *
     * @var array
     */
    public function garantia() {
        return $this->belongsTo(Garantia::class);
    }

    /**
     * Retorna a o checklist
     *
     * @var array
     */
    public function checklist() {
        return $this->belongsTo(Checklist::class);
    }
}
