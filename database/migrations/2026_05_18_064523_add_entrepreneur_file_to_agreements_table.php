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
        Schema::table('agreements', function (Blueprint $table) {
            $table->string('entrepreneur_file')->nullable();
            $table->string('entrepreneur_filename')->nullable();
            $table->string('entrepreneur_filesize')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropColumn(['entrepreneur_file', 'entrepreneur_filename', 'entrepreneur_filesize']);
        });
    }
};
