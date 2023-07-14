<?php

namespace App\Models\Checklist;

use App\Models\Configuracao\Os\CategoriaOs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checklist extends Model
{
    use HasFactory;


    public function categoria() : BelongsTo
    {
        return $this->belongsTo(CategoriaOs::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
