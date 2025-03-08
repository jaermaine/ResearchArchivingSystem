<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adviser;

class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adviser::create([
            'user_id' => 2,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'college_id' => 1,
        ]);

        Adviser::create([
            'user_id' => 3,
            'first_name' => 'Steve',
            'last_name' => 'Smith',
            'college_id' => 2,
        ]);

        Adviser::create([
            'user_id' => 12,
            'first_name' => 'Robert',
            'last_name' => 'Garcia',
            'college_id' => 3,
        ]);
        
        Adviser::create([
            'user_id' => 13,
            'first_name' => 'Linda',
            'last_name' => 'Rodriguez',
            'college_id' => 4,
        ]);
        
        Adviser::create([
            'user_id' => 14,
            'first_name' => 'William',
            'last_name' => 'Martinez',
            'college_id' => 5,
        ]);
        
        Adviser::create([
            'user_id' => 15,
            'first_name' => 'Barbara',
            'last_name' => 'Anderson',
            'college_id' => 6,
        ]);
        
        Adviser::create([
            'user_id' => 16,
            'first_name' => 'James',
            'last_name' => 'Thomas',
            'college_id' => 7,
        ]);
    }
}
