<?php

namespace App\Livewire\Home;

use App\Services\OsLab\FavoriteMenuService;
use Livewire\Component;

class ShowUserFavorites extends Component
{
    public function render()
    {
        $favoriteMenu = new FavoriteMenuService();
        return view('livewire.home.show-user-favorites', [
            'menu' => $favoriteMenu->getUserFavoriteData()
        ]);
    }
}
