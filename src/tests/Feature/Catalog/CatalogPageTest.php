<?php

use App\Models\Category;
use App\Models\Product;

it('открывает каталог существующей категории', function () {
    $category = Category::factory()->create();

    $this->get(route('catalog', $category->slug))
        ->assertOk()
        ->assertSee($category->name)
        ->assertViewHas('category', fn ($c) => $c->is($category));
});

it('возвращает 404 для несуществующей категории', function () {
    $this->get(route('catalog', 'net-takoy-kategorii'))->assertNotFound();
});

it('показывает товары категории и её подкатегорий, но не чужие', function () {
    $category = Category::factory()->create();
    $child = Category::factory()->childOf($category)->create();
    $other = Category::factory()->create();

    $own = Product::factory()->for($category)->create();
    $inChild = Product::factory()->for($child)->create();
    $foreign = Product::factory()->for($other)->create();

    $this->get(route('catalog', $category->slug))
        ->assertViewHas('products', fn ($products) => $products->pluck('id')->sort()->values()->all() === [$own->id, $inChild->id])
        ->assertDontSee($foreign->name);
});

it('показывает общее число найденных товаров', function () {
    $category = Category::factory()->create();
    Product::factory()->count(3)->for($category)->create();

    $this->get(route('catalog', $category->slug))->assertSee('Найдено 3 товаров');
});

it('не показывает мягко удалённые товары', function () {
    $category = Category::factory()->create();
    $visible = Product::factory()->for($category)->create();
    $deleted = Product::factory()->for($category)->create();
    $deleted->delete();

    $this->get(route('catalog', $category->slug))
        ->assertSee($visible->name)
        ->assertDontSee($deleted->name)
        ->assertViewHas('products', fn ($products) => $products->total() === 1);
});

it('делит товары по 6 на страницу', function () {
    $category = Category::factory()->create();
    Product::factory()->count(7)->for($category)->create();

    $this->get(route('catalog', $category->slug))
        ->assertViewHas('products', fn ($p) => $p->count() === 6 && $p->total() === 7 && $p->lastPage() === 2);

    $this->get(route('catalog', ['slug' => $category->slug, 'page' => 2]))
        ->assertViewHas('products', fn ($p) => $p->count() === 1 && $p->currentPage() === 2);
});

it('сохраняет фильтры в ссылках пагинации', function () {
    $category = Category::factory()->create();
    Product::factory()->count(7)->for($category)->create(['price' => 500]);

    $this->get(route('catalog', ['slug' => $category->slug, 'price_min' => 100]))
        ->assertViewHas('products', fn ($p) => str_contains($p->url(2), 'price_min=100'));
});
