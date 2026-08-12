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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voting_schedule_id')->constrained('voting_schedules')->onDelete('cascade');
            $table->integer('candidate_number');
            $table->string('name');
            $table->string('npm')->nullable();
            $table->string('photo')->nullable();
            $table->text('vision');
            $table->text('mission'); // json or line-separated text
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
