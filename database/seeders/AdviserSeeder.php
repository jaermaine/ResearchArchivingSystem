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
    }
}
