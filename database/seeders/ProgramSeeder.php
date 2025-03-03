<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs =[
            [ // College of Allied Medical Sciences
            ['Bachelor of Science in Medical Technology', "MT"],
            ['Bachelor of Science in Pharmacy', "PH"],
            ['Bachelor of Science in Radiologic Technology', "BSRT"],
            ['Bachelor of Science in Biology', "BIO"]
            ],

            [ // College of Liberal Arts and Communication
            ['Bachelor of Arts in Communication', "ABC"],
            ['AB Foreign Service', "FS"],
            ['AB Legal Studies', "LS"],
            ['Bachelor of Early Childhood Education', "ECED"],
            ['Bachelor in Secondary Education', "SED"],
            ['Bachelor of Science in Psychology', "PSY"]
            ],
            
            [ // College of Business Administration
            ['Bachelor of Science in Accountancy', "AC"],
            ['Bachelor of Science in Business Administration', "BA"],
            ['Bachelor of Science in Customs Administration', "CA"],
            ['Bachelor of Science in Entrepreneurship', "ENT"],
            ['Bachelor of Science in Real Estate Management', "REM"]
            ],

            [ // College of Engineering, Computer Studies and Architecture
            ['Bachelor of Science in Architecture', "ARCH"],
            ['Bachelor of Science in Computer Science', "CS"],
            ['Bachelor of Science in Information Technology', "IT"],
            ['Bachelor of Library and Information Science', "LIS"],
            ['Bachelor of Science in Aeronautical Engineering', "AE"],
            ['Bachelor of Science in Civil Engineering', "CE"],
            ['Bachelor of Science in Computer Engineering', "CPE"],
            ['Bachelor of Engineering Technology', "ET"],
            ['Bachelor of Science in Electrical Engineering', "EE"],
            ['Bachelor of Science in Electronics Engineering', "ECE"],
            ['Bachelor of Science in Industrial Engineering', "IE"],
            ['Bachelor of Science in Mechanical Engineering', "ME"]
            ],

            [ // College of Fine Arts and Design
            ['Bachelor of Fine Arts', "BFA"],
            ['Bachelor of Multimedia Arts', "MMA"],
            ['Bachelor in Photography', "PHO"]
            ],

            [ // College of International Tourism and Hospitality Management
            ['Bachelor of Science in International Travel and Tourism Management', "TTM"],
            ['Bachelor of Science in International Hospitality Management', "HM"],
            ['Bachelor of Science in Nutrition and Dietetics', "ND"]
            ],

            [ // College of Nursing
                ['Bachelor of Science in Nursing', "BSN"]
            ]
        ];

        for($i = 0; $i < count($programs); $i++) {
            foreach($programs[$i] as $program) {
                Program::create([
                    'college_id' => $i + 1,
                    'name' => $program[0],
                    'abbreviation' => $program[1]
                ]);
            }
        }
    }
}
