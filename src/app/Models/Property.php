<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Одно значение характеристики («Сухая», «7») внутри группы
#[Fillable(['group_id', 'value', 'sort'])]
class Property extends Model
{
    public function group(): BelongsTo
    {
        return $this->belongsTo(PropertyGroup::class, 'group_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany( Product::class, 'product_properties', 'property_id', 'product_id')
            ->withPivot('group_id', 'is_multiple')
            ->withTimestamps();
    }
}
