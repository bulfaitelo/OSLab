<?php

namespace App\Models\Venda;

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Parametro\Status;
use App\Models\Financeiro\Contas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Venda extends Model
{
    use HasFactory;

    protected $casts = [
        'data_saida' => 'date',
        'prazo_garantia' => 'date',
    ];

    /**
     * Retornar o técnico.
     *
     * Retorna o técnico relacionado
     *
     * @return BelongsTo Vendedor
     **/
    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar o usuário.
     *
     * Retorna o usuário relacionado
     *
     * @return BelongsTo User
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar o Cliente.
     *
     * Retorna o Cliente relacionado
     *
     * @return BelongsTo Cliente
     **/
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Retorna as despesas e receitas da Vendas.
     *
     * Retorna as despesas e receitas da Vendas.
     *
     * @return BelongsTo conta
     **/
    public function contas(): HasMany
    {
        return $this->hasMany(Contas::class);
    }

    /**
     * Retornar os Produtos da Venda.
     *
     * Retorna os produtos relacionado a venda
     *
     * @return hasMany Produtos
     **/
    public function produtos(): HasMany
    {
        return $this->hasMany(VendaProduto::class)
                    ->with('produto');
    }

    /**
     * Retornar o Status.
     *
     * Retorna o Status relacionado
     *
     * @return BelongsTo Status
     **/
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
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
     * Retorna id e nome do vendedor.
     *
     * Retorna um vetor com o o id e o vendedor para ser usado no Select2
     *
     * @return array Categoria
     **/
    public function getVendedorForSelect(): array
    {
        if ($this->tecnico_id) {
            return [
                'id' => $this->vendedor_id,
                'name' => $this->vendedor->name,
                'os_count' => $this->tecnico->os->count(),
            ];
        }

        return [];
    }

    /**
     * Retorna o valor total da Venda.
     *
     * @return string Valor total
     */
    public function valorTotal(): string
    {
        return number_format($this->produtos()->sum('valor_venda_total'), 2, '.', '');
    }

    /**
     * Retorna o Centro de custo padrão.
     *
     * Com base na categoria é retornado o centro de custo padrão da Venda
     *
     * @return int|null,
     */
    public function getCentroCustoPadrao()
    {
        return getConfig('default_venda_faturar_centro_custo');
    }

    /**
     * Verifica se a os já foi quitada.
     *
     * @return bool
     **/
    public function quitada(): bool
    {
        $conta = $this->contas()->find($this->conta_id);
        if ($conta) {
            $pagamentos = $conta->pagamentos;
            if ($conta->valor <= $pagamentos->sum('valor')) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retorna um vetor com balancete.
     *
     * @return array
     **/
    public function balancete(): array
    {
        $array_balancete['total_credito_previsto'] = 0;
        $array_balancete['total_debito_previsto'] = 0;
        $array_balancete['total_credito_executado'] = 0;
        $array_balancete['total_debito_executado'] = 0;
        $receita_count = 0;

        $balancete = $this->contas()
                ->select(DB::raw('tipo, centro_custos.name as centro_custo, sum(DISTINCT contas.valor) as previsto, sum(contas_pagamentos.valor) as valor_executado'))
                ->join('contas_pagamentos', 'contas_pagamentos.conta_id', 'contas.id')
                ->join('centro_custos', 'contas.centro_custo_id', 'centro_custos.id')
                ->groupBy(['centro_custos.name', 'tipo'])
                ->orderBy('tipo', 'desc')
                ->get();
        foreach ($balancete as $key => $value) {
            $array_balancete['detalhes'][] = [
                'tipo' => $value->tipo,
                'centro_custo' => $value->centro_custo,
                'valor_previsto' => $value->previsto,
                'valor_executado' => $value->valor_executado,

            ];
            if ($value->tipo == 'R') {
                $receita_count++;
                $array_balancete['total_credito_previsto'] += $value->previsto;
                $array_balancete['total_credito_executado'] += $value->valor_executado;
            } elseif ($value->tipo == 'D') {
                $array_balancete['total_debito_previsto'] += $value->previsto;
                $array_balancete['total_debito_executado'] += $value->valor_executado;
            }
        }
        if ($receita_count <= 0) {
            $array_balancete['total_credito_previsto'] = $this->valor_total;
        }

        $array_balancete['saldo'] = ($array_balancete['total_credito_executado'] - $array_balancete['total_debito_executado']);

        return $array_balancete;
    }
}
