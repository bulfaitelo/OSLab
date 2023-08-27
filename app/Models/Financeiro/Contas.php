<?php

namespace App\Models\Financeiro;

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Financeiro\CentroCusto;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contas extends Model
{
    use HasFactory;


    protected $casts = [
        'data_quitacao' => 'date',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y');
    }

    /**
     * Relacionamento com os Pagamentos
     */
    public function pagamentos () {
        return $this->hasMany(Pagamentos::class, 'conta_id');
    }

    /**
     * Relacionamento com o Cliente
     */
    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relacionamento com o Centro de Custo
     */
    public function centroCusto() {
        return $this->belongsTo(CentroCusto::class);
    }

    public function getVencimentoDate() {

        if ($this->pagamentos->count() > 0) {
            $data = new Carbon($this->pagamentos()->select('vencimento')->first()->vencimento);
            return $data->format('d');
        } else {

        }

    }


}
