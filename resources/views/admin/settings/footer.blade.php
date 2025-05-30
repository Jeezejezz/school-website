@extends('admin.layouts.app')

@section('title', 'Pengaturan Footer')
@section('page-title', 'Pengaturan Footer')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-footer me-2"></i>
                    Pengaturan Footer Website
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.footer.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Footer Content -->
                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Informasi Sekolah</h6>
                            
                            <div class="mb-3">
                                <label for="footer_about" class="form-label">Tentang Sekolah</label>
                                <textarea class="form-control @error('footer_about') is-invalid @enderror" 
                                          id="footer_about" name="footer_about" rows="4">{{ old('footer_about', $footerSettings->where('key', 'footer_about')->first()->value ?? '') }}</textarea>
                                @error('footer_about')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Deskripsi singkat sekolah yang ditampilkan di footer</small>
                            </div>
                            
                            <div class="mb-3">
                                <label for="footer_address" class="form-label">Alamat</label>
                                <textarea class="form-control @error('footer_address') is-invalid @enderror" 
                                          id="footer_address" name="footer_address" rows="3">{{ old('footer_address', $footerSettings->where('key', 'footer_address')->first()->value ?? '') }}</textarea>
                                @error('footer_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="footer_phone" class="form-label">Telepon</label>
                                        <input type="text" class="form-control @error('footer_phone') is-invalid @enderror" 
                                               id="footer_phone" name="footer_phone" 
                                               value="{{ old('footer_phone', $footerSettings->where('key', 'footer_phone')->first()->value ?? '') }}">
                                        @error('footer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="footer_email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('footer_email') is-invalid @enderror" 
                                               id="footer_email" name="footer_email" 
                                               value="{{ old('footer_email', $footerSettings->where('key', 'footer_email')->first()->value ?? '') }}">
                                        @error('footer_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="footer_copyright" class="form-label">Teks Copyright</label>
                                <input type="text" class="form-control @error('footer_copyright') is-invalid @enderror" 
                                       id="footer_copyright" name="footer_copyright" 
                                       value="{{ old('footer_copyright', $footerSettings->where('key', 'footer_copyright')->first()->value ?? '') }}">
                                @error('footer_copyright')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Teks copyright yang ditampilkan di bagian bawah footer</small>
                            </div>
                        </div>
                        
                        <!-- Social Media Links -->
                        <div class="col-md-6">
                            <h6 class="text-primary fw-bold mb-3">Media Sosial</h6>
                            
                            <div class="mb-3">
                                <label for="social_facebook" class="form-label">
                                    <i class="fab fa-facebook text-primary me-2"></i>Facebook URL
                                </label>
                                <input type="url" class="form-control @error('social_facebook') is-invalid @enderror" 
                                       id="social_facebook" name="social_facebook" 
                                       value="{{ old('social_facebook', $footerSettings->where('key', 'social_facebook')->first()->value ?? '') }}"
                                       placeholder="https://facebook.com/sekolahkami">
                                @error('social_facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="social_instagram" class="form-label">
                                    <i class="fab fa-instagram text-danger me-2"></i>Instagram URL
                                </label>
                                <input type="url" class="form-control @error('social_instagram') is-invalid @enderror" 
                                       id="social_instagram" name="social_instagram" 
                                       value="{{ old('social_instagram', $footerSettings->where('key', 'social_instagram')->first()->value ?? '') }}"
                                       placeholder="https://instagram.com/sekolahkami">
                                @error('social_instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="social_youtube" class="form-label">
                                    <i class="fab fa-youtube text-danger me-2"></i>YouTube URL
                                </label>
                                <input type="url" class="form-control @error('social_youtube') is-invalid @enderror" 
                                       id="social_youtube" name="social_youtube" 
                                       value="{{ old('social_youtube', $footerSettings->where('key', 'social_youtube')->first()->value ?? '') }}"
                                       placeholder="https://youtube.com/sekolahkami">
                                @error('social_youtube')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="social_twitter" class="form-label">
                                    <i class="fab fa-twitter text-info me-2"></i>Twitter URL
                                </label>
                                <input type="url" class="form-control @error('social_twitter') is-invalid @enderror" 
                                       id="social_twitter" name="social_twitter" 
                                       value="{{ old('social_twitter', $footerSettings->where('key', 'social_twitter')->first()->value ?? '') }}"
                                       placeholder="https://twitter.com/sekolahkami">
                                @error('social_twitter')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Preview Section -->
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">Preview Footer</h6>
                        <div class="bg-dark text-white p-4 rounded">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6><i class="fas fa-graduation-cap me-2"></i><span id="preview-title">Sekolah Kami</span></h6>
                                    <p id="preview-about" class="small">{{ $footerSettings->where('key', 'footer_about')->first()->value ?? 'Deskripsi sekolah...' }}</p>
                                </div>
                                <div class="col-md-4">
                                    <h6>Quick Links</h6>
                                    <ul class="list-unstyled small">
                                        <li><a href="#" class="text-light text-decoration-none">Home</a></li>
                                        <li><a href="#" class="text-light text-decoration-none">About Us</a></li>
                                        <li><a href="#" class="text-light text-decoration-none">Academics</a></li>
                                        <li><a href="#" class="text-light text-decoration-none">Contact</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <h6>Contact Info</h6>
                                    <p class="small">
                                        <i class="fas fa-map-marker-alt me-2"></i><span id="preview-address">{{ $footerSettings->where('key', 'footer_address')->first()->value ?? 'Alamat sekolah...' }}</span><br>
                                        <i class="fas fa-phone me-2"></i><span id="preview-phone">{{ $footerSettings->where('key', 'footer_phone')->first()->value ?? '' }}</span><br>
                                        <i class="fas fa-envelope me-2"></i><span id="preview-email">{{ $footerSettings->where('key', 'footer_email')->first()->value ?? '' }}</span>
                                    </p>
                                    
                                    <!-- Social Media Preview -->
                                    <div class="mt-3">
                                        <h6>Follow Us</h6>
                                        <div class="d-flex gap-2">
                                            <a href="#" class="text-light" id="preview-facebook" style="{{ $footerSettings->where('key', 'social_facebook')->first()->value ? '' : 'display:none' }}">
                                                <i class="fab fa-facebook fa-lg"></i>
                                            </a>
                                            <a href="#" class="text-light" id="preview-instagram" style="{{ $footerSettings->where('key', 'social_instagram')->first()->value ? '' : 'display:none' }}">
                                                <i class="fab fa-instagram fa-lg"></i>
                                            </a>
                                            <a href="#" class="text-light" id="preview-youtube" style="{{ $footerSettings->where('key', 'social_youtube')->first()->value ? '' : 'display:none' }}">
                                                <i class="fab fa-youtube fa-lg"></i>
                                            </a>
                                            <a href="#" class="text-light" id="preview-twitter" style="{{ $footerSettings->where('key', 'social_twitter')->first()->value ? '' : 'display:none' }}">
                                                <i class="fab fa-twitter fa-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-3">
                            <div class="text-center">
                                <p class="mb-0 small">&copy; {{ date('Y') }} <span id="preview-copyright">{{ $footerSettings->where('key', 'footer_copyright')->first()->value ?? 'Sekolah Kami. All rights reserved.' }}</span></p>
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
// Live preview updates
document.getElementById('footer_about').addEventListener('input', function() {
    document.getElementById('preview-about').textContent = this.value || 'Deskripsi sekolah...';
});

document.getElementById('footer_address').addEventListener('input', function() {
    document.getElementById('preview-address').textContent = this.value || 'Alamat sekolah...';
});

document.getElementById('footer_phone').addEventListener('input', function() {
    document.getElementById('preview-phone').textContent = this.value;
});

document.getElementById('footer_email').addEventListener('input', function() {
    document.getElementById('preview-email').textContent = this.value;
});

document.getElementById('footer_copyright').addEventListener('input', function() {
    document.getElementById('preview-copyright').textContent = this.value || 'Sekolah Kami. All rights reserved.';
});

// Social media preview
document.getElementById('social_facebook').addEventListener('input', function() {
    const preview = document.getElementById('preview-facebook');
    preview.style.display = this.value ? 'inline' : 'none';
});

document.getElementById('social_instagram').addEventListener('input', function() {
    const preview = document.getElementById('preview-instagram');
    preview.style.display = this.value ? 'inline' : 'none';
});

document.getElementById('social_youtube').addEventListener('input', function() {
    const preview = document.getElementById('preview-youtube');
    preview.style.display = this.value ? 'inline' : 'none';
});

document.getElementById('social_twitter').addEventListener('input', function() {
    const preview = document.getElementById('preview-twitter');
    preview.style.display = this.value ? 'inline' : 'none';
});
</script>
@endsection
