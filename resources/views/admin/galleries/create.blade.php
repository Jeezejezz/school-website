@extends('admin.layouts.app')

@section('title', 'Upload Foto Gallery')
@section('page-title', 'Upload Foto Gallery')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>
                    Upload Foto Baru ke Gallery
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Foto</h6>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Berikan judul yang menarik untuk foto ini</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="3">{{ old('description') }}</textarea>
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
                                            <option value="Kegiatan Sekolah" {{ old('category') == 'Kegiatan Sekolah' ? 'selected' : '' }}>Kegiatan Sekolah</option>
                                            <option value="Fasilitas" {{ old('category') == 'Fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                            <option value="Prestasi" {{ old('category') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                                            <option value="Ekstrakurikuler" {{ old('category') == 'Ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler</option>
                                            <option value="Acara Khusus" {{ old('category') == 'Acara Khusus' ? 'selected' : '' }}>Acara Khusus</option>
                                            <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">File Gambar <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*" required>
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
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
                                                   {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">
                                                <strong>Foto Unggulan</strong>
                                            </label>
                                        </div>
                                        <small class="text-muted">Foto unggulan akan ditampilkan di halaman utama</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Preview -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Preview Gambar</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div id="imagePreview" class="mb-3" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    </div>
                                    <div id="noPreview" class="text-muted">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p>Pilih gambar untuk melihat preview</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Tips -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Tips Upload</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        <strong>Tips untuk foto yang baik:</strong><br>
                                        • Gunakan resolusi tinggi (minimal 800x600)<br>
                                        • Pastikan pencahayaan yang cukup<br>
                                        • Hindari foto yang blur atau gelap<br>
                                        • Berikan judul yang deskriptif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i>Upload Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Image preview
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

// Auto-generate title from filename
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const titleInput = document.getElementById('title');
    
    if (file && !titleInput.value) {
        // Remove extension and format filename
        let filename = file.name.replace(/\.[^/.]+$/, "");
        filename = filename.replace(/[-_]/g, ' ');
        filename = filename.replace(/\b\w/g, l => l.toUpperCase());
        titleInput.value = filename;
    }
});
</script>
@endsection
