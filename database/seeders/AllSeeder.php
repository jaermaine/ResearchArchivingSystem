<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        // Get all table names
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        // Truncate each table
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $this->call([
            CollegeSeeder::class,
            ProgramSeeder::class,
            YearSeeder::class,
            SectionSeeder::class,
            DocumentStatusSeeder::class,
            DocumentSeeder::class,
            UserSeeder::class,
            StudentSeeder::class,
            AdviserSeeder::class,
            DocumentAdviserSeeder::class,
            DocumentStudentSeeder::class,
            AdminSeeder::class
        ]);
    }
}
