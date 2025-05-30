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
        Schema::create('academics', function (Blueprint $table) {
            $table->id();
            $table->string('program_name');
            $table->text('description');
            $table->string('level'); // SD, SMP, SMA
            $table->text('curriculum');
            $table->string('duration');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academics');
    }
};
