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

        DocumentStudent::create([
            'document_id' => 3,
            'student_id' => 3,
        ]);
        
        DocumentStudent::create([
            'document_id' => 4,
            'student_id' => 4,
        ]);
        
        DocumentStudent::create([
            'document_id' => 5,
            'student_id' => 5,
        ]);
        
        DocumentStudent::create([
            'document_id' => 6,
            'student_id' => 6,
        ]);
        
        DocumentStudent::create([
            'document_id' => 7,
            'student_id' => 7,
        ]);
    }
}
