<?php

use App\Models\Basket;
use App\Models\Product;
use App\Models\User;

it('при входе складывает сессию с корзиной в базе и очищает сессию', function () {
    $product = Product::factory()->create(['quantity' => 10]);
    $user = User::factory()->create();
    Basket::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 2]);

    $this->withSession(['cart' => [$product->id => 2]])
        ->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect(route('home', absolute: false))
        ->assertSessionMissing('cart');

    expect(Basket::where('user_id', $user->id)->where('product_id', $product->id)->value('quantity'))->toBe(4);
});

it('при входе не кладёт в корзину больше остатка и пропускает недоступный товар', function () {
    $limited = Product::factory()->create(['quantity' => 3]);
    $empty = Product::factory()->create(['quantity' => 0]);
    $deleted = Product::factory()->create(['quantity' => 5]);
    $deleted->delete();
    $user = User::factory()->create();
    Basket::create(['user_id' => $user->id, 'product_id' => $limited->id, 'quantity' => 2]);

    $this->withSession(['cart' => [
        $limited->id => 2,
        $empty->id => 1,
        $deleted->id => 1,
    ]])->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertSessionMissing('cart');

    expect(Basket::where('product_id', $limited->id)->value('quantity'))->toBe(3);
    expect(Basket::where('product_id', $empty->id)->exists())->toBeFalse();
    expect(Basket::where('product_id', $deleted->id)->exists())->toBeFalse();
});

it('при регистрации переносит сессионную корзину и не делает пользователя админом', function () {
    $product = Product::factory()->create(['quantity' => 5]);

    $this->withSession(['cart' => [$product->id => 2]])
        ->post('/register', [
            'first_name' => 'Анна',
            'last_name' => 'Смирнова',
            'email' => 'anna@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'is_admin' => 1,
        ])
        ->assertRedirect(route('home', absolute: false))
        ->assertSessionMissing('cart');

    $user = User::where('email', 'anna@example.com')->first();

    expect((bool) $user->is_admin)->toBeFalse();
    expect(Basket::where('user_id', $user->id)->where('product_id', $product->id)->value('quantity'))->toBe(2);
});

it('после входа пишет корзину в базу, а не в сессию', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create(['quantity' => 5, 'price' => 100]);

    $this->actingAs($user)
        ->post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 2])
        ->assertSessionMissing('cart');

    expect(Basket::where('user_id', $user->id)->where('product_id', $product->id)->value('quantity'))->toBe(2);
    expect(Basket::count())->toBe(1);
});

it('показывает в шапке сумму из базы', function () {
    $user = User::factory()->create();
    $first = Product::factory()->create();
    $second = Product::factory()->create();
    Basket::create(['user_id' => $user->id, 'product_id' => $first->id, 'quantity' => 2]);
    Basket::create(['user_id' => $user->id, 'product_id' => $second->id, 'quantity' => 1]);

    $this->actingAs($user)
        ->get(route('home'))
        ->assertOk()
        ->assertSee('text-white">3<', false);
});

it('после выхода оставляет корзину в базе', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    Basket::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 2]);

    $this->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect('/')
        ->assertSessionMissing('cart');

    $this->assertGuest();
    expect(Basket::count())->toBe(1);
});
