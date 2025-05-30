@extends('admin.layouts.app')

@section('title', 'Tambah Jenjang Pendidikan')
@section('page-title', 'Tambah Jenjang Pendidikan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Jenjang Pendidikan Baru
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.academic-levels.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Jenjang</h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Kode Jenjang <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" 
                                               placeholder="SD" maxlength="10" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Contoh: SD, SMP, SMA, SMK (maksimal 10 karakter)</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="display_name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('display_name') is-invalid @enderror" 
                                               id="display_name" name="display_name" value="{{ old('display_name') }}" 
                                               placeholder="Sekolah Dasar" required>
                                        @error('display_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Nama lengkap jenjang pendidikan</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi singkat tentang jenjang pendidikan ini</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="color" class="form-label">Warna Badge <span class="text-danger">*</span></label>
                                        <select class="form-select @error('color') is-invalid @enderror" 
                                                id="color" name="color" required>
                                            <option value="">Pilih Warna</option>
                                            <option value="primary" {{ old('color') == 'primary' ? 'selected' : '' }}>Primary (Biru)</option>
                                            <option value="success" {{ old('color') == 'success' ? 'selected' : '' }}>Success (Hijau)</option>
                                            <option value="info" {{ old('color') == 'info' ? 'selected' : '' }}>Info (Cyan)</option>
                                            <option value="warning" {{ old('color') == 'warning' ? 'selected' : '' }}>Warning (Kuning)</option>
                                            <option value="danger" {{ old('color') == 'danger' ? 'selected' : '' }}>Danger (Merah)</option>
                                            <option value="secondary" {{ old('color') == 'secondary' ? 'selected' : '' }}>Secondary (Abu-abu)</option>
                                        </select>
                                        @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Warna badge untuk jenjang ini</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sort_order" class="form-label">Urutan <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}" 
                                               min="0" required>
                                        @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Urutan tampil (angka kecil lebih dulu)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sidebar -->
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Pengaturan Visibility</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_visible" name="is_visible" value="1" 
                                                   {{ old('is_visible', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_visible">
                                                <strong>Tampilkan di Website</strong>
                                            </label>
                                        </div>
                                        <small class="text-muted">
                                            Jika dicentang, jenjang ini akan muncul sebagai filter di halaman academics.
                                            Jika tidak dicentang, jenjang akan tersembunyi dari pengunjung website.
                                        </small>
                                    </div>
                                    
                                    <div class="alert alert-info small">
                                        <i class="fas fa-info-circle me-1"></i>
                                        <strong>Tips:</strong> Anda dapat mengubah visibility kapan saja dari halaman daftar jenjang.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Preview -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Preview Badge</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="badge bg-primary fs-5" id="preview-badge">SD</span>
                                    </div>
                                    <p class="small text-muted mb-0" id="preview-name">Sekolah Dasar</p>
                                </div>
                            </div>
                            
                            <!-- Info -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Informasi</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Jenjang yang tersembunyi tidak akan muncul di filter halaman academics, 
                                        tetapi program akademik dengan jenjang tersebut tetap dapat diakses.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.academic-levels.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Jenjang
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
    const nameInput = document.getElementById('name');
    const displayNameInput = document.getElementById('display_name');
    const colorSelect = document.getElementById('color');
    
    const previewBadge = document.getElementById('preview-badge');
    const previewName = document.getElementById('preview-name');
    
    function updatePreview() {
        // Update badge text
        previewBadge.textContent = nameInput.value || 'SD';
        
        // Update badge color
        const color = colorSelect.value || 'primary';
        previewBadge.className = `badge bg-${color} fs-5`;
        
        // Update display name
        previewName.textContent = displayNameInput.value || 'Sekolah Dasar';
    }
    
    nameInput.addEventListener('input', updatePreview);
    displayNameInput.addEventListener('input', updatePreview);
    colorSelect.addEventListener('change', updatePreview);
    
    // Auto-generate display name based on common patterns
    nameInput.addEventListener('input', function() {
        if (!displayNameInput.value) {
            const name = this.value.toUpperCase();
            let displayName = '';
            
            switch(name) {
                case 'SD':
                    displayName = 'Sekolah Dasar';
                    break;
                case 'SMP':
                    displayName = 'Sekolah Menengah Pertama';
                    break;
                case 'SMA':
                    displayName = 'Sekolah Menengah Atas';
                    break;
                case 'SMK':
                    displayName = 'Sekolah Menengah Kejuruan';
                    break;
                default:
                    displayName = name;
            }
            
            displayNameInput.value = displayName;
            updatePreview();
        }
    });
    
    // Initial preview
    updatePreview();
});
</script>
@endsection
