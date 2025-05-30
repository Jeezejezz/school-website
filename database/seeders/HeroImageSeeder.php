<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroImage;

class HeroImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing hero images
        HeroImage::truncate();

        // Create sample hero images with placeholder URLs
        $heroImages = [
            [
                'image_path' => 'placeholder1.jpg',
                'title' => 'Selamat Datang di Sekolah Kami',
                'description' => 'Tempat terbaik untuk mengembangkan potensi dan meraih prestasi',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'image_path' => 'placeholder2.jpg',
                'title' => 'Fasilitas Modern',
                'description' => 'Dilengkapi dengan fasilitas pembelajaran yang modern dan lengkap',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'image_path' => 'placeholder3.jpg',
                'title' => 'Prestasi Membanggakan',
                'description' => 'Meraih berbagai prestasi di tingkat regional dan nasional',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($heroImages as $heroImage) {
            HeroImage::create($heroImage);
        }

        echo "Created " . count($heroImages) . " hero images\n";
    }


}
