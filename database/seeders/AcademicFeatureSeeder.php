<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicFeature;

class AcademicFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'title' => 'Laboratorium Modern',
                'description' => 'Laboratorium sains dan komputer dengan peralatan terkini untuk mendukung pembelajaran praktis',
                'icon' => 'fas fa-microscope',
                'color' => 'primary',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Perpustakaan Digital',
                'description' => 'Koleksi buku digital dan akses ke database internasional untuk penelitian dan pembelajaran',
                'icon' => 'fas fa-book-open',
                'color' => 'success',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Kelas Kecil',
                'description' => 'Rasio guru dan siswa yang ideal untuk pembelajaran optimal dan perhatian individual',
                'icon' => 'fas fa-users',
                'color' => 'info',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Program Internasional',
                'description' => 'Kerjasama dengan sekolah internasional dan program pertukaran pelajar',
                'icon' => 'fas fa-globe',
                'color' => 'warning',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Teknologi Pembelajaran',
                'description' => 'Penggunaan teknologi terdepan dalam proses belajar mengajar',
                'icon' => 'fas fa-laptop',
                'color' => 'danger',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Ekstrakurikuler Beragam',
                'description' => 'Berbagai kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat siswa',
                'icon' => 'fas fa-trophy',
                'color' => 'secondary',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($features as $feature) {
            AcademicFeature::updateOrCreate(
                ['title' => $feature['title']],
                $feature
            );
        }
    }
}
