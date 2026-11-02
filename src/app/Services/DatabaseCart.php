<?php

namespace App\Services;

use App\Contracts\Cart;
use App\Models\Basket;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

// Корзина авторизованного пользователя. Одна строка baskets на пару user_id + product_id.
class DatabaseCart implements Cart
{
    public function add(int $productId, int $quantity): void
    {
        $product = $this->availableProduct($productId);
        $line = $this->line($productId);
        $next = (int) ($line->quantity ?? 0) + $quantity;

        $this->assertWithinStock($product, $next);
        $line->quantity = $next;
        $line->save();
    }

    // Абсолютное количество. Меньше 1 — удаление строки: CHECK не принимает ноль
    public function set(int $productId, int $quantity): void
    {
        if ($quantity < 1) {
            $this->remove($productId);

            return;
        }

        $product = $this->availableProduct($productId);
        $this->assertWithinStock($product, $quantity);

        $line = $this->line($productId);
        $line->quantity = $quantity;
        $line->save();
    }

    public function remove(int $productId): void
    {
        Basket::query()
            ->where('user_id', $this->userId())
            ->where('product_id', $productId)
            ->delete();
    }

    public function items(): Collection
    {
        $lines = Basket::query()->where('user_id', $this->userId())->get();

        if ($lines->isEmpty()) {
            return collect();
        }

        $products = Product::query()
            ->whereIn('id', $lines->pluck('product_id'))
            ->get()
            ->keyBy('id');

        return $lines->map(function (Basket $line) use ($products) {
            $product = $products->get($line->product_id);

            if ($product === null) {
                return null;
            }

            $quantity = (int) $line->quantity;

            return (object) [
                'product' => $product,
                'quantity' => $quantity,
                'lineTotal' => (float) $product->price * $quantity,
            ];
        })->filter()->values();
    }

    public function count(): int
    {
        return (int) Basket::query()->where('user_id', $this->userId())->sum('quantity');
    }

    public function total(): float
    {
        return (float) $this->items()->sum(fn ($item) => $item->lineTotal);
    }

    private function line(int $productId): Basket
    {
        return Basket::query()->firstOrNew([
            'user_id' => $this->userId(),
            'product_id' => $productId,
        ]);
    }

    private function userId(): int
    {
        return (int) auth()->id();
    }

    private function availableProduct(int $productId): Product
    {
        $product = Product::find($productId);

        if ($product === null) {
            throw ValidationException::withMessages([
                'product_id' => 'Товар недоступен.',
            ]);
        }

        return $product;
    }

    // Остаток только ограничивает корзину. products.quantity здесь не уменьшается
    private function assertWithinStock(Product $product, int $quantity): void
    {
        if ($quantity > $product->quantity) {
            throw ValidationException::withMessages([
                'quantity' => 'Нельзя добавить больше, чем есть на складе.',
            ]);
        }
    }
}
