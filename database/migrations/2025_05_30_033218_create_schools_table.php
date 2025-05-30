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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('vision');
            $table->text('mission');
            $table->text('history');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->year('established_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
