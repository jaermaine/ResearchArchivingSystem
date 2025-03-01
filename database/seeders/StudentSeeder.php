<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'first_name' => 'Cj',
            'last_name' => 'Rojo',
            'user_id' => 1,
            'college_id' => 2,
        ]);

        Student::create([
            'first_name' => 'Jaermaine',
            'last_name' => 'Domingcil',
            'user_id' => 4,
            'college_id' => 2,
        ]);
    }
}
