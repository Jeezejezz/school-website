@extends('layouts.app')

@section('title', 'About Us - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Tentang Kami</h1>
                <p class="lead">Mengenal lebih dekat sekolah kami</p>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container">
        @if($school)
        <!-- School Overview -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">{{ $school->name }}</h2>
                <p class="lead">{{ $school->description }}</p>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-alt text-primary me-3 fa-lg"></i>
                            <div>
                                <strong>Didirikan</strong><br>
                                <span class="text-muted">{{ $school->established_year }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-3 fa-lg"></i>
                            <div>
                                <strong>Lokasi</strong><br>
                                <span class="text-muted">{{ $school->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                @if($school->logo)
                <img src="{{ asset('storage/' . $school->logo) }}" alt="{{ $school->name }}" class="img-fluid rounded shadow">
                @else
                <img src="https://via.placeholder.com/600x400/667eea/ffffff?text=School+Building" alt="School Building" class="img-fluid rounded shadow">
                @endif
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-eye fa-3x text-primary"></i>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Visi</h3>
                        <p class="text-center">{{ $school->vision }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Misi</h3>
                        <p class="text-center">{{ $school->mission }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- History -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-history fa-3x text-primary"></i>
                            <h3 class="fw-bold mt-3">Sejarah Sekolah</h3>
                        </div>
                        <p class="lead text-center">{{ $school->history }}</p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Default content when no school data -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Sekolah Kami</h2>
                <p class="lead">Sekolah kami adalah institusi pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas tinggi dengan mengintegrasikan nilai-nilai akademik dan karakter.</p>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-calendar-alt text-primary me-3 fa-lg"></i>
                            <div>
                                <strong>Didirikan</strong><br>
                                <span class="text-muted">1995</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-3 fa-lg"></i>
                            <div>
                                <strong>Lokasi</strong><br>
                                <span class="text-muted">Jakarta, Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/600x400/667eea/ffffff?text=School+Building" alt="School Building" class="img-fluid rounded shadow">
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-eye fa-3x text-primary"></i>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Visi</h3>
                        <p class="text-center">Menjadi sekolah unggulan yang menghasilkan generasi cerdas, berkarakter, dan siap menghadapi tantangan masa depan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-bullseye fa-3x text-primary"></i>
                        </div>
                        <h3 class="text-center fw-bold mb-4">Misi</h3>
                        <p class="text-center">Menyelenggarakan pendidikan berkualitas dengan pendekatan holistik yang mengembangkan potensi akademik dan karakter siswa.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Statistics -->
        <div class="row text-center">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold stats-number" data-target="{{ $homepage->stats_students ?? '1200+' }}">0</h3>
                        <p class="text-muted">Siswa Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-chalkboard-teacher fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold stats-number" data-target="{{ $homepage->stats_teachers ?? '85+' }}">0</h3>
                        <p class="text-muted">Tenaga Pengajar</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-graduation-cap fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold stats-number" data-target="{{ $homepage->stats_programs ?? '12+' }}">0</h3>
                        <p class="text-muted">Program Studi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <i class="fas fa-trophy fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold stats-number" data-target="{{ $homepage->stats_achievements ?? '150+' }}">0</h3>
                        <p class="text-muted">Prestasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
// Stats Counter Animation for About Page
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
        const statsSection = document.querySelector('.row.text-center');

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
