<?php

namespace App\Models\OsLab;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaginaFavorita extends Model
{
    use HasFactory;

    protected $table = 'pagina_favoritas';

    protected $fillable = [
        'user_id',
        'route',
        'text',
        'icon',
        'color',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public const AVAILABLE_COLORS = [
        'btn-primary' => 'Azul (Padrão)',
        'btn-secondary' => 'Cinza',
        'btn-success' => 'Verde',
        'btn-danger' => 'Vermelho',
        'btn-warning' => 'Amarelo',
        'btn-info' => 'Azul Claro',
        'btn-oslab' => 'OSLab',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
