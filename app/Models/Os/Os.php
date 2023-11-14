<?php

namespace App\Models\Os;

use App\Http\OsLabClass\Checklist\CreateHtmlChecklist;
use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Os\OsCategoria;
use App\Models\Configuracao\Os\OsStatus;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Financeiro\Contas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Os extends Model
{
    use HasFactory;

    protected $casts = [
        'data_entrada' => 'date',
        'data_saida' => 'date',
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
    public function logs() : HasMany
    {
        return $this->hasMany(OsLog::class);
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

}
