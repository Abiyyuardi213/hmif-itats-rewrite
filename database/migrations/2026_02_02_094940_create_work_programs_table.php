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
        Schema::create('work_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('division_id')->nullable()->constrained()->onDelete('set null');
            $table->text('description')->nullable();
            $table->enum('status', ['selesai', 'berjalan', 'mendatang'])->default('mendatang');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('head_id')->nullable()->constrained('org_members')->onDelete('set null');
            $table->integer('participants_count')->default(0);
            $table->string('budget')->nullable();
            $table->integer('team_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_programs');
    }
};
