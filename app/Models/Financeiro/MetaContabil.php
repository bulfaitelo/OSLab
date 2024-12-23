<?php

namespace App\Models\Financeiro;

use App\Models\Configuracao\Financeiro\CentroCusto;
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
     * Retorna a meta estipulada e executada para a meta selecionada para o mes e ano corrente.
     *
     * @return
     */
    public function getMetaExecutadaData()
    {
        $ano = now()->format('Y');
        $mes = now()->format('m');
        $query = Pagamentos::query();      
        
        if ($this->intervalo == 'Anual') {
            $query->selectRaw('
                YEAR(vencimento) AS ano
            ');
            $query->groupByRaw('YEAR(vencimento)');
            $query->orderByDesc('ano');
            $query->whereRaw("YEAR(vencimento) = {$ano}");
        } else {
            $query->selectRaw('
                YEAR(vencimento) AS ano,
                MONTH(vencimento) AS mes
            ');
            $query->groupByRaw('YEAR(vencimento), MONTH(vencimento)');
            $query->orderByDesc('mes');
            $query->whereRaw("MONTH(vencimento) = {$mes} and YEAR(vencimento) = {$ano}");
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

        $metaQuery = $query->first();

        // dd($metaQuery);
        if ($metaQuery) {
            $metaReturn['ano'] = $metaQuery->ano;
            $metaReturn['mes'] = $metaQuery->mes;
            $metaReturn['receita'] = $metaQuery->receita;
            $metaReturn['despesa'] = $metaQuery->despesa;
            $metaReturn['saldo'] = $metaQuery->saldo;
            $metaReturn['valor_meta'] = $this->getRawOriginal('valor_meta');
            if ($this->meta_liquida) {
                if ($this->tipo_meta == 'R') {
                    $metaReturn['executado'] = $metaQuery->saldo;
                    $metaReturn['porcentagem_executada'] = (int) max(round(($metaQuery->saldo / $this->getRawOriginal('valor_meta')) * 100), 0);
                } else {
                    $metaReturn['executado'] = ($metaQuery->despesa - $metaQuery->receita);
                    $metaReturn['porcentagem_executada'] = (int) max(round((($metaQuery->despesa - $metaQuery->receita) / $this->getRawOriginal('valor_meta')) * 100), 0);
                }
            } else {
                if ($this->tipo_meta == 'R') {
                    $metaReturn['executado'] = $metaQuery->receita;
                    $metaReturn['porcentagem_executada'] = (int) max(round(($metaQuery->receita / $this->getRawOriginal('valor_meta')) * 100), 0);
                } else {
                    $metaReturn['executado'] = $metaQuery->despesa;
                    $metaReturn['porcentagem_executada'] = (int) max(round(($metaQuery->despesa / $this->getRawOriginal('valor_meta')) * 100), 0);
                }
            }
        } else {
            $metaReturn['executado'] = 0.00;
            $metaReturn['porcentagem_executada'] = 0;
        }

        return json_decode(json_encode($metaReturn), false);
    }

    /**
     * Retorna o objeto pra modelagem da tabela de Metas Contábeis.
     *
     * @param  Request  $request  default null
     * @param  bool  $dashboard  default false
     * @param  int  $itensPorPagina  default 100
     */
    public static function getDataTable(Request $request = null, bool $dashboard = false, int $itensPorPagina = 100): object
    {        
        $metaContabil = self::query();
        if ($dashboard) {
            $metaContabil->where('exibir_dashboard', '=', 1);            
        }

        return $metaContabil->paginate($itensPorPagina);        
    }
}
