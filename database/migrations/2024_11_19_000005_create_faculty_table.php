<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faculty', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('document_id')->nullable()->constrained('documents');
            $table->foreignId('department_id')->nullable()->constrained('departments');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE faculty ALTER COLUMN document_id SET DEFAULT NULL');
        DB::statement('ALTER TABLE faculty ALTER COLUMN department_id SET DEFAULT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty');
    }
};
