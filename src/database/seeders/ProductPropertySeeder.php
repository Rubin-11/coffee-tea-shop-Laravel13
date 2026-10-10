<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Database\Seeder;

class ProductPropertySeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('☕ Привязка характеристик к товарам...');

        // group by name -> один запрос вместо N+1 на каждый товар
        $properties = Property::all()->groupBy('name');
        $products = Product::whereIn('category_id', $this->coffeeCategoryIds())->get();

        foreach ($products as $product) {
            $propertyIds = [
                // по одному случайному значению на "одиночные" группы
                $properties['Способ обжарки']->random()->id,
                $properties['Кислинка']->random()->id,
                $properties['Вид кофе']->random()->id,
                $properties['Степень обжарки']->random()->id,
                $properties['Кислинка число']->random()->id,
                $properties['Горчинка']->random()->id,
                $properties['Насыщенность']->random()->id,
                $properties['Рейтинг']->random()->id,
                // 0-3 тега; random(0) не падает — просто пустая коллекция
                ...$properties['Особые']->random(rand(0, 3))->pluck('id')->all(),
            ];

            // sync(), не attach() — сидер можно перезапускать без дублей в pivot
            $product->properties()->sync($propertyIds);
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
