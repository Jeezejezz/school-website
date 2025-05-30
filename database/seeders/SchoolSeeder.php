<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::create([
            'name' => 'SMA Negeri 1 Jakarta',
            'description' => 'SMA Negeri 1 Jakarta adalah sekolah menengah atas unggulan yang berkomitmen memberikan pendidikan berkualitas tinggi dengan mengintegrasikan teknologi modern dan nilai-nilai karakter untuk mempersiapkan siswa menghadapi tantangan masa depan.',
            'vision' => 'Menjadi sekolah unggulan yang menghasilkan lulusan cerdas, berkarakter mulia, dan berdaya saing global.',
            'mission' => 'Menyelenggarakan pendidikan berkualitas dengan pendekatan holistik, mengembangkan potensi akademik dan non-akademik siswa, serta membentuk karakter yang berakhlak mulia dan siap berkontribusi untuk bangsa.',
            'history' => 'Didirikan pada tahun 1995, SMA Negeri 1 Jakarta telah menjadi salah satu sekolah terdepan dalam memberikan pendidikan berkualitas. Dengan pengalaman lebih dari 25 tahun, sekolah ini telah menghasilkan ribuan alumni yang sukses di berbagai bidang dan berkontribusi positif bagi masyarakat.',
            'address' => 'Jl. Pendidikan Raya No. 123, Jakarta Pusat, DKI Jakarta 10110',
            'phone' => '(021) 3456-7890',
            'email' => 'info@sman1jakarta.sch.id',
            'website' => 'https://www.sman1jakarta.sch.id',
            'established_year' => 1995
        ]);
    }
}
