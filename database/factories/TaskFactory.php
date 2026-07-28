<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
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
            'category_id'=>Category::factory(),
            'title'=>fake()->sentence(3),
            'description'=>fake()->optional()->paragraph(),
            'completed'=>false,
            'due_date'=>fake()->optional->dateTimeBetween(
                'now',
                '+1 month'
            ),
        ];
    }
}
