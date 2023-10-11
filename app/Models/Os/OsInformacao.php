<?php

namespace App\Models\Os;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnSelf;

class OsInformacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo',
        'descricao',
        'tipo_informacao',
        'informacao',

    ];

    protected $casts = [
        'validade_link' => 'datetime'
    ];

    /**
     * Retorna o tipo com base no id
     *
     * @return string Tipo
     */
    function getTipo() : string {
        $tipo = [
            1 => 'Anotação',
            2=> 'Senha',
            3=> 'Arquivo',
        ];
        return $tipo[$this->tipo];
    }

    /**
     * trata o retorno da descrição
     *
     * @return string Descrição
     */
    function getDescricao()  {
        if ($this->tipo == 1) {
            return $this->informacao;
        }
        if (($this->tipo == 3) && (!$this->descricao) ) {
            return explode('/',$this->informacao)[2];
        }
        return $this->descricao;
    }

    public function url()
    {
        return asset('storage/'.$this->informacao);
    }

    public function urlShare() : string {
        return route('os.public.edit', $this->uuid);
    }
}
