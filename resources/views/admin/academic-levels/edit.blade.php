@extends('admin.layouts.app')

@section('title', 'Edit Jenjang Pendidikan')
@section('page-title', 'Edit Jenjang Pendidikan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Jenjang: {{ $academicLevel->display_name }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.academic-levels.update', $academicLevel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Jenjang</h6>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Kode Jenjang <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $academicLevel->name) }}" 
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
                                               id="display_name" name="display_name" value="{{ old('display_name', $academicLevel->display_name) }}" 
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
                                          id="description" name="description" rows="3">{{ old('description', $academicLevel->description) }}</textarea>
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
                                            <option value="primary" {{ old('color', $academicLevel->color) == 'primary' ? 'selected' : '' }}>Primary (Biru)</option>
                                            <option value="success" {{ old('color', $academicLevel->color) == 'success' ? 'selected' : '' }}>Success (Hijau)</option>
                                            <option value="info" {{ old('color', $academicLevel->color) == 'info' ? 'selected' : '' }}>Info (Cyan)</option>
                                            <option value="warning" {{ old('color', $academicLevel->color) == 'warning' ? 'selected' : '' }}>Warning (Kuning)</option>
                                            <option value="danger" {{ old('color', $academicLevel->color) == 'danger' ? 'selected' : '' }}>Danger (Merah)</option>
                                            <option value="secondary" {{ old('color', $academicLevel->color) == 'secondary' ? 'selected' : '' }}>Secondary (Abu-abu)</option>
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
                                               id="sort_order" name="sort_order" value="{{ old('sort_order', $academicLevel->sort_order) }}" 
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
                                                   {{ old('is_visible', $academicLevel->is_visible) ? 'checked' : '' }}>
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
                                        <strong>Status Saat Ini:</strong> 
                                        @if($academicLevel->is_visible)
                                        <span class="text-success">Tampil di Website</span>
                                        @else
                                        <span class="text-danger">Tersembunyi</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Statistics -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Statistik</h6>
                                </div>
                                <div class="card-body">
                                    @php
                                        $programCount = \App\Models\Academic::where('level', $academicLevel->name)->count();
                                        $activePrograms = \App\Models\Academic::where('level', $academicLevel->name)->where('is_active', true)->count();
                                    @endphp
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <h4 class="text-primary mb-0">{{ $programCount }}</h4>
                                            <small class="text-muted">Total Program</small>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="text-success mb-0">{{ $activePrograms }}</h4>
                                            <small class="text-muted">Program Aktif</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Level Info -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Informasi Jenjang</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong>ID:</strong> {{ $academicLevel->id }}<br>
                                        <strong>Dibuat:</strong> {{ $academicLevel->created_at->format('d M Y H:i') }}<br>
                                        <strong>Diupdate:</strong> {{ $academicLevel->updated_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                            
                            <!-- Preview -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Preview Badge</h6>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="badge bg-{{ $academicLevel->color }} fs-5" id="preview-badge">{{ $academicLevel->name }}</span>
                                    </div>
                                    <p class="small text-muted mb-0" id="preview-name">{{ $academicLevel->display_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.academic-levels.show', $academicLevel->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <div>
                            @if($programCount == 0)
                            <button type="button" class="btn btn-danger me-2" onclick="confirmDelete()">
                                <i class="fas fa-trash me-2"></i>Hapus Jenjang
                            </button>
                            @endif
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Jenjang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
@if($programCount == 0)
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus jenjang <strong>{{ $academicLevel->display_name }}</strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.academic-levels.destroy', $academicLevel->id) }}" method="POST" style="display: inline;">
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
@endif
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
        previewBadge.textContent = nameInput.value || '{{ $academicLevel->name }}';
        
        // Update badge color
        const color = colorSelect.value || '{{ $academicLevel->color }}';
        previewBadge.className = `badge bg-${color} fs-5`;
        
        // Update display name
        previewName.textContent = displayNameInput.value || '{{ $academicLevel->display_name }}';
    }
    
    nameInput.addEventListener('input', updatePreview);
    displayNameInput.addEventListener('input', updatePreview);
    colorSelect.addEventListener('change', updatePreview);
});

@if($programCount == 0)
function confirmDelete() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
@endif
</script>
@endsection
