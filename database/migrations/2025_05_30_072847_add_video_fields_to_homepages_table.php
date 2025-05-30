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
        Schema::table('homepages', function (Blueprint $table) {
            $table->string('welcome_video_type')->default('none')->after('welcome_image_path'); // none, upload, link
            $table->string('welcome_video_path')->nullable()->after('welcome_video_type');
            $table->text('welcome_video_link')->nullable()->after('welcome_video_path');
            $table->string('welcome_video_thumbnail')->nullable()->after('welcome_video_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->dropColumn(['welcome_video_type', 'welcome_video_path', 'welcome_video_link', 'welcome_video_thumbnail']);
        });
    }
};
