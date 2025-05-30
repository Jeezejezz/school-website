@extends('layouts.app')

@section('title', 'Contact - Sekolah Kami')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Hubungi Kami</h1>
                <p class="lead">Kami siap membantu Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subjek <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                           id="subject" name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label for="message" class="form-label">Pesan <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Informasi Kontak</h3>
                        
                        @if($school)
                        <div class="contact-info">
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-map-marker-alt text-primary me-3 mt-1 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Alamat</h6>
                                    <p class="text-muted mb-0">{{ $school->address }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-phone text-primary me-3 mt-1 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Telepon</h6>
                                    <p class="text-muted mb-0">{{ $school->phone }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-envelope text-primary me-3 mt-1 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Email</h6>
                                    <p class="text-muted mb-0">{{ $school->email }}</p>
                                </div>
                            </div>
                            
                            @if($school->website)
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-globe text-primary me-3 mt-1 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Website</h6>
                                    <p class="text-muted mb-0">
                                        <a href="{{ $school->website }}" target="_blank" class="text-decoration-none">
                                            {{ $school->website }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="contact-info">
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-map-marker-alt text-primary me-3 mt-1 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Alamat</h6>
                                    <p class="text-muted mb-0">Jl. Pendidikan Raya No. 123, Jakarta Pusat</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-phone text-primary me-3 mt-1 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Telepon</h6>
                                    <p class="text-muted mb-0">(021) 123-4567</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-start mb-4">
                                <i class="fas fa-envelope text-primary me-3 mt-1 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">Email</h6>
                                    <p class="text-muted mb-0">info@sekolahkami.sch.id</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <hr class="my-4">
                        
                        <h6 class="fw-bold mb-3">Jam Operasional</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Senin - Jumat</span>
                            <span class="text-muted">07:00 - 16:00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sabtu</span>
                            <span class="text-muted">07:00 - 12:00</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Minggu</span>
                            <span class="text-muted">Tutup</span>
                        </div>
                    </div>
                </div>
                
                <!-- Map -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-body p-0">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e67356080477!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sen!2sid!4v1635123456789!5m2!1sen!2sid" 
                                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
