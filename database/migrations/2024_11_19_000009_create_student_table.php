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
        Schema::create('student', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('user_id')->constrained('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('document_id')->nullable()->constrained('documents');
            $table->foreignId('college_id')->nullable()->constrained('college');
            $table->foreignId('program_id')->nullable()->constrained('program');
            $table->foreignId('year_id')->nullable()->constrained('year');
            $table->foreignId('section_id')->nullable()->constrained('section');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
