<?php

use App\Models\Category;
use App\Models\Product;

// ids товаров из выдачи каталога, по возрастанию — удобно сравнивать с ожидаемым набором
function catalogIds($response): array
{
    return $response->viewData('products')->pluck('id')->sort()->values()->all();
}

function catalog(Category $category, array $query = [])
{
    return test()->get(route('catalog', ['slug' => $category->slug] + $query));
}

beforeEach(function () {
    $this->category = Category::factory()->create();
});

describe('цена', function () {
    it('фильтрует по минимальной и максимальной цене включительно', function () {
        $cheap = Product::factory()->for($this->category)->create(['price' => 100]);
        $middle = Product::factory()->for($this->category)->create(['price' => 500]);
        $expensive = Product::factory()->for($this->category)->create(['price' => 900]);

        expect(catalogIds(catalog($this->category, ['price_min' => 500])))->toBe([$middle->id, $expensive->id])
            ->and(catalogIds(catalog($this->category, ['price_max' => 500])))->toBe([$cheap->id, $middle->id])
            ->and(catalogIds(catalog($this->category, ['price_min' => 200, 'price_max' => 800])))->toBe([$middle->id]);
    });

    it('игнорирует пустые параметры цены', function () {
        $products = Product::factory()->count(2)->for($this->category)->create();

        expect(catalogIds(catalog($this->category, ['price_min' => '', 'price_max' => ''])))
            ->toBe($products->pluck('id')->all());
    });
});

describe('подкатегории', function () {
    it('сужает выдачу до выбранных подкатегорий', function () {
        $childA = Category::factory()->childOf($this->category)->create();
        $childB = Category::factory()->childOf($this->category)->create();
        $inA = Product::factory()->for($childA)->create();
        Product::factory()->for($childB)->create();
        Product::factory()->for($this->category)->create();

        expect(catalogIds(catalog($this->category, ['subcategory' => [$childA->id]])))->toBe([$inA->id]);
    });

    it('не показывает товары подкатегории, которая не входит в открытую категорию', function () {
        $foreignChild = Category::factory()->childOf(Category::factory()->create())->create();
        Product::factory()->for($foreignChild)->create();
        Product::factory()->for($this->category)->create();

        expect(catalogIds(catalog($this->category, ['subcategory' => [$foreignChild->id]])))->toBe([]);
    });
});

describe('характеристики', function () {
    it('оставляет только товары с выбранным значением группы', function () {
        $light = productWith($this->category, [['roast-level', '3']]);
        productWith($this->category, [['roast-level', '5']]);

        expect(catalogIds(catalog($this->category, ['roast_level' => ['3']])))->toBe([$light->id]);
    });

    it('объединяет значения внутри одной группы через ИЛИ', function () {
        $a = productWith($this->category, [['roast-level', '3']]);
        $b = productWith($this->category, [['roast-level', '4']]);
        productWith($this->category, [['roast-level', '5']]);

        expect(catalogIds(catalog($this->category, ['roast_level' => ['3', '4']])))->toBe([$a->id, $b->id]);
    });

    it('объединяет разные группы через И', function () {
        $both = productWith($this->category, [['roast-level', '3'], ['body', '5']]);
        productWith($this->category, [['roast-level', '3'], ['body', '7']]);
        productWith($this->category, [['roast-level', '4'], ['body', '5']]);

        expect(catalogIds(catalog($this->category, ['roast_level' => ['3'], 'body' => ['5']])))->toBe([$both->id]);
    });

    it('не путает одинаковые значения из разных групп', function () {
        // body = 3 не должен находиться по фильтру roast_level = 3
        $roast = productWith($this->category, [['roast-level', '3']]);
        productWith($this->category, [['body', '3']]);

        expect(catalogIds(catalog($this->category, ['roast_level' => ['3']])))->toBe([$roast->id]);
    });

    it('фильтрует по текстовым значениям', function () {
        $dry = productWith($this->category, [['processing-method', 'Сухая']]);
        productWith($this->category, [['processing-method', 'Мытая']]);

        expect(catalogIds(catalog($this->category, ['processing' => ['Сухая']])))->toBe([$dry->id]);
    });

    it('игнорирует пустой параметр и неизвестные параметры', function () {
        $products = Product::factory()->count(2)->for($this->category)->create();

        expect(catalogIds(catalog($this->category, ['roast_level' => [], 'nonexistent' => ['1']])))
            ->toBe($products->pluck('id')->all());
    });

    it('сочетается с ценой и не показывает мягко удалённые товары', function () {
        $match = productWith($this->category, [['roast-level', '3']], ['price' => 300]);
        productWith($this->category, [['roast-level', '3']], ['price' => 900]);
        productWith($this->category, [['roast-level', '3']], ['price' => 300])->delete();

        expect(catalogIds(catalog($this->category, ['roast_level' => ['3'], 'price_max' => 500])))->toBe([$match->id]);
    });
});
