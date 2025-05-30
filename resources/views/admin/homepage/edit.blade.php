@extends('admin.layouts.app')

@section('title', 'Edit Beranda')
@section('page-title', 'Edit Pengaturan Beranda')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Pengaturan Halaman Beranda
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Hero Section -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-star me-2"></i>Hero Section
                            </h6>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="hero_title" class="form-label">Judul Hero <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('hero_title') is-invalid @enderror"
                                               id="hero_title" name="hero_title" value="{{ old('hero_title', $homepage->hero_title) }}" required>
                                        @error('hero_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="hero_subtitle" class="form-label">Subtitle Hero <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('hero_subtitle') is-invalid @enderror"
                                                  id="hero_subtitle" name="hero_subtitle" rows="3" required>{{ old('hero_subtitle', $homepage->hero_subtitle) }}</textarea>
                                        @error('hero_subtitle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="hero_button_text" class="form-label">Teks Button <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_button_text') is-invalid @enderror"
                                                       id="hero_button_text" name="hero_button_text" value="{{ old('hero_button_text', $homepage->hero_button_text) }}" required>
                                                @error('hero_button_text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="hero_button_link" class="form-label">Link Button <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('hero_button_link') is-invalid @enderror"
                                                       id="hero_button_link" name="hero_button_link" value="{{ old('hero_button_link', $homepage->hero_button_link) }}" required>
                                                @error('hero_button_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Contoh: #about, /academics, https://example.com</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="alert alert-info">
                                        <h6 class="alert-heading">
                                            <i class="fas fa-images me-2"></i>Gambar Hero
                                        </h6>
                                        <p class="mb-3">Gambar hero sekarang menggunakan sistem slider yang dapat menampilkan maksimal 5 gambar.</p>
                                        <a href="{{ route('admin.hero-images.index') }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-cog me-2"></i>Kelola Gambar Hero
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Welcome Section -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-handshake me-2"></i>Welcome Section
                            </h6>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="welcome_title" class="form-label">Judul Welcome <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('welcome_title') is-invalid @enderror"
                                               id="welcome_title" name="welcome_title" value="{{ old('welcome_title', $homepage->welcome_title) }}" required>
                                        @error('welcome_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="welcome_description" class="form-label">Deskripsi Welcome <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('welcome_description') is-invalid @enderror"
                                                  id="welcome_description" name="welcome_description" rows="4" required>{{ old('welcome_description', $homepage->welcome_description) }}</textarea>
                                        @error('welcome_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="welcome_image" class="form-label">Gambar Welcome</label>
                                        <input type="file" class="form-control @error('welcome_image') is-invalid @enderror"
                                               id="welcome_image" name="welcome_image" accept="image/*">
                                        @error('welcome_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                    </div>

                                    @if($homepage->welcome_image_path)
                                    <div class="mb-3">
                                        <label class="form-label">Gambar Saat Ini</label>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $homepage->welcome_image_path) }}"
                                                 alt="Welcome Image"
                                                 class="img-fluid rounded"
                                                 style="max-height: 120px;">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Video Section -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-video me-2"></i>Video Welcome Section
                            </h6>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="welcome_video_type" class="form-label">Tipe Video <span class="text-danger">*</span></label>
                                                <select class="form-select @error('welcome_video_type') is-invalid @enderror"
                                                        id="welcome_video_type" name="welcome_video_type" required onchange="toggleVideoFields()">
                                                    <option value="none" {{ old('welcome_video_type', $homepage->welcome_video_type) == 'none' ? 'selected' : '' }}>Tidak Ada Video</option>
                                                    <option value="upload" {{ old('welcome_video_type', $homepage->welcome_video_type) == 'upload' ? 'selected' : '' }}>Upload Video</option>
                                                    <option value="link" {{ old('welcome_video_type', $homepage->welcome_video_type) == 'link' ? 'selected' : '' }}>Link Video (YouTube/Vimeo)</option>
                                                </select>
                                                @error('welcome_video_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3" id="position_field">
                                                <label for="welcome_video_position" class="form-label">Posisi Video <span class="text-danger">*</span></label>
                                                <select class="form-select @error('welcome_video_position') is-invalid @enderror"
                                                        id="welcome_video_position" name="welcome_video_position" required>
                                                    <option value="below" {{ old('welcome_video_position', $homepage->welcome_video_position) == 'below' ? 'selected' : '' }}>Di Bawah Deskripsi (Besar)</option>
                                                    <option value="side" {{ old('welcome_video_position', $homepage->welcome_video_position) == 'side' ? 'selected' : '' }}>Di Samping Deskripsi</option>
                                                </select>
                                                @error('welcome_video_position')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Pilih posisi video di welcome section</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Upload Video Field -->
                                    <div class="mb-3" id="upload_video_field" style="display: none;">
                                        <label for="welcome_video" class="form-label">Upload Video</label>
                                        <input type="file" class="form-control @error('welcome_video') is-invalid @enderror"
                                               id="welcome_video" name="welcome_video" accept="video/*">
                                        @error('welcome_video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Format: MP4, AVI, MOV, WMV, FLV, WebM. Maksimal 50MB</small>
                                    </div>

                                    <!-- Video Link Field -->
                                    <div class="mb-3" id="link_video_field" style="display: none;">
                                        <label for="welcome_video_link" class="form-label">Link Video</label>
                                        <input type="url" class="form-control @error('welcome_video_link') is-invalid @enderror"
                                               id="welcome_video_link" name="welcome_video_link" value="{{ old('welcome_video_link', $homepage->welcome_video_link) }}"
                                               placeholder="https://www.youtube.com/watch?v=... atau https://vimeo.com/...">
                                        @error('welcome_video_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Masukkan URL YouTube atau Vimeo</small>
                                    </div>

                                    <!-- Video Thumbnail Field -->
                                    <div class="mb-3" id="thumbnail_field" style="display: none;">
                                        <label for="welcome_video_thumbnail" class="form-label">Thumbnail Video (Opsional)</label>
                                        <input type="file" class="form-control @error('welcome_video_thumbnail') is-invalid @enderror"
                                               id="welcome_video_thumbnail" name="welcome_video_thumbnail" accept="image/*">
                                        @error('welcome_video_thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Thumbnail custom untuk video. Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <!-- Current Video Display -->
                                    @if($homepage->welcome_video_type !== 'none')
                                    <div class="mb-3">
                                        <label class="form-label">Video Saat Ini</label>
                                        <div class="text-center">
                                            @if($homepage->welcome_video_type === 'upload' && $homepage->welcome_video_path)
                                            <video controls class="img-fluid rounded" style="max-height: 150px; width: 100%;">
                                                <source src="{{ asset('storage/' . $homepage->welcome_video_path) }}" type="video/mp4">
                                                Browser Anda tidak mendukung video.
                                            </video>
                                            <p class="small text-muted mt-1">{{ basename($homepage->welcome_video_path) }}</p>
                                            @elseif($homepage->welcome_video_type === 'link' && $homepage->welcome_video_link)
                                            @if($homepage->getVideoEmbedUrl())
                                            <iframe src="{{ $homepage->getVideoEmbedUrl() }}"
                                                    class="rounded"
                                                    style="width: 100%; height: 150px;"
                                                    frameborder="0"
                                                    allowfullscreen></iframe>
                                            @else
                                            <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center"
                                                 style="height: 150px;">
                                                <i class="fas fa-video fa-2x"></i>
                                            </div>
                                            @endif
                                            <p class="small text-muted mt-1">{{ Str::limit($homepage->welcome_video_link, 50) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Current Thumbnail Display -->
                                    @if($homepage->welcome_video_thumbnail)
                                    <div class="mb-3">
                                        <label class="form-label">Thumbnail Saat Ini</label>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $homepage->welcome_video_thumbnail) }}"
                                                 alt="Video Thumbnail"
                                                 class="img-fluid rounded"
                                                 style="max-height: 100px;">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Section -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-chart-bar me-2"></i>Statistik Sekolah
                            </h6>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="stats_students" class="form-label">Jumlah Siswa <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('stats_students') is-invalid @enderror"
                                               id="stats_students" name="stats_students" value="{{ old('stats_students', $homepage->stats_students) }}" required>
                                        @error('stats_students')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Contoh: 1000+, 1.2K</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="stats_teachers" class="form-label">Jumlah Guru <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('stats_teachers') is-invalid @enderror"
                                               id="stats_teachers" name="stats_teachers" value="{{ old('stats_teachers', $homepage->stats_teachers) }}" required>
                                        @error('stats_teachers')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Contoh: 50+, 75</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="stats_programs" class="form-label">Jumlah Program <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('stats_programs') is-invalid @enderror"
                                               id="stats_programs" name="stats_programs" value="{{ old('stats_programs', $homepage->stats_programs) }}" required>
                                        @error('stats_programs')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Contoh: 10+, 15</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="stats_achievements" class="form-label">Jumlah Prestasi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('stats_achievements') is-invalid @enderror"
                                               id="stats_achievements" name="stats_achievements" value="{{ old('stats_achievements', $homepage->stats_achievements) }}" required>
                                        @error('stats_achievements')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Contoh: 100+, 250</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Visibility -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <h6 class="text-primary fw-bold mb-3">
                                <i class="fas fa-eye me-2"></i>Visibilitas Section
                            </h6>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="show_news_section" name="show_news_section" value="1"
                                               {{ old('show_news_section', $homepage->show_news_section) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_news_section">
                                            <i class="fas fa-newspaper me-2"></i>Tampilkan Section Berita
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="show_gallery_section" name="show_gallery_section" value="1"
                                               {{ old('show_gallery_section', $homepage->show_gallery_section) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_gallery_section">
                                            <i class="fas fa-images me-2"></i>Tampilkan Section Gallery
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="show_testimonials_section" name="show_testimonials_section" value="1"
                                               {{ old('show_testimonials_section', $homepage->show_testimonials_section) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_testimonials_section">
                                            <i class="fas fa-comments me-2"></i>Tampilkan Section Testimonial
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="show_contact_section" name="show_contact_section" value="1"
                                               {{ old('show_contact_section', $homepage->show_contact_section) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="show_contact_section">
                                            <i class="fas fa-envelope me-2"></i>Tampilkan Section Kontak
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.homepage.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>

                        <div>
                            <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-info me-2">
                                <i class="fas fa-eye me-2"></i>Preview Website
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
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
function toggleVideoFields() {
    const videoType = document.getElementById('welcome_video_type').value;
    const uploadField = document.getElementById('upload_video_field');
    const linkField = document.getElementById('link_video_field');
    const thumbnailField = document.getElementById('thumbnail_field');
    const positionField = document.getElementById('position_field');

    // Hide all fields first
    uploadField.style.display = 'none';
    linkField.style.display = 'none';
    thumbnailField.style.display = 'none';

    // Show/hide position field based on video type
    if (videoType === 'none') {
        positionField.style.display = 'none';
    } else {
        positionField.style.display = 'block';
    }

    // Show relevant fields based on selection
    if (videoType === 'upload') {
        uploadField.style.display = 'block';
        thumbnailField.style.display = 'block';
    } else if (videoType === 'link') {
        linkField.style.display = 'block';
        thumbnailField.style.display = 'block';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleVideoFields();
});
</script>
@endsection
