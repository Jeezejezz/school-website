@extends('admin.layouts.app')

@section('title', 'Pengaturan Header')
@section('page-title', 'Pengaturan Header')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-header me-2"></i>
                    Pengaturan Header Website
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.header.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Settings -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Header</h6>
                            
                            <div class="mb-3">
                                <label for="header_title" class="form-label">Judul Website <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('header_title') is-invalid @enderror" 
                                       id="header_title" name="header_title" 
                                       value="{{ old('header_title', $headerSettings->where('key', 'header_title')->first()->value ?? '') }}" 
                                       required>
                                @error('header_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Judul yang akan ditampilkan di header website</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="header_tagline" class="form-label">Tagline/Slogan</label>
                                <input type="text" class="form-control @error('header_tagline') is-invalid @enderror" 
                                       id="header_tagline" name="header_tagline" 
                                       value="{{ old('header_tagline', $headerSettings->where('key', 'header_tagline')->first()->value ?? '') }}">
                                @error('header_tagline')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Tagline atau slogan sekolah yang ditampilkan di header</small>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="header_phone" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control @error('header_phone') is-invalid @enderror" 
                                               id="header_phone" name="header_phone" 
                                               value="{{ old('header_phone', $headerSettings->where('key', 'header_phone')->first()->value ?? '') }}">
                                        @error('header_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="header_email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('header_email') is-invalid @enderror" 
                                               id="header_email" name="header_email" 
                                               value="{{ old('header_email', $headerSettings->where('key', 'header_email')->first()->value ?? '') }}">
                                        @error('header_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Logo Section -->
                        <div class="col-md-4">
                            <h6 class="text-primary fw-bold mb-3">Logo Header</h6>
                            
                            <!-- Current Logo -->
                            @php
                                $currentLogo = $headerSettings->where('key', 'header_logo')->first()->value ?? null;
                            @endphp
                            
                            @if($currentLogo)
                            <div class="mb-3">
                                <label class="form-label">Logo Saat Ini:</label>
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $currentLogo) }}" 
                                         alt="Current Logo" 
                                         class="img-fluid rounded shadow"
                                         style="max-height: 150px;" id="current-logo">
                                </div>
                            </div>
                            @endif
                            
                            <div class="mb-3">
                                <label for="header_logo" class="form-label">
                                    {{ $currentLogo ? 'Ganti Logo' : 'Upload Logo' }}
                                </label>
                                <input type="file" class="form-control @error('header_logo') is-invalid @enderror" 
                                       id="header_logo" name="header_logo" accept="image/*">
                                @error('header_logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: JPG, PNG, GIF, SVG. Maksimal 2MB.</small>
                            </div>
                            
                            <!-- Logo Preview -->
                            <div id="logoPreview" class="text-center" style="display: none;">
                                <label class="form-label">Preview:</label>
                                <div>
                                    <img id="previewImg" src="" alt="Preview" class="img-fluid rounded shadow" style="max-height: 150px;">
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removePreview()">
                                    <i class="fas fa-times me-1"></i>Hapus Preview
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Preview Section -->
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">Preview Header</h6>
                        <div class="bg-light p-4 rounded border">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    @if($currentLogo)
                                    <img src="{{ asset('storage/' . $currentLogo) }}" alt="Logo" style="height: 50px;">
                                    @else
                                    <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <h5 class="mb-0" id="preview-title">{{ $headerSettings->where('key', 'header_title')->first()->value ?? 'Sekolah Kami' }}</h5>
                                    <small class="text-muted" id="preview-tagline">{{ $headerSettings->where('key', 'header_tagline')->first()->value ?? '' }}</small>
                                </div>
                                <div class="ms-auto">
                                    <small class="text-muted">
                                        <i class="fas fa-phone me-1"></i><span id="preview-phone">{{ $headerSettings->where('key', 'header_phone')->first()->value ?? '' }}</span>
                                        <br>
                                        <i class="fas fa-envelope me-1"></i><span id="preview-email">{{ $headerSettings->where('key', 'header_email')->first()->value ?? '' }}</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Pengaturan
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
// Logo preview
document.getElementById('header_logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('logoPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

function removePreview() {
    document.getElementById('header_logo').value = '';
    document.getElementById('logoPreview').style.display = 'none';
}

// Live preview
document.getElementById('header_title').addEventListener('input', function() {
    document.getElementById('preview-title').textContent = this.value || 'Sekolah Kami';
});

document.getElementById('header_tagline').addEventListener('input', function() {
    document.getElementById('preview-tagline').textContent = this.value;
});

document.getElementById('header_phone').addEventListener('input', function() {
    document.getElementById('preview-phone').textContent = this.value;
});

document.getElementById('header_email').addEventListener('input', function() {
    document.getElementById('preview-email').textContent = this.value;
});
</script>
@endsection
