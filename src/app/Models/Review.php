<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'product_id', 'rating', 'body'])]
class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        // products.reviews_count — счётчик, держим его в согласии с таблицей отзывов.
        // withTrashed(): отзыв может прийти к мягко удалённому товару (например, из админки)
        static::created(fn (Review $review) => Product::withTrashed()->whereKey($review->product_id)->increment('reviews_count'));
        static::deleted(fn (Review $review) => Product::withTrashed()->whereKey($review->product_id)->decrement('reviews_count'));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
