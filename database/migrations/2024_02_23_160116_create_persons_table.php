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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('surname', 70);
            $table->date('date_birth');
            $table->string('name_mother', 255);
            $table->string('description', 255);
            $table->foreignIdFor(App\Models\Group::class)->constrained();
            $table->foreignIdFor(App\Models\City::class)->constrained();
            $table->timestamps();
        });
    }
            

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
