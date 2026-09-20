<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('request_id')
                ->constrained('requests')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('tutor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('date');

            $table->time('start_time');

            $table->time('end_time');

            $table->enum('session_type', [
                'online',
                'in_person',
                'either',
            ]);

            $table->enum('status', [
                'pending',
                'accepted',
                'confirmed',
                'completed',
                'cancelled',
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
