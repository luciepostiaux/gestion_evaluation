<?php

namespace Database\Seeders;

use App\Models\AA;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AA::factory(10)->create();
    }
}
