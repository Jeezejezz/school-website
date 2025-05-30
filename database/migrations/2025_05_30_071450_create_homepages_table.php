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
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->text('hero_subtitle');
            $table->string('hero_image_path')->nullable();
            $table->string('hero_button_text')->default('Pelajari Lebih Lanjut');
            $table->string('hero_button_link')->default('#about');

            $table->string('welcome_title')->default('Selamat Datang di Sekolah Kami');
            $table->text('welcome_description');
            $table->string('welcome_image_path')->nullable();

            $table->string('stats_students')->default('1000+');
            $table->string('stats_teachers')->default('50+');
            $table->string('stats_programs')->default('10+');
            $table->string('stats_achievements')->default('100+');

            $table->boolean('show_news_section')->default(true);
            $table->boolean('show_gallery_section')->default(true);
            $table->boolean('show_testimonials_section')->default(true);
            $table->boolean('show_contact_section')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepages');
    }
};
