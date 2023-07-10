<?php

namespace App\Models\Wiki;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Configuracao\Wiki\Fabricante;
use App\Models\User;
use App\Models\Configuracao\Os\CategoriaOs;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wiki extends Model
{
    use HasFactory;


    public function fabricante() {
        return $this->belongsTo(Fabricante::class);
    }

    public function modelos () {
        return $this->hasMany(Modelo::class);
    }

    public function modelosTitle() {
        $return = "";
        foreach ($this->modelos as $value) {
            $return.= $value->name.', ';
        }
        return rtrim($return, ', ');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria() : BelongsTo
    {
        return $this->belongsTo(CategoriaOs::class);
    }

}
