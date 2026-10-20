<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'group_id' => PropertyGroup::factory(),
            'value' => fake()->unique()->word(),
            'sort' => 0,
        ];
    }
}
