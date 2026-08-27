<?php

namespace Database\Factories;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => $this->faker->country(),
            'region' => $this->faker->region(),
            'city' => $this->faker->city(),
            'street' => $this->faker->street(),
            'house_number' => $this->faker->buildingNumber(),
            'flat_number' => $this->faker->buildingNumber(),
            'phone_number' => $this->faker->phoneNumber(),
        ];
    }
}
