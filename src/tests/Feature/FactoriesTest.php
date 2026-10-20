<?php

use App\Enums\OrderStatus;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyGroup;
use App\Models\Review;

// Фабрики — основа остальных тестов: если они ломаются, ломается всё сразу, поэтому проверяем их отдельно

it('создаёт товар вместе с категорией', function () {
    $product = Product::factory()->create();

    expect($product->category)->toBeInstanceOf(Category::class)
        ->and($product->reviews_count)->toBe(0);
});

it('создаёт подкатегорию через childOf()', function () {
    $parent = Category::factory()->create();
    $child = Category::factory()->childOf($parent)->create();

    expect($child->parent->is($parent))->toBeTrue();
});

it('создаёт значение характеристики вместе с группой', function () {
    $property = Property::factory()->create();

    expect($property->group)->toBeInstanceOf(PropertyGroup::class)
        ->and($property->group->is_multiple)->toBeFalse();
    expect(PropertyGroup::factory()->multiple()->create()->is_multiple)->toBeTrue();
});

it('создаёт отзыв с пользователем и товаром', function () {
    $review = Review::factory()->create();

    expect($review->rating)->toBeBetween(1, 5)
        ->and($review->user)->not->toBeNull()
        ->and($review->product)->not->toBeNull();
});

it('создаёт заказ со статусом pending и гостевой заказ без пользователя', function () {
    $order = Order::factory()->create();
    $guest = Order::factory()->guest()->create();

    expect($order->status)->toBe(OrderStatus::Pending)
        ->and($order->user_id)->not->toBeNull()
        ->and($guest->user_id)->toBeNull();
});
