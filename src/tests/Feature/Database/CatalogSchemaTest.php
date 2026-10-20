<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

describe('товары', function () {
    it('допускает остаток 0 и отклоняет отрицательный', function () {
        expect(Product::factory()->create(['quantity' => 0])->quantity)->toBe(0);

        expectRejected(fn () => Product::factory()->create(['quantity' => -1]));
    });

    it('отклоняет отрицательный reviews_count', function () {
        $product = Product::factory()->create();

        expectRejected(fn () => DB::table('products')->where('id', $product->id)->update(['reviews_count' => -1]));
    });

    it('хранит описание длиннее 255 символов', function () {
        $product = Product::factory()->create(['description' => str_repeat('я', 2000)]);

        expect(mb_strlen($product->fresh()->description))->toBe(2000);
    });

    it('не даёт создать два товара с одним slug, даже если один удалён', function () {
        $product = Product::factory()->create(['slug' => 'duplicate']);
        $product->delete();

        expectRejected(fn () => Product::factory()->create(['slug' => 'duplicate']));
    });

    it('скрывает мягко удалённый товар и возвращает через restore()', function () {
        $product = Product::factory()->create();

        $product->delete();
        expect(Product::find($product->id))->toBeNull()
            ->and(Product::withTrashed()->find($product->id))->not->toBeNull();

        $product->restore();
        expect(Product::find($product->id))->not->toBeNull();
    });
});

describe('категории', function () {
    it('отклоняет дубль имени на верхнем уровне', function () {
        Category::factory()->create(['name' => 'Кофе']);

        expectRejected(fn () => Category::factory()->create(['name' => 'Кофе']));
    });

    it('отклоняет дубль имени внутри одного родителя', function () {
        $parent = Category::factory()->create();
        Category::factory()->childOf($parent)->create(['name' => 'Эфиопия']);

        expectRejected(fn () => Category::factory()->childOf($parent)->create(['name' => 'Эфиопия']));
    });

    it('разрешает одинаковое имя у разных родителей', function () {
        Category::factory()->childOf(Category::factory()->create())->create(['name' => 'Эфиопия']);
        Category::factory()->childOf(Category::factory()->create())->create(['name' => 'Эфиопия']);

        expect(Category::where('name', 'Эфиопия')->count())->toBe(2);
    });

    it('оставляет подкатегории при удалении родителя, делая их верхнего уровня', function () {
        $parent = Category::factory()->create();
        $child = Category::factory()->childOf($parent)->create();

        $parent->delete();

        expect($child->fresh()->parent_id)->toBeNull();
    });

    it('не даёт удалить категорию с товарами, в том числе мягко удалёнными', function () {
        $category = Category::factory()->create();
        $product = Product::factory()->for($category)->create();

        expectRejected(fn () => $category->delete());

        $product->delete();
        expectRejected(fn () => $category->delete());
    });
});
