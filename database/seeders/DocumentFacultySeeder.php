<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentFaculty;

class DocumentFacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentFaculty::create([
            'document_id' => 1,
            'faculty_id' => 1,
        ]);

        DocumentFaculty::create([
            'document_id' => 2,
            'faculty_id' => 2,
        ]);
    }
}
