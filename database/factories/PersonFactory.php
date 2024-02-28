<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'surname' => fake()->name(),
            'date_birth' => fake()->dateTimeBetween(),
            'name_mother' => fake()->name(),
            'city_id' => rand(1,184),
            'description' => fake()->text(255),
            'group_id' => rand(1,3),
        ];
    }
}
