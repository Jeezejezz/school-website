@extends('admin.layouts.app')

@section('title', 'Manajemen Jenjang Pendidikan')
@section('page-title', 'Manajemen Jenjang Pendidikan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-layer-group me-2"></i>
                    Daftar Jenjang Pendidikan
                </h5>
                <a href="{{ route('admin.academic-levels.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Jenjang
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Info:</strong> Jenjang yang disembunyikan tidak akan muncul di filter halaman academics. 
                    Klik tombol mata untuk mengatur visibility.
                </div>
                
                @if($levels->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Kode</th>
                                <th width="25%">Nama Jenjang</th>
                                <th width="30%">Deskripsi</th>
                                <th width="10%">Program</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($levels as $level)
                            <tr class="{{ !$level->is_visible ? 'table-secondary' : '' }}">
                                <td>{{ $level->sort_order }}</td>
                                <td>
                                    <span class="badge bg-{{ $level->color }} fs-6">{{ $level->name }}</span>
                                </td>
                                <td>
                                    <h6 class="mb-1">{{ $level->display_name }}</h6>
                                    <small class="text-muted">{{ ucfirst($level->color) }}</small>
                                </td>
                                <td>
                                    <p class="mb-0 text-muted">{{ $level->description ?: 'Tidak ada deskripsi' }}</p>
                                </td>
                                <td>
                                    @php
                                        $programCount = \App\Models\Academic::where('level', $level->name)->count();
                                    @endphp
                                    <span class="badge bg-secondary">{{ $programCount }} program</span>
                                </td>
                                <td>
                                    @if($level->is_visible)
                                    <span class="badge bg-success">
                                        <i class="fas fa-eye me-1"></i>Tampil
                                    </span>
                                    @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-eye-slash me-1"></i>Tersembunyi
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.academic-levels.show', $level->id) }}" 
                                           class="btn btn-outline-info" 
                                           title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.academic-levels.toggle-visibility', $level->id) }}" 
                                              method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="btn btn-outline-{{ $level->is_visible ? 'warning' : 'success' }}" 
                                                    title="{{ $level->is_visible ? 'Sembunyikan' : 'Tampilkan' }}">
                                                <i class="fas fa-{{ $level->is_visible ? 'eye-slash' : 'eye' }}"></i>
                                            </button>
                                        </form>
                                        
                                        <a href="{{ route('admin.academic-levels.edit', $level->id) }}" 
                                           class="btn btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        @if($programCount == 0)
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                title="Hapus"
                                                onclick="confirmDelete({{ $level->id }}, '{{ $level->display_name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @else
                                        <button type="button" 
                                                class="btn btn-outline-secondary" 
                                                title="Tidak dapat dihapus (ada program)"
                                                disabled>
                                            <i class="fas fa-lock"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-layer-group fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Jenjang Pendidikan</h4>
                    <p class="text-muted">Mulai tambahkan jenjang pendidikan untuk website sekolah.</p>
                    <a href="{{ route('admin.academic-levels.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Jenjang Pertama
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Summary Card -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h3 class="mb-0">{{ $levels->count() }}</h3>
                <small>Total Jenjang</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <h3 class="mb-0">{{ $levels->where('is_visible', true)->count() }}</h3>
                <small>Jenjang Tampil</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <h3 class="mb-0">{{ $levels->where('is_visible', false)->count() }}</h3>
                <small>Jenjang Tersembunyi</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body text-center">
                @php
                    $totalPrograms = \App\Models\Academic::count();
                @endphp
                <h3 class="mb-0">{{ $totalPrograms }}</h3>
                <small>Total Program</small>
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
                <p>Apakah Anda yakin ingin menghapus jenjang <strong id="levelName"></strong>?</p>
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
function confirmDelete(levelId, levelName) {
    document.getElementById('levelName').textContent = levelName;
    document.getElementById('deleteForm').action = `/admin/academic-levels/${levelId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
