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
        Schema::table('merchandise_orders', function (Blueprint $table) {
            $table->string('transaction_id')->unique()->after('id');
            $table->string('payment_proof')->nullable()->after('notes');
            $table->timestamp('expires_at')->nullable()->after('payment_proof');
            $table->timestamp('paid_at')->nullable()->after('expires_at');
            $table->string('payment_method')->nullable()->after('paid_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('merchandise_orders', function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'payment_proof', 'expires_at', 'paid_at', 'payment_method']);
        });
    }
};
