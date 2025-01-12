<?php

namespace App\Models\Configuracao\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

/**
 * Estendendo a classe permissions, para adicionar novas funções.
 */
class ExtendedPermission extends Permission
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(PermissionsGroup::class);
    }

    /**
     * Retorna os dados da tabela de Permissions.
     *
     * @param  Request  $request
     * @param  int  $itensPorPagina  Define a quantidade de itens por pagina, valor padrão 100
     **/
    public static function getDataTable(Request $request, $itensPorPagina = 100)
    {

        $query = self::with('group');
        if ($request->busca) {
            $query->where('name', 'LIKE', '%'.$request->busca.'%');
            $query->orWhere('description', 'LIKE', '%'.$request->busca.'%');
        }
        if ($request->group_id) {
            $query->where('group_id', $request->group_id);
        }
        $query->orderBy('name', 'ASC');

        return $query->paginate($itensPorPagina);
    }
}
