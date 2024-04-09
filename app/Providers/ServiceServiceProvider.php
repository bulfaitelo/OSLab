<?php

namespace App\Providers;

use App\Contracts\Services\OsService\OsServiceInterface;
use App\Services\OsService\OsService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            OsServiceInterface::class,
            OsService::class
        );
    }
}
