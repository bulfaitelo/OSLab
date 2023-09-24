<?php

namespace App\Models\Wiki;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'wiki_links';

    protected $fillable = [
        'name',
        'link',
        'user_id',
    ];
}
