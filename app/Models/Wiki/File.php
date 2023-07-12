<?php

namespace App\Models\Wiki;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function url()
    {
        return asset('storage/'.$this->file);
    }
}
