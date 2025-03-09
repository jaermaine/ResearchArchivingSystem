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
            'title' => 'Web and Mobile-Based 360° Faculty Evaluation System for Comprehensive Performance Assessment',
            'abstract' => 'Digital platform aimed at automating and streamlining the faculty evaluation process at educational institutions.',
            'keyword' => 'Evaluation System',
            'document_status_id' => 2,
            'program_id' => 17
        ]);

        Documents::create([
            'title' => 'Cloud-based Research Archiving System: A Design Framework for Scalable Repositories',
            'abstract' => 'Provide a platform that eases the submission process of papers related to Thesis, Research, and Capstone Projects.',
            'keyword' => 'Document Archiving',
            'document_status_id' => 2,
            'program_id' => 17
        ]);

        Documents::create([
            'title' => 'Analysis of Machine Learning Algorithms',
            'abstract' => 'This study investigates the performance of various machine learning algorithms in predicting data patterns.',
            'keyword' => 'machine learning, algorithms, prediction',
            'document_status_id' => 2,
            'program_id' => 17
        ]);
        
        Documents::create([
            'title' => 'Impact of Social Media on Youth Behavior',
            'abstract' => 'An examination of the effects of social media usage on the behavioral patterns of young adults.',
            'keyword' => 'social media, youth, behavior',
            'document_status_id' => 2,
            'program_id' => 10
        ]);
        
        Documents::create([
            'title' => 'Development of a Mobile Application for Language Learning',
            'abstract' => 'This project focuses on creating a mobile application to facilitate language acquisition.',
            'keyword' => 'mobile app, language learning, education',
            'document_status_id' => 2,
            'program_id' => 18
        ]);
        
        Documents::create([
            'title' => 'The Role of Renewable Energy in Sustainable Development',
            'abstract' => 'A study on the importance and implementation of renewable energy sources for sustainable development.',
            'keyword' => 'renewable energy, sustainability, development',
            'document_status_id' => 2,
            'program_id' => 24
        ]);
        
        Documents::create([
            'title' => 'Investigating the Effects of Climate Change on Coastal Ecosystems',
            'abstract' => 'Research on the impact of climate change on the biodiversity and stability of coastal ecosystems.',
            'keyword' => 'climate change, coastal ecosystems, biodiversity',
            'document_status_id' => 2,
            'program_id' => 4
        ]);
    }
}
