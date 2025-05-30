<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicLevel;

class AcademicLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'SD',
                'display_name' => 'Sekolah Dasar',
                'description' => 'Jenjang pendidikan dasar untuk anak usia 6-12 tahun',
                'color' => 'success',
                'sort_order' => 1,
                'is_visible' => true,
            ],
            [
                'name' => 'SMP',
                'display_name' => 'Sekolah Menengah Pertama',
                'description' => 'Jenjang pendidikan menengah pertama untuk anak usia 12-15 tahun',
                'color' => 'info',
                'sort_order' => 2,
                'is_visible' => true,
            ],
            [
                'name' => 'SMA',
                'display_name' => 'Sekolah Menengah Atas',
                'description' => 'Jenjang pendidikan menengah atas untuk anak usia 15-18 tahun',
                'color' => 'primary',
                'sort_order' => 3,
                'is_visible' => true,
            ],
            [
                'name' => 'SMK',
                'display_name' => 'Sekolah Menengah Kejuruan',
                'description' => 'Jenjang pendidikan menengah kejuruan untuk anak usia 15-18 tahun',
                'color' => 'warning',
                'sort_order' => 4,
                'is_visible' => false, // Default hidden
            ],
        ];

        foreach ($levels as $level) {
            AcademicLevel::updateOrCreate(
                ['name' => $level['name']],
                $level
            );
        }
    }
}
