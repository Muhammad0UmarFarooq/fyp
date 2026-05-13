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
        Schema::create('pitches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('startup_name');
            $table->bigInteger('invested_amount')->nullable();
            $table->bigInteger('monthly_net_value')->nullable();
            $table->bigInteger('monthly_growth')->nullable();
            $table->text('vision_statement')->nullable();
            $table->text('additional_detail')->nullable();
            $table->bigInteger('funding_required')->nullable();
            $table->string('return_time')->nullable();
            $table->bigInteger('total_valuation')->nullable();
            $table->string('video_path')->nullable();
            $table->enum('status', ['active', 'funded', 'archived'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pitches');
    }
};
