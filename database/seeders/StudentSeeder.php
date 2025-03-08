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
            'college_id' => 1,
        ]);

        Student::create([
            'first_name' => 'Jaermaine',
            'last_name' => 'Domingcil',
            'user_id' => 4,
            'college_id' => 2,
        ]);

        Student::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'user_id' => 7,
            'college_id' => 3,
        ]);
        
        Student::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'user_id' => 8,
            'college_id' => 4,
        ]);
        
        Student::create([
            'first_name' => 'David',
            'last_name' => 'Lee',
            'user_id' => 9,
            'college_id' => 5,
        ]);
        
        Student::create([
            'first_name' => 'Emily',
            'last_name' => 'Brown',
            'user_id' => 10,
            'college_id' => 6,
        ]);
        
        Student::create([
            'first_name' => 'Michael',
            'last_name' => 'Wilson',
            'user_id' => 11,
            'college_id' => 7,
        ]);
    }
}
