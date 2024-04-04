<?php

namespace App\Models\Cliente;

use App\Models\Os\Os;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

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
     * Retorna o objeto pra modelagem da tabela de Clientes
     *
     * @param Request $request
     * @param int $itensPorPagina default 100
     */
    static public function getDataTable(Request $request, int $itensPorPagina = 100) : object {
        $queryCliente = self::query();
        $queryCliente->with('os');

        if ($request->busca) {
            $queryCliente->where(function ($query) use ($request){

                $query->orWhere('name', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('email', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('celular', 'LIKE', '%' . $request->busca . '%');
                $query->orWhere('telefone', 'LIKE', '%' . $request->busca . '%');

            });
        }

        if(isset($request->tipo)){
            $queryCliente->where('pessoa_juridica', '=', $request->tipo );
        }
        $queryCliente->orderBy('name');
        return $queryCliente->paginate($itensPorPagina);
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
