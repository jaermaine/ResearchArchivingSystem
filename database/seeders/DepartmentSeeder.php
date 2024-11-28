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
            'Department of Architecture',
            'Department of Computer Studies',
            'Department of Engineering'
        ];

        foreach($departments as $department) {
            Department::create([
                'name' => $department
            ]);
        }
    }
}
