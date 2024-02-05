<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call([
            LessonSeeder::class,
            AASeeder::class,
            CriteriaSeeder::class,
            SkillSeeder::class,
            StudentSeeder::class,
            SectionSeeder::class,
            SkillStudentSeeder::class,
            LessonStudentSeeder::class,
            StudentSectionSeeder::class,
            CriteriaStudentSeeder::class,


        ]);
    }
}
