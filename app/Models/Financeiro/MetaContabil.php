<?php

namespace App\Models\Financeiro;

use App\Models\Configuracao\Financeiro\CentroCusto;
use DB;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MetaContabil extends Model
{
    /**
     * Relacionamento com o Centro de Custo.
     */
    public function centroCusto()
    {
        return $this->belongsTo(CentroCusto::class);
    }

    /**
     * Retornar o valor formatado em BRL.
     *
     * @return Attribute
     **/
    protected function valorMeta(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => number_format($value, 2, ',', '.')
        );
    }

    /**
     * Retorna o intervalo para exibição.
     *
     * @return Attribute
     **/
    protected function intervalo(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if ($value == 'mes') {
                    return 'Mensal';
                } elseif ($value == 'ano') {
                    return 'Anual';
                }
            }
        );
    }

    /**
     * Retorna a meta estipulada e executada para a meta selecionada.
     *
     * @return
     */
    public function getMetaExecutadaTable()
    {
        $query = Pagamentos::query();

        if ($this->intervalo == 'Anual') {
            $query->selectRaw('
                YEAR(vencimento) AS ano
            ');
            $query->groupByRaw('YEAR(vencimento)');
            $query->orderByDesc('ano');
        } else {
            $query->selectRaw('
                YEAR(vencimento) AS ano,
                MONTH(vencimento) AS mes
            ');
            $query->groupByRaw('YEAR(vencimento), MONTH(vencimento)');
            $query->orderByDesc('ano');
            $query->orderByDesc('mes');
        }

        $query->selectRaw('
            IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) AS receita,
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0) AS despesa,
            (IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) -
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0)) AS saldo
        ');

        $query->leftJoin('contas', 'contas_pagamentos.conta_id', '=', 'contas.id');

        if ($this->centro_custo_id) {
            $query->where('centro_custo_id', '=', $this->centro_custo_id);
        }

        $metaQuery = $query->get();

        foreach ($metaQuery  as $key => $value) {
            // dd($metaQuery);
            $metaReturn[$key]['ano'] = $value->ano;
            $metaReturn[$key]['mes'] = $value->mes;
            $metaReturn[$key]['receita'] = $value->receita;
            $metaReturn[$key]['despesa'] = $value->despesa;
            $metaReturn[$key]['saldo'] = $value->saldo;
            $metaReturn[$key]['valor_meta'] = $this->getRawOriginal('valor_meta');
            if ($this->meta_liquida) {
                if ($this->tipo_meta == 'R') {
                    $metaReturn[$key]['executado'] = $value->saldo;
                    $metaReturn[$key]['porcentagem_executada'] = (int) max(round(($value->saldo / $this->getRawOriginal('valor_meta')) * 100), 0);
                } else {
                    $metaReturn[$key]['executado'] = ($value->despesa - $value->receita);
                    $metaReturn[$key]['porcentagem_executada'] = (int) max(round((($value->despesa - $value->receita) / $this->getRawOriginal('valor_meta')) * 100), 0);
                }
            } else {
                if ($this->tipo_meta == 'R') {
                    $metaReturn[$key]['executado'] = $value->receita;
                    $metaReturn[$key]['porcentagem_executada'] = (int) max(round(($value->receita / $this->getRawOriginal('valor_meta')) * 100), 0);
                } else {
                    $metaReturn[$key]['executado'] = $value->despesa;
                    $metaReturn[$key]['porcentagem_executada'] = (int) max(round(($value->despesa / $this->getRawOriginal('valor_meta')) * 100), 0);
                }
            }
        }

        return json_decode(json_encode($metaReturn), false);
    }

    /**
     * Retorna o objeto pra modelagem da tabela de Metas Contábeis.
     *
     * @param  Request  $request  default null
     * @param  bool  $dashboard  default false
     * @param  int  $itensPorPagina  default 100
     * @param  string  $colunaOrdenacao  default null
     * @param  string  $ordenacao  default asc
     */
    public static function getDataTable(Request $request = null, bool $dashboard = false, int $itensPorPagina = 100, $colunaOrdenacao = null, $ordenacao = 'asc'): object
    {
        $calculos = DB::table('meta_contabils as mc')
            ->select(
                'mc.id',
                'mc.name',
                'mc.valor_meta',
                'mc.intervalo',
                'mc.centro_custo_id',
                'mc.tipo_meta',
                'mc.meta_liquida',
                'mc.exibir_dashboard',
                DB::raw("
                    (
                        SELECT
                            CASE
                                WHEN mc.tipo_meta = 'R' THEN (
                                    CASE
                                        WHEN mc.meta_liquida = 1 THEN
                                            (IFNULL(SUM(CASE WHEN contas.tipo = 'R' THEN contas_pagamentos.valor ELSE 0 END), 0) -
                                            IFNULL(SUM(CASE WHEN contas.tipo = 'D' THEN contas_pagamentos.valor ELSE 0 END), 0))
                                        ELSE
                                            IFNULL(SUM(CASE WHEN contas.tipo = 'R' THEN contas_pagamentos.valor ELSE 0 END), 0)
                                    END
                                )
                                WHEN mc.tipo_meta = 'D' THEN (
                                    CASE
                                        WHEN mc.meta_liquida = 1 THEN
                                            (IFNULL(SUM(CASE WHEN contas.tipo = 'D' THEN contas_pagamentos.valor ELSE 0 END), 0) -
                                            IFNULL(SUM(CASE WHEN contas.tipo = 'R' THEN contas_pagamentos.valor ELSE 0 END), 0))
                                        ELSE
                                            IFNULL(SUM(CASE WHEN contas.tipo = 'D' THEN contas_pagamentos.valor ELSE 0 END), 0)
                                    END
                                )
                            END
                        FROM contas_pagamentos
                        LEFT JOIN contas ON contas_pagamentos.conta_id = contas.id
                        WHERE
                            (
                                (mc.intervalo = 'mes' AND YEAR(vencimento) = YEAR(CURRENT_DATE()) AND MONTH(vencimento) = MONTH(CURRENT_DATE())) OR
                                (mc.intervalo = 'ano' AND YEAR(vencimento) = YEAR(CURRENT_DATE()))
                            )
                            AND (mc.centro_custo_id IS NULL OR contas.centro_custo_id = mc.centro_custo_id)
                    ) as executado
                ")
            );

        $query = DB::query()
            ->fromSub($calculos, 'calculos')
            ->select(
                'id',
                'name',
                'executado',
                'valor_meta',
                'tipo_meta',
                'meta_liquida',
                'intervalo',
                'centro_custo_id',
                'exibir_dashboard',
                DB::raw('
                    CASE
                        WHEN (executado / NULLIF(valor_meta, 0)) * 100 < 0 THEN 0
                        ELSE ROUND((executado / NULLIF(valor_meta, 0)) * 100)
                    END AS porcentagem_executada
                ')
            )->where(function ($query) use ($dashboard) {
                if ($dashboard) {
                    $query->where('exibir_dashboard', '=', 1);
                }
            });
        if ($colunaOrdenacao) {
            $query->orderBy($colunaOrdenacao, $ordenacao);
        }
        if ($dashboard) {
            $query->limit($itensPorPagina);
            $result = $query->get();
        } else {
            $result = $query->paginate($itensPorPagina);
        }

        return $result;
    }
}
