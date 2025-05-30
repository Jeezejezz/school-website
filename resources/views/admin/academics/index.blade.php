@extends('admin.layouts.app')

@section('title', 'Manajemen Program Akademik')
@section('page-title', 'Manajemen Program Akademik')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>
                    Daftar Program Akademik
                </h5>
                <a href="{{ route('admin.academics.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Program
                </a>
            </div>
            <div class="card-body">
                @if($academics->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Nama Program</th>
                                <th width="15%">Level</th>
                                <th width="15%">Durasi</th>
                                <th width="25%">Deskripsi</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($academics as $index => $academic)
                            <tr>
                                <td>{{ $academics->firstItem() + $index }}</td>
                                <td>
                                    <h6 class="mb-1">{{ $academic->program_name }}</h6>
                                    <small class="text-muted">ID: {{ $academic->id }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $academic->level }}</span>
                                </td>
                                <td>{{ $academic->duration }}</td>
                                <td>
                                    <p class="mb-0">{{ Str::limit($academic->description, 80) }}</p>
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
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.academics.show', $academic->id) }}" 
                                           class="btn btn-outline-info" 
                                           title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.academics.edit', $academic->id) }}" 
                                           class="btn btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                title="Hapus"
                                                onclick="confirmDelete({{ $academic->id }}, '{{ $academic->program_name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $academics->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-graduation-cap fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Program Akademik</h4>
                    <p class="text-muted">Mulai tambahkan program akademik untuk sekolah.</p>
                    <a href="{{ route('admin.academics.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Program Pertama
                    </a>
                </div>
                @endif
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
                <p>Apakah Anda yakin ingin menghapus program akademik <strong id="programName"></strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
function confirmDelete(academicId, programName) {
    document.getElementById('programName').textContent = programName;
    document.getElementById('deleteForm').action = `/admin/academics/${academicId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
