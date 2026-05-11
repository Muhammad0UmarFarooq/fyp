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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->constrained()->onDelete('cascade');
            $table->foreignId('pitch_id')->constrained()->onDelete('cascade');
            $table->foreignId('entrepreneur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('investor_id')->constrained('users')->onDelete('cascade');
            $table->decimal('ownership_stake', 5, 2);
            $table->decimal('estimated_roi', 15, 2);
            $table->date('agreement_date');
            $table->enum('status', ['pending_signature', 'active', 'completed'])->default('pending_signature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
