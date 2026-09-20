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
    Schema::create('skill_exchanges', function (Blueprint $table) {
        $table->id();

        $table->foreignId('proposer_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->foreignId('receiver_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->foreignId('teach_skill_id')
            ->constrained('skills')
            ->cascadeOnDelete();

        $table->foreignId('learn_skill_id')
            ->constrained('skills')
            ->cascadeOnDelete();

        $table->text('message')->nullable();

        $table->enum('status', [
            'pending',
            'accepted',
            'declined',
        ])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_exchanges');
    }
};
