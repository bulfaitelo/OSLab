<?php

namespace App\Models\Financeiro;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas extends Model
{
    use HasFactory;



    public function pagamentos () {
        return $this->hasMany(Pagamentos::class, 'conta_id');
    }
}
