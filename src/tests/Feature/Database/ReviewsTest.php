<?php

use App\Models\Product;
use App\Models\Review;
use App\Models\User;

it('создаёт отзыв и увеличивает reviews_count', function () {
    $product = Product::factory()->create();

    Review::factory()->for($product)->create();
    Review::factory()->for($product)->create();

    expect($product->fresh()->reviews_count)->toBe(2);
});

it('уменьшает reviews_count при удалении отзыва', function () {
    $product = Product::factory()->create();
    $review = Review::factory()->for($product)->create();

    $review->delete();

    expect($product->fresh()->reviews_count)->toBe(0);
});

it('держит reviews_count и у мягко удалённого товара', function () {
    $product = Product::factory()->create();
    $product->delete();

    Review::factory()->for($product)->create();

    expect(Product::withTrashed()->find($product->id)->reviews_count)->toBe(1);
});

it('не даёт пользователю оставить два отзыва на один товар', function () {
    $review = Review::factory()->create();

    expectRejected(fn () => Review::factory()->create(['user_id' => $review->user_id, 'product_id' => $review->product_id]));
});

it('разрешает разным пользователям отзывы на один товар и одному — на разные', function () {
    $product = Product::factory()->create();
    $user = User::factory()->create();

    Review::factory()->for($product)->create();
    Review::factory()->for($product)->for($user)->create();
    Review::factory()->for($user)->create();

    expect(Review::count())->toBe(3);
});

it('принимает оценки 1–5 и отклоняет остальные', function (int $rating, bool $valid) {
    $make = fn () => Review::factory()->create(['rating' => $rating]);

    $valid ? expect($make()->rating)->toBe($rating) : expectRejected($make);
})->with([
    'ноль' => [0, false],
    'минимум' => [1, true],
    'максимум' => [5, true],
    'шесть' => [6, false],
    'минус' => [-1, false],
]);

it('требует текст отзыва', function () {
    expectRejected(fn () => Review::factory()->create(['body' => null]));
});

it('удаляет отзывы вместе с пользователем', function () {
    $review = Review::factory()->create();

    $review->user->delete();

    expect(Review::count())->toBe(0);
});

it('сохраняет отзывы при мягком удалении товара и удаляет при физическом', function () {
    $review = Review::factory()->create();
    $product = $review->product;

    $product->delete();
    expect(Review::count())->toBe(1);

    $product->forceDelete();
    expect(Review::count())->toBe(0);
});
