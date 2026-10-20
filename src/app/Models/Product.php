<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['category_id', 'name', 'slug', 'description','price', 'quantity', 'reviews_count'])]
class Product extends Model
{
    // delete() ставит deleted_at вместо удаления строки; все запросы Product:: по умолчанию скрывают такие товары
    use SoftDeletes;

    protected static function booted(): void
    {
        // Удалённый товар больше нельзя купить — убираем его из всех корзин
        static::deleted(function (Product $product) {
            Basket::where('product_id', $product->id)->delete();
        });
    }

    public function productsImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany( Property::class, 'product_properties', 'product_id', 'property_id')
            ->withPivot('group_id', 'is_multiple')
            ->withTimestamps();
    }

    // Заменяет характеристики товара набором значений. group_id и is_multiple в pivot
    // заполняем из самих значений — sync() без этого не пройдёт составные внешние ключи
    public function syncProperties(array $propertyIds): void
    {
        $pivot = Property::with('group')->findMany($propertyIds)
            ->mapWithKeys(fn (Property $property) => [
                $property->id => [
                    'group_id' => $property->group_id,
                    'is_multiple' => $property->group->is_multiple,
                ],
            ])
            ->all();

        $this->properties()->sync($pivot);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'baskets', 'product_id', 'user_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_products', 'product_id', 'order_id')
            ->withPivot('product_name', 'quantity', 'price')
            ->withTimestamps();
    }

    // Получить категорию
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
