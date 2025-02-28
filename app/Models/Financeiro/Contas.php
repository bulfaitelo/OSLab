<?php

namespace App\Models\Financeiro;

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Financeiro\CentroCusto;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
     * Relacionamento com os Pagamentos.
     */
    public function pagamentos()
    {
        return $this->hasMany(Pagamentos::class, 'conta_id');
    }

    /**
     * Relacionamento com o Cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relacionamento com o Centro de Custo.
     */
    public function centroCusto()
    {
        return $this->belongsTo(CentroCusto::class);
    }

    public function getVencimentoDate()
    {
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
     *
     * @return array Categoria
     **/
    public function getClienteForSelect(): array
    {
        if ($this->cliente_id) {
            return [
                'id' => $this->cliente_id,
                'name' => $this->cliente->name,
                'tipo' => $this->cliente->getTipoCliente(),
                'os_count' => $this->cliente->os->count(),
            ];
        }

        return [];
    }

    /**
     * Retorna o relatório de contas agrupados por mes  para balancetes.
     *
     * @param  string|null  $dataInicio  Data de inicio da busca
     * @param  string|null  $dataFim  Data de fim da busca
     * @param  string|null  $ordenacao  Ordenação padrão
     * @return object|null
     */
    public static function RelatorioBalanceteMes($dataInicio = null, $dataFim = null, $ordenacao = null): object|null
    {
        $query = Pagamentos::query();
        $query->selectRaw('
            YEAR(vencimento) AS ano,
            MONTH(vencimento) AS mes,
            IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) AS receita,
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0) AS despesa,
            (IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) -
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0)) AS saldo
        ');
        $query->leftJoin('contas', 'contas_pagamentos.conta_id', '=', 'contas.id');
        $query->groupByRaw('YEAR(vencimento), MONTH(vencimento)');
        if ($dataInicio and $dataFim) {
            $query->whereBetween('vencimento', [$dataInicio, $dataFim]);
        }

        return $query->get();
    }

    /**
     * Retorna o relatório de contas agrupados por centro de custo para balancetes.
     *
     * @param  string|null  $dataInicio  Data de inicio da busca
     * @param  string|null  $dataFim  Data de fim da busca
     * @param  string|null  $ordenacao  Ordenação padrão
     * @return object|null
     */
    public static function RelatorioBalanceteCentroCusto($dataInicio = null, $dataFim = null, $ordenacao = null): object|null
    {
        $query = Pagamentos::query();
        $query->selectRaw('
            centro_custos.name as centro_custo,
            IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) AS receita,
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0) AS despesa,
            (IFNULL(SUM(CASE WHEN contas.tipo = "R" THEN contas_pagamentos.valor ELSE 0 END), 0) -
            IFNULL(SUM(CASE WHEN contas.tipo = "D" THEN contas_pagamentos.valor ELSE 0 END), 0)) AS saldo
        ');
        $query->leftJoin('contas', 'contas_pagamentos.conta_id', '=', 'contas.id');
        $query->join('centro_custos', 'contas.centro_custo_id', '=', 'centro_custos.id');
        $query->groupByRaw('contas.centro_custo_id');
        if ($dataInicio and $dataFim) {
            $query->whereBetween('vencimento', [$dataInicio, $dataFim]);
        }
        if ($ordenacao != null) {
            $orderArray = [
                'saldo' => [
                    'colun' => 'saldo',
                    'order' => 'desc',
                ],
                'nome' => [
                    'colun' => 'centro_custo',
                    'order' => 'asc',
                ],
                'data' => [
                    'colun' => 'centro_custo',
                    'order' => 'asc',
                ],
            ];
            $query->orderBy($orderArray[$ordenacao]['colun'], $orderArray[$ordenacao]['order']);
        }

        return $query->get();
    }

    /**
     * Retorna o relatório de contas em Aberto.
     *
     * @param  Request  $request  request
     * @return object|null
     */
    public static function RelatorioContasAbertas(Request $request): object|null
    {
        $query = self::query();
        $query->selectRaw('
            contas.id,
            contas.tipo,
            contas.name, 
            contas.os_id,
            contas.venda_id,
            clientes.name as cliente,
            contas.valor,
            COALESCE(SUM(contas_pagamentos.valor), 0) AS valor_pago,
            (contas.valor - COALESCE(SUM(contas_pagamentos.valor), 0)) AS debito
        ');
        if ($request->busca) {
            $query->where(function ($query) use ($request) {
                $query->where('clientes.name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('contas.name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('contas.observacoes', 'LIKE', '%'.$request->busca.'%');
            });
        }
        if ($request->financeiro) {
            $tipo = ($request->financeiro == 'receita') ? 'R' : 'D';
            $query->where('contas.tipo', $tipo);
        }
        if ($request->centro_custo) {
            $query->where('contas.centro_custo_id', $request->centro_custo);
        }
        $query->leftJoin('contas_pagamentos', 'contas_pagamentos.conta_id', '=', 'contas.id');
        $query->join('clientes', 'contas.cliente_id', '=', 'clientes.id');
        $query->groupBy('contas.id', 'contas.tipo', 'contas.name', 'contas.os_id', 'contas.venda_id', 'contas.cliente_id', 'contas.valor');
        $query->having('debito', '>', 0);
        if ($request->data_inicio and $request->data_fim) {
            $query->whereBetween('contas.created_at', [$request->data_inicio, $request->data_fim]);
        }        
        return $query->get();
    }
}
