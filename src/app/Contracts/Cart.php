<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

// Общие действия корзины. Гость пишет в сессию, авторизованный — в baskets.
interface Cart
{
    public function add(int $productId, int $quantity): void;

    public function set(int $productId, int $quantity): void;

    public function remove(int $productId): void;

    public function items(): Collection;

    public function count(): int;

    public function total(): float;
}
