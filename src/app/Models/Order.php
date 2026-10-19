<?php

namespace App\Models;

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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products', 'order_id', 'product_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
