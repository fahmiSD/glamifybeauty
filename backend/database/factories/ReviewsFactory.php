<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,2),
            'description' => fake()->paragraph(3),
            'purpose' => fake()->paragraph(1),
            'upvotes' => fake()->numberBetween(0, 100),
            'scores' => fake()->numberBetween(0, 5)
        ];
    }
}