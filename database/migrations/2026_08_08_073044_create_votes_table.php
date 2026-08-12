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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voting_schedule_id')->constrained('voting_schedules')->onDelete('cascade');
            $table->foreignId('candidate_id')->constrained('candidates')->onDelete('cascade');
            $table->string('voter_npm');
            $table->string('voter_name');
            $table->string('voter_email')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();

            // Prevent duplicate voting per schedule per NPM
            $table->unique(['voting_schedule_id', 'voter_npm']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
