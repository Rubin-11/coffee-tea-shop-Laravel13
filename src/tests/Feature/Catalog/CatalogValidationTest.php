<?php

use App\Models\Category;

beforeEach(function () {
    $this->category = Category::factory()->create();
});

it('редиректит на ту же категорию, оставив только корректные параметры', function () {
    $this->get(route('catalog', ['slug' => $this->category->slug, 'price_min' => 'abc', 'roast_level' => ['3']]))
        ->assertRedirect(route('catalog', ['slug' => $this->category->slug, 'roast_level' => ['3']]))
        ->assertSessionHasErrors('price_min');
});

it('сбрасывает цену «до», которая меньше цены «от»', function () {
    $this->get(route('catalog', ['slug' => $this->category->slug, 'price_min' => 500, 'price_max' => 100]))
        ->assertRedirect(route('catalog', ['slug' => $this->category->slug, 'price_min' => 500]))
        ->assertSessionHasErrors('price_max');
});

it('не обвиняет цену «до», если ошибка только в цене «от»', function () {
    $this->get(route('catalog', ['slug' => $this->category->slug, 'price_min' => 'abc', 'price_max' => 500]))
        ->assertRedirect(route('catalog', ['slug' => $this->category->slug, 'price_max' => 500]))
        ->assertSessionHasErrors('price_min')
        ->assertSessionDoesntHaveErrors('price_max');
});

it('сбрасывает весь фильтр, если неверен хотя бы один его элемент', function () {
    $this->get(route('catalog', ['slug' => $this->category->slug, 'subcategory' => ['1', 'abc']]))
        ->assertRedirect(route('catalog', ['slug' => $this->category->slug]))
        ->assertSessionHasErrors('subcategory.1');
});

it('показывает причину сброса на странице каталога', function () {
    $this->followingRedirects()
        ->get(route('catalog', ['slug' => $this->category->slug, 'price_min' => 'abc']))
        ->assertOk()
        ->assertSee('Цена «от» должна быть числом.');
});

it('не редиректит корректный запрос и не показывает ошибок', function () {
    $this->get(route('catalog', ['slug' => $this->category->slug, 'price_min' => 100, 'price_max' => 500, 'roast_level' => ['3']]))
        ->assertOk()
        ->assertDontSee('Некорректн');
});

it('отвечает 404 на несуществующую категорию и с корректными, и с некорректными параметрами', function () {
    $this->followingRedirects()->get(route('catalog', ['slug' => 'net-takoy', 'price_min' => 'abc']))->assertNotFound();
    $this->get(route('catalog', ['slug' => 'net-takoy', 'price_min' => 100]))->assertNotFound();
});
