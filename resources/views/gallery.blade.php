@extends('layouts.app')

@section('title', 'Gallery - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Galeri Foto</h1>
                <p class="lead">Momen-momen berharga di sekolah kami</p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Content -->
<section class="py-5">
    <div class="container">
        @if($galleries->count() > 0)
        <!-- Category Filter -->
        @if($categories->count() > 1)
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="btn-group flex-wrap" role="group" aria-label="Category filter">
                    <a href="{{ route('gallery') }}" class="btn {{ !$category ? 'btn-primary' : 'btn-outline-primary' }}">
                        Semua Kategori
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('gallery', ['category' => $cat]) }}"
                       class="btn {{ $category == $cat ? 'btn-primary' : 'btn-outline-primary' }}">
                        {{ ucfirst($cat) }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Gallery Grid -->
        <div class="row g-4">
            @foreach($galleries as $gallery)
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item position-relative">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        @if($gallery->image_path)
                        <img src="{{ asset('storage/' . $gallery->image_path) }}"
                             class="card-img-top"
                             alt="{{ $gallery->title }}"
                             style="height: 250px; object-fit: cover; cursor: pointer;"
                             onclick="openModal('{{ asset('storage/' . $gallery->image_path) }}', '{{ $gallery->title }}', '{{ $gallery->description }}')">
                        @else
                        <img src="https://via.placeholder.com/400x250/6c757d/ffffff?text=Gallery"
                             class="card-img-top"
                             alt="{{ $gallery->title }}"
                             style="height: 250px; object-fit: cover; cursor: pointer;"
                             onclick="openModal('https://via.placeholder.com/800x600/6c757d/ffffff?text=Gallery', '{{ $gallery->title }}', '{{ $gallery->description }}')">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            @if($gallery->description)
                            <p class="card-text text-muted">{{ Str::limit($gallery->description, 80) }}</p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary">{{ ucfirst($gallery->category) }}</span>
                                @if($gallery->is_featured)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i>Featured
                                </span>
                                @endif
                            </div>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center opacity-0 hover-overlay">
                            <button class="btn btn-light btn-lg"
                                    onclick="openModal('{{ $gallery->image_path ? asset('storage/' . $gallery->image_path) : 'https://via.placeholder.com/800x600/6c757d/ffffff?text=Gallery' }}', '{{ $gallery->title }}', '{{ $gallery->description }}')">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $galleries->appends(request()->query())->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-5">
            <i class="fas fa-images fa-5x text-muted mb-4"></i>
            <h3 class="text-muted">Belum Ada Galeri</h3>
            <p class="text-muted">Foto-foto kegiatan sekolah akan ditampilkan di sini.</p>
        </div>
        @endif
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gallery Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" alt="" class="img-fluid w-100">
                <div class="p-3">
                    <p id="modalDescription" class="mb-0 text-muted"></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.gallery-item {
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
}

.gallery-item:hover .hover-overlay {
    opacity: 1 !important;
    transition: opacity 0.3s ease;
}

.hover-overlay {
    transition: opacity 0.3s ease;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.gallery-item:hover .card-img-top {
    transform: scale(1.05);
}
</style>
@endsection

@section('scripts')
<script>
function openModal(imageSrc, title, description) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModalLabel').textContent = title;
    document.getElementById('modalDescription').textContent = description || '';

    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Keyboard navigation for modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
        if (modal) {
            modal.hide();
        }
    }
});
</script>
@endsection
