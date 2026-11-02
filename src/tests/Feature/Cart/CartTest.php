<?php

use App\Models\Basket;
use App\Models\Product;

it('складывает количество при повторном добавлении и не пишет в таблицу baskets', function () {
    $product = Product::factory()->create(['quantity' => 10]);

    $this->post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1])
        ->assertSessionHas('cart', [$product->id => 1]);

    $this->withSession(['cart' => [$product->id => 1]])
        ->post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 2])
        ->assertSessionHas('cart', [$product->id => 3]);

    expect(Basket::count())->toBe(0);
});

it('не добавляет несуществующий и мягко удалённый товар', function () {
    $deleted = Product::factory()->create();
    $deleted->delete();

    $this->post(route('cart.store'), ['product_id' => $deleted->id, 'quantity' => 1])
        ->assertSessionHasErrors('product_id')
        ->assertSessionMissing('cart');

    $this->post(route('cart.store'), ['product_id' => 999999, 'quantity' => 1])
        ->assertSessionHasErrors('product_id')
        ->assertSessionMissing('cart');
});

it('не меняет корзину, если количество выше остатка', function () {
    $product = Product::factory()->create(['quantity' => 2]);

    $this->withSession(['cart' => [$product->id => 2]])
        ->from(route('cart.index'))
        ->post(route('cart.store'), ['product_id' => $product->id, 'quantity' => 1])
        ->assertSessionHasErrors('quantity')
        ->assertSessionHas('cart', [$product->id => 2]);
});

it('убирает строку при уменьшении до нуля и при удалении', function () {
    $product = Product::factory()->create(['quantity' => 5]);

    $this->withSession(['cart' => [$product->id => 1]])
        ->from(route('cart.index'))
        ->patch(route('cart.update', $product), ['quantity' => 0])
        ->assertSessionHas('cart', []);

    $this->withSession(['cart' => [$product->id => 2]])
        ->from(route('cart.index'))
        ->delete(route('cart.destroy', $product))
        ->assertSessionHas('cart', []);
});

it('показывает имя и сумму по текущей цене из базы', function () {
    $product = Product::factory()->create([
        'name' => 'Эфиопия Сидамо',
        'price' => 100.50,
        'quantity' => 5,
    ]);
    $product->update(['price' => 80]);

    $this->withSession(['cart' => [$product->id => 2]])
        ->get(route('cart.index'))
        ->assertOk()
        ->assertSee('Эфиопия Сидамо')
        ->assertSee('160.00')
        ->assertDontSee('201.00');
});

it('показывает пустое состояние', function () {
    $this->get(route('cart.index'))
        ->assertOk()
        ->assertSee('В корзине пока пусто')
        ->assertDontSee('К оплате');
});

it('убирает из корзины товар, удалённый после добавления', function () {
    $product = Product::factory()->create(['name' => 'Снятый с продажи']);
    $product->delete();

    $this->withSession(['cart' => [$product->id => 1]])
        ->get(route('cart.index'))
        ->assertDontSee('Снятый с продажи')
        ->assertSee('В корзине пока пусто')
        ->assertSessionHas('cart', []);
});

it('показывает в шапке сумму количеств', function () {
    $first = Product::factory()->create();
    $second = Product::factory()->create();

    $this->withSession(['cart' => [$first->id => 2, $second->id => 1]])
        ->get(route('home'))
        ->assertOk()
        ->assertSee('text-white">3<', false);
});
