@extends('admin.layouts.app')

@section('title', 'Detail Foto Gallery')
@section('page-title', 'Detail Foto Gallery')

@section('content')
<div class="row">
    <!-- Main Image -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-image me-2"></i>
                    {{ $gallery->title }}
                </h5>
                <div>
                    <span class="badge bg-primary fs-6 me-2">{{ $gallery->category }}</span>
                    @if($gallery->is_featured)
                    <span class="badge bg-warning">
                        <i class="fas fa-star me-1"></i>Unggulan
                    </span>
                    @endif
                </div>
            </div>
            <div class="card-body p-0">
                <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                     class="img-fluid w-100" 
                     alt="{{ $gallery->title }}"
                     style="max-height: 500px; object-fit: contain; background: #f8f9fa;">
            </div>
            @if($gallery->description)
            <div class="card-footer">
                <h6 class="text-primary fw-bold">Deskripsi</h6>
                <p class="mb-0">{{ $gallery->description }}</p>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" 
                       class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Foto
                    </a>
                    
                    <form action="{{ route('admin.galleries.toggle-featured', $gallery->id) }}" 
                          method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="btn btn-{{ $gallery->is_featured ? 'warning' : 'outline-warning' }} w-100">
                            <i class="fas fa-{{ $gallery->is_featured ? 'star' : 'star-o' }} me-2"></i>
                            {{ $gallery->is_featured ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}
                        </button>
                    </form>
                    
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>Hapus Foto
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Image Information -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Informasi Gambar</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td width="40%"><strong>ID:</strong></td>
                        <td>{{ $gallery->id }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kategori:</strong></td>
                        <td><span class="badge bg-primary">{{ $gallery->category }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($gallery->is_featured)
                            <span class="badge bg-warning">
                                <i class="fas fa-star me-1"></i>Unggulan
                            </span>
                            @else
                            <span class="badge bg-secondary">Normal</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Upload:</strong></td>
                        <td>{{ $gallery->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Update:</strong></td>
                        <td>{{ $gallery->updated_at->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>File:</strong></td>
                        <td>
                            <small class="text-muted">{{ basename($gallery->image_path) }}</small>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <!-- File Details -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Detail File</h6>
            </div>
            <div class="card-body">
                @php
                    $imagePath = storage_path('app/public/' . $gallery->image_path);
                    $fileSize = file_exists($imagePath) ? filesize($imagePath) : 0;
                    $imageInfo = file_exists($imagePath) ? getimagesize($imagePath) : null;
                @endphp
                
                <table class="table table-borderless table-sm">
                    @if($imageInfo)
                    <tr>
                        <td width="40%"><strong>Dimensi:</strong></td>
                        <td>{{ $imageInfo[0] }} x {{ $imageInfo[1] }} px</td>
                    </tr>
                    <tr>
                        <td><strong>Tipe:</strong></td>
                        <td>{{ strtoupper(pathinfo($gallery->image_path, PATHINFO_EXTENSION)) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Ukuran:</strong></td>
                        <td>{{ number_format($fileSize / 1024, 2) }} KB</td>
                    </tr>
                    <tr>
                        <td><strong>Path:</strong></td>
                        <td><small class="text-muted">{{ $gallery->image_path }}</small></td>
                    </tr>
                </table>
                
                <div class="mt-3">
                    <a href="{{ asset('storage/' . $gallery->image_path) }}" 
                       target="_blank" 
                       class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-external-link-alt me-2"></i>Buka di Tab Baru
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Navigasi</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.galleries.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>Daftar Gallery
                    </a>
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Upload Foto Baru
                    </a>
                    <a href="{{ route('gallery') }}" target="_blank" class="btn btn-outline-info">
                        <i class="fas fa-eye me-2"></i>Lihat Gallery Website
                    </a>
                </div>
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
                <p>Apakah Anda yakin ingin menghapus foto <strong>{{ $gallery->title }}</strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    File gambar akan dihapus permanen dan tidak dapat dikembalikan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" style="display: inline;">
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

@section('scripts')
<script>
function confirmDelete() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
