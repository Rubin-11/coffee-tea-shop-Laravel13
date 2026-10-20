<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\PropertyGroup;
use Illuminate\Database\Seeder;

class ProductPropertySeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('☕ Привязка характеристик к товарам...');

        // Группы со значениями — один запрос на группы и один на значения вместо N+1 на каждый товар
        $groups = PropertyGroup::with('properties')->get()->keyBy('slug');
        $products = Product::whereIn('category_id', $this->coffeeCategoryIds())->get();

        // Одиночные группы (is_multiple = false) — по одному случайному значению на товар
        $singleSlugs = ['processing-method', 'acidity', 'coffee-type', 'roast-level',
            'acidity-level', 'bitterness', 'body', 'rating'];

        foreach ($products as $product) {
            $propertyIds = [];
            foreach ($singleSlugs as $slug) {
                $propertyIds[] = $groups[$slug]->properties->random()->id;
            }

            // 0-3 тега из группы с несколькими значениями; random(0) не падает — просто пустая коллекция
            array_push($propertyIds, ...$groups['specials']->properties->random(rand(0, 3))->pluck('id')->all());

            // syncProperties() — sync() под капотом, сидер можно перезапускать без дублей в pivot
            $product->syncProperties($propertyIds);
        }

        $this->command->info('✅ Характеристики привязаны к товарам!');
    }

    // id родительской категории кофе + всех её подкатегорий (регионов)
    private function coffeeCategoryIds(): array
    {
        $coffeeCategory = Category::where('slug', 'svezheobzharennyy-kofe')->firstOrFail();

        return Category::where('parent_id', $coffeeCategory->id)
            ->pluck('id')
            ->push($coffeeCategory->id)
            ->all();
    }
}
