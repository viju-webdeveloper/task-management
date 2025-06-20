<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->optional()->paragraph(),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'priority' => $this->faker->numberBetween(0, 2), // 0: Low, 1: Medium, 2: High
            'created_at' => now(),
        ];
    }
}
