<?php

namespace Database\Factories;

use App\Models\AA;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Critere>
 */
class CriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>
            fake()->name(),
            'description' =>
            fake()->paragraph(),
            'notation' =>
            fake()->numberBetween(5,30),
            'a_a_s_id' =>
            AA::get()->random()->id
        ];
    }
}
