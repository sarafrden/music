<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DdexService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DdexService::class, function ($app) {
            return new DdexService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
