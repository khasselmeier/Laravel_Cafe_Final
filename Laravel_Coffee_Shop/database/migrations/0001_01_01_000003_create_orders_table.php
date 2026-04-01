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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Total price (cached for performance)
            $table->integer('total_amount');

            // Order status
            $table->enum('status', [
                'pending',
                'paid',
                'preparing',
                'ready',
                'completed',
                'cancelled'
            ])->default('pending');

            // Optional notes (e.g., "no sugar")
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
