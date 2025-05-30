@extends('admin.layouts.app')

@section('title', 'Edit Profil Sekolah')
@section('page-title', 'Edit Profil Sekolah')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    {{ $school->exists ? 'Edit' : 'Tambah' }} Profil Sekolah
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.school.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Dasar</h6>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $school->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4" required>{{ old('description', $school->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="established_year" class="form-label">Tahun Didirikan <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('established_year') is-invalid @enderror" 
                                               id="established_year" name="established_year" 
                                               value="{{ old('established_year', $school->established_year) }}" 
                                               min="1900" max="{{ date('Y') }}" required>
                                        @error('established_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Logo Sekolah</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                               id="logo" name="logo" accept="image/*">
                                        @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Logo Preview -->
                        <div class="col-md-4">
                            <h6 class="text-primary fw-bold mb-3">Logo Saat Ini</h6>
                            <div class="text-center">
                                @if($school->logo)
                                <img src="{{ asset('storage/' . $school->logo) }}" alt="Logo Sekolah" 
                                     class="img-fluid rounded shadow" style="max-height: 200px;" id="logo-preview">
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center shadow" 
                                     style="height: 200px;" id="logo-preview">
                                    <i class="fas fa-school fa-4x text-muted"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Vision & Mission -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Visi</h6>
                            <div class="mb-3">
                                <textarea class="form-control @error('vision') is-invalid @enderror" 
                                          id="vision" name="vision" rows="5" required>{{ old('vision', $school->vision) }}</textarea>
                                @error('vision')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Misi</h6>
                            <div class="mb-3">
                                <textarea class="form-control @error('mission') is-invalid @enderror" 
                                          id="mission" name="mission" rows="5" required>{{ old('mission', $school->mission) }}</textarea>
                                @error('mission')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- History -->
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">Sejarah</h6>
                        <textarea class="form-control @error('history') is-invalid @enderror" 
                                  id="history" name="history" rows="4" required>{{ old('history', $school->history) }}</textarea>
                        @error('history')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Contact Information -->
                    <h6 class="text-primary fw-bold mb-3">Informasi Kontak</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="3" required>{{ old('address', $school->address) }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $school->phone) }}" required>
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $school->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                       id="website" name="website" value="{{ old('website', $school->website) }}" 
                                       placeholder="https://www.sekolah.com">
                                @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.school.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
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
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('logo-preview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Logo Preview" class="img-fluid rounded shadow" style="max-height: 200px;">`;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
