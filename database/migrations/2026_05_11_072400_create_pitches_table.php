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
            $table->decimal('invested_amount', 15, 2)->nullable();
            $table->decimal('monthly_net_value', 15, 2)->nullable();
            $table->decimal('monthly_growth', 5, 2)->nullable();
            $table->text('vision_statement')->nullable();
            $table->text('additional_detail')->nullable();
            $table->decimal('funding_required', 15, 2)->nullable();
            $table->string('return_time')->nullable();
            $table->decimal('total_valuation', 15, 2)->nullable();
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
