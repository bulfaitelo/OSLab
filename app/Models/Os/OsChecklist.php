<?php

namespace App\Models\Os;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OsChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'user_id',
        'checklist_id',
    ];


}
