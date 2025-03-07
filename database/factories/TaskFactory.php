<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Defines the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'user_id' => \App\Models\User::factory(),
            'completed_at' => null,
        ];
    }

    /**
     * Indicates that the task is complete.
     *
     * @param  \DateTimeInterface|string|null  $date
     * @return \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
     */
    public function completed($date = null): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'completed_at' => $date ?? now(),
            ];
        });
    }
}
