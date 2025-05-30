@extends('admin.layouts.app')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Berita: {{ Str::limit($news->title, 50) }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $news->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="content" class="form-label">Isi Berita <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" name="content" rows="15" required>{{ old('content', $news->content) }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Tulis isi berita dengan detail dan jelas.</small>
                            </div>
                        </div>
                        
                        <!-- Sidebar -->
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Pengaturan Publikasi</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="author" class="form-label">Penulis <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                               id="author" name="author" value="{{ old('author', $news->author) }}" required>
                                        @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="published_at" class="form-label">Tanggal Publish <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('published_at') is-invalid @enderror" 
                                               id="published_at" name="published_at" value="{{ old('published_at', $news->published_at->format('Y-m-d')) }}" required>
                                        @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" 
                                                   {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_published">
                                                Publikasikan sekarang
                                            </label>
                                        </div>
                                        <small class="text-muted">Jika tidak dicentang, berita akan disimpan sebagai draft.</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Gambar Berita</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Current Image -->
                                    @if($news->image)
                                    <div class="mb-3">
                                        <label class="form-label">Gambar Saat Ini:</label>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $news->image) }}" 
                                                 alt="{{ $news->title }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-height: 200px;">
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            {{ $news->image ? 'Ganti Gambar' : 'Upload Gambar' }}
                                        </label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                                    </div>
                                    
                                    <!-- Image Preview -->
                                    <div id="imagePreview" class="text-center" style="display: none;">
                                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removePreview()">
                                            <i class="fas fa-times me-1"></i>Hapus Preview
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- News Info -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Informasi</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong>Dibuat:</strong> {{ $news->created_at->format('d M Y H:i') }}<br>
                                        <strong>Diupdate:</strong> {{ $news->updated_at->format('d M Y H:i') }}<br>
                                        <strong>ID:</strong> {{ $news->id }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.news.show', $news->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <div>
                            <button type="submit" name="action" value="draft" class="btn btn-outline-primary me-2">
                                <i class="fas fa-save me-2"></i>Simpan Draft
                            </button>
                            <button type="submit" name="action" value="publish" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Update & Publikasikan
                            </button>
                        </div>
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
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

function removePreview() {
    document.getElementById('image').value = '';
    document.getElementById('imagePreview').style.display = 'none';
}

// Auto-set published checkbox based on action
document.addEventListener('DOMContentLoaded', function() {
    const publishBtn = document.querySelector('button[value="publish"]');
    const draftBtn = document.querySelector('button[value="draft"]');
    const publishCheckbox = document.getElementById('is_published');
    
    publishBtn.addEventListener('click', function() {
        publishCheckbox.checked = true;
    });
    
    draftBtn.addEventListener('click', function() {
        publishCheckbox.checked = false;
    });
});
</script>
@endsection
