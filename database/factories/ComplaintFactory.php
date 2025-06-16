<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'user_id' => User::inRandomOrder()->where('role', 'student')->first()?->id,
             'department_id' => Department::inRandomOrder()->first()->id,
            'title' =>fake()->company(),
            'description'=>fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'in_progress', 'resolved']),
        ];
    }
}
