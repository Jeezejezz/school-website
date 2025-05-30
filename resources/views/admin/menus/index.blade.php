@extends('admin.layouts.app')

@section('title', 'Manajemen Menu')
@section('page-title', 'Manajemen Menu')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-bars me-2"></i>
                    Daftar Menu Navigation
                </h5>
                <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Menu
                </a>
            </div>
            <div class="card-body">
                @if($menus->count() > 0)
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Tips:</strong> Drag & drop untuk mengubah urutan menu. Menu dengan parent akan menjadi dropdown.
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="menuTable">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">
                                    <i class="fas fa-grip-vertical text-muted"></i>
                                </th>
                                <th width="5%">#</th>
                                <th width="25%">Judul Menu</th>
                                <th width="20%">URL/Route</th>
                                <th width="15%">Parent</th>
                                <th width="10%">Urutan</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-menu">
                            @foreach($menus->whereNull('parent_id') as $menu)
                            <tr data-id="{{ $menu->id }}" class="menu-item">
                                <td class="handle">
                                    <i class="fas fa-grip-vertical text-muted"></i>
                                </td>
                                <td>{{ $menu->id }}</td>
                                <td>
                                    @if($menu->icon)
                                    <i class="{{ $menu->icon }} me-2"></i>
                                    @endif
                                    <strong>{{ $menu->title }}</strong>
                                    @if($menu->children->count() > 0)
                                    <span class="badge bg-info ms-2">{{ $menu->children->count() }} sub-menu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($menu->route_name)
                                    <span class="badge bg-success">{{ $menu->route_name }}</span>
                                    @elseif($menu->url)
                                    <span class="text-primary">{{ Str::limit($menu->url, 30) }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">Main Menu</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $menu->sort_order }}</span>
                                </td>
                                <td>
                                    @if($menu->is_active)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Active
                                    </span>
                                    @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times me-1"></i>Inactive
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                           class="btn btn-outline-primary"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger"
                                                title="Hapus"
                                                onclick="confirmDelete({{ $menu->id }}, '{{ $menu->title }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Sub Menus -->
                            @foreach($menu->children as $child)
                            <tr data-id="{{ $child->id }}" class="menu-item sub-menu">
                                <td class="handle">
                                    <i class="fas fa-grip-vertical text-muted ms-3"></i>
                                </td>
                                <td>{{ $child->id }}</td>
                                <td class="ps-4">
                                    <i class="fas fa-level-up-alt fa-rotate-90 text-muted me-2"></i>
                                    @if($child->icon)
                                    <i class="{{ $child->icon }} me-2"></i>
                                    @endif
                                    {{ $child->title }}
                                </td>
                                <td>
                                    @if($child->route_name)
                                    <span class="badge bg-success">{{ $child->route_name }}</span>
                                    @elseif($child->url)
                                    <span class="text-primary">{{ Str::limit($child->url, 30) }}</span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-info">{{ $menu->title }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $child->sort_order }}</span>
                                </td>
                                <td>
                                    @if($child->is_active)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Active
                                    </span>
                                    @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times me-1"></i>Inactive
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.menus.edit', $child->id) }}"
                                           class="btn btn-outline-primary"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                                class="btn btn-outline-danger"
                                                title="Hapus"
                                                onclick="confirmDelete({{ $child->id }}, '{{ $child->title }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-bars fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Menu</h4>
                    <p class="text-muted">Mulai tambahkan menu navigasi untuk website.</p>
                    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Menu Pertama
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
                <p>Apakah Anda yakin ingin menghapus menu <strong id="menuTitle"></strong>?</p>
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
function confirmDelete(menuId, menuTitle) {
    document.getElementById('menuTitle').textContent = menuTitle;
    document.getElementById('deleteForm').action = `/admin/menus/${menuId}`;

    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Sortable functionality
document.addEventListener('DOMContentLoaded', function() {
    const sortable = Sortable.create(document.getElementById('sortable-menu'), {
        handle: '.handle',
        animation: 150,
        onEnd: function(evt) {
            updateMenuOrder();
        }
    });
});

function updateMenuOrder() {
    const menuItems = document.querySelectorAll('.menu-item');
    const menus = [];

    menuItems.forEach((item, index) => {
        menus.push({
            id: item.dataset.id,
            sort_order: index + 1
        });
    });

    fetch('/admin/menus/update-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ menus: menus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update sort order badges
            menuItems.forEach((item, index) => {
                const badge = item.querySelector('.badge.bg-secondary');
                if (badge) {
                    badge.textContent = index + 1;
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
