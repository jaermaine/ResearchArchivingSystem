<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Documents;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documents::create([
            'title' => 'Test Title',
            'abstract' => 'Test Abstract',
            'field_topic' => 'Test Field Topic',
            'document_status_id' => 1,
        ]);

        Documents::create([
            'title' => 'Test Title1',
            'abstract' => 'Test Abstract1',
            'field_topic' => 'Test Field Topic1',
            'document_status_id' => 1,
        ]);
    }
}
