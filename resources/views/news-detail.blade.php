@extends('layouts.app')

@section('title', $news->title . ' - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news') }}" class="text-white">News</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">{{ Str::limit($news->title, 50) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- News Detail Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm">
                    @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="height: 400px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/800x400/6c757d/ffffff?text=News" class="card-img-top" alt="{{ $news->title }}" style="height: 400px; object-fit: cover;">
                    @endif
                    
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>
                                <span class="text-muted">{{ $news->published_at->format('d F Y') }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user text-primary me-2"></i>
                                <span class="text-muted">{{ $news->author }}</span>
                            </div>
                        </div>
                        
                        <h1 class="fw-bold mb-4">{{ $news->title }}</h1>
                        
                        <div class="content">
                            {!! nl2br(e($news->content)) !!}
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('news') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Berita
                            </a>
                            
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                                    <i class="fas fa-print me-1"></i>Print
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="shareNews()">
                                    <i class="fas fa-share me-1"></i>Share
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-4">
                <!-- Related News -->
                @if($relatedNews->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-newspaper me-2"></i>Berita Terkait</h5>
                    </div>
                    <div class="card-body p-0">
                        @foreach($relatedNews as $related)
                        <div class="p-3 border-bottom">
                            <h6 class="mb-2">
                                <a href="{{ route('news.show', $related->id) }}" class="text-decoration-none text-dark">
                                    {{ $related->title }}
                                </a>
                            </h6>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>{{ $related->published_at->format('d M Y') }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Quick Links -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-link me-2"></i>Quick Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('about') }}" class="list-group-item list-group-item-action border-0">
                                <i class="fas fa-info-circle me-2 text-primary"></i>About Us
                            </a>
                            <a href="{{ route('academics') }}" class="list-group-item list-group-item-action border-0">
                                <i class="fas fa-book me-2 text-primary"></i>Academics
                            </a>
                            <a href="{{ route('gallery') }}" class="list-group-item list-group-item-action border-0">
                                <i class="fas fa-images me-2 text-primary"></i>Gallery
                            </a>
                            <a href="{{ route('contact') }}" class="list-group-item list-group-item-action border-0">
                                <i class="fas fa-envelope me-2 text-primary"></i>Contact
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
function shareNews() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $news->title }}',
            text: '{{ Str::limit(strip_tags($news->content), 100) }}',
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Link berhasil disalin ke clipboard!');
        });
    }
}
</script>
@endsection
