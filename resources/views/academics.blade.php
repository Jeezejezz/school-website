@extends('layouts.app')

@section('title', 'Academics - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Program Akademik</h1>
                <p class="lead">Kurikulum dan program pendidikan unggulan</p>
            </div>
        </div>
    </div>
</section>

<!-- Academic Programs -->
<section class="py-5">
    <div class="container">
        @if($academics->count() > 0)
        <!-- Filter by Level -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="btn-group" role="group" aria-label="Filter by level">
                    <button type="button" class="btn btn-outline-primary active" data-filter="all">Semua Program</button>
                    @foreach($levels as $level)
                    <button type="button" class="btn btn-outline-{{ $level->color }}" data-filter="{{ $level->name }}">
                        {{ $level->display_name }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Academic Programs Grid -->
        <div class="row g-4" id="academic-programs">
            @foreach($academics as $academic)
            <div class="col-lg-4 col-md-6 academic-item" data-level="{{ $academic->level }}">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            @php
                                $levelData = $academicLevels->where('name', $academic->level)->first();
                                $levelColor = $levelData ? $levelData->color : 'primary';
                                $levelDisplay = $levelData ? $levelData->display_name : $academic->level;
                            @endphp
                            <span class="badge bg-{{ $levelColor }} fs-6">{{ $levelDisplay }}</span>
                            <span class="badge bg-success">{{ $academic->duration }}</span>
                        </div>

                        <h5 class="card-title fw-bold">{{ $academic->program_name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($academic->description, 120) }}</p>

                        <div class="mb-3">
                            <h6 class="fw-bold text-primary">Kurikulum:</h6>
                            <p class="small text-muted mb-0">{{ Str::limit($academic->curriculum, 100) }}</p>
                        </div>

                        <a href="{{ route('academics.show', $academic->id) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Default Academic Programs -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary fs-6">SMA</span>
                            <span class="badge bg-success">3 Tahun</span>
                        </div>

                        <h5 class="card-title fw-bold">Program IPA</h5>
                        <p class="card-text text-muted">Program Ilmu Pengetahuan Alam yang mempersiapkan siswa untuk melanjutkan ke perguruan tinggi di bidang sains dan teknologi.</p>

                        <div class="mb-3">
                            <h6 class="fw-bold text-primary">Kurikulum:</h6>
                            <p class="small text-muted mb-0">Matematika, Fisika, Kimia, Biologi, dan mata pelajaran umum lainnya.</p>
                        </div>

                        <button class="btn btn-primary" disabled>
                            <i class="fas fa-arrow-right me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary fs-6">SMA</span>
                            <span class="badge bg-success">3 Tahun</span>
                        </div>

                        <h5 class="card-title fw-bold">Program IPS</h5>
                        <p class="card-text text-muted">Program Ilmu Pengetahuan Sosial yang mempersiapkan siswa untuk bidang sosial, ekonomi, dan humaniora.</p>

                        <div class="mb-3">
                            <h6 class="fw-bold text-primary">Kurikulum:</h6>
                            <p class="small text-muted mb-0">Sejarah, Geografi, Ekonomi, Sosiologi, dan mata pelajaran umum lainnya.</p>
                        </div>

                        <button class="btn btn-primary" disabled>
                            <i class="fas fa-arrow-right me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm card-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary fs-6">SMA</span>
                            <span class="badge bg-success">3 Tahun</span>
                        </div>

                        <h5 class="card-title fw-bold">Program Bahasa</h5>
                        <p class="card-text text-muted">Program Bahasa yang fokus pada pengembangan kemampuan linguistik dan komunikasi internasional.</p>

                        <div class="mb-3">
                            <h6 class="fw-bold text-primary">Kurikulum:</h6>
                            <p class="small text-muted mb-0">Bahasa Indonesia, Bahasa Inggris, Bahasa Mandarin, Sastra, dan mata pelajaran umum.</p>
                        </div>

                        <button class="btn btn-primary" disabled>
                            <i class="fas fa-arrow-right me-2"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Academic Features -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">Keunggulan Akademik</h2>
                <p class="text-muted">Fasilitas dan program unggulan untuk mendukung pembelajaran</p>
            </div>
        </div>

        @if($academicFeatures->count() > 0)
        <div class="row g-4">
            @foreach($academicFeatures as $feature)
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="bg-{{ $feature->color }} text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="{{ $feature->icon }} fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">{{ $feature->title }}</h5>
                    <p class="text-muted">{{ $feature->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Default Academic Features -->
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-microscope fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Laboratorium Modern</h5>
                    <p class="text-muted">Laboratorium sains dan komputer dengan peralatan terkini</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-book-open fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Perpustakaan Digital</h5>
                    <p class="text-muted">Koleksi buku digital dan akses ke database internasional</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Kelas Kecil</h5>
                    <p class="text-muted">Rasio guru dan siswa yang ideal untuk pembelajaran optimal</p>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-globe fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Program Internasional</h5>
                    <p class="text-muted">Kerjasama dengan sekolah internasional dan program pertukaran</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const academicItems = document.querySelectorAll('.academic-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Filter items
            academicItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-level') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endsection
