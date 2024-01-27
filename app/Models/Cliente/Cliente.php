<?php

namespace App\Models\Cliente;

use App\Models\Os\Os;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;


        /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Relacionamento com OS
     */
    public function os () : HasMany {
        return $this->hasMany(Os::class);
    }

    /**
     * Retornar o tipo de cliente
     *
     * @return string
     **/
    public function getTipoCliente() : string {
        if ($this->pessoa_juridica == 1) {
           return 'Pessoa Jurídica';
        }
        return $tipo = 'Pessoa Física';
    }


    /**
     * Retorna o nome do Cliente separados por underline e sem acentuação
     *
     * @return string
     **/
    public function titleName() : string {
        $return = str_replace(" ","_",preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($this->name))));
        return $return ;
    }



}
