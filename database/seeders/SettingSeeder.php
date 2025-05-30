<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Header Settings
            [
                'key' => 'header_logo',
                'value' => null,
                'type' => 'image',
                'group' => 'header',
                'label' => 'Logo Header',
                'description' => 'Logo yang ditampilkan di header website'
            ],
            [
                'key' => 'header_title',
                'value' => 'Sekolah Kami',
                'type' => 'text',
                'group' => 'header',
                'label' => 'Judul Header',
                'description' => 'Judul yang ditampilkan di header'
            ],
            [
                'key' => 'header_tagline',
                'value' => 'Memberikan pendidikan berkualitas untuk masa depan yang cerah',
                'type' => 'text',
                'group' => 'header',
                'label' => 'Tagline Header',
                'description' => 'Tagline atau slogan sekolah'
            ],
            [
                'key' => 'header_phone',
                'value' => '(021) 123-4567',
                'type' => 'text',
                'group' => 'header',
                'label' => 'Nomor Telepon',
                'description' => 'Nomor telepon yang ditampilkan di header'
            ],
            [
                'key' => 'header_email',
                'value' => 'info@sekolahkami.sch.id',
                'type' => 'text',
                'group' => 'header',
                'label' => 'Email',
                'description' => 'Email yang ditampilkan di header'
            ],

            // Footer Settings
            [
                'key' => 'footer_about',
                'value' => 'Sekolah Kami adalah institusi pendidikan yang berkomitmen memberikan pendidikan berkualitas tinggi dengan fasilitas modern dan tenaga pengajar profesional.',
                'type' => 'textarea',
                'group' => 'footer',
                'label' => 'Tentang Sekolah',
                'description' => 'Deskripsi singkat sekolah di footer'
            ],
            [
                'key' => 'footer_address',
                'value' => 'Jl. Pendidikan Raya No. 123, Jakarta Pusat, DKI Jakarta 10110',
                'type' => 'textarea',
                'group' => 'footer',
                'label' => 'Alamat',
                'description' => 'Alamat lengkap sekolah'
            ],
            [
                'key' => 'footer_phone',
                'value' => '(021) 123-4567',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Telepon Footer',
                'description' => 'Nomor telepon di footer'
            ],
            [
                'key' => 'footer_email',
                'value' => 'info@sekolahkami.sch.id',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Email Footer',
                'description' => 'Email di footer'
            ],
            [
                'key' => 'footer_copyright',
                'value' => 'Sekolah Kami. All rights reserved.',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Copyright Text',
                'description' => 'Teks copyright di footer'
            ],

            // Social Media
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/sekolahkami',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Facebook URL',
                'description' => 'Link Facebook sekolah'
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/sekolahkami',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Instagram URL',
                'description' => 'Link Instagram sekolah'
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/sekolahkami',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'YouTube URL',
                'description' => 'Link YouTube sekolah'
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/sekolahkami',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Twitter URL',
                'description' => 'Link Twitter sekolah'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
