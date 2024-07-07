<?php

namespace App\Models\Configuracao\Wiki;

use App\Models\Os\Os;
use App\Models\Wiki\Wiki;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'wiki_models';

    public function wiki()
    {
        return $this->belongsTo(Wiki::class);
    }

    public function os()
    {
        return $this->hasMany(Os::class);
    }
}
