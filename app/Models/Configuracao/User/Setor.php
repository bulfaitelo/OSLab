<?php

namespace App\Models\Configuracao\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    protected $table = 'setor';

    /**
     * Retorna o nome do usuário.
     *
     * @var array
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
