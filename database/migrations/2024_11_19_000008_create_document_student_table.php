<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_student', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('document_id')->constrained('documents')->nullable();
            $table->foreignId('student_id')->constrained('student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_student');
    }
};
