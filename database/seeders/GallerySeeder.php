<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryData = [
            [
                'title' => 'Upacara Bendera Senin',
                'description' => 'Kegiatan upacara bendera rutin setiap hari Senin yang diikuti oleh seluruh siswa dan guru.',
                'image_path' => 'placeholder',
                'category' => 'kegiatan',
                'is_featured' => true
            ],
            [
                'title' => 'Laboratorium Kimia',
                'description' => 'Fasilitas laboratorium kimia yang modern dengan peralatan lengkap untuk praktikum siswa.',
                'image_path' => 'placeholder',
                'category' => 'fasilitas',
                'is_featured' => true
            ],
            [
                'title' => 'Pertunjukan Seni Budaya',
                'description' => 'Penampilan tari tradisional dalam acara peringatan hari kemerdekaan Indonesia.',
                'image_path' => 'placeholder',
                'category' => 'acara',
                'is_featured' => true
            ],
            [
                'title' => 'Kelas Pembelajaran',
                'description' => 'Suasana pembelajaran di kelas dengan metode diskusi kelompok yang interaktif.',
                'image_path' => 'placeholder',
                'category' => 'pembelajaran',
                'is_featured' => false
            ],
            [
                'title' => 'Perpustakaan Sekolah',
                'description' => 'Perpustakaan dengan koleksi buku yang lengkap dan area baca yang nyaman.',
                'image_path' => 'placeholder',
                'category' => 'fasilitas',
                'is_featured' => true
            ],
            [
                'title' => 'Olimpiade Sains',
                'description' => 'Siswa-siswi yang meraih juara dalam kompetisi olimpiade sains tingkat nasional.',
                'image_path' => 'placeholder',
                'category' => 'prestasi',
                'is_featured' => true
            ],
            [
                'title' => 'Kegiatan Ekstrakurikuler',
                'description' => 'Latihan ekstrakurikuler robotika yang mengembangkan kreativitas dan inovasi siswa.',
                'image_path' => 'placeholder',
                'category' => 'kegiatan',
                'is_featured' => false
            ],
            [
                'title' => 'Wisuda Kelulusan',
                'description' => 'Momen bahagia wisuda kelulusan siswa kelas XII tahun ajaran 2023/2024.',
                'image_path' => 'placeholder',
                'category' => 'acara',
                'is_featured' => true
            ],
            [
                'title' => 'Lapangan Olahraga',
                'description' => 'Lapangan basket dan voli yang digunakan untuk kegiatan olahraga dan ekstrakurikuler.',
                'image_path' => 'placeholder',
                'category' => 'fasilitas',
                'is_featured' => false
            ],
            [
                'title' => 'Bakti Sosial',
                'description' => 'Kegiatan bakti sosial siswa di panti asuhan sebagai bentuk kepedulian sosial.',
                'image_path' => 'placeholder',
                'category' => 'kegiatan',
                'is_featured' => false
            ]
        ];

        foreach ($galleryData as $gallery) {
            Gallery::create($gallery);
        }
    }
}
