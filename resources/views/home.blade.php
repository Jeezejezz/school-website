@extends('layouts.app')

@section('title', 'Home - Sekolah Kami')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center h-100">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="hero-content">
                    <div class="hero-badge mb-3">
                        <span class="badge bg-light text-primary px-3 py-2 rounded-pill">
                            <i class="fas fa-star me-2"></i>Sekolah Terbaik
                        </span>
                    </div>
                    <h1 class="hero-title display-3 fw-bold mb-4 text-white">
                        {{ $homepage->hero_title }}
                    </h1>
                    <p class="hero-subtitle lead mb-4 text-white-50">{{ $homepage->hero_subtitle }}</p>
                    <div class="hero-buttons d-flex flex-column flex-sm-row gap-3 mb-4">
                        <a href="{{ $homepage->hero_button_link }}" class="btn btn-light btn-lg rounded-pill px-4 py-3">
                            <i class="fas fa-rocket me-2"></i>{{ $homepage->hero_button_text }}
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3">
                            <i class="fas fa-envelope me-2"></i>Hubungi Kami
                        </a>
                    </div>


                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="hero-slider-container">
                    @if(isset($heroImages) && $heroImages->count() > 0)
                    <!-- Hero Image Slider -->
                    <div class="hero-slider" id="heroSlider">
                        <div class="slider-wrapper">
                            @foreach($heroImages as $index => $heroImage)
                            <div class="slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                                @if(file_exists(public_path('storage/' . $heroImage->image_path)))
                                <img src="{{ asset('storage/' . $heroImage->image_path) }}"
                                     alt="{{ $heroImage->title ?: $homepage->hero_title }}"
                                     class="hero-image">
                                @else
                                <img src="https://via.placeholder.com/600x500/667eea/ffffff?text={{ urlencode($heroImage->title ?: 'Sekolah Kami') }}"
                                     alt="{{ $heroImage->title ?: $homepage->hero_title }}"
                                     class="hero-image">
                                @endif
                                @if($heroImage->title || $heroImage->description)
                                <div class="slide-overlay">
                                    @if($heroImage->title)
                                    <h3 class="slide-title">{{ $heroImage->title }}</h3>
                                    @endif
                                    @if($heroImage->description)
                                    <p class="slide-description">{{ $heroImage->description }}</p>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>

                        @if($heroImages->count() > 1)
                        <!-- Navigation Arrows -->
                        <button class="slider-nav prev" onclick="changeSlide(-1)">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slider-nav next" onclick="changeSlide(1)">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Dots Indicator -->
                        <div class="slider-dots">
                            @foreach($heroImages as $index => $heroImage)
                            <button class="dot {{ $index === 0 ? 'active' : '' }}"
                                    onclick="currentSlide({{ $index }})"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @elseif($homepage->hero_image_path)
                    <!-- Fallback to single hero image -->
                    <div class="hero-image-container">
                        <img src="{{ asset('storage/' . $homepage->hero_image_path) }}"
                             alt="{{ $homepage->hero_title }}" class="hero-image">
                    </div>
                    @else
                    <!-- Default placeholder -->
                    <div class="hero-image-container">
                        <img src="https://via.placeholder.com/600x500/667eea/ffffff?text=Sekolah+Kami"
                             alt="Sekolah" class="hero-image">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome-section py-5 position-relative">
    <!-- Background Pattern -->
    <div class="welcome-bg-pattern"></div>

    <div class="container position-relative">
        @if($homepage->welcome_video_type !== 'none' && $homepage->welcome_video_position === 'side')
        <!-- Side Layout: Text and Video Side by Side -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3">{{ $homepage->welcome_title }}</h2>
                <p class="lead text-muted">{{ $homepage->welcome_description }}</p>
            </div>
            <div class="col-lg-6">
                <div class="welcome-media-container">
                    @if($homepage->welcome_video_type === 'upload' && $homepage->welcome_video_path)
                    <!-- Uploaded Video -->
                    <video controls class="welcome-video-side rounded shadow">
                        <source src="{{ asset('storage/' . $homepage->welcome_video_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>
                    @elseif($homepage->welcome_video_type === 'link' && $homepage->getVideoEmbedUrl())
                    <!-- Embedded Video (YouTube/Vimeo) -->
                    <div class="welcome-video-embed-side">
                        <div class="ratio ratio-16x9 rounded shadow overflow-hidden">
                            <iframe src="{{ $homepage->getVideoEmbedUrl() }}"
                                    frameborder="0"
                                    allowfullscreen
                                    class="rounded"></iframe>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @else
        <!-- Below Layout: Text Above, Video/Image Below -->
        <!-- Welcome Text -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3">{{ $homepage->welcome_title }}</h2>
                <p class="lead text-muted mb-0">{{ $homepage->welcome_description }}</p>
            </div>
        </div>

        <!-- Welcome Media (Video/Image) -->
        @if($homepage->welcome_video_type !== 'none' || $homepage->welcome_image_path)
        <div class="row mb-5">
            <div class="col-12">
                <div class="welcome-media-container text-center">
                    @if($homepage->welcome_video_type !== 'none')
                    <!-- Video Display -->
                    <div class="video-container">
                        @if($homepage->welcome_video_type === 'upload' && $homepage->welcome_video_path)
                        <!-- Uploaded Video -->
                        <video controls class="welcome-video rounded shadow">
                            <source src="{{ asset('storage/' . $homepage->welcome_video_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                        @elseif($homepage->welcome_video_type === 'link' && $homepage->getVideoEmbedUrl())
                        <!-- Embedded Video (YouTube/Vimeo) -->
                        <div class="welcome-video-embed">
                            <div class="ratio ratio-16x9 rounded shadow overflow-hidden">
                                <iframe src="{{ $homepage->getVideoEmbedUrl() }}"
                                        frameborder="0"
                                        allowfullscreen
                                        class="rounded"></iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                    @elseif($homepage->welcome_image_path)
                    <!-- Image Display -->
                    <img src="{{ asset('storage/' . $homepage->welcome_image_path) }}"
                         alt="{{ $homepage->welcome_title }}"
                         class="welcome-image img-fluid rounded shadow">
                    @endif
                </div>
            </div>
        </div>
        @endif
        @endif

        <!-- Enhanced Statistics -->
        <div class="stats-section mb-5">
            <div class="row text-center mb-4">
                <div class="col-12">
                    <h2 class="fw-bold mb-3">Prestasi Kami dalam Angka</h2>
                    <p class="text-muted">Data yang membanggakan dari perjalanan pendidikan kami</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-card stats-card-primary">
                        <div class="stats-card-inner">
                            <div class="stats-icon">
                                <i class="fas fa-users"></i>
                                <div class="icon-glow"></div>
                            </div>
                            <div class="stats-content">
                                <h3 class="stats-number" data-target="{{ $homepage->stats_students }}">0</h3>
                                <p class="stats-label">Siswa Aktif</p>
                                <div class="stats-progress">
                                    <div class="progress-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card stats-card-success">
                        <div class="stats-card-inner">
                            <div class="stats-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <div class="icon-glow"></div>
                            </div>
                            <div class="stats-content">
                                <h3 class="stats-number" data-target="{{ $homepage->stats_teachers }}">0</h3>
                                <p class="stats-label">Tenaga Pengajar</p>
                                <div class="stats-progress">
                                    <div class="progress-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card stats-card-info">
                        <div class="stats-card-inner">
                            <div class="stats-icon">
                                <i class="fas fa-graduation-cap"></i>
                                <div class="icon-glow"></div>
                            </div>
                            <div class="stats-content">
                                <h3 class="stats-number" data-target="{{ $homepage->stats_programs }}">0</h3>
                                <p class="stats-label">Program Studi</p>
                                <div class="stats-progress">
                                    <div class="progress-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card stats-card-warning">
                        <div class="stats-card-inner">
                            <div class="stats-icon">
                                <i class="fas fa-trophy"></i>
                                <div class="icon-glow"></div>
                            </div>
                            <div class="stats-content">
                                <h3 class="stats-number" data-target="{{ $homepage->stats_achievements }}">0</h3>
                                <p class="stats-label">Prestasi Diraih</p>
                                <div class="stats-progress">
                                    <div class="progress-line"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Features -->
        <div class="features-section">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold mb-3">Mengapa Memilih Kami?</h2>
                    <p class="text-muted">Keunggulan yang membuat kami berbeda dari yang lain</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-card-inner">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="feature-icon-bg"></div>
                            </div>
                            <div class="feature-content">
                                <h5 class="feature-title">Tenaga Pengajar Berkualitas</h5>
                                <p class="feature-description">Guru-guru berpengalaman dan bersertifikat yang siap membimbing siswa menuju kesuksesan dengan metode pembelajaran terkini.</p>
                                <div class="feature-link">
                                    <span>Pelajari Lebih Lanjut</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-card-inner">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon">
                                    <i class="fas fa-laptop"></i>
                                </div>
                                <div class="feature-icon-bg"></div>
                            </div>
                            <div class="feature-content">
                                <h5 class="feature-title">Fasilitas Modern</h5>
                                <p class="feature-description">Dilengkapi dengan teknologi terkini dan fasilitas lengkap untuk mendukung proses pembelajaran yang efektif dan menyenangkan.</p>
                                <div class="feature-link">
                                    <span>Pelajari Lebih Lanjut</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-card-inner">
                            <div class="feature-icon-wrapper">
                                <div class="feature-icon">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="feature-icon-bg"></div>
                            </div>
                            <div class="feature-content">
                                <h5 class="feature-title">Prestasi Gemilang</h5>
                                <p class="feature-description">Berbagai prestasi akademik dan non-akademik yang membanggakan di tingkat regional, nasional, hingga internasional.</p>
                                <div class="feature-link">
                                    <span>Pelajari Lebih Lanjut</span>
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Latest News Section -->
@if($homepage->show_news_section && $latestNews->count() > 0)
<section class="news-section py-5 bg-light position-relative">
    <!-- Background Pattern -->
    <div class="news-bg-pattern"></div>

    <div class="container position-relative">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="section-badge mb-3">
                    <span class="badge bg-primary text-white px-3 py-2 rounded-pill">
                        <i class="fas fa-newspaper me-2"></i>Berita Terbaru
                    </span>
                </div>
                <h2 class="fw-bold mb-3">Informasi Terkini</h2>
                <p class="text-muted">Dapatkan update terbaru tentang kegiatan dan prestasi sekolah kami</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($latestNews as $news)
            <div class="col-md-4">
                <article class="news-card-modern">
                    <div class="news-card-inner">
                        <div class="news-image-wrapper">
                            @if($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}"
                                 class="news-image"
                                 alt="{{ $news->title }}">
                            @else
                            <img src="https://via.placeholder.com/400x250/667eea/ffffff?text=News"
                                 class="news-image"
                                 alt="{{ $news->title }}">
                            @endif
                            <div class="news-overlay">
                                <div class="news-date">
                                    <span class="day">{{ $news->published_at->format('d') }}</span>
                                    <span class="month">{{ $news->published_at->format('M') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span class="news-category">
                                    <i class="fas fa-tag me-1"></i>Berita
                                </span>
                                <span class="news-time">
                                    <i class="fas fa-clock me-1"></i>{{ $news->published_at->diffForHumans() }}
                                </span>
                            </div>
                            <h5 class="news-title">{{ $news->title }}</h5>
                            <p class="news-excerpt">{{ Str::limit(strip_tags($news->content), 120) }}</p>
                            <div class="news-footer">
                                <a href="{{ route('news.show', $news->id) }}" class="news-read-more">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('news') }}" class="btn btn-primary btn-lg rounded-pill px-5 py-3 btn-hover-effect">
                <i class="fas fa-newspaper me-2"></i>Lihat Semua Berita
                <span class="btn-shine"></span>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Enhanced Gallery Preview Section -->
@if($homepage->show_gallery_section && $featuredGallery->count() > 0)
<section class="gallery-section py-5 position-relative">
    <!-- Background Elements -->
    <div class="gallery-bg-elements">
        <div class="floating-circle circle-1"></div>
        <div class="floating-circle circle-2"></div>
        <div class="floating-circle circle-3"></div>
    </div>

    <div class="container position-relative">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <div class="section-badge mb-3">
                    <span class="badge bg-success text-white px-3 py-2 rounded-pill">
                        <i class="fas fa-images me-2"></i>Galeri Foto
                    </span>
                </div>
                <h2 class="fw-bold mb-3">Momen Berharga</h2>
                <p class="text-muted">Dokumentasi kegiatan dan prestasi yang membanggakan di sekolah kami</p>
            </div>
        </div>
        <div class="gallery-grid">
            @foreach($featuredGallery as $index => $gallery)
            <div class="gallery-item-modern {{ $index === 0 ? 'gallery-featured' : '' }}">
                <div class="gallery-card">
                    <div class="gallery-image-wrapper">
                        @if($gallery->image_path)
                        <img src="{{ asset('storage/' . $gallery->image_path) }}"
                             class="gallery-image"
                             alt="{{ $gallery->title }}">
                        @else
                        <img src="https://via.placeholder.com/400x300/667eea/ffffff?text=Gallery"
                             class="gallery-image"
                             alt="{{ $gallery->title }}">
                        @endif

                        <!-- Hover Overlay -->
                        <div class="gallery-overlay">
                            <div class="gallery-overlay-content">
                                <div class="gallery-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                                <h6 class="gallery-title">{{ $gallery->title }}</h6>
                                @if($gallery->description)
                                <p class="gallery-description">{{ Str::limit($gallery->description, 80) }}</p>
                                @endif
                                <div class="gallery-action">
                                    <span class="view-gallery">Lihat Detail</span>
                                </div>
                            </div>
                        </div>

                        <!-- Image Effects -->
                        <div class="gallery-shine"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('gallery') }}" class="btn btn-success btn-lg rounded-pill px-5 py-3 btn-hover-effect">
                <i class="fas fa-images me-2"></i>Jelajahi Semua Galeri
                <span class="btn-shine"></span>
            </a>
        </div>
    </div>
</section>
@endif
@endsection

@section('scripts')
<script>
// Simple Hero Slider
(function() {
    'use strict';

    let currentSlide = 0;
    let autoPlayTimer = null;
    let isInitialized = false;

    function initHeroSlider() {
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        const slider = document.getElementById('heroSlider');

        if (slides.length <= 1) {
            return;
        }

        if (isInitialized) {
            return;
        }

        isInitialized = true;

        // Show first slide
        showSlide(0);

        // Start auto-play
        startAutoPlay();

        // Add hover events
        if (slider) {
            slider.addEventListener('mouseenter', stopAutoPlay);
            slider.addEventListener('mouseleave', startAutoPlay);
        }
    }

    function showSlide(index) {
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');

        if (slides.length === 0) return;

        // Remove active class from all
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Add active class to current
        if (slides[index]) {
            slides[index].classList.add('active');
        }
        if (dots[index]) {
            dots[index].classList.add('active');
        }

        currentSlide = index;
    }

    function nextSlide() {
        const slides = document.querySelectorAll('.slide');
        const nextIndex = (currentSlide + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        const slides = document.querySelectorAll('.slide');
        const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    function startAutoPlay() {
        const slides = document.querySelectorAll('.slide');

        if (slides.length <= 1) return;

        stopAutoPlay(); // Clear any existing timer

        autoPlayTimer = setInterval(() => {
            nextSlide();
        }, 5000);
    }

    function stopAutoPlay() {
        if (autoPlayTimer) {
            clearInterval(autoPlayTimer);
            autoPlayTimer = null;
        }
    }

    // Global functions for navigation
    window.changeSlide = function(direction) {
        stopAutoPlay();
        if (direction === 1) {
            nextSlide();
        } else {
            prevSlide();
        }
        startAutoPlay();
    };

    window.currentSlide = function(index) {
        stopAutoPlay();
        showSlide(index);
        startAutoPlay();
    };



    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroSlider);
    } else {
        initHeroSlider();
    }

    // Cleanup
    window.addEventListener('beforeunload', stopAutoPlay);

})();

// Stats Counter Animation
(function() {
    'use strict';

    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }

            // Format number with + if it's in the original target
            const originalText = element.getAttribute('data-target');
            if (originalText && originalText.includes('+')) {
                element.textContent = Math.floor(current) + '+';
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }

    function startStatsAnimation() {
        const statsNumbers = document.querySelectorAll('.stats-number[data-target]');

        statsNumbers.forEach(element => {
            const target = element.getAttribute('data-target');
            // Extract numeric value (remove + and other characters)
            const numericTarget = parseInt(target.replace(/[^0-9]/g, ''));

            if (numericTarget && numericTarget > 0) {
                animateCounter(element, numericTarget, 2000);
            }
        });
    }

    // Intersection Observer for triggering animation when stats come into view
    function initStatsObserver() {
        const statsSection = document.querySelector('.stats-section');

        if (!statsSection) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startStatsAnimation();
                    observer.unobserve(entry.target); // Only animate once
                }
            });
        }, {
            threshold: 0.5 // Trigger when 50% of the section is visible
        });

        observer.observe(statsSection);
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStatsObserver);
    } else {
        initStatsObserver();
    }
})();
</script>
@endsection

@section('styles')
<!-- Modern Homepage Styles -->
<link href="{{ asset('css/modern-homepage.css') }}" rel="stylesheet">

<style>
/* Minimal additional styles - main styles are in modern-homepage.css */
.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.news-card {
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}
</style>
@endsection
