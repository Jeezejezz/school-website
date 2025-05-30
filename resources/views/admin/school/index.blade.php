@extends('admin.layouts.app')

@section('title', 'Profil Sekolah')
@section('page-title', 'Profil Sekolah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-school me-2"></i>
                    Informasi Sekolah
                </h5>
                <a href="{{ route('admin.school.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
            </div>
            <div class="card-body">
                @if($school)
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        @if($school->logo)
                        <img src="{{ asset('storage/' . $school->logo) }}" alt="Logo Sekolah" class="img-fluid rounded shadow" style="max-height: 200px;">
                        @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center shadow" style="height: 200px;">
                            <i class="fas fa-school fa-4x text-muted"></i>
                        </div>
                        @endif
                        <h4 class="mt-3">{{ $school->name }}</h4>
                        <p class="text-muted">Didirikan tahun {{ $school->established_year }}</p>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <h6 class="text-primary fw-bold">Deskripsi</h6>
                                <p>{{ $school->description }}</p>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <h6 class="text-primary fw-bold">Visi</h6>
                                <p>{{ $school->vision }}</p>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <h6 class="text-primary fw-bold">Misi</h6>
                                <p>{{ $school->mission }}</p>
                            </div>
                            
                            <div class="col-12 mb-4">
                                <h6 class="text-primary fw-bold">Sejarah</h6>
                                <p>{{ $school->history }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold">Informasi Kontak</h6>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <span>{{ $school->address }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-phone text-primary me-3"></i>
                            <span>{{ $school->phone }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <span>{{ $school->email }}</span>
                        </div>
                        @if($school->website)
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-globe text-primary me-3"></i>
                            <a href="{{ $school->website }}" target="_blank" class="text-decoration-none">{{ $school->website }}</a>
                        </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold">Statistik</h6>
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body py-3">
                                        <h4 class="mb-0">{{ \App\Models\News::count() }}</h4>
                                        <small>Total Berita</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body py-3">
                                        <h4 class="mb-0">{{ \App\Models\Gallery::count() }}</h4>
                                        <small>Total Galeri</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body py-3">
                                        <h4 class="mb-0">{{ \App\Models\Academic::count() }}</h4>
                                        <small>Program Akademik</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body py-3">
                                        <h4 class="mb-0">{{ \App\Models\Contact::count() }}</h4>
                                        <small>Total Pesan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-school fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Profil Sekolah Belum Diatur</h4>
                    <p class="text-muted">Silakan klik tombol "Edit Profil" untuk mengatur informasi sekolah.</p>
                    <a href="{{ route('admin.school.edit') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Profil Sekolah
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
