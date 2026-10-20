<?php

use App\Models\Category;
use App\Models\Product;

// Параметры фильтров приходят из URL и могут быть любыми. Тест не диктует, что именно ответит каталог
// (ошибка валидации, редирект или страница без этого фильтра) — только что это не 500
it('не падает с ошибкой сервера на некорректных параметрах фильтров', function (array $query) {
    $category = Category::factory()->create();
    Product::factory()->count(2)->for($category)->create();

    $response = $this->get(route('catalog', ['slug' => $category->slug] + $query));

    expect($response->status())->toBeLessThan(500);
})->with([
    'цена — не число' => [['price_min' => 'abc']],
    'подкатегории — не массив' => [['subcategory' => '1']],
    'характеристика — вложенный массив' => [['roast_level' => [['3']]]],
]);
