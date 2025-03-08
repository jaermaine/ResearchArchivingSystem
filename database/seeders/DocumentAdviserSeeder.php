<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentAdviser;

class DocumentAdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentAdviser::create([
            'document_id' => 1,
            'adviser_id' => 1,
        ]);

        DocumentAdviser::create([
            'document_id' => 2,
            'adviser_id' => 2,
        ]);

        DocumentAdviser::create([
            'document_id' => 3,
            'adviser_id' => 3,
        ]);
        
        DocumentAdviser::create([
            'document_id' => 4,
            'adviser_id' => 4,
        ]);
        
        DocumentAdviser::create([
            'document_id' => 5,
            'adviser_id' => 5,
        ]);
        
        DocumentAdviser::create([
            'document_id' => 6,
            'adviser_id' => 6,
        ]);
        
        DocumentAdviser::create([
            'document_id' => 7,
            'adviser_id' => 7,
        ]);
    }
}
