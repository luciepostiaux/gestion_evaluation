<?php

namespace Database\Factories;

use App\Models\Criteria;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class CriteriaStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'criteria_id' =>
            Criteria::get()->random()->id,
            'student_id' =>
            Student::get()->random()->id,
            'note' =>
            fake()->numberBetween(0, 1),

        ];
    }
}
