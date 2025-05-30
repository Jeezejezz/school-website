<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SchoolSeeder::class,
            NewsSeeder::class,
            AcademicSeeder::class,
            GallerySeeder::class,
            SettingSeeder::class,
            MenuSeeder::class,
            AcademicFeatureSeeder::class,
            AcademicLevelSeeder::class,
        ]);

        // Ensure homepage has proper stats data
        \App\Models\Homepage::updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => 'Selamat Datang di SMK SATRIA BHAKTI',
                'hero_subtitle' => 'Membangun generasi unggul dengan pendidikan berkualitas dan karakter yang kuat untuk masa depan yang gemilang.',
                'hero_button_text' => 'Pelajari Lebih Lanjut',
                'hero_button_link' => '#about',
                'welcome_title' => 'Selamat Datang di SMK SATRIA BHAKTI',
                'welcome_description' => 'Kami berkomitmen memberikan pendidikan terbaik dengan fasilitas modern dan tenaga pengajar yang berpengalaman.',
                'stats_students' => '1200+',
                'stats_teachers' => '85+',
                'stats_programs' => '12+',
                'stats_achievements' => '150+',
                'welcome_video_type' => 'none',
                'welcome_video_position' => 'below',
                'show_news_section' => true,
                'show_gallery_section' => true,
                'show_testimonials_section' => false,
                'show_contact_section' => false,
            ]
        );
    }
}
