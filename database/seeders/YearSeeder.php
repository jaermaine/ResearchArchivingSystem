<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            '1st Year',
            '2nd Year',
            '3rd Year',
            '4th Year'
        ];

        $yearNumbers = [
            '1',
            '2',
            '3',
            '4'
        ];
        $yearNumbers = array_combine($years, $yearNumbers);
        // Create the years
        foreach($yearNumbers as $year => $number) {
            \App\Models\Year::create([
                'name' => $year,
                'number' => $number
            ]);
        }
    }
}
