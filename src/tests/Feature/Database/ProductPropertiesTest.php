<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

beforeEach(function () {
    $this->product = Product::factory()->create();
});

it('заполняет group_id и is_multiple в пивоте при syncProperties()', function () {
    $roast = propertyValue('roast-level', '3');
    $tag = propertyValue('specials', 'Скидки', multiple: true);

    $this->product->syncProperties([$roast->id, $tag->id]);

    $pivot = DB::table('product_properties')->where('product_id', $this->product->id)->get()->keyBy('property_id');
    expect($pivot[$roast->id]->group_id)->toBe($roast->group_id)
        ->and((bool) $pivot[$roast->id]->is_multiple)->toBeFalse()
        ->and((bool) $pivot[$tag->id]->is_multiple)->toBeTrue();
});

it('заменяет набор характеристик, а не дописывает', function () {
    $old = propertyValue('roast-level', '3');
    $new = propertyValue('roast-level', '4');

    $this->product->syncProperties([$old->id]);
    $this->product->syncProperties([$new->id]);

    expect($this->product->properties()->pluck('properties.id')->all())->toBe([$new->id]);
});

it('не даёт товару два значения одиночной группы', function () {
    $a = propertyValue('roast-level', '3');
    $b = propertyValue('roast-level', '4');

    expectRejected(fn () => $this->product->syncProperties([$a->id, $b->id]));
});

it('разрешает несколько значений в группе is_multiple', function () {
    $tags = collect(['Скидки', 'Новинка', 'Популярное'])->map(fn ($v) => propertyValue('specials', $v, multiple: true));

    $this->product->syncProperties($tags->pluck('id')->all());

    expect($this->product->properties()->count())->toBe(3);
});

it('отклоняет group_id, не совпадающий с группой значения', function () {
    $roast = propertyValue('roast-level', '3');
    $body = propertyValue('body', '5');

    expectRejected(fn () => DB::table('product_properties')->insert([
        'product_id' => $this->product->id,
        'property_id' => $body->id,
        'group_id' => $roast->group_id,
        'is_multiple' => false,
    ]));
});

it('отклоняет is_multiple, не совпадающий с флагом группы', function () {
    $tag = propertyValue('specials', 'Скидки', multiple: true);

    expectRejected(fn () => DB::table('product_properties')->insert([
        'product_id' => $this->product->id,
        'property_id' => $tag->id,
        'group_id' => $tag->group_id,
        'is_multiple' => false,
    ]));
});

it('не даёт привязать одно и то же значение дважды', function () {
    $roast = propertyValue('roast-level', '3');
    $this->product->syncProperties([$roast->id]);

    expectRejected(fn () => DB::table('product_properties')->insert([
        'product_id' => $this->product->id,
        'property_id' => $roast->id,
        'group_id' => $roast->group_id,
        'is_multiple' => false,
    ]));
});

it('не даёт завести дубль значения в группе', function () {
    $roast = propertyValue('roast-level', '3');

    expectRejected(fn () => $roast->group->properties()->create(['value' => '3']));
});

it('удаляет связи при физическом удалении товара и значения', function () {
    $roast = propertyValue('roast-level', '3');
    $this->product->syncProperties([$roast->id]);

    $this->product->forceDelete();
    expect(DB::table('product_properties')->count())->toBe(0);

    $other = Product::factory()->for(Category::factory())->create();
    $other->syncProperties([$roast->id]);
    $roast->group->delete();
    expect(DB::table('product_properties')->count())->toBe(0)
        ->and(DB::table('properties')->count())->toBe(0);
});
