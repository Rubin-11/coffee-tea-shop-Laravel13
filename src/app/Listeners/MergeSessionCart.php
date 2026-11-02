<?php

namespace App\Listeners;

use App\Models\Basket;
use App\Models\Product;
use App\Models\User;
use App\Services\SessionCart;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

// Срабатывает и на вход, и на регистрацию: Auth::login уже перенёс данные сессии на новый id.
class MergeSessionCart
{
    public function handle(Login $event): void
    {
        $cart = session(SessionCart::KEY, []);

        if ($cart === [] || ! $event->user instanceof User) {
            return;
        }

        $user = $event->user;

        DB::transaction(function () use ($cart, $user) {
            $products = Product::query()
                ->whereIn('id', array_map('intval', array_keys($cart)))
                ->get()
                ->keyBy('id');

            foreach ($cart as $id => $quantity) {
                $product = $products->get((int) $id);
                $quantity = (int) $quantity;

                if ($product === null || $product->quantity < 1 || $quantity < 1) {
                    continue;
                }

                $line = Basket::query()->firstOrNew([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);

                $line->quantity = min((int) $product->quantity, (int) ($line->quantity ?? 0) + $quantity);
                $line->save();
            }
        });

        session()->forget(SessionCart::KEY);
    }
}
