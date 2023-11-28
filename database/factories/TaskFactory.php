<?php

namespace Database\Factories;

use App\Models\Checklist;
use App\Models\User;
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
            'title' => fake()->text(25),
            'description' => fake()->text(),
            'checklist_id' => Checklist::all()->random(),
            'deadline' => fake()->date(),
            'user_id' => User::all()->random()
        ];
    }
}
