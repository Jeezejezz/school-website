@extends('admin.layouts.app')

@section('title', 'Manajemen Keunggulan Akademik')
@section('page-title', 'Manajemen Keunggulan Akademik')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-star me-2"></i>
                    Daftar Keunggulan Akademik
                </h5>
                <a href="{{ route('admin.academic-features.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Keunggulan
                </a>
            </div>
            <div class="card-body">
                @if($features->count() > 0)
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Tips:</strong> Drag & drop untuk mengubah urutan keunggulan akademik.
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="featuresTable">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">
                                    <i class="fas fa-grip-vertical text-muted"></i>
                                </th>
                                <th width="5%">#</th>
                                <th width="30%">Judul</th>
                                <th width="35%">Deskripsi</th>
                                <th width="10%">Icon</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-features">
                            @foreach($features as $feature)
                            <tr data-id="{{ $feature->id }}" class="feature-item">
                                <td class="handle">
                                    <i class="fas fa-grip-vertical text-muted"></i>
                                </td>
                                <td>{{ $feature->sort_order }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-{{ $feature->color }} text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px;">
                                            <i class="{{ $feature->icon }}"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $feature->title }}</h6>
                                            <small class="text-muted">{{ ucfirst($feature->color) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">{{ Str::limit($feature->description, 100) }}</p>
                                </td>
                                <td>
                                    <code>{{ $feature->icon }}</code>
                                </td>
                                <td>
                                    @if($feature->is_active)
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
                                        <a href="{{ route('admin.academic-features.show', $feature->id) }}" 
                                           class="btn btn-outline-info" 
                                           title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.academic-features.edit', $feature->id) }}" 
                                           class="btn btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                title="Hapus"
                                                onclick="confirmDelete({{ $feature->id }}, '{{ $feature->title }}')">
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
                    {{ $features->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-star fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Keunggulan Akademik</h4>
                    <p class="text-muted">Mulai tambahkan keunggulan akademik untuk website sekolah.</p>
                    <a href="{{ route('admin.academic-features.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Keunggulan Pertama
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
                <p>Apakah Anda yakin ingin menghapus keunggulan akademik <strong id="featureTitle"></strong>?</p>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
function confirmDelete(featureId, featureTitle) {
    document.getElementById('featureTitle').textContent = featureTitle;
    document.getElementById('deleteForm').action = `/admin/academic-features/${featureId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Sortable functionality
document.addEventListener('DOMContentLoaded', function() {
    const sortable = Sortable.create(document.getElementById('sortable-features'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            updateFeatureOrder();
        }
    });
});

function updateFeatureOrder() {
    const featureItems = document.querySelectorAll('.feature-item');
    const features = [];
    
    featureItems.forEach((item, index) => {
        features.push({
            id: item.dataset.id,
            sort_order: index + 1
        });
    });
    
    fetch('/admin/academic-features/update-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ features: features })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update sort order numbers
            featureItems.forEach((item, index) => {
                const orderCell = item.querySelector('td:nth-child(2)');
                if (orderCell) {
                    orderCell.textContent = index + 1;
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
@endsection
