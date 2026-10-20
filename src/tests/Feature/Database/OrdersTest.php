<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Order;
use App\Models\Product;

function addToOrder(Order $order, Product $product, int $quantity = 2, string $price = '150.00'): void
{
    $order->products()->attach($product->id, ['product_name' => $product->name, 'quantity' => $quantity, 'price' => $price]);
}

it('создаёт заказ со статусом pending и приводит поля к enum', function () {
    $order = Order::factory()->create(['payment_method' => 'card'])->fresh();

    expect($order->status)->toBe(OrderStatus::Pending)
        ->and($order->payment_method)->toBe(PaymentMethod::Card);
});

it('не принимает неизвестный способ оплаты через модель', function () {
    expect(fn () => Order::factory()->create(['payment_method' => 'bitcoin']))->toThrow(ValueError::class);
});

it('требует уникальный номер заказа', function () {
    $order = Order::factory()->create();

    expectRejected(fn () => Order::factory()->create(['order_number' => $order->order_number]));
});

it('допускает заказ без квартиры', function () {
    expect(Order::factory()->create(['flat_number' => null])->flat_number)->toBeNull();
});

it('сохраняет заказ при удалении пользователя, обнуляя user_id', function () {
    $order = Order::factory()->create();

    $order->user->delete();

    expect($order->fresh()->user_id)->toBeNull();
});

it('не даёт удалить заказ с позициями', function () {
    $order = Order::factory()->create();
    addToOrder($order, Product::factory()->create());

    expectRejected(fn () => $order->delete());
});

it('не даёт физически удалить товар, который есть в заказе', function () {
    $product = Product::factory()->create();
    addToOrder(Order::factory()->create(), $product);

    expectRejected(fn () => $product->forceDelete());
});

it('показывает мягко удалённый товар в составе старого заказа', function () {
    $product = Product::factory()->create(['name' => 'Старое название']);
    $order = Order::factory()->create();
    addToOrder($order, $product, quantity: 2, price: '150.00');

    $product->delete();

    $item = $order->fresh()->products->first();
    expect($item)->not->toBeNull()
        ->and($item->pivot->product_name)->toBe('Старое название')
        ->and($item->pivot->quantity)->toBe(2)
        ->and($item->pivot->price)->toBe('150.00');
});

it('хранит в позиции название на момент заказа, а не текущее', function () {
    $product = Product::factory()->create(['name' => 'Было']);
    $order = Order::factory()->create();
    addToOrder($order, $product);

    $product->update(['name' => 'Стало']);

    expect($order->products->first()->pivot->product_name)->toBe('Было');
});

it('не даёт добавить один товар в заказ дважды', function () {
    $order = Order::factory()->create();
    $product = Product::factory()->create();
    addToOrder($order, $product);

    expectRejected(fn () => addToOrder($order, $product));
});
