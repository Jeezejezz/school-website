<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsData = [
            [
                'title' => 'Penerimaan Siswa Baru Tahun Ajaran 2024/2025',
                'content' => 'Sekolah kami membuka pendaftaran siswa baru untuk tahun ajaran 2024/2025. Pendaftaran dibuka mulai tanggal 1 Juni hingga 30 Juni 2024. Calon siswa dapat mendaftar secara online melalui website resmi sekolah atau datang langsung ke sekolah. Persyaratan pendaftaran meliputi fotokopi ijazah, fotokopi rapor, pas foto, dan formulir pendaftaran yang telah diisi lengkap.',
                'author' => 'Admin Sekolah',
                'published_at' => Carbon::now()->subDays(5),
                'is_published' => true
            ],
            [
                'title' => 'Prestasi Gemilang di Olimpiade Sains Nasional',
                'content' => 'Siswa-siswi SMA Negeri 1 Jakarta meraih prestasi membanggakan dalam Olimpiade Sains Nasional 2024. Tim kami berhasil meraih 3 medali emas, 5 medali perak, dan 7 medali perunggu dalam berbagai bidang sains. Prestasi ini membuktikan kualitas pendidikan dan dedikasi guru-guru dalam membimbing siswa mencapai potensi terbaik mereka.',
                'author' => 'Kepala Sekolah',
                'published_at' => Carbon::now()->subDays(10),
                'is_published' => true
            ],
            [
                'title' => 'Renovasi Laboratorium Komputer Selesai',
                'content' => 'Renovasi laboratorium komputer telah selesai dilaksanakan. Laboratorium baru dilengkapi dengan 40 unit komputer terbaru, proyektor interaktif, dan sistem jaringan yang lebih cepat. Fasilitas ini akan mendukung pembelajaran teknologi informasi dan komunikasi yang lebih efektif bagi siswa.',
                'author' => 'Wakil Kepala Sekolah',
                'published_at' => Carbon::now()->subDays(15),
                'is_published' => true
            ],
            [
                'title' => 'Kegiatan Bakti Sosial di Panti Asuhan',
                'content' => 'Siswa-siswi kelas XI mengadakan kegiatan bakti sosial di Panti Asuhan Kasih Sayang. Kegiatan ini meliputi pemberian bantuan berupa sembako, alat tulis, dan buku-buku pelajaran. Selain itu, siswa juga mengadakan kegiatan belajar bersama dan permainan edukatif untuk anak-anak panti asuhan.',
                'author' => 'OSIS',
                'published_at' => Carbon::now()->subDays(20),
                'is_published' => true
            ],
            [
                'title' => 'Workshop Pengembangan Karakter Siswa',
                'content' => 'Sekolah mengadakan workshop pengembangan karakter siswa yang diikuti oleh seluruh siswa kelas X. Workshop ini bertujuan untuk memperkuat nilai-nilai moral dan etika dalam kehidupan sehari-hari. Materi workshop meliputi kepemimpinan, kerjasama tim, dan komunikasi efektif.',
                'author' => 'Guru BK',
                'published_at' => Carbon::now()->subDays(25),
                'is_published' => true
            ]
        ];

        foreach ($newsData as $news) {
            News::create($news);
        }
    }
}
