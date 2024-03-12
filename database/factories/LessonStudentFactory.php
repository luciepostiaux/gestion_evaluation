<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;


class LessonStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' =>
            Student::get()->random()->id,
            'lesson_id' =>
            Lesson::get()->random()->id,
            'status' => 0
        ];
    }
}
