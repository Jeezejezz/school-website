@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Total Berita</h6>
                        <h2 class="mb-0">{{ $stats['total_news'] }}</h2>
                        <small class="text-white-50">{{ $stats['published_news'] }} dipublikasi</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-newspaper fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Galeri</h6>
                        <h2 class="mb-0">{{ $stats['total_gallery'] }}</h2>
                        <small class="text-white-50">{{ $stats['featured_gallery'] }} featured</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-images fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Program Akademik</h6>
                        <h2 class="mb-0">{{ $stats['total_academics'] }}</h2>
                        <small class="text-white-50">{{ $stats['active_academics'] }} aktif</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-book fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-white-50">Pesan Kontak</h6>
                        <h2 class="mb-0">{{ $stats['total_contacts'] }}</h2>
                        <small class="text-white-50">{{ $stats['unread_contacts'] }} belum dibaca</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-envelope fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.homepage.edit') }}" class="btn btn-primary w-100">
                            <i class="fas fa-home me-2"></i>Edit Beranda
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.hero-images.index') }}" class="btn btn-info w-100">
                            <i class="fas fa-images me-2"></i>Kelola Hero
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.news.create') }}" class="btn btn-success w-100">
                            <i class="fas fa-plus me-2"></i>Tambah Berita
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.academics.create') }}" class="btn btn-success w-100">
                            <i class="fas fa-plus me-2"></i>Tambah Program
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.school.edit') }}" class="btn btn-info w-100">
                            <i class="fas fa-edit me-2"></i>Edit Profil Sekolah
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-warning w-100">
                            <i class="fas fa-images me-2"></i>Upload Foto
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-envelope me-2"></i>Lihat Pesan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Content -->
<div class="row">
    <!-- Recent News -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-newspaper me-2"></i>
                    Berita Terbaru
                </h5>
                <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($recent_news->count() > 0)
                    @foreach($recent_news as $news)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">{{ Str::limit($news->title, 50) }}</h6>
                            <small class="text-muted">
                                {{ $news->published_at->format('d M Y') }} • {{ $news->author }}
                            </small>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge bg-{{ $news->is_published ? 'success' : 'warning' }}">
                                {{ $news->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center py-3">Belum ada berita</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-envelope me-2"></i>
                    Pesan Terbaru
                </h5>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body">
                @if($recent_contacts->count() > 0)
                    @foreach($recent_contacts as $contact)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <div class="flex-shrink-0">
                            <div class="bg-{{ $contact->is_read ? 'secondary' : 'warning' }} text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-envelope{{ $contact->is_read ? '-open' : '' }}"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">{{ $contact->name }}</h6>
                            <p class="mb-1 small">{{ Str::limit($contact->subject, 40) }}</p>
                            <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="badge bg-{{ $contact->is_read ? 'success' : 'warning' }}">
                                {{ $contact->is_read ? 'Read' : 'Unread' }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center py-3">Belum ada pesan</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Gallery -->
@if($recent_gallery->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-images me-2"></i>
                    Galeri Terbaru
                </h5>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm btn-outline-primary">
                    Kelola Gallery
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($recent_gallery as $gallery)
                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                        <div class="card">
                            @if($gallery->image_path)
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height: 120px; object-fit: cover;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 120px;">
                                <i class="fas fa-image fa-2x text-muted"></i>
                            </div>
                            @endif
                            <div class="card-body p-2">
                                <h6 class="card-title small mb-1">{{ Str::limit($gallery->title, 20) }}</h6>
                                <small class="text-muted">{{ ucfirst($gallery->category) }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
