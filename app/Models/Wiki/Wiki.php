<?php

namespace App\Models\Wiki;

use App\Models\Configuracao\Os\OsCategoria;
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
        return $this->belongsTo(OsCategoria::class);
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
     * @param  Request  $request
     * @param  int  $itensPorPagina  default 100
     */
    public static function getDataTable(Request $request, int $itensPorPagina = 100): object
    {
        $queryWiki = self::query();
        $queryWiki->with('modelos');
        $queryWiki->with('user');
        $queryWiki->with('categoria');
        $queryWiki->with('fabricante');
        if (isset($request->busca)) {
            $queryWiki->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->busca.'%');
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

        return $queryWiki->paginate($itensPorPagina);
    }

    public function modelosTitle()
    {
        $return = '';
        foreach ($this->modelos as $value) {
            $return .= $value->name.', ';
        }

        return rtrim($return, ', ');
    }
}
