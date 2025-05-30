@extends('admin.layouts.app')

@section('title', 'Kelola Beranda')
@section('page-title', 'Kelola Beranda Website')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-home me-2"></i>
                    Pengaturan Halaman Beranda
                </h5>
                <div>
                    <a href="{{ route('admin.homepage.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Beranda
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-info">
                        <i class="fas fa-eye me-2"></i>Lihat Website
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Hero Section Preview -->
                <div class="row mb-5">
                    <div class="col-12">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="fas fa-star me-2"></i>Hero Section
                        </h6>
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="fw-bold text-primary">{{ $homepage->hero_title }}</h4>
                                        <p class="text-muted mb-3">{{ $homepage->hero_subtitle }}</p>
                                        <div class="d-flex align-items-center">
                                            <span class="btn btn-primary me-3">{{ $homepage->hero_button_text }}</span>
                                            <small class="text-muted">Link: {{ $homepage->hero_button_link }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="alert alert-info mb-3">
                                            <h6 class="alert-heading">
                                                <i class="fas fa-images me-2"></i>Hero Images Slider
                                            </h6>
                                            <p class="mb-2">Sistem slider dengan maksimal 5 gambar</p>
                                            <a href="{{ route('admin.hero-images.index') }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-cog me-2"></i>Kelola Hero Images
                                            </a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Welcome Section Preview -->
                <div class="row mb-5">
                    <div class="col-12">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="fas fa-handshake me-2"></i>Welcome Section
                        </h6>
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="fw-bold">{{ $homepage->welcome_title }}</h5>
                                        <p class="text-muted">{{ $homepage->welcome_description }}</p>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        @if($homepage->welcome_video_type !== 'none')
                                        <!-- Video Preview -->
                                        <div class="mb-2">
                                            @if($homepage->welcome_video_type === 'upload' && $homepage->welcome_video_path)
                                            <video controls class="img-fluid rounded" style="max-height: 120px; width: 100%;">
                                                <source src="{{ asset('storage/' . $homepage->welcome_video_path) }}" type="video/mp4">
                                                Browser Anda tidak mendukung video.
                                            </video>
                                            <small class="text-success d-block mt-1">
                                                <i class="fas fa-video me-1"></i>Video Upload
                                            </small>
                                            @elseif($homepage->welcome_video_type === 'link' && $homepage->welcome_video_link)
                                            @if($homepage->getVideoEmbedUrl())
                                            <iframe src="{{ $homepage->getVideoEmbedUrl() }}"
                                                    class="rounded"
                                                    style="width: 100%; height: 120px;"
                                                    frameborder="0"
                                                    allowfullscreen></iframe>
                                            @else
                                            <div class="bg-info text-white rounded d-flex align-items-center justify-content-center"
                                                 style="height: 120px;">
                                                <i class="fas fa-video fa-2x"></i>
                                            </div>
                                            @endif
                                            <small class="text-info d-block mt-1">
                                                <i class="fas fa-link me-1"></i>Video Link
                                            </small>
                                            @endif
                                        </div>
                                        @elseif($homepage->welcome_image_path)
                                        <!-- Image Preview -->
                                        <img src="{{ asset('storage/' . $homepage->welcome_image_path) }}"
                                             alt="Welcome Image"
                                             class="img-fluid rounded"
                                             style="max-height: 120px;">
                                        <small class="text-primary d-block mt-1">
                                            <i class="fas fa-image me-1"></i>Gambar Welcome
                                        </small>
                                        @else
                                        <!-- No Media -->
                                        <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center"
                                             style="height: 120px;">
                                            <i class="fas fa-image fa-2x"></i>
                                        </div>
                                        <small class="text-muted">Belum ada media welcome</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Preview -->
                <div class="row mb-5">
                    <div class="col-12">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="fas fa-chart-bar me-2"></i>Statistik Sekolah
                        </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-center bg-primary text-white">
                                    <div class="card-body">
                                        <i class="fas fa-users fa-2x mb-2"></i>
                                        <h4 class="mb-0">{{ $homepage->stats_students }}</h4>
                                        <small>Siswa</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-success text-white">
                                    <div class="card-body">
                                        <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                                        <h4 class="mb-0">{{ $homepage->stats_teachers }}</h4>
                                        <small>Guru</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-info text-white">
                                    <div class="card-body">
                                        <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                                        <h4 class="mb-0">{{ $homepage->stats_programs }}</h4>
                                        <small>Program</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center bg-warning text-white">
                                    <div class="card-body">
                                        <i class="fas fa-trophy fa-2x mb-2"></i>
                                        <h4 class="mb-0">{{ $homepage->stats_achievements }}</h4>
                                        <small>Prestasi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Visibility -->
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="fas fa-eye me-2"></i>Visibilitas Section
                        </h6>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-newspaper fa-2x mb-2 text-{{ $homepage->show_news_section ? 'success' : 'muted' }}"></i>
                                        <h6>Berita</h6>
                                        <span class="badge bg-{{ $homepage->show_news_section ? 'success' : 'secondary' }}">
                                            {{ $homepage->show_news_section ? 'Tampil' : 'Tersembunyi' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-images fa-2x mb-2 text-{{ $homepage->show_gallery_section ? 'success' : 'muted' }}"></i>
                                        <h6>Gallery</h6>
                                        <span class="badge bg-{{ $homepage->show_gallery_section ? 'success' : 'secondary' }}">
                                            {{ $homepage->show_gallery_section ? 'Tampil' : 'Tersembunyi' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-comments fa-2x mb-2 text-{{ $homepage->show_testimonials_section ? 'success' : 'muted' }}"></i>
                                        <h6>Testimonial</h6>
                                        <span class="badge bg-{{ $homepage->show_testimonials_section ? 'success' : 'secondary' }}">
                                            {{ $homepage->show_testimonials_section ? 'Tampil' : 'Tersembunyi' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <i class="fas fa-envelope fa-2x mb-2 text-{{ $homepage->show_contact_section ? 'success' : 'muted' }}"></i>
                                        <h6>Kontak</h6>
                                        <span class="badge bg-{{ $homepage->show_contact_section ? 'success' : 'secondary' }}">
                                            {{ $homepage->show_contact_section ? 'Tampil' : 'Tersembunyi' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.homepage.edit') }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Pengaturan Beranda
                    </a>
                    <a href="{{ route('admin.hero-images.index') }}" class="btn btn-info">
                        <i class="fas fa-images me-2"></i>Kelola Hero Images
                    </a>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-info">
                        <i class="fas fa-eye me-2"></i>Preview Website
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Reset Pengaturan</h6>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Reset semua pengaturan beranda ke nilai default.</p>
                <button type="button" class="btn btn-warning w-100" onclick="confirmReset()">
                    <i class="fas fa-undo me-2"></i>Reset ke Default
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Reset Confirmation Modal -->
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetModalLabel">Konfirmasi Reset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mereset semua pengaturan beranda ke nilai default?</p>
                <p class="text-warning small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Semua gambar yang diupload akan dihapus dan pengaturan akan kembali ke default.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.homepage.reset') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-undo me-2"></i>Reset
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function confirmReset() {
    const modal = new bootstrap.Modal(document.getElementById('resetModal'));
    modal.show();
}
</script>
@endsection
