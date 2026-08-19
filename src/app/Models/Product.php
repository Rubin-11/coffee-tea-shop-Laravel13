<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    public function productsImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany( Property::class, 'product_properties', 'product_id', 'property_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany( User::class, 'baskets', 'product_id', 'user_id')
            ->withPivot('session_id','quantity' )
            ->withTimestamps();
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'orders_products', 'product_id', 'order_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
