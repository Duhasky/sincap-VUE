<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });

        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->timestamps();
        });

        Schema::create('ability_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ability_id')->constrained(table: 'abilities')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained(table: 'roles')->cascadeOnDelete();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained(table: 'roles')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained(table: 'users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('ability_role');
        Schema::dropIfExists('abilities');
        Schema::dropIfExists('roles');
    }
};
