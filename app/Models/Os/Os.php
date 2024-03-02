<?php

namespace App\Models\Os;

use App\Http\OsLabClass\Checklist\CreateHtmlChecklist;
use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Os\OsCategoria;
use App\Models\Configuracao\Os\OsStatus;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Financeiro\Contas;
use App\Models\Financeiro\Pagamentos;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Os extends Model
{
    use HasFactory;

    protected $casts = [
        'data_entrada' => 'date',
        'data_saida' => 'date',
        'prazo_garantia' => 'date',
    ];

    /**
     * Retornar o técnico
     *
     * Retorna o técnico relacionado
     * @return BelongsTo Técnico
     **/
    public function tecnico() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar o usuário
     *
     * Retorna o usuário relacionado
     * @return BelongsTo Técnico
     **/
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retornar o Cliente
     *
     * Retorna o Cliente relacionado
     * @return BelongsTo Cliente
     **/
    public function cliente() : BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Retornar o Status
     *
     * Retorna o Status relacionado
     * @return BelongsTo Status
     **/
    public function status() : BelongsTo
    {
        return $this->belongsTo(OsStatus::class);
    }

    /**
     * Retornar o log de alterações da Os.
     *
     * Retorna o log relacionado
     * @return BelongsTo log
     **/
    public function statusLogs() : HasMany
    {
        return $this->hasMany(OsStatusLog::class);
    }

    /**
     * Retorna as despesas e receitas da Os.
     *
     * Retorna as despesas e receitas da Os.
     *
     * @return BelongsTo conta
     **/
    public function contas() : HasMany
    {
        return $this->hasMany(Contas::class);
    }


    /**
     * Retornar o Status
     *
     * Retorna o Status relacionado
     * @return BelongsTo Status
     **/
    public function modelo() : BelongsTo
    {
        return $this->belongsTo(Modelo::class);
    }

    /**
     * Retornar o Categoria
     *
     * Retorna o Categoria relacionado
     * @return BelongsTo Categoria
     **/
    public function categoria() : BelongsTo
    {
        return $this->belongsTo(OsCategoria::class);
    }

    /**
     * Retornar os Produtos da OS
     *
     * Retorna os produtos relacionado a os
     * @return hasMany Produtos
     **/
    public function produtos() : HasMany
    {
        return $this->hasMany(OsProduto::class)
                    ->with('produto');
    }

    /**
     * Retornar os Serviços da OS
     *
     * Retorna os serviços relacionado a os
     * @return hasMany Serviços
     **/
    public function servicos() : HasMany
    {
        return $this->hasMany(OsServico::class)
                    ->with('servico');
    }


    /**
     * Retornar as opções respondidas no checklist da OS
     *
     * Retorna retornar caso exista o as opções respondidas no checklist
     * @return hasMany Checklist
     **/
    public function checklist() : HasMany
    {
        return $this->hasMany(OsChecklist::class);
    }

    /**
     * Retornar as informações da OS
     *
     * Retorna retora as informações, Senhas e arquivos relacionado A OS
     * @return hasMany Checklist
     **/
    public function informacoes() : HasMany
    {
        return $this->hasMany(OsInformacao::class);
    }


    /**
     * Retorna o HTML referente ao Checklist da OS
     *
     * Retorna o Checklist da OS, montado pronto para ser carregado na blade.
     * @return string html
     **/
    public function getHtmlChecklist() {
        $html = new CreateHtmlChecklist($this->categoria->checklist, $this->checklist);
        return $html->render();
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
     * Retorna id e nome do Técnico.
     *
     * Retorna um vetor com o o id e o técnico para ser usado no Select2
     * @return array Categoria
     **/
    public function getTecnicoForSelect() : array {
        if ($this->tecnico_id) {
            return [
                'id' => $this->tecnico_id,
                'name' => $this->tecnico->name,
                'os_count' => $this->tecnico->os->count(),
            ];
        }
        return [] ;

    }

    /**
     * Retorna id e nome do Modelo.
     *
     * Retorna um vetor com o o id e o Modelo para ser usado no Select2
     * @return array Categoria
     **/
    public function getModeloForSelect() : array {
        if ($this->modelo_id) {
            return [
                'id' => $this->modelo_id,
                'name' => $this->modelo->name,
                'wiki' => $this->modelo->wiki->name,
            ];
        }
        return [] ;

    }

    /**
     * Retorna o valor total da OS
     *
     * @return string Valor total
     */
    function valorTotal() : string {
        return number_format($this->servicos()->sum('valor_servico_total') + $this->produtos()->sum('valor_venda_total'), 2, '.', '');
    }

    /**
     * Retorna o Centro de custo padrão
     *
     * Com base na categoria é retornado o centro de custo padrão da OS
     *
     * @return int|null,
     */
    function centroCustoPadrao() {
        return $this->categoria->centroCusto?->id;
    }


    /**
     * Verifica se a os já foi quitada.
     *
     * @return bool
     **/
    public function osQuitada() : bool {
        $conta = $this->contas()->find($this->fatura_id);
        if($conta){
            $pagamentos = $conta->pagamentos;
            if ($conta->valor <= $pagamentos->sum('valor')) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retorna logs da os
     *
     * Retorna um vetor com os logs da Os, que consiste em alteração de status, alterações nas contas.
     *
     * @return array
     **/
    public function getOsLogs() {
        $log = [];
        $statusLog = $this->statusLogs()->orderByDesc('created_at')->get();
        foreach ($statusLog as $status) {
            // if(($dateTemp == null) && ($dateTemp != $status['created_at']->format('d/m/Y')) ){
            $log[$status['created_at']->format('Y-m-d')][] = [
                'log_type' => 'status',
                'id' => $status->id,
                'observacao' => $status->observacao,
                'created_at' => $status->created_at->format('d/m/Y'),
                'status' => $status->status->name,
                'status_color' => $status->status->color,
            ];
        }
        foreach ($this->contas as $conta) {
            foreach ($conta->pagamentos()->orderByDesc('data_pagamento')->get()  as $pagamento) {
                $log[$pagamento->data_pagamento->format('Y-m-d')][] = [
                    'log_type' => 'conta',
                    'conta_tipo' => $conta->tipo,
                    'name' => ($conta->tipo == 'D') ? $conta->name : null,
                    'id' => $pagamento->id,
                    'conta_id' => $pagamento->conta_id,
                    'data_pagamento' => $pagamento->data_pagamento->format('d/m/Y'),
                    'valor' => number_format($pagamento->valor, 2, ',', '.'),
                ];
            }
        }

        krsort($log);
        return $log;
    }


    /**
     * Retorna um vetor com balancete
     *
     * @return array
     **/
    public function balancete() : array {

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
            if($value->tipo == 'R') {
                $receita_count++;
                $array_balancete['total_credito_previsto']+= $value->previsto;
                $array_balancete['total_credito_executado']+= $value->valor_executado;
            }
            elseif ($value->tipo == 'D') {
                $array_balancete['total_debito_previsto']+= $value->previsto;
                $array_balancete['total_debito_executado']+= $value->valor_executado;
            }
        }
        if ($receita_count <= 0) {
            $array_balancete['total_credito_previsto'] = $this->valor_total;
        }

        $array_balancete['saldo'] = ($array_balancete['total_credito_executado'] - $array_balancete['total_debito_executado']);
        return $array_balancete;
    }


    /**
     * Retorna o relatório de os para balancetes
     * @param string|null $dataInicio Data de inicio da busca
     * @param string|null $dataFim Data de fim da busca
     * @param string|null $ordenacao Ordenação padrão
     */
    public static function RelatorioBalancete($dataInicio = null, $dataFim = null, $ordenacao = null)  {

        $query = Os::query();
        $query->select(DB::raw('
            os.id,
            os.created_at,
            clientes.name as cliente,
            os_status.name as status,
            os.data_entrada,
            valor_total,
            IFNULL(debito, 0) AS debito,
            IFNULL(credito, 0) AS credito,
            (credito - debito) as saldo
        '));
        $query->join('clientes', 'os.cliente_id', '=', 'clientes.id');
        $query->join('os_status', 'os.status_id', '=', 'os_status.id');
        $query->leftJoin(DB::raw("
            (
                SELECT
                    contas.os_id,
                    SUM(pagamentos.valor) AS debito
                FROM
                    contas
                LEFT JOIN contas_pagamentos AS pagamentos ON pagamentos.conta_id = contas.id
                WHERE
                    contas.tipo = 'D'
                GROUP BY
                    contas.os_id
            ) AS debitos
        "), 'debitos.os_id', '=', 'os.id');
        $query->leftJoin(DB::raw("
            (
                SELECT
                    contas.os_id,
                    SUM(pagamentos.valor) AS credito
                FROM
                    contas
                LEFT JOIN contas_pagamentos AS pagamentos ON pagamentos.conta_id = contas.id
                WHERE
                    contas.tipo = 'R'
                GROUP BY
                    contas.os_id
            ) AS creditos
        "), 'creditos.os_id', '=', 'os.id');
        $query->whereBetween('data_entrada', [$dataInicio, $dataFim]);
        if($ordenacao != null){
            $orderArray = [
                'data' => [
                    'colun' => 'data_entrada',
                    'order' => 'asc',
                ],
                'saldo' => [
                    'colun' => 'saldo',
                    'order' => 'desc',
                ],
                'nome' => [
                    'colun' => 'cliente',
                    'order' => 'asc',
                    ]
            ];
            $query->orderBy($orderArray[$ordenacao]['colun'], $orderArray[$ordenacao]['order']);
            $query->orderBy('created_at', 'asc');

        }

        return $query->get();





    // LEFT JOIN (
    //     SELECT
    //         contas.os_id,
    //         SUM(pagamentos.valor) AS credito
    //     FROM
    //         contas
    //     LEFT JOIN contas_pagamentos AS pagamentos ON pagamentos.conta_id = contas.id
    //     WHERE
    //         contas.tipo = 'R'
    //     GROUP BY
    //         contas.os_id
    // ) AS creditos ON creditos.os_id = os.id;";
    }

}
