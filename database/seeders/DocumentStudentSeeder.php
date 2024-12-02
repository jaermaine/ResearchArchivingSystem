<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentStudent;

class DocumentStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentStudent::create([
            'document_id' => 1,
            'student_id' => 1,
        ]);

        DocumentStudent::create([
            'document_id' => 2,
            'student_id' => 2,
        ]);
    }
}
