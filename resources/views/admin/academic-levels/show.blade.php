@extends('admin.layouts.app')

@section('title', 'Detail Jenjang Pendidikan')
@section('page-title', 'Detail Jenjang Pendidikan')

@section('content')
<div class="row">
    <!-- Main Info -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-layer-group me-2"></i>
                    {{ $academicLevel->display_name }}
                </h5>
                <div>
                    <span class="badge bg-{{ $academicLevel->color }} fs-6 me-2">{{ $academicLevel->name }}</span>
                    @if($academicLevel->is_visible)
                    <span class="badge bg-success">
                        <i class="fas fa-eye me-1"></i>Tampil
                    </span>
                    @else
                    <span class="badge bg-danger">
                        <i class="fas fa-eye-slash me-1"></i>Tersembunyi
                    </span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold">Informasi Dasar</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>Kode Jenjang:</strong></td>
                                <td>{{ $academicLevel->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap:</strong></td>
                                <td>{{ $academicLevel->display_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Warna Badge:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $academicLevel->color }}">{{ ucfirst($academicLevel->color) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Urutan:</strong></td>
                                <td>{{ $academicLevel->sort_order }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($academicLevel->is_visible)
                                    <span class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>Tampil di Website
                                    </span>
                                    @else
                                    <span class="text-danger">
                                        <i class="fas fa-times-circle me-1"></i>Tersembunyi dari Website
                                    </span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary fw-bold">Metadata</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td width="40%"><strong>ID:</strong></td>
                                <td>{{ $academicLevel->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat:</strong></td>
                                <td>{{ $academicLevel->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Diupdate:</strong></td>
                                <td>{{ $academicLevel->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Selisih:</strong></td>
                                <td>{{ $academicLevel->updated_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($academicLevel->description)
                <hr>
                <h6 class="text-primary fw-bold">Deskripsi</h6>
                <p class="text-muted">{{ $academicLevel->description }}</p>
                @endif
            </div>
        </div>
        
        <!-- Academic Programs -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-book me-2"></i>
                    Program Akademik ({{ $academicLevel->academics->count() }})
                </h5>
            </div>
            <div class="card-body">
                @if($academicLevel->academics->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Program</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academicLevel->academics as $academic)
                            <tr>
                                <td>
                                    <h6 class="mb-1">{{ $academic->program_name }}</h6>
                                    <small class="text-muted">{{ Str::limit($academic->description, 60) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $academic->duration }}</span>
                                </td>
                                <td>
                                    @if($academic->is_active)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Aktif
                                    </span>
                                    @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times me-1"></i>Tidak Aktif
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.academics.show', $academic->id) }}" 
                                           class="btn btn-outline-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.academics.edit', $academic->id) }}" 
                                           class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-book fa-3x text-muted mb-3"></i>
                    <h6 class="text-muted">Belum Ada Program Akademik</h6>
                    <p class="text-muted small">Jenjang ini belum memiliki program akademik.</p>
                    <a href="{{ route('admin.academics.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-2"></i>Tambah Program
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Aksi Cepat</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.academic-levels.edit', $academicLevel->id) }}" 
                       class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Jenjang
                    </a>
                    
                    <form action="{{ route('admin.academic-levels.toggle-visibility', $academicLevel->id) }}" 
                          method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="btn btn-{{ $academicLevel->is_visible ? 'warning' : 'success' }} w-100">
                            <i class="fas fa-{{ $academicLevel->is_visible ? 'eye-slash' : 'eye' }} me-2"></i>
                            {{ $academicLevel->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                        </button>
                    </form>
                    
                    @if($academicLevel->academics->count() == 0)
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>Hapus Jenjang
                    </button>
                    @else
                    <button type="button" class="btn btn-secondary" disabled title="Tidak dapat dihapus (ada program)">
                        <i class="fas fa-lock me-2"></i>Tidak Dapat Dihapus
                    </button>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Statistics -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Statistik</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-primary mb-0">{{ $academicLevel->academics->count() }}</h3>
                        <small class="text-muted">Total Program</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-success mb-0">{{ $academicLevel->academics->where('is_active', true)->count() }}</h3>
                        <small class="text-muted">Program Aktif</small>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="text-info mb-0">{{ $academicLevel->sort_order }}</h3>
                        <small class="text-muted">Urutan</small>
                    </div>
                    <div class="col-6">
                        <h3 class="text-{{ $academicLevel->is_visible ? 'success' : 'danger' }} mb-0">
                            <i class="fas fa-{{ $academicLevel->is_visible ? 'eye' : 'eye-slash' }}"></i>
                        </h3>
                        <small class="text-muted">Visibility</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Preview -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Preview Website</h6>
            </div>
            <div class="card-body text-center">
                <p class="small text-muted mb-2">Filter Button:</p>
                <button class="btn btn-outline-{{ $academicLevel->color }} mb-3" disabled>
                    {{ $academicLevel->display_name }}
                </button>
                
                <p class="small text-muted mb-2">Program Badge:</p>
                <span class="badge bg-{{ $academicLevel->color }} fs-6">{{ $academicLevel->name }}</span>
            </div>
        </div>
        
        <!-- Navigation -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Navigasi</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.academic-levels.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>Daftar Jenjang
                    </a>
                    <a href="{{ route('admin.academic-levels.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Jenjang
                    </a>
                    <a href="{{ route('admin.academics.index') }}" class="btn btn-outline-info">
                        <i class="fas fa-book me-2"></i>Program Akademik
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
@if($academicLevel->academics->count() == 0)
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
@if($academicLevel->academics->count() == 0)
function confirmDelete() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
@endif
</script>
@endsection
