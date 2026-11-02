<?php

namespace App\Providers;

use App\Contracts\Cart;
use App\Services\DatabaseCart;
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
        // Не singleton: на одном запросе пользователь может как раз войти, и следующий резолв должен увидеть это
        $this->app->bind(Cart::class, function ($app) {
            if (auth()->check()) {
                return $app->make(DatabaseCart::class);
            }

            return $app->make(SessionCart::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Счётчик шапки: у гостя сумма из сессии, у вошедшего — сумма quantity в baskets
        View::composer('components.header', function ($view) {
            $view->with('cartCount', app(Cart::class)->count());
        });
    }
}
