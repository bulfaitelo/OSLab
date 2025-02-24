<?php

namespace App\Models\Financeiro;

use App\Models\Configuracao\Financeiro\FormaPagamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Pagamentos extends Model
{
    use HasFactory;

    protected $table = 'contas_pagamentos';

    protected $casts = [
        'vencimento' => 'date',
        'data_pagamento' => 'date',
        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'forma_pagamento_id',
        'user_id',
        'valor',
        'vencimento',
        'data_pagamento',
        'parcela',
    ];

    /**
     * Retornar a Conta.
     *
     * Retorna a Conta relacionada
     *
     * @return BelongsTo Conta
     **/
    public function conta(): BelongsTo
    {
        return $this->belongsTo(Contas::class);
    }

    /**
     * Retornar o Usuário.
     *
     * Retorna o Usuário relacionado
     *
     * @return BelongsTo User
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar a forma de pagamento.
     *
     * Retorna a forma de pagamento relacionado
     *
     * @return BelongsTo FormaPagamento
     **/
    public function formaPagamento(): BelongsTo
    {
        return $this->belongsTo(FormaPagamento::class);
    }

    /**
     * Retorna um json para exibição do modal.
     *
     * @return string Dados do modal
     */
    public function dataModal(): string
    {
        return json_encode([
            'id' => $this->id,
            'parcela' => $this->parcela,
            'vencimento' => $this->vencimento?->format('Y-m-d'),
            'data_pagamento' => $this->data_pagamento?->format('Y-m-d'),
            'forma_pagamento_id' => $this->forma_pagamento_id,
            'valor' => number_format($this->valor, 2, ',', '.'),
        ]);
    }

    /**
     * Retorna os dados para o relatório de Despesas.
     *
     * @param  Request  $request  request
     * @return array|null
     **/
    public static function RelatorioDespesasReceita(Request $request): array|null
    {
        $query = self::query();
        $query->selectRaw('
            contas.id as id,
            contas.tipo as tipo,
            contas.name as descricao,
            clientes.name as cliente,
            centro_custos.name as centro_custo,
            contas_pagamentos.parcela as parcela,
            contas.parcelas as total_parcela,
            contas_pagamentos.valor as valor,
            forma_pagamentos.name as forma_pagamento,
            contas_pagamentos.vencimento as vencimento,
            contas_pagamentos.data_pagamento as data_pagamento,
            users.name as usuario
        ');
        $query->Join('contas', 'contas_pagamentos.conta_id', '=', 'contas.id');
        $query->Join('forma_pagamentos', 'contas_pagamentos.forma_pagamento_id', '=', 'forma_pagamentos.id');
        $query->Join('centro_custos', 'contas.centro_custo_id', '=', 'centro_custos.id');
        $query->Join('users', 'contas_pagamentos.user_id', '=', 'users.id');
        $query->Join('clientes', 'contas.cliente_id', '=', 'clientes.id');

        if ($request->busca) {
            $query->where(function ($query) use ($request) {
                $query->where('clientes.name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('contas.name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('contas.observacoes', 'LIKE', '%'.$request->busca.'%');
            });
        }

        if ($request->data_inicio and $request->data_fim) {
            $column = ($request->tipo_data == 'pagamento') ? 'data_pagamento' : 'vencimento';
            $query->whereBetween($column, [$request->data_inicio, $request->data_fim]);
        }
        if ($request->centro_custo) {
            $query->where('contas.centro_custo_id', $request->centro_custo);
        }
        if ($request->forma_pagamento_id) {
            $query->where('contas.centro_custo_id', $request->forma_pagamento_id);
        }
        $query->orderByDesc('tipo');

        if ($request->financeiro) {
            $tipo = ($request->financeiro == 'receita') ? 'R' : 'D';
            $query->where('contas.tipo', $tipo);
        }

        $temp = $query->get();

        if ($temp->count() > 0) {
            foreach ($temp as $key => $value) {
                $return[$value->tipo][] = $value;
            }

            return $return;
        }

       return null;
    }
}
