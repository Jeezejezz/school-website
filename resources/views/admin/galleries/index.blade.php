@extends('admin.layouts.app')

@section('title', 'Manajemen Gallery')
@section('page-title', 'Manajemen Gallery')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-images me-2"></i>
                    Daftar Foto Gallery
                </h5>
                <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Upload Foto
                </a>
            </div>
            <div class="card-body">
                @if($galleries->count() > 0)
                <div class="row g-4">
                    @foreach($galleries as $gallery)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card h-100 border-0 shadow-sm gallery-item">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                     class="card-img-top" 
                                     alt="{{ $gallery->title }}"
                                     style="height: 200px; object-fit: cover;">
                                
                                <!-- Featured Badge -->
                                @if($gallery->is_featured)
                                <span class="position-absolute top-0 start-0 badge bg-warning m-2">
                                    <i class="fas fa-star me-1"></i>Unggulan
                                </span>
                                @endif
                                
                                <!-- Category Badge -->
                                <span class="position-absolute top-0 end-0 badge bg-primary m-2">
                                    {{ $gallery->category }}
                                </span>
                            </div>
                            
                            <div class="card-body">
                                <h6 class="card-title fw-bold">{{ $gallery->title }}</h6>
                                @if($gallery->description)
                                <p class="card-text text-muted small">{{ Str::limit($gallery->description, 80) }}</p>
                                @endif
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $gallery->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-transparent">
                                <div class="btn-group w-100" role="group">
                                    <a href="{{ route('admin.galleries.show', $gallery->id) }}" 
                                       class="btn btn-outline-info btn-sm" 
                                       title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.galleries.toggle-featured', $gallery->id) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-outline-{{ $gallery->is_featured ? 'warning' : 'secondary' }} btn-sm" 
                                                title="{{ $gallery->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}">
                                            <i class="fas fa-{{ $gallery->is_featured ? 'star' : 'star-o' }}"></i>
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" 
                                       class="btn btn-outline-primary btn-sm" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <button type="button" 
                                            class="btn btn-outline-danger btn-sm" 
                                            title="Hapus"
                                            onclick="confirmDelete({{ $gallery->id }}, '{{ $gallery->title }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $galleries->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-images fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Foto di Gallery</h4>
                    <p class="text-muted">Mulai upload foto untuk gallery sekolah.</p>
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Upload Foto Pertama
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h3 class="mb-0">{{ $galleries->total() }}</h3>
                <small>Total Foto</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                @php
                    $featuredCount = \App\Models\Gallery::where('is_featured', true)->count();
                @endphp
                <h3 class="mb-0">{{ $featuredCount }}</h3>
                <small>Foto Unggulan</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                @php
                    $categoriesCount = \App\Models\Gallery::distinct('category')->count('category');
                @endphp
                <h3 class="mb-0">{{ $categoriesCount }}</h3>
                <small>Kategori</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                @php
                    $todayCount = \App\Models\Gallery::whereDate('created_at', today())->count();
                @endphp
                <h3 class="mb-0">{{ $todayCount }}</h3>
                <small>Upload Hari Ini</small>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus foto <strong id="galleryTitle"></strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    File gambar akan dihapus permanen dan tidak dapat dikembalikan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.gallery-item {
    transition: transform 0.2s;
}

.gallery-item:hover {
    transform: translateY(-5px);
}

.card-img-top {
    transition: transform 0.3s;
}

.gallery-item:hover .card-img-top {
    transform: scale(1.05);
}
</style>
@endsection

@section('scripts')
<script>
function confirmDelete(galleryId, galleryTitle) {
    document.getElementById('galleryTitle').textContent = galleryTitle;
    document.getElementById('deleteForm').action = `/admin/galleries/${galleryId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
