<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaitriseEtudiant>
 */
class SkillStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::get()->random()->id,
            'skill_id' => Skill::get()->random()->id,
            'note' => rand(0, 100)
        ];
    }
}
