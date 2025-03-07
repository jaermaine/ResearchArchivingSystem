<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            CollegeSeeder::class,
            ProgramSeeder::class,
            DocumentStatusSeeder::class,
            DocumentSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            AdviserSeeder::class,
            DocumentAdviserSeeder::class,
            DocumentStudentSeeder::class,
            AdminSeeder::class
        ]);
    }
}
