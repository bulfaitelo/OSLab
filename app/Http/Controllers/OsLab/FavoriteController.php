<?php

namespace App\Http\Controllers\OsLab;

use App\Http\Controllers\Controller;
use App\Services\OsLab\FavoriteMenuService;

class FavoriteController extends Controller
{
    protected $menuService;

    public function __construct(FavoriteMenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Rota para criação de um favorito.
     *
     * Cria o favorito e retorna para a mesma tela com uma notificação.
     *
     * @param  string  $routeName  Nome da rota
     **/
    public function favoriteToggle($routeName)
    {
        if ($this->menuService->checkRouteIsFavorited($routeName)) {
            $this->menuService->deleteRoute($routeName);

            return redirect()->back()->with('success', 'Pagina removida dos favoritos com sucesso!');
        } else {
            $this->menuService->favoriteRoute($routeName);

            return redirect()->back()->with('success', 'Pagina favoritada com sucesso!');
        }
    }
}
