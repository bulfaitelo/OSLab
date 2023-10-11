<?php

namespace App\Models\Configuracao\Sistema;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemaConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];
}
