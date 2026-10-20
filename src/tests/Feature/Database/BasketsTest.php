<?php

use App\Models\Basket;
use App\Models\Product;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->product = Product::factory()->create();
});

it('ставит количество 1 по умолчанию', function () {
    $basket = Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id]);

    expect($basket->fresh()->quantity)->toBe(1);
});

it('не даёт добавить один товар в корзину пользователя второй строкой', function () {
    Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id, 'quantity' => 1]);

    expectRejected(fn () => Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id, 'quantity' => 2]));
});

it('разрешает тот же товар в корзинах разных пользователей', function () {
    Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id]);
    Basket::create(['user_id' => User::factory()->create()->id, 'product_id' => $this->product->id]);

    expect(Basket::count())->toBe(2);
});

it('отклоняет нулевое и отрицательное количество', function (int $quantity) {
    expectRejected(fn () => Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id, 'quantity' => $quantity]));
})->with([0, -1]);

it('требует владельца корзины', function () {
    expectRejected(fn () => Basket::create(['user_id' => null, 'product_id' => $this->product->id]));
});

it('удаляет корзину вместе с пользователем', function () {
    Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id]);

    $this->user->delete();

    expect(Basket::count())->toBe(0);
});

it('убирает товар из корзин при мягком удалении', function () {
    Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id]);
    $keep = Product::factory()->create();
    Basket::create(['user_id' => $this->user->id, 'product_id' => $keep->id]);

    $this->product->delete();

    expect(Basket::pluck('product_id')->all())->toBe([$keep->id]);
});

it('отдаёт товары корзины с количеством через User::products()', function () {
    Basket::create(['user_id' => $this->user->id, 'product_id' => $this->product->id, 'quantity' => 3]);

    expect($this->user->products->first()->pivot->quantity)->toBe(3);
});
