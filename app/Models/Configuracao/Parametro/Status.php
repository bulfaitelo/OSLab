<?php

namespace App\Models\Configuracao\Parametro;

use App\Models\Os\Os;
use App\Models\Os\OsStatusLog;
use App\Models\Venda\Venda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    /**
     * Relacionamento com OS.
     *
     * @return HasMany
     **/
    public function os(): HasMany
    {
        return $this->hasMany(Os::class);
    }

    /**
     * Relacionamento com Vendas.
     *
     * @return HasMany
     **/
    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }

    /**
     * Relacionamento com Status Log de OS.
     *
     * @return HasMany
     **/
    public function osStatusLogs(): HasMany
    {
        return $this->hasMany(OsStatusLog::class);
    }
}
