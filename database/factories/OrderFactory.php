<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'contact' => $this->faker->phoneNumber(),
            'size_id' => $this->faker->randomElement([1, 2, 3]),
            'flex' => $this->faker->randomElement([1, 2, 3]),
            'booked_for' => $this->faker->date(),
        ];
    }
}
