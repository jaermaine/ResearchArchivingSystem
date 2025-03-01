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
        Schema::create('documents', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('title');
            $table->string('abstract');
            $table->string('keyword');
            $table->foreignId('document_status_id')->nullable()->constrained('document_statuses');
            $table->foreignId('document_type_id')->nullable()->constrained('document_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
