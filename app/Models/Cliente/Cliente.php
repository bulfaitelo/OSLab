<?php

namespace App\Models\Cliente;

use App\Models\Financeiro\Contas;
use App\Models\Os\Os;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Relacionamento com OS.
     */
    public function os(): HasMany
    {
        return $this->hasMany(related: Os::class)
            ->with([
                'categoria',
                'status',
                'cliente',
                'tecnico',
            ]);
    }

    /**
     * Retorna o objeto pra modelagem da tabela de Clientes.
     *
     * @param  int  $itensPorPagina  default 100
     */
    public static function getDataTable(Request $request, int $itensPorPagina = 100): object
    {
        $queryCliente = self::query();
        $queryCliente->with('os');

        if ($request->busca) {
            $queryCliente->where(function ($query) use ($request) {
                $query->orWhere('name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('email', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('celular', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('telefone', 'LIKE', '%'.$request->busca.'%');
            });
        }

        if (isset($request->tipo)) {
            $queryCliente->where('pessoa_juridica', '=', $request->tipo);
        }
        $queryCliente->orderBy('name');

        return $queryCliente->paginate($itensPorPagina);
    }

    /**
     * Retornar o tipo de cliente.
     *
     **/
    public function getTipoCliente(): string
    {
        if ($this->pessoa_juridica == 1) {
            return 'Pessoa Jurídica';
        }

        return $tipo = 'Pessoa Física';
    }

    /**
     * Retorna o nome do Cliente separados por underline e sem acentuação.
     *
     **/
    public function titleName(): string
    {
        $return = str_replace(' ', '_', preg_replace('/&([a-z])[a-z]+;/i', '$1', htmlentities(trim($this->name))));

        return $return;
    }

    /**
     * Verifica se o Cliente tem débitos em aberto e, caso sim, retorna quais em texto.
     *
     * Os dados podem ser tanto de Ordem de Serviço quanto de Vendas.
     *
     **/
    public function hasPendingDebits(): ?string
    {
        $results = $this->getPendingDebits();

        if ($results->isEmpty()) {
            return null;
        }

        $userCanOsShow = Auth::user()->can('os_show');
        $userCanVendaShow = Auth::user()->can('venda_show');

        $osString = $this->formatPendingItems(
            $results->pluck('os_id')->filter(),
            $userCanOsShow,
            'os.show',
            'OS'
        );

        $vendaString = $this->formatPendingItems(
            $results->pluck('venda_id')->filter(),
            $userCanVendaShow,
            'venda.show',
            'Vendas'
        );

        return 'Este usuário está com pendências financeiras: '
            .collect([$osString, $vendaString])->filter()->implode(' - ').'.';
    }

    /**
     * Consulta as pendências financeiras do usuário.
     */
    private function getPendingDebits()
    {
        return Contas::query()
            ->selectRaw('
                contas.os_id,
                contas.venda_id,
                contas.valor as valor,
                SUM(contas_pagamentos.valor) as valor_pago
            ')
            ->leftJoin('contas_pagamentos', 'contas.id', '=', 'contas_pagamentos.conta_id')
            ->where('cliente_id', $this->id)
            ->where('tipo', 'R')
            ->groupBy('contas.id', 'contas.valor')
            ->havingRaw('valor > valor_pago OR valor_pago is null')
            ->get();
    }

    /**
     * Formata os itens pendentes como links ou texto simples.
     */
    private function formatPendingItems($items, bool $canShow, string $routeName, string $label): ?string
    {
        if ($items->isEmpty()) {
            return null;
        }

        $formattedItems = $items->map(fn ($id) => $canShow
            ? '<a href="'.route($routeName, $id).'" target="_blank"><b>#'.$id.'</b></a>'
            : '<b>#'.$id.'</b>'
        )->implode(', ');

        return "{$label}: {$formattedItems}";
    }
}
