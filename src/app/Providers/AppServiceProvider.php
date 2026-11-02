<?php

namespace App\Providers;

use App\Services\SessionCart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Счётчик шапки — сумма количеств из сессии, без запроса к товарам
        View::composer('components.header', function ($view) {
            $view->with('cartCount', app(SessionCart::class)->count());
        });
    }
}
