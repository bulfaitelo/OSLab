<?php

namespace App\Services\Os;

use App\Contracts\Services\Os\OsServiceInterface;
use App\Models\Configuracao\Parametro\Categoria;
use App\Models\Os\Os;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Classe de serviço de OS.
 */
class OsService implements OsServiceInterface
{
    public function __construct(

    ) {
    }

    /**
     * Retorna o objeto pra modelagem da tabela de OS.
     *
     * @param  Request  $request  default null
     * @param  int  $itensPorPagina  default 100
     * @param  string  $colunaOrdenacao  default null
     * @param  string  $ordenacao  default desc
     */
    public static function getDataTable(Request $request, int $itensPorPagina = 100, $colunaOrdenacao = null, $ordenacao = 'desc')
    {
        $dataHoje = Carbon::now()->format('Y-m-d');
        $osListagemPadrao = getConfig('os_listagem_padrao');

        $queryOs = Os::with(['cliente', 'tecnico', 'categoria', 'status']);

        if ($request->busca) {
            $queryOs->where(function ($query) use ($request) {
                $query->whereHas('cliente', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
                $query->orWhere('descricao', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('id', $request->busca);
                $query->orWhere('defeito', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('observacoes', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('laudo', 'LIKE', '%'.$request->busca.'%');
                $query->orWhereHas('modelo', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
            });
        }

        if ($request->categoria_id) {
            $queryOs->where('categoria_id', $request->categoria_id);
        }

        if ($request->data_inicial || $request->data_final) {
            $dataInicial = $request->data_inicial ?: $dataHoje;
            $dataFinal = $request->data_final ?: $dataHoje;

            $queryOs->where(function ($query) use ($dataInicial, $dataFinal) {
                $query->whereBetween('created_at', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_entrada', [$dataInicial, $dataFinal]);
                $query->orWhereBetween('data_saida', [$dataInicial, $dataFinal]);
            });
        }

        if ($request->status_id) {
            $queryOs->where('status_id', $request->status_id);
        }

        if (! $request->input() && $osListagemPadrao) {
            $queryOs->whereIn('status_id', $osListagemPadrao);
        }

        if ($colunaOrdenacao) {
            $queryOs->orderBy($colunaOrdenacao, $ordenacao);
        } else {
            $queryOs->orderBy('id', 'desc');
        }

        // Aqui a paginação é feita e armazenada
        $ordensPaginadas = $queryOs->paginate($itensPorPagina);

        // Modifica apenas os itens da página atual
        $ordensPaginadas->getCollection()->transform(function ($ordem) use ($request) {
            if (! $request->busca) {
                return $ordem;
            }

            foreach (['descricao', 'defeito', 'observacoes', 'laudo'] as $campo) {
                if (! empty($ordem->$campo) && stripos($ordem->$campo, $request->busca) !== false) {
                    $ordem->{'snippet_'.$campo} = self::gerarSnippet($ordem->$campo, $request->busca, 80);
                }
            }

            return $ordem;
        });

        return $ordensPaginadas;
    }

    public function store(Request $request): Os
    {
        DB::beginTransaction();
        try {
            $os = new Os;
            $os->user_id = Auth::id();
            $os->cliente_id = $request->cliente_id;
            $os->tecnico_id = $request->tecnico_id;
            $os->categoria_id = $request->categoria_id;
            $os->modelo_id = $request->modelo_id;
            $os->status_id = $request->status_id;
            $os->data_entrada = $request->data_entrada;
            $os->data_saida = $request->data_saida;
            // $os->prazo_garantia = $this->addDayGarantia($request->data_entrada, $request->categoria_id);
            $os->descricao = $request->descricao;
            $os->defeito = $request->defeito;
            $os->observacoes = $request->observacoes;
            $os->laudo = $request->laudo;
            $os->serial = $request->serial;
            $os->save();
            DB::commit();

            return $os;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function update(Request $request, Os $os): Os
    {
        DB::beginTransaction();
        try {
            $os->user_id = Auth::id();
            $os->cliente_id = $request->cliente_id;
            $os->tecnico_id = $request->tecnico_id;
            $os->categoria_id = $request->categoria_id;
            $os->modelo_id = $request->modelo_id;
            $os->status_id = $request->status_id;
            $os->data_entrada = $request->data_entrada;
            $os->data_saida = $request->data_saida;
            if (isset($request->data_saida)) {
                $os->prazo_garantia = $this->addDayGarantia($request->data_saida, $request->categoria_id);
            } else {
                $os->prazo_garantia = null;
            }
            $os->descricao = $request->descricao;
            $os->defeito = $request->defeito;
            $os->observacoes = $request->observacoes;
            $os->laudo = $request->laudo;
            $os->serial = $request->serial;
            $os->save();
            DB::commit();

            return $os;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(Os $os): bool
    {
        try {
            return $os->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Retorna o dia de vencimento com base na categoria selecionada.
     *
     * @param  string  $data_saida  Data de saida da os
     * @param  int  $categoria_id  id da categoria da os para gera os dias de garantia
     * @return string|null retorna o dia de vendimento ou null caso nao exista
     *
     **/
    private function addDayGarantia($data_saida, $categoria_id): ?string
    {
        $prazoEmDias = Categoria::find($categoria_id)->garantia?->prazo_garantia;
        if ($prazoEmDias) {
            $dataGarantia = Carbon::createFromFormat('Y-m-d', $data_saida);

            return $dataGarantia->addDays($prazoEmDias)->format('Y-m-d');
        }

        return null;
    }

    /**
     * Gerar o Snippet com o texto ja tratado.
     *
     * @param  string  $texto  Texto base para ser buscado
     * @param  string  $busca  Busca a ser realizada
     * @param  int  $contexto  Quantidade de letras antes e depois do retorno
     * @return string retorna o texto pronto para ser exibido
     *
     **/
    protected static function gerarSnippet($texto, $busca, $contexto = 50)
    {
        $textoLimpo = strip_tags($texto);
        $busca = trim($busca);
        $pos = stripos($textoLimpo, $busca);

        if ($pos === false) {
            return null;
        }

        $inicio = max($pos - $contexto, 0);
        $fim = min($pos + strlen($busca) + $contexto, strlen($textoLimpo));

        $prefixo = ($inicio > 0) ? '... ' : '';
        $sufixo = ($fim < strlen($textoLimpo)) ? ' ...' : '';

        $snippet = substr($textoLimpo, $inicio, $fim - $inicio);

        // Destaque do termo buscado
        $pattern = '/'.preg_quote($busca, '/').'/i';
        $snippet = preg_replace($pattern, '<mark>$0</mark>', $snippet);

        return $prefixo.$snippet.$sufixo;
    }
}
