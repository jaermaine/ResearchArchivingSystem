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
        Schema::create('document_faculty', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('documents_id')->constrained('documents')->nullable();
            $table->foreignId('faculty_id')->constrained('faculty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_faculty');
    }
};
