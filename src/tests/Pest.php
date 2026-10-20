<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// RefreshDatabase: каждый тест идёт в транзакции над БД laravel_db_test (см. phpunit.xml);
// схема создаётся один раз через migrate:fresh. withoutVite(): в тестах не нужен собранный public/build
pest()->extend(TestCase::class)
    ->use(RefreshDatabase::class)
    ->beforeEach(fn () => $this->withoutVite())
    ->in('Feature', 'Unit');

// Значение характеристики в группе с данным slug; группа создаётся при первом обращении
function propertyValue(string $groupSlug, string $value, bool $multiple = false): App\Models\Property
{
    $group = App\Models\PropertyGroup::firstOrCreate(
        ['slug' => $groupSlug],
        ['name' => $groupSlug, 'is_multiple' => $multiple, 'sort' => 0],
    );

    return $group->properties()->firstOrCreate(['value' => $value], ['sort' => 0]);
}

// Товар в категории с набором характеристик: productWith($category, [['roast-level', '3'], ['body', '5']])
function productWith(App\Models\Category $category, array $properties = [], array $attributes = []): App\Models\Product
{
    $product = App\Models\Product::factory()->for($category)->create($attributes);
    $product->syncProperties(
        collect($properties)->map(fn (array $p) => propertyValue($p[0], $p[1])->id)->all()
    );

    return $product;
}
