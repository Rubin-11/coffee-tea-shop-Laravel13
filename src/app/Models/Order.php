<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

// status не в списке: при создании берётся default 'pending', менять его будет только админка
#[Fillable([
    'user_id', 'order_number', 'price', 'payment_method',
    'customer_name', 'customer_email', 'customer_phone',
    'country', 'region', 'city', 'street', 'house_number', 'flat_number',
])]
class Order extends Model
{
    protected function casts(): array
    {
        return [
            'payment_method' => PaymentMethod::class,
            'status' => OrderStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        // withTrashed(): мягко удалённые товары не должны пропадать из состава старых заказов
        return $this->belongsToMany(Product::class, 'orders_products', 'order_id', 'product_id')
            ->withTrashed()
            ->withPivot('product_name', 'quantity', 'price')
            ->withTimestamps();
    }
}
