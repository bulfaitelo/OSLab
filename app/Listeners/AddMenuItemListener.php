<?php

namespace App\Listeners;

use App\Services\OsLab\MenuService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Route;

class AddMenuItemListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BuildingMenu $event): void
    {
        $this->menuFavoriteToggle($event);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param  BuildingMenu  $event
     * @return  void
     **/
    public function menuFavoriteToggle($event): void
    {
        $menuService = new MenuService();
        $eligible = $menuService->getRouteData(Route::currentRouteName());
        $favorited = $menuService->checkRouteIsFavorited(Route::currentRouteName());
        if ($favorited) {
            $starIcon = 'fa-solid fa-star';
        } else {
            $starIcon = 'fa-regular fa-star';
        }

        if($eligible){
            $event->menu->addAfter('notifications', [
                'text' => '',
                'topnav_right' => true,
                'route'  => ['favorite.toggle', [Route::currentRouteName() ]],
                'icon' => $starIcon,
            ]);
        }
    }
}
