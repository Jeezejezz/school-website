@extends('layouts.app')

@section('title', $academic->program_name . ' - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('academics') }}" class="text-white">Academics</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">{{ Str::limit($academic->program_name, 30) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Academic Detail Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <span class="badge bg-primary fs-6 mb-2">{{ $academic->level }}</span>
                                <h1 class="fw-bold">{{ $academic->program_name }}</h1>
                            </div>
                            <span class="badge bg-success fs-6">{{ $academic->duration }}</span>
                        </div>

                        <div class="mb-5">
                            <h3 class="fw-bold text-primary mb-3">Deskripsi Program</h3>
                            <p class="lead">{{ $academic->description }}</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="fw-bold text-primary mb-3">Kurikulum</h3>
                            <p>{{ $academic->curriculum }}</p>
                        </div>

                        @if($academic->career_prospects)
                        <div class="mb-5">
                            <h3 class="fw-bold text-primary mb-3">
                                <i class="fas fa-briefcase me-2"></i>Prospek Karir
                            </h3>
                            <div class="bg-light p-4 rounded">
                                <div style="white-space: pre-wrap;">{{ $academic->career_prospects }}</div>
                            </div>
                        </div>
                        @else
                        <div class="mb-5">
                            <h3 class="fw-bold text-primary mb-3">
                                <i class="fas fa-briefcase me-2"></i>Prospek Karir
                            </h3>
                            @if($academic->level == 'SMA')
                                @if(str_contains(strtolower($academic->program_name), 'ipa'))
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-user-md text-primary me-2"></i>
                                            <span>Dokter & Tenaga Medis</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-cogs text-primary me-2"></i>
                                            <span>Insinyur & Teknisi</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-flask text-primary me-2"></i>
                                            <span>Peneliti & Ilmuwan</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-laptop-code text-primary me-2"></i>
                                            <span>IT & Software Developer</span>
                                        </div>
                                    </div>
                                </div>
                                @elseif(str_contains(strtolower($academic->program_name), 'ips'))
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-balance-scale text-primary me-2"></i>
                                            <span>Pengacara & Hakim</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-chart-line text-primary me-2"></i>
                                            <span>Ekonom & Analis</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-users text-primary me-2"></i>
                                            <span>Manajer & Konsultan</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-globe text-primary me-2"></i>
                                            <span>Diplomat & Hubungan Internasional</span>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-chalkboard-teacher text-primary me-2"></i>
                                            <span>Guru & Pendidik</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-language text-primary me-2"></i>
                                            <span>Penerjemah & Interpreter</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-newspaper text-primary me-2"></i>
                                            <span>Jurnalis & Penulis</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-plane text-primary me-2"></i>
                                            <span>Pariwisata & Perhotelan</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Informasi prospek karir akan segera ditambahkan.
                            </div>
                            @endif
                        </div>
                        @endif

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('academics') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Program Akademik
                            </a>

                            <a href="{{ route('contact') }}" class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Program Info -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Program</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong>Jenjang:</strong>
                            <span class="badge bg-primary">{{ $academic->level }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong>Durasi:</strong>
                            <span>{{ $academic->duration }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <strong>Status:</strong>
                            <span class="badge bg-success">{{ $academic->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Requirements -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Persyaratan Masuk</h5>
                    </div>
                    <div class="card-body">
                        @if($academic->requirements)
                        <div style="white-space: pre-wrap;">{{ $academic->requirements }}</div>
                        @else
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Lulus SMP/MTs dengan nilai rata-rata minimal 7.0
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Mengikuti tes masuk sekolah
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Melengkapi berkas administrasi
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Sehat jasmani dan rohani
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Butuh Informasi?</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="mb-3">Hubungi kami untuk informasi lebih lanjut tentang program ini.</p>
                        <a href="{{ route('contact') }}" class="btn btn-info text-white">
                            <i class="fas fa-envelope me-2"></i>Hubungi Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
