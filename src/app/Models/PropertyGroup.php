<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'is_multiple', 'sort'])]
class PropertyGroup extends Model
{
    protected function casts(): array
    {
        return ['is_multiple' => 'boolean'];
    }

    // Значения группы в порядке вывода
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'group_id')->orderBy('sort');
    }
}
