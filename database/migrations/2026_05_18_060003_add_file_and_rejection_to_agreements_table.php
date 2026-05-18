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
            $table->string('agreement_file')->nullable();
            $table->string('agreement_filename')->nullable();
            $table->string('agreement_filesize')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->string('status')->default('pending_signature')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropColumn(['agreement_file', 'agreement_filename', 'agreement_filesize', 'rejection_reason']);
        });
    }
};
