<?php

use App\Models\Category;

it('открывает главную страницу', function () {
    $this->get('/')->assertOk();
});

it('показывает только категории верхнего уровня', function () {
    $top = Category::factory()->create(['name' => 'Верхняя категория']);
    Category::factory()->childOf($top)->create(['name' => 'Вложенная категория']);

    $this->get('/')
        ->assertOk()
        ->assertSee('Верхняя категория')
        ->assertDontSee('Вложенная категория')
        ->assertViewHas('categories', fn ($categories) => $categories->pluck('id')->all() === [$top->id]);
});
