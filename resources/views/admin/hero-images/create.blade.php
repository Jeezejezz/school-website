@extends('admin.layouts.app')

@section('title', 'Tambah Gambar Hero')
@section('page-title', 'Tambah Gambar Hero')

@section('content')
<div class="row">
    <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-plus me-2"></i>Tambah Gambar Hero
                    </h5>
                    <a href="{{ route('admin.hero-images.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hero-images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Gambar Hero <span class="text-danger">*</span></label>
                                    <input type="file"
                                           class="form-control @error('image') is-invalid @enderror"
                                           id="image"
                                           name="image"
                                           accept="image/*"
                                           required
                                           onchange="previewImage(this)">
                                    @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB. Resolusi optimal: 600x500px</small>
                                </div>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul (Opsional)</label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           id="title"
                                           name="title"
                                           value="{{ old('title') }}"
                                           placeholder="Masukkan judul untuk gambar ini">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Judul akan ditampilkan sebagai overlay di gambar</small>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi (Opsional)</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              name="description"
                                              rows="3"
                                              placeholder="Masukkan deskripsi untuk gambar ini">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Deskripsi akan ditampilkan sebagai overlay di gambar</small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="is_active"
                                               name="is_active"
                                               value="1"
                                               {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Aktifkan gambar ini
                                        </label>
                                    </div>
                                    <small class="text-muted">Hanya gambar yang aktif yang akan ditampilkan di slider</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Preview Gambar</label>
                                    <div class="border rounded p-3 text-center" style="min-height: 200px;">
                                        <img id="image-preview"
                                             src=""
                                             alt="Preview"
                                             class="img-fluid rounded"
                                             style="max-height: 200px; display: none;">
                                        <div id="preview-placeholder" class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-muted">
                                                <i class="fas fa-image fa-3x mb-2"></i>
                                                <p>Preview gambar akan muncul di sini</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Tips:</strong>
                                    <ul class="mb-0 mt-2">
                                        <li>Gunakan gambar dengan rasio 6:5 (600x500px)</li>
                                        <li>Pastikan gambar berkualitas tinggi</li>
                                        <li>Hindari teks kecil pada gambar</li>
                                        <li>Gambar akan di-resize otomatis</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Gambar
                            </button>
                            <a href="{{ route('admin.hero-images.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('preview-placeholder');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
        placeholder.style.display = 'flex';
    }
}
</script>
@endsection
