<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
        // Add some items to the menu...
        $event->menu->addAfter('notifications', [
            'text' => \Route::currentRouteName(),
            'url'  => '',
            // 'icon' => 'fa-regular fa-star',
            'icon' => 'fa-solid fa-star',
            'topnav_right' => true,
        ]);
    }
}
