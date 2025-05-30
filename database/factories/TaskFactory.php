<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'description' => $this->faker->sentence,
            'due_date' => $this->faker->optional()->date(),
            'completed_at' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['Em andamento', 'Concluido', 'Parado']),
        ];
    }
}
