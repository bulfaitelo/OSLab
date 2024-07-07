<?php

namespace App\Models\Configuracao\User;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
}
