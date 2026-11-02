<?php

use App\Models\Category;
use App\Models\Product;

function searchCatalogIds(Category $category, array $query = []): array
{
    return test()->get(route('catalog', ['slug' => $category->slug] + $query))
        ->viewData('products')
        ->pluck('id')
        ->sort()
        ->values()
        ->all();
}

describe('поиск в категории', function () {
    beforeEach(function () {
        $this->category = Category::factory()->create();
    });

    it('находит товар по части названия без учёта регистра', function () {
        $match = Product::factory()->for($this->category)->create(['name' => 'Эфиопия Сидамо']);
        Product::factory()->for($this->category)->create(['name' => 'Бразилия Сантос']);

        expect(searchCatalogIds($this->category, ['q' => 'сидамо']))->toBe([$match->id])
            ->and(searchCatalogIds($this->category, ['q' => 'ЭФИОПИЯ']))->toBe([$match->id]);
    });

    it('не ищет по описанию и не показывает товары чужой категории', function () {
        Product::factory()->for($this->category)->create([
            'name' => 'Бразилия Сантос',
            'description' => 'В описании есть слово эфиопия',
        ]);
        Product::factory()->for(Category::factory()->create())->create(['name' => 'Эфиопия Иргачефф']);
        $own = Product::factory()->for($this->category)->create(['name' => 'Эфиопия Гуджи']);

        expect(searchCatalogIds($this->category, ['q' => 'эфиопия']))->toBe([$own->id]);
    });

    it('сочетается с фильтром цены и скрывает мягко удалённые товары', function () {
        $match = Product::factory()->for($this->category)->create(['name' => 'Кения АА', 'price' => 300]);
        Product::factory()->for($this->category)->create(['name' => 'Кения АБ', 'price' => 900]);
        Product::factory()->for($this->category)->create(['name' => 'Кения удалённая', 'price' => 300])->delete();

        expect(searchCatalogIds($this->category, ['q' => 'кения', 'price_max' => 500]))->toBe([$match->id]);
    });

    it('пустой запрос не сужает выдачу', function () {
        $products = Product::factory()->count(2)->for($this->category)->create();

        $ids = $products->pluck('id')->sort()->values()->all();

        expect(searchCatalogIds($this->category, ['q' => '']))->toBe($ids)
            ->and(searchCatalogIds($this->category, ['q' => '   ']))->toBe($ids);
    });

    it('символы процента и подчёркивания ищутся как обычный текст', function () {
        $literal = Product::factory()->for($this->category)->create(['name' => 'Скидка 100%']);
        Product::factory()->for($this->category)->create(['name' => 'Обычный кофе']);

        expect(searchCatalogIds($this->category, ['q' => '%']))->toBe([$literal->id])
            ->and(searchCatalogIds($this->category, ['q' => '_']))->toBe([]);
    });

    it('сохраняет запрос в ссылках пагинации', function () {
        Product::factory()->count(7)->for($this->category)->create(['name' => 'Арабика']);

        $this->get(route('catalog', ['slug' => $this->category->slug, 'q' => 'арабика']))
            ->assertViewHas('products', fn ($p) => str_contains($p->url(2), 'q='));
    });
});

describe('поиск по всему каталогу', function () {
    it('находит товар в любой категории', function () {
        $product = Product::factory()->for(Category::factory()->create())->create(['name' => 'Улун молочный']);
        Product::factory()->for(Category::factory()->create())->create(['name' => 'Зелёный сенча']);

        $this->get(route('search', ['q' => 'молочный']))
            ->assertOk()
            ->assertSee($product->name)
            ->assertDontSee('Зелёный сенча')
            ->assertViewHas('products', fn ($products) => $products->pluck('id')->all() === [$product->id]);
    });

    it('без запроса не показывает товары', function () {
        Product::factory()->for(Category::factory()->create())->create();

        $this->get(route('search'))
            ->assertOk()
            ->assertSee('Введите название товара')
            ->assertViewHas('products', fn ($products) => $products->total() === 0);
    });

    it('сбрасывает некорректный запрос и показывает причину', function () {
        $this->get(route('search', ['q' => ['не строка']]))
            ->assertRedirect(route('search'))
            ->assertSessionHasErrors('q');

        $this->followingRedirects()
            ->get(route('search', ['q' => ['не строка']]))
            ->assertOk()
            ->assertSee('Некорректный поисковый запрос.');
    });
});
