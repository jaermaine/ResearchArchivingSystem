<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [

            '<div><strong>College of Allied Medical Sciences (CAMS) </strong></div>',
            'Bachelor of Science in Medical Technology',
            'Bachelor of Science in Pharmacy',
            'Bachelor of Science in Radiologic Technology',
            'Bachelor of Science in Biology',
            '----------------------------------------------------------------------------',

            'College of Liberal Arts and Education (CLAE)',
            'Bachelor of Arts in Communication',
            'AB Foreign Service',
            'AB Legal Studies',
            'Bachelor of Early Childhood Education',
            'Bachelor in Secondary Education',
            'Bachelor of Science in Psychology',
            '----------------------------------------------------------------------------',

            'College of Business Administration (CBA)',
            'Bachelor of Science in Accountancy',
            'Bachelor of Science in Business Administration',
            'Bachelor of Science in Customs Administration',
            'Bachelor of Science in Entrepreneurship',
            'Bachelor of Science in Real Estate Management',
            '----------------------------------------------------------------------------',

            'College of Engineering, Computer Studies and Architecture (COECSA)',
            'Bachelor of Science in Architecture',
            '----------------------------------------------------------------------------',
            'Bachelor of Science in Computer Science',
            'Bachelor of Science in Information Technology',
            'Bachelor of Library and Information Science',
            '----------------------------------------------------------------------------',
            'Bachelor of Science in Aeronautical Engineering',
            'Bachelor of Science in Civil Engineering',
            'Bachelor of Science in Computer Engineering',
            'Bachelor of Engineering Technology',
            'Bachelor of Science in Electrical Engineering',
            'Bachelor of Science in Electronics Engineering',
            'Bachelor of Science in Industrial Engineering',
            'Bachelor of Science in Mechanical Engineering',
            '----------------------------------------------------------------------------',

            'College of Fine Arts and Design (CFAD)',
            'Bachelor of Fine Arts',
            'Bachelor of Multimedia Arts',
            'Bachelor in Photography',
            '----------------------------------------------------------------------------',

            'College of International Tourism and Hospitality Management (CITHM)',
            'Bachelor of Science in International Travel and Tourism Management',
            'Bachelor of Science in International Hospitality Management',
            'Bachelor of Science in Nutrition and Dietetics',
            '----------------------------------------------------------------------------',

            'College of Nursing (CON)',
            'Bachelor of Science in Nursing'

        ];

        foreach($departments as $department) {
            Department::create([
                'name' => $department
            ]);
        }
    }
}
