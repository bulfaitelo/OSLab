<?php

namespace App\Models\Wiki;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Configuracao\Wiki\Fabricante;
use App\Models\User;
use App\Models\Configuracao\Os\CategoriaOs;
use App\Models\Os\Os;
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

    public function links () {
        return $this->hasMany(Link::class);
    }

    public function files () {
        return $this->hasMany(File::class);
    }

    public function os () {
        return $this->hasManyThrough(
            Os::class,
            Modelo::class,
            'wiki_id', // Chave da Wiki
            'modelo_id', // Chave_modelo
            'id', // Chave local de Modelos
            'id' // Chave Local de Os
        )
        ->with('cliente')
        ->with('tecnico')
        ->with('categoria')
        ->with('status');
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
