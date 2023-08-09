<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planet>
 */
class PlanetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->word,
            'type'=> fake()->randomElement(['terrestrial', 'gaseous', 'dwarf']),
            'size'=> fake()->randomFloat(2, 1000, 50000),
            'average_temperature'=> fake()->numberBetween(-100, 100),
            'gravity'=> fake()->randomFloat(2, 1, 30),
        ];
    }
}
