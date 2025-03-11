<?php

namespace App\Services\OsLab;

use App\Models\OsLab\PaginaFavorita;
use Illuminate\Support\Facades\Auth;

/**
 * Classe de funções de controle de menu.
 */
final class FavoriteMenuService
{
    private $availableRoutes = [
        'index',
        'create',
    ];

    private $textMenuConcat = [
        'index' => '',
        'create' => 'Criar ',
    ];

    /**
     * Retorna os dados da rota.
     *
     * @param  string  $routeName  Nome da Rota a ser buscada.
     * @return array|null
     **/
    public function getRouteData($routeName)
    {
        $routeNameUpdated = $this->updateRouteName($routeName);
        $menu = config('adminlte.menu');

        return self::findRoute($menu, $routeNameUpdated);
    }

    /**
     * Checa se a rota já está favoritada.
     *
     * @param  string  $routeName  Nome da Rota a ser buscada.
     * @return mixed|null
     **/
    public function checkRouteIsFavorited($routeName)
    {
        $userId = Auth::id();

        return PaginaFavorita::where('user_id', $userId)->where('route', $routeName)->first();
    }

    /**
     * Cria um novo favorito para os parâmetros definidos.
     *
     * @param  string  $routeName  Nome da Rota a ser salva.
     **/
    public function favoriteRoute($routeName)
    {
        $routeData = $this->getRouteData($routeName);
        $text = $this->updateTextName($routeName, $routeData['text']);

        if (isset($routeData['icon'])) {
            $icon = $routeData['icon'];
        }
        $userId = Auth::id();

        $paginaFavorita = new PaginaFavorita;
        $paginaFavorita->user_id = $userId;
        $paginaFavorita->route = $routeName;
        $paginaFavorita->icon = $icon;
        $paginaFavorita->text = $text;
        $paginaFavorita->save();
    }

    /**
     * Apaga uma rota ja favoritada.
     *
     * @param  string  $routeName  Nome da Rota a ser excluida.
     **/
    public function deleteRoute($routeName)
    {
        $userId = Auth::id();

        PaginaFavorita::where('user_id', $userId)->where('route', $routeName)->delete();
    }

    /**
     * Retornar os itens favoritos do Usuário.
     *
     * Retornar um array com os dados
     *
     **/
    public function getUserFavoriteData()
    {
        $userId = Auth::id();

        return PaginaFavorita::where('user_id', $userId)->get();
    }

    /**
     * Busca no array o nome da rota.
     *
     * @param  string  $routeName  Nome da Rota a ser buscada.
     * @return array|null
     **/
    private function findRoute(array $array, $routeName)
    {
        foreach ($array as $key => $value) {
            // Se o valor atual é um array, faça uma chamada recursiva
            if (is_array($value)) {
                $result = $this->findRoute($value, $routeName);
                if ($result) {
                    return $result;
                }
            }
            // Se encontramos a chave "route" com o valor desejado
            if ($key === 'route' && $value === $routeName) {
                // Retornamos o array completo do mesmo nível
                return $array;
            }
        }

        return null;
    }

    /**
     * Trata nome da rota.
     *
     * Troca nome do fim da rota de create, ou etc para index.
     *
     * @param  string  $routeName  Nome da rota a ser tradada.
     * @return string|null
     **/
    private function updateRouteName($routeName)
    {
        $routeNameArray = explode('.', $routeName);
        if (in_array(end($routeNameArray), $this->availableRoutes)) {
            return str_replace(end($routeNameArray), 'index', $routeName);
        }

        return null;
    }

    /**
     * Atualiza o texto com base na rota.
     *
     * Concatena um texto para caso a rota seja diferente de um index.
     *
     * @param  string  $routeName  Nome da rota a ser tradada.
     * @param  string  $text  Texto a ser atualizado
     * @return string|null
     **/
    private function updateTextName($routeName, $text)
    {
        $routeEndNameArray = explode('.', $routeName);
        $routeEndName = end($routeEndNameArray);
        if (array_key_exists($routeEndName, $this->textMenuConcat)) {
            return $this->textMenuConcat[$routeEndName].$text;
        }

        return null;
    }
}
