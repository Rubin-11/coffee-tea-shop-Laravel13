<?php

namespace Database\Factories;

use App\Models\PropertyGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyGroup>
 */
class PropertyGroupFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'slug' => fake()->unique()->slug(),
            'is_multiple' => false,
            'sort' => 0,
        ];
    }

    // Группа-теги: у товара может быть несколько значений сразу
    public function multiple(): static
    {
        return $this->state(['is_multiple' => true]);
    }
}
