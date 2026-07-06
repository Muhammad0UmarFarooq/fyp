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
            $table->dropForeign(['pitch_id']);
            $table->foreign('pitch_id')->references('id')->on('pitches')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropForeign(['pitch_id']);
            $table->foreign('pitch_id')->references('id')->on('pitches')->cascadeOnDelete();
        });
    }
};
