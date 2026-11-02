<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

// Корзина гостя. В сессии только пары product_id => quantity.
// Название и цена читаются из products в момент показа, чтобы смена цены не зависела от сессии.
class SessionCart
{
    public const KEY = 'cart';

    public function add(int $productId, int $quantity): void
    {
        $product = $this->availableProduct($productId);
        $next = ($this->raw()[$productId] ?? 0) + $quantity;

        $this->assertWithinStock($product, $next);
        $this->putLine($productId, $next);
    }

    // Абсолютное количество. Меньше 1 — удаление строки: ноль в сессии не хранится
    public function set(int $productId, int $quantity): void
    {
        if ($quantity < 1) {
            $this->remove($productId);

            return;
        }

        $product = $this->availableProduct($productId);
        $this->assertWithinStock($product, $quantity);
        $this->putLine($productId, $quantity);
    }

    public function remove(int $productId): void
    {
        $cart = $this->raw();
        unset($cart[$productId]);
        session()->put(self::KEY, $cart);
    }

    // Пропавшие товары (мягко удалённые) вычищаются из сессии, чтобы не копились мёртвые id
    public function items(): Collection
    {
        $cart = $this->raw();

        if ($cart === []) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $cleaned = [];
        $items = collect();

        foreach ($cart as $id => $quantity) {
            $product = $products->get((int) $id);

            if ($product === null) {
                continue;
            }

            $quantity = (int) $quantity;
            $cleaned[$product->id] = $quantity;
            $items->push((object) [
                'product' => $product,
                'quantity' => $quantity,
                'lineTotal' => (float) $product->price * $quantity,
            ]);
        }

        if ($cleaned !== $cart) {
            session()->put(self::KEY, $cleaned);
        }

        return $items;
    }

    public function count(): int
    {
        return array_sum($this->raw());
    }

    public function total(): float
    {
        return (float) $this->items()->sum(fn ($item) => $item->lineTotal);
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

    private function putLine(int $productId, int $quantity): void
    {
        $cart = $this->raw();
        $cart[$productId] = $quantity;
        session()->put(self::KEY, $cart);
    }

    private function raw(): array
    {
        return session(self::KEY, []);
    }
}
