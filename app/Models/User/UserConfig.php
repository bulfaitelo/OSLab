<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserConfig extends Model
{
    protected $fillable = [
        'key',
        'value',
        'user_id',
    ];
}
