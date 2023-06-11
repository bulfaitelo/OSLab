<?php

namespace App\Models\Configuracao\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;




class Setor extends Model
{
    use HasFactory;

    protected $table = 'setor';




    /**
     * Retorna o Setor atribuído pra o funcionário
     *
     * @var array
     */
    public function users() {
        return $this->hasMany(User::class);
    }



}
