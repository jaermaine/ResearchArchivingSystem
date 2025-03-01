<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('adviser', function (Blueprint $table) {
            $table->string('suffix')->nullable()->after('last_name');
        });

        Schema::table('student', function (Blueprint $table) {
            $table->string('suffix')->nullable()->after('last_name');
        });
    }

    public function down()
    {
        Schema::table('adviser', function (Blueprint $table) {
            $table->dropColumn('suffix');
        });

        Schema::table('student', function (Blueprint $table) {
            $table->dropColumn('suffix');
        });
    }
};
