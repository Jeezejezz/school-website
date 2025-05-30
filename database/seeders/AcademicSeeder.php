<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Academic;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicData = [
            [
                'program_name' => 'Program IPA (Ilmu Pengetahuan Alam)',
                'description' => 'Program IPA dirancang untuk siswa yang memiliki minat dan bakat di bidang sains dan teknologi. Program ini mempersiapkan siswa untuk melanjutkan pendidikan ke perguruan tinggi di bidang kedokteran, teknik, farmasi, dan ilmu sains lainnya.',
                'level' => 'SMA',
                'curriculum' => 'Kurikulum Merdeka dengan fokus pada Matematika Wajib, Matematika Lanjutan, Fisika, Kimia, Biologi, Bahasa Indonesia, Bahasa Inggris, dan mata pelajaran pilihan sesuai minat siswa.',
                'duration' => '3 Tahun',
                'career_prospects' => "Lulusan Program IPA memiliki peluang karir yang sangat luas di berbagai bidang:\n\n• Dokter dan Tenaga Medis (Dokter Umum, Dokter Spesialis, Perawat, Bidan)\n• Insinyur dan Teknisi (Teknik Sipil, Elektro, Mesin, Informatika)\n• Peneliti dan Ilmuwan (Peneliti di LIPI, BPPT, Universitas)\n• IT dan Software Developer (Programmer, System Analyst, Data Scientist)\n• Farmasi dan Kesehatan (Apoteker, Ahli Gizi, Terapis)\n• Pendidikan (Guru IPA, Dosen, Peneliti Pendidikan)\n\nProgram ini memberikan dasar yang kuat untuk melanjutkan ke perguruan tinggi dengan jurusan:\n- Kedokteran dan Kesehatan\n- Teknik dan Teknologi\n- Matematika dan Ilmu Pengetahuan Alam\n- Farmasi dan Bioteknologi",
                'requirements' => "Persyaratan untuk masuk Program IPA:\n\n📋 PERSYARATAN AKADEMIK:\n• Lulus SMP/MTs dengan nilai rata-rata minimal 7.5\n• Nilai Matematika dan IPA minimal 8.0\n• Lulus tes masuk (Matematika, IPA, Bahasa Indonesia, Bahasa Inggris)\n• Tidak buta warna untuk calon siswa yang ingin masuk jurusan tertentu\n\n📄 BERKAS ADMINISTRASI:\n• Fotokopi ijazah SMP/MTs yang telah dilegalisir\n• Fotokopi SKHUN yang telah dilegalisir\n• Fotokopi rapor semester 1-6 SMP/MTs\n• Fotokopi akta kelahiran\n• Fotokopi kartu keluarga\n• Pas foto terbaru ukuran 3x4 sebanyak 6 lembar\n• Surat keterangan sehat dari dokter\n• Surat keterangan berkelakuan baik dari sekolah asal",
                'is_active' => true
            ],
            [
                'program_name' => 'Program IPS (Ilmu Pengetahuan Sosial)',
                'description' => 'Program IPS mengembangkan pemahaman siswa tentang fenomena sosial, ekonomi, dan budaya. Program ini ideal bagi siswa yang tertarik dengan bidang hukum, ekonomi, manajemen, hubungan internasional, dan ilmu sosial lainnya.',
                'level' => 'SMA',
                'curriculum' => 'Kurikulum Merdeka dengan fokus pada Sejarah, Geografi, Ekonomi, Sosiologi, Bahasa Indonesia, Bahasa Inggris, Matematika Wajib, dan mata pelajaran pilihan.',
                'duration' => '3 Tahun',
                'career_prospects' => "Lulusan Program IPS memiliki berbagai peluang karir di sektor publik dan swasta:\n\n• Hukum dan Keadilan (Pengacara, Hakim, Jaksa, Notaris)\n• Ekonomi dan Bisnis (Ekonom, Analis Keuangan, Konsultan Bisnis)\n• Manajemen dan Administrasi (Manajer, HRD, Admin Publik)\n• Hubungan Internasional (Diplomat, Konsultan Politik, Jurnalis)\n• Pendidikan dan Penelitian (Guru IPS, Dosen, Peneliti Sosial)\n• Media dan Komunikasi (Wartawan, Public Relations, Content Creator)\n\nJurusan perguruan tinggi yang dapat dipilih:\n- Hukum dan Ilmu Politik\n- Ekonomi dan Bisnis\n- Hubungan Internasional\n- Ilmu Komunikasi\n- Psikologi dan Sosiologi",
                'requirements' => "Persyaratan untuk masuk Program IPS:\n\n📋 PERSYARATAN AKADEMIK:\n• Lulus SMP/MTs dengan nilai rata-rata minimal 7.0\n• Nilai Bahasa Indonesia dan IPS minimal 7.5\n• Lulus tes masuk (Bahasa Indonesia, IPS, Matematika, Bahasa Inggris)\n• Memiliki minat dan bakat di bidang sosial dan humaniora\n\n📄 BERKAS ADMINISTRASI:\n• Fotokopi ijazah SMP/MTs yang telah dilegalisir\n• Fotokopi SKHUN yang telah dilegalisir\n• Fotokopi rapor semester 1-6 SMP/MTs\n• Fotokopi akta kelahiran\n• Fotokopi kartu keluarga\n• Pas foto terbaru ukuran 3x4 sebanyak 6 lembar\n• Surat keterangan sehat dari dokter\n• Surat keterangan berkelakuan baik dari sekolah asal",
                'is_active' => true
            ],
            [
                'program_name' => 'Program Bahasa dan Budaya',
                'description' => 'Program Bahasa mengembangkan kemampuan komunikasi dan apresiasi budaya siswa. Program ini cocok untuk siswa yang ingin berkarir di bidang pendidikan, jurnalistik, penerjemahan, pariwisata, dan hubungan internasional.',
                'level' => 'SMA',
                'curriculum' => 'Kurikulum Merdeka dengan fokus pada Bahasa Indonesia, Bahasa Inggris, Bahasa Asing Pilihan (Mandarin/Jepang), Sastra, Antropologi, dan mata pelajaran umum.',
                'duration' => '3 Tahun',
                'career_prospects' => "Lulusan Program Bahasa dan Budaya memiliki peluang karir yang beragam:\n\n• Pendidikan dan Pengajaran (Guru Bahasa, Dosen, Tutor Privat)\n• Media dan Jurnalistik (Wartawan, Editor, Content Writer)\n• Penerjemahan dan Interpretasi (Penerjemah, Interpreter, Subtitler)\n• Pariwisata dan Perhotelan (Tour Guide, Travel Agent, Hotel Manager)\n• Hubungan Internasional (Diplomat, Cultural Attaché, NGO Worker)\n• Kreatif dan Seni (Penulis, Penyair, Sutradara, Produser)\n\nJurusan perguruan tinggi yang sesuai:\n- Sastra dan Bahasa\n- Ilmu Komunikasi\n- Hubungan Internasional\n- Pariwisata\n- Antropologi dan Budaya\n- Pendidikan Bahasa",
                'requirements' => "Persyaratan untuk masuk Program Bahasa dan Budaya:\n\n📋 PERSYARATAN AKADEMIK:\n• Lulus SMP/MTs dengan nilai rata-rata minimal 7.0\n• Nilai Bahasa Indonesia dan Bahasa Inggris minimal 7.5\n• Lulus tes masuk (Bahasa Indonesia, Bahasa Inggris, Tes Bakat Bahasa)\n• Memiliki minat dan bakat di bidang bahasa dan sastra\n\n📄 BERKAS ADMINISTRASI:\n• Fotokopi ijazah SMP/MTs yang telah dilegalisir\n• Fotokopi SKHUN yang telah dilegalisir\n• Fotokopi rapor semester 1-6 SMP/MTs\n• Fotokopi akta kelahiran\n• Fotokopi kartu keluarga\n• Pas foto terbaru ukuran 3x4 sebanyak 6 lembar\n• Surat keterangan sehat dari dokter\n• Surat keterangan berkelakuan baik dari sekolah asal\n\n🎯 PERSYARATAN KHUSUS:\n• Portofolio karya tulis (opsional)\n• Sertifikat prestasi bahasa (jika ada)",
                'is_active' => true
            ]
        ];

        foreach ($academicData as $academic) {
            Academic::create($academic);
        }
    }
}
