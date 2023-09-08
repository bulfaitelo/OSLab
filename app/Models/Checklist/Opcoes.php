<?php

namespace App\Models\Checklist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcoes extends Model
{
    use HasFactory;

    protected $table = "checklist_opcoes";

    protected $fillable = [
        'user_id',
        'name',
        'opcao',
        'type',
    ];
}
