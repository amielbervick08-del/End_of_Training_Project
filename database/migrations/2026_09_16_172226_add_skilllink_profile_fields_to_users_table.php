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
        Schema::table('users', function (Blueprint $table) {
            $table->string('location')->nullable()->after('email');
            $table->text('bio')->nullable()->after('location');
            $table->string('profile_image')->nullable()->after('bio');
            $table->enum('role', ['learn', 'teach', 'both'])
                ->default('learn')
                ->after('profile_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'location',
                'bio',
                'profile_image',
                'role',
            ]);
        });
    }
};