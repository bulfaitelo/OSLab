<?php

namespace App\Models\Configuracao\Parametro;

use App\Models\Os\Os;
use App\Models\Os\OsStatusLog;
use App\Models\Venda\Venda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Status extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'status';

    /**
     * Relacionamento com OS.
     *
     **/
    public function os(): HasMany
    {
        return $this->hasMany(Os::class);
    }

    /**
     * Relacionamento com Vendas.
     *
     **/
    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }

    /**
     * Relacionamento com Status Log de OS.
     *
     **/
    public function osStatusLogs(): HasMany
    {
        return $this->hasMany(OsStatusLog::class);
    }
}
