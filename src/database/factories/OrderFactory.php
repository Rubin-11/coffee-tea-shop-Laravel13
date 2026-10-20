<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'price' => fake()->randomFloat(2, 100, 20000),
            'payment_method' => fake()->randomElement(PaymentMethod::cases()),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => '+7' . fake()->numerify('##########'),
            'country' => 'Россия',
            'region' => fake()->word(),
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'house_number' => fake()->buildingNumber(),
            'flat_number' => fake()->optional()->buildingNumber(),
            'status' => OrderStatus::Pending,
        ];
    }

    // Гостевой заказ (или заказ удалённого пользователя): user_id = NULL
    public function guest(): static
    {
        return $this->state(['user_id' => null]);
    }
}
