@extends('admin.layouts.app')

@section('title', 'Edit Keunggulan Akademik')
@section('page-title', 'Edit Keunggulan Akademik')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Keunggulan: {{ $academicFeature->title }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.academic-features.update', $academicFeature->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Keunggulan</h6>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Keunggulan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $academicFeature->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Contoh: Laboratorium Modern, Perpustakaan Digital</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4" required>{{ old('description', $academicFeature->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Jelaskan secara detail tentang keunggulan ini</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon FontAwesome <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                               id="icon" name="icon" value="{{ old('icon', $academicFeature->icon) }}" 
                                               placeholder="fas fa-microscope" required>
                                        @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            Contoh: fas fa-microscope, fas fa-book-open, fas fa-users<br>
                                            <a href="https://fontawesome.com/icons" target="_blank">Lihat semua icon</a>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                                        <select class="form-select @error('color') is-invalid @enderror" 
                                                id="color" name="color" required>
                                            <option value="">Pilih Warna</option>
                                            <option value="primary" {{ old('color', $academicFeature->color) == 'primary' ? 'selected' : '' }}>Primary (Biru)</option>
                                            <option value="success" {{ old('color', $academicFeature->color) == 'success' ? 'selected' : '' }}>Success (Hijau)</option>
                                            <option value="info" {{ old('color', $academicFeature->color) == 'info' ? 'selected' : '' }}>Info (Cyan)</option>
                                            <option value="warning" {{ old('color', $academicFeature->color) == 'warning' ? 'selected' : '' }}>Warning (Kuning)</option>
                                            <option value="danger" {{ old('color', $academicFeature->color) == 'danger' ? 'selected' : '' }}>Danger (Merah)</option>
                                            <option value="secondary" {{ old('color', $academicFeature->color) == 'secondary' ? 'selected' : '' }}>Secondary (Abu-abu)</option>
                                        </select>
                                        @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                        <label for="sort_order" class="form-label">Urutan <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" name="sort_order" value="{{ old('sort_order', $academicFeature->sort_order) }}" 
                                               min="0" required>
                                        @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Angka kecil akan tampil lebih dulu</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                                   {{ old('is_active', $academicFeature->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Keunggulan Aktif
                                            </label>
                                        </div>
                                        <small class="text-muted">Keunggulan akan ditampilkan di website</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Feature Info -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Informasi</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong>ID:</strong> {{ $academicFeature->id }}<br>
                                        <strong>Dibuat:</strong> {{ $academicFeature->created_at->format('d M Y H:i') }}<br>
                                        <strong>Diupdate:</strong> {{ $academicFeature->updated_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                            
                            <!-- Preview -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Preview Keunggulan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="bg-{{ $academicFeature->color }} text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                             style="width: 80px; height: 80px;" id="preview-icon-container">
                                            <i class="{{ $academicFeature->icon }} fa-2x" id="preview-icon"></i>
                                        </div>
                                        <h6 class="fw-bold" id="preview-title">{{ $academicFeature->title }}</h6>
                                        <p class="text-muted small" id="preview-description">{{ Str::limit($academicFeature->description, 80) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.academic-features.show', $academicFeature->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Keunggulan
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
// Live preview
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const descriptionTextarea = document.getElementById('description');
    const iconInput = document.getElementById('icon');
    const colorSelect = document.getElementById('color');
    
    const previewTitle = document.getElementById('preview-title');
    const previewDescription = document.getElementById('preview-description');
    const previewIcon = document.getElementById('preview-icon');
    const previewIconContainer = document.getElementById('preview-icon-container');
    
    function updatePreview() {
        // Update title
        previewTitle.textContent = titleInput.value || 'Judul Keunggulan';
        
        // Update description
        const desc = descriptionTextarea.value || 'Deskripsi keunggulan akan muncul di sini...';
        previewDescription.textContent = desc.length > 80 ? desc.substring(0, 80) + '...' : desc;
        
        // Update icon
        if (iconInput.value) {
            previewIcon.className = iconInput.value + ' fa-2x';
        } else {
            previewIcon.className = 'fas fa-star fa-2x';
        }
        
        // Update color
        const color = colorSelect.value || 'primary';
        previewIconContainer.className = `bg-${color} text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3`;
        previewIconContainer.style.width = '80px';
        previewIconContainer.style.height = '80px';
    }
    
    titleInput.addEventListener('input', updatePreview);
    descriptionTextarea.addEventListener('input', updatePreview);
    iconInput.addEventListener('input', updatePreview);
    colorSelect.addEventListener('change', updatePreview);
});
</script>
@endsection
