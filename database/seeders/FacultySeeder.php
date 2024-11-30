<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'user_id' => 2,
            'department_id' => 1,
        ]);

        Faculty::create([
            'first_name' => 'Steve',
            'last_name' => 'Smith',
            'user_id' => 3,
            'department_id' => 2,
        ]);
    }
}
