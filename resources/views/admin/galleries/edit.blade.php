@extends('admin.layouts.app')

@section('title', 'Edit Foto Gallery')
@section('page-title', 'Edit Foto Gallery')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Foto: {{ $gallery->title }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Foto</h6>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $gallery->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Berikan judul yang menarik untuk foto ini</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="3">{{ old('description', $gallery->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi opsional tentang foto ini</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="form-select @error('category') is-invalid @enderror" 
                                                id="category" name="category" required>
                                            <option value="">Pilih Kategori</option>
                                            <option value="Kegiatan Sekolah" {{ old('category', $gallery->category) == 'Kegiatan Sekolah' ? 'selected' : '' }}>Kegiatan Sekolah</option>
                                            <option value="Fasilitas" {{ old('category', $gallery->category) == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            <option value="Prestasi" {{ old('category', $gallery->category) == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                                            <option value="Ekstrakurikuler" {{ old('category', $gallery->category) == 'Ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler</option>
                                            <option value="Acara Khusus" {{ old('category', $gallery->category) == 'Acara Khusus' ? 'selected' : '' }}>Acara Khusus</option>
                                            <option value="Lainnya" {{ old('category', $gallery->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Ganti Gambar</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar. Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sidebar -->
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Pengaturan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" 
                                                   {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                <strong>Foto Unggulan</strong>
                                            </label>
                                        </div>
                                        <small class="text-muted">Foto unggulan akan ditampilkan di halaman utama</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Current Image -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Gambar Saat Ini</h6>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                         alt="{{ $gallery->title }}" 
                                         class="img-fluid rounded mb-2" 
                                         style="max-height: 200px;">
                                    <p class="small text-muted mb-0">{{ basename($gallery->image_path) }}</p>
                                </div>
                            </div>
                            
                            <!-- New Image Preview -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Preview Gambar Baru</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div id="imagePreview" class="mb-3" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                    <div id="noPreview" class="text-muted">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p>Pilih gambar baru untuk melihat preview</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Gallery Info -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Informasi</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong>ID:</strong> {{ $gallery->id }}<br>
                                        <strong>Upload:</strong> {{ $gallery->created_at->format('d M Y H:i') }}<br>
                                        <strong>Update:</strong> {{ $gallery->updated_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.galleries.show', $gallery->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <div>
                            <button type="button" class="btn btn-danger me-2" onclick="confirmDelete()">
                                <i class="fas fa-trash me-2"></i>Hapus Foto
                            </button>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Foto
                            </button>
                        </div>
                    </div>
                </form>
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
// Image preview for new upload
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    const noPreview = document.getElementById('noPreview');
    const previewImg = document.getElementById('previewImg');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
            noPreview.style.display = 'none';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        noPreview.style.display = 'block';
    }
});

function confirmDelete() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
