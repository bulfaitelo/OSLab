<?php

namespace App\Models\Wiki;

use App\Models\Configuracao\Parametro\Categoria;
use App\Models\Configuracao\Wiki\Fabricante;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Os\Os;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Wiki extends Model
{
    use HasFactory;

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function os()
    {
        return $this->hasManyThrough(
            Os::class,
            Modelo::class,
            'wiki_id', // Chave da Wiki
            'modelo_id', // Chave_modelo
            'id', // Chave local de Modelos
            'id' // Chave Local de Os
        )
            ->with('cliente')
            ->with('tecnico')
            ->with('categoria')
            ->with('status');
    }

    /**
     * Retorna o objeto pra modelagem da tabela de Produtos.
     *
     * @param  int  $itensPorPagina  default 100
     */
    public static function getDataTable(Request $request, int $itensPorPagina = 100): object
    {
        $queryWiki = self::query();

        $queryWiki->leftJoin('fabricantes', 'wikis.fabricante_id', '=', 'fabricantes.id')
            ->select('wikis.*')
            ->with(['modelos', 'user', 'categoria', 'fabricante', 'os']);

        if (isset($request->busca)) {
            $queryWiki->where(function ($query) use ($request) {
                $query->where('wikis.name', 'LIKE', '%'.$request->busca.'%');
                $query->orWhere('wikis.texto', 'LIKE', '%'.$request->busca.'%');
                $query->orWhereHas('modelos', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
                $query->orWhereHas('fabricante', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%'.$request->busca.'%');
                });
            });
        }
        if ($request->categoria_id) {
            $queryWiki->where('categoria_id', $request->categoria_id);
        }
        $queryWiki->orderBy('fabricantes.name')->orderBy('wikis.name');

        // Aqui a paginação é feita e armazenada
        $wikiPaginada = $queryWiki->paginate($itensPorPagina);

        // Modifica apenas os itens da página atual
        $wikiPaginada->getCollection()->transform(function ($ordem) use ($request) {
            if (! $request->busca) {
                return $ordem;
            }

            foreach (['texto'] as $campo) {
                if (! empty($ordem->$campo) && stripos($ordem->$campo, $request->busca) !== false) {
                    $ordem->{'snippet_'.$campo} = self::gerarSnippet($ordem->$campo, $request->busca, 200);
                }
            }

            return $ordem;
        });

        return $wikiPaginada;
    }

    public function modelosTitle()
    {
        $return = '';
        foreach ($this->modelos as $value) {
            $return .= $value->name.', ';
        }

        return rtrim($return, ', ');
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
