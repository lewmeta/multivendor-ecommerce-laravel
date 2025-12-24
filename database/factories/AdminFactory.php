<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->text(),
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => fake()->safeEmail(),
            'password' => fake()->text(),
            'avatar' => fake()->text(),
            'remember_token' => fake()->text(),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
