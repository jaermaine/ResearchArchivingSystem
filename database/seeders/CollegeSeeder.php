<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\College;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colleges = [
            'College of Allied Medical Sciences',
            'College of Liberal Arts and Education',
            'College of Business Administration',
            'College of Engineering, Computer Studies and Architecture',
            'College of Fine Arts and Design',
            'College of International Tourism and Hospitality Management',
            'College of Nursing',
        ];

        foreach($colleges as $college) {
            College::create([
                'name' => $college
            ]);
        }
    }
}
