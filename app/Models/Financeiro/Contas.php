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

    protected $fillable = [
        'tipo',
        'name',
        'os_id',
        'user_id',
        'centro_custo_id',
        'cliente_id',
        'valor',
        'data_quitacao',
        'parcelas',
    ];


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

    /**
     * Retorna id e nome do Cliente.
     *
     * Retorna um vetor com o o id e o Cliente para ser usado no Select2
     * @return array Categoria
     **/
    public function getClienteForSelect() : array {
        if ($this->cliente_id) {
            return [
                'id' => $this->cliente_id,
                'name' => $this->cliente->name,
                'tipo' => $this->cliente->getTipoCliente(),
                'os_count' => $this->cliente->os->count(),
            ];
        }
        return [] ;
    }

    /**
     * Retorna o relatório de contas agrupados por mes  para balancetes
     * @param string|null $dataInicio Data de inicio da busca
     * @param string|null $dataFim Data de fim da busca
     * @param string|null $ordenacao Ordenação padrão
     */
    public static function RelatorioBalancete($dataInicio = null, $dataFim = null, $ordenacao = null)  {


        $query = Pagamentos::query();
        $query->selectRaw('YEAR(vencimento) AS ano,
                     MONTH(vencimento) AS mes,
                     IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) AS receita,
                     IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0) AS despesa,
                     (IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) -
                      IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0)) AS saldo');
        $query->leftJoin('contas', 'contas_pagamentos.conta_id', '=', 'contas.id');
        $query->groupByRaw('YEAR(vencimento), MONTH(vencimento)');
        $query->whereBetween('vencimento', [$dataInicio, $dataFim]);
        return $query->get();




        // $query->selectRaw("
        //             YEAR(contas_pagamentos.vencimento) AS ano_vencimento,
        //             MONTH(contas_pagamentos.vencimento) AS mes_vencimento,
        //             SUM(
        //                 CASE WHEN contas.tipo = 'R' THEN contas_pagamentos.valor ELSE 0
        //             END
        //         ) AS receita,
        //         SUM(
        //             CASE WHEN contas.tipo = 'D' THEN contas_pagamentos.valor ELSE 0
        //         END
        //         ) AS despesa,
        //         (receita - despesa) as saldo
        //     ");
        // $query->leftJoin('contas', 'contas_pagamentos.conta_id', '=', 'contas.id');
        // $query->groupByRaw("YEAR(contas_pagamentos.vencimento), MONTH(contas_pagamentos.vencimento)");
        // return $query->get();


    //     SELECT
    //     ano_vencimento,
    //     mes_vencimento,
    //     IFNULL(receita, 0) AS receita,
    //     IFNULL(despesa, 0) AS despesa,
    //     IFNULL(receita, 0) - IFNULL(despesa, 0) AS saldo
    // FROM
    //     (
    //         SELECT
    //             YEAR(cp.vencimento) AS ano_vencimento,
    //             MONTH(cp.vencimento) AS mes_vencimento,
    //             SUM(CASE WHEN c.tipo = 'R' THEN cp.valor ELSE 0 END) AS receita,
    //             SUM(CASE WHEN c.tipo = 'D' THEN cp.valor ELSE 0 END) AS despesa
    //         FROM
    //             contas_pagamentos cp
    //         LEFT JOIN contas c ON cp.conta_id = c.id
    //         GROUP BY
    //         YEAR(cp.vencimento),
    //             MONTH(cp.vencimento)
    //     ) AS pagamentos_por_mes;


    }



}
