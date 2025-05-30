@extends('layouts.app')

@section('title', $gallery->title . ' - Gallery - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('gallery') }}" class="text-white">Gallery</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">{{ Str::limit($gallery->title, 30) }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Detail Content -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <!-- Main Image -->
                        <div class="position-relative">
                            @if($gallery->image && $gallery->image !== 'placeholder')
                            <img src="{{ asset('storage/' . $gallery->image) }}" 
                                 class="img-fluid w-100" 
                                 alt="{{ $gallery->title }}"
                                 style="max-height: 600px; object-fit: cover;">
                            @else
                            <img src="https://via.placeholder.com/1200x600/6c757d/ffffff?text={{ urlencode($gallery->title) }}" 
                                 class="img-fluid w-100" 
                                 alt="{{ $gallery->title }}"
                                 style="max-height: 600px; object-fit: cover;">
                            @endif
                            
                            <!-- Image Overlay -->
                            <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white p-4">
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <h1 class="h3 fw-bold mb-2">{{ $gallery->title }}</h1>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="badge bg-primary">{{ ucfirst($gallery->category) }}</span>
                                            @if($gallery->is_featured)
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-star me-1"></i>Featured
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-light btn-sm" onclick="downloadImage()">
                                            <i class="fas fa-download me-1"></i>Download
                                        </button>
                                        <button class="btn btn-light btn-sm" onclick="shareImage()">
                                            <i class="fas fa-share me-1"></i>Share
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Image Details -->
                        <div class="p-4">
                            @if($gallery->description)
                            <div class="mb-4">
                                <h5 class="fw-bold text-primary mb-3">Deskripsi</h5>
                                <p class="lead">{{ $gallery->description }}</p>
                            </div>
                            @endif
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-primary">Kategori</h6>
                                    <p class="text-muted">{{ ucfirst($gallery->category) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold text-primary">Status</h6>
                                    <p class="text-muted">
                                        @if($gallery->is_featured)
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star me-1"></i>Featured
                                        </span>
                                        @else
                                        <span class="badge bg-secondary">Regular</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('gallery') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Gallery
                                </a>
                                
                                <div class="d-flex gap-2">
                                    <a href="{{ route('gallery', ['category' => $gallery->category]) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-images me-2"></i>Lihat {{ ucfirst($gallery->category) }} Lainnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Images -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="fw-bold text-center mb-4">Galeri Lainnya</h3>
                <div class="row g-3">
                    @php
                    $relatedGalleries = \App\Models\Gallery::where('id', '!=', $gallery->id)
                                                          ->where('category', $gallery->category)
                                                          ->take(4)
                                                          ->get();
                    if($relatedGalleries->count() < 4) {
                        $additionalGalleries = \App\Models\Gallery::where('id', '!=', $gallery->id)
                                                                 ->where('category', '!=', $gallery->category)
                                                                 ->take(4 - $relatedGalleries->count())
                                                                 ->get();
                        $relatedGalleries = $relatedGalleries->merge($additionalGalleries);
                    }
                    @endphp
                    
                    @foreach($relatedGalleries as $related)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm gallery-item">
                            <a href="{{ route('gallery.show', $related->id) }}" class="text-decoration-none">
                                @if($related->image && $related->image !== 'placeholder')
                                <img src="{{ asset('storage/' . $related->image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $related->title }}"
                                     style="height: 200px; object-fit: cover;">
                                @else
                                <img src="https://via.placeholder.com/300x200/6c757d/ffffff?text={{ urlencode($related->title) }}" 
                                     class="card-img-top" 
                                     alt="{{ $related->title }}"
                                     style="height: 200px; object-fit: cover;">
                                @endif
                                
                                <div class="card-body">
                                    <h6 class="card-title text-dark">{{ $related->title }}</h6>
                                    <small class="text-muted">{{ ucfirst($related->category) }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.gallery-item {
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
}

.gallery-item img {
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
}
</style>
@endsection

@section('scripts')
<script>
function downloadImage() {
    @if($gallery->image && $gallery->image !== 'placeholder')
    const link = document.createElement('a');
    link.href = '{{ asset('storage/' . $gallery->image) }}';
    link.download = '{{ $gallery->title }}.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    @else
    alert('Gambar tidak tersedia untuk diunduh.');
    @endif
}

function shareImage() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $gallery->title }}',
            text: '{{ $gallery->description }}',
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
