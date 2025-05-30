@extends('admin.layouts.app')

@section('title', 'Detail Program Akademik')
@section('page-title', 'Detail Program Akademik')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>
                    Detail Program Akademik
                </h5>
                <div>
                    <a href="{{ route('admin.academics.edit', $academic->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('academics') }}" class="btn btn-outline-secondary btn-sm" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat di Website
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Program Header -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h1 class="h3 fw-bold text-primary">{{ $academic->program_name }}</h1>
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <span class="badge bg-info fs-6">{{ $academic->level }}</span>
                            <span class="badge bg-secondary fs-6">{{ $academic->duration }}</span>
                            @if($academic->is_active)
                            <span class="badge bg-success fs-6">
                                <i class="fas fa-check me-1"></i>Aktif
                            </span>
                            @else
                            <span class="badge bg-danger fs-6">
                                <i class="fas fa-times me-1"></i>Tidak Aktif
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            Dibuat: {{ $academic->created_at->format('d F Y') }}
                        </small>
                    </div>
                </div>

                <!-- Program Content -->
                <div class="row">
                    <div class="col-md-8">
                        <!-- Description -->
                        <div class="mb-4">
                            <h5 class="text-primary fw-bold mb-3">
                                <i class="fas fa-info-circle me-2"></i>Deskripsi Program
                            </h5>
                            <div class="bg-light p-4 rounded">
                                <p class="mb-0">{{ $academic->description }}</p>
                            </div>
                        </div>

                        <!-- Curriculum -->
                        <div class="mb-4">
                            <h5 class="text-primary fw-bold mb-3">
                                <i class="fas fa-book me-2"></i>Kurikulum
                            </h5>
                            <div class="bg-light p-4 rounded">
                                <div style="white-space: pre-wrap;">{{ $academic->curriculum }}</div>
                            </div>
                        </div>

                        <!-- Career Prospects -->
                        @if($academic->career_prospects)
                        <div class="mb-4">
                            <h5 class="text-primary fw-bold mb-3">
                                <i class="fas fa-briefcase me-2"></i>Prospek Karir
                            </h5>
                            <div class="bg-light p-4 rounded">
                                <div style="white-space: pre-wrap;">{{ $academic->career_prospects }}</div>
                            </div>
                        </div>
                        @endif

                        <!-- Requirements -->
                        @if($academic->requirements)
                        <div class="mb-4">
                            <h5 class="text-primary fw-bold mb-3">
                                <i class="fas fa-clipboard-check me-2"></i>Persyaratan Masuk
                            </h5>
                            <div class="bg-light p-4 rounded">
                                <div style="white-space: pre-wrap;">{{ $academic->requirements }}</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <!-- Program Information -->
                        <div class="card bg-light">
                            <div class="card-header">
                                <h6 class="mb-0 fw-bold text-primary">Informasi Program</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="40%"><strong>ID:</strong></td>
                                        <td>{{ $academic->id }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Level:</strong></td>
                                        <td><span class="badge bg-info">{{ $academic->level }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Durasi:</strong></td>
                                        <td>{{ $academic->duration }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            @if($academic->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                            @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dibuat:</strong></td>
                                        <td>{{ $academic->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Diupdate:</strong></td>
                                        <td>{{ $academic->updated_at->format('d F Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="card bg-light mt-3">
                            <div class="card-header">
                                <h6 class="mb-0 fw-bold text-primary">Statistik</h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="card bg-primary text-white">
                                            <div class="card-body py-3">
                                                <h4 class="mb-0">{{ strlen($academic->description) }}</h4>
                                                <small>Karakter Deskripsi</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card bg-info text-white">
                                            <div class="card-body py-3">
                                                <h4 class="mb-0">{{ str_word_count($academic->curriculum) }}</h4>
                                                <small>Kata Kurikulum</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($academic->career_prospects || $academic->requirements)
                                <div class="row text-center mt-2">
                                    @if($academic->career_prospects)
                                    <div class="col-{{ $academic->requirements ? '6' : '12' }}">
                                        <div class="card bg-success text-white">
                                            <div class="card-body py-3">
                                                <h4 class="mb-0">{{ str_word_count($academic->career_prospects) }}</h4>
                                                <small>Kata Prospek Karir</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($academic->requirements)
                                    <div class="col-{{ $academic->career_prospects ? '6' : '12' }}">
                                        <div class="card bg-warning text-white">
                                            <div class="card-body py-3">
                                                <h4 class="mb-0">{{ str_word_count($academic->requirements) }}</h4>
                                                <small>Kata Persyaratan</small>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card bg-light mt-3">
                            <div class="card-header">
                                <h6 class="mb-0 fw-bold text-primary">Quick Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.academics.edit', $academic->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit me-2"></i>Edit Program
                                    </a>

                                    @if($academic->is_active)
                                    <form action="{{ route('admin.academics.update', $academic->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="program_name" value="{{ $academic->program_name }}">
                                        <input type="hidden" name="description" value="{{ $academic->description }}">
                                        <input type="hidden" name="level" value="{{ $academic->level }}">
                                        <input type="hidden" name="curriculum" value="{{ $academic->curriculum }}">
                                        <input type="hidden" name="duration" value="{{ $academic->duration }}">
                                        <input type="hidden" name="career_prospects" value="{{ $academic->career_prospects }}">
                                        <input type="hidden" name="requirements" value="{{ $academic->requirements }}">
                                        <input type="hidden" name="is_active" value="0">
                                        <button type="submit" class="btn btn-warning btn-sm w-100">
                                            <i class="fas fa-eye-slash me-2"></i>Nonaktifkan
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.academics.update', $academic->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="program_name" value="{{ $academic->program_name }}">
                                        <input type="hidden" name="description" value="{{ $academic->description }}">
                                        <input type="hidden" name="level" value="{{ $academic->level }}">
                                        <input type="hidden" name="curriculum" value="{{ $academic->curriculum }}">
                                        <input type="hidden" name="duration" value="{{ $academic->duration }}">
                                        <input type="hidden" name="career_prospects" value="{{ $academic->career_prospects }}">
                                        <input type="hidden" name="requirements" value="{{ $academic->requirements }}">
                                        <input type="hidden" name="is_active" value="1">
                                        <button type="submit" class="btn btn-success btn-sm w-100">
                                            <i class="fas fa-eye me-2"></i>Aktifkan
                                        </button>
                                    </form>
                                    @endif

                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">
                                        <i class="fas fa-trash me-2"></i>Hapus Program
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.academics.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>

                    <div>
                        <a href="{{ route('admin.academics.edit', $academic->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-2"></i>Edit Program
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus program akademik <strong>"{{ $academic->program_name }}"</strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.academics.destroy', $academic->id) }}" method="POST" style="display: inline;">
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
@endsection

@section('scripts')
<script>
function confirmDelete() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
