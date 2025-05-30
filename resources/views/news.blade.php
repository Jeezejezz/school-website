@extends('layouts.app')

@section('title', 'News - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Berita & Pengumuman</h1>
                <p class="lead">Informasi terkini dari sekolah kami</p>
            </div>
        </div>
    </div>
</section>

<!-- News Content -->
<section class="py-5">
    <div class="container">
        @if($news->count() > 0)
        <div class="row g-4">
            @foreach($news as $item)
            <div class="col-lg-6">
                <div class="card news-card h-100">
                    @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 250px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/500x250/6c757d/ffffff?text=News" class="card-img-top" alt="{{ $item->title }}" style="height: 250px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary">{{ $item->published_at->format('d M Y') }}</span>
                            <small class="text-muted">By {{ $item->author }}</small>
                        </div>
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ Str::limit(strip_tags($item->content), 150) }}</p>
                        <a href="{{ route('news.show', $item->id) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $news->links() }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-newspaper fa-5x text-muted mb-4"></i>
            <h3 class="text-muted">Belum Ada Berita</h3>
            <p class="text-muted">Berita dan pengumuman akan ditampilkan di sini.</p>
        </div>
        @endif
    </div>
</section>
@endsection
