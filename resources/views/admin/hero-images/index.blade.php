@extends('admin.layouts.app')

@section('title', 'Kelola Gambar Hero')
@section('page-title', 'Kelola Gambar Hero')

@section('content')
<div class="row">
    <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2"></i>Kelola Gambar Hero
                    </h5>
                    @if($heroImages->count() < 5)
                    <a href="{{ route('admin.hero-images.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Gambar
                    </a>
                    @else
                    <span class="badge bg-warning">Maksimal 5 gambar tercapai</span>
                    @endif
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($heroImages->count() > 0)
                    <div class="row" id="sortable-images">
                        @foreach($heroImages as $heroImage)
                        <div class="col-md-6 col-lg-4 mb-4" data-id="{{ $heroImage->id }}">
                            <div class="card hero-image-card {{ $heroImage->is_active ? '' : 'opacity-50' }}">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $heroImage->image_path) }}"
                                         class="card-img-top"
                                         style="height: 200px; object-fit: cover;"
                                         alt="{{ $heroImage->title }}">

                                    <!-- Status Badge -->
                                    <span class="position-absolute top-0 start-0 m-2">
                                        @if($heroImage->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                        @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </span>

                                    <!-- Sort Order Badge -->
                                    <span class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-primary">{{ $heroImage->sort_order }}</span>
                                    </span>

                                    <!-- Drag Handle -->
                                    <div class="position-absolute bottom-0 start-0 m-2">
                                        <span class="badge bg-dark">
                                            <i class="fas fa-grip-vertical"></i> Drag
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h6 class="card-title">
                                        {{ $heroImage->title ?: 'Tanpa Judul' }}
                                    </h6>
                                    @if($heroImage->description)
                                    <p class="card-text small text-muted">
                                        {{ Str::limit($heroImage->description, 100) }}
                                    </p>
                                    @endif

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.hero-images.edit', $heroImage) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.hero-images.toggle-active', $heroImage) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-sm {{ $heroImage->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                <i class="fas {{ $heroImage->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.hero-images.destroy', $heroImage) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Tips:</strong>
                        <ul class="mb-0 mt-2">
                            <li>Drag dan drop kartu untuk mengubah urutan tampilan</li>
                            <li>Maksimal 5 gambar hero yang dapat diupload</li>
                            <li>Gambar akan berganti otomatis setiap 5 detik</li>
                            <li>Hanya gambar yang aktif yang akan ditampilkan di website</li>
                        </ul>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada gambar hero</h5>
                        <p class="text-muted">Tambahkan gambar hero pertama untuk slider</p>
                        <a href="{{ route('admin.hero-images.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Gambar Hero
                        </a>
                    </div>
                    @endif
                </div>
            </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortableContainer = document.getElementById('sortable-images');

    if (sortableContainer) {
        new Sortable(sortableContainer, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const orders = Array.from(sortableContainer.children).map(item =>
                    parseInt(item.dataset.id)
                );

                // Send AJAX request to update order
                fetch('{{ route("admin.hero-images.update-order") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ orders: orders })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update sort order badges
                        sortableContainer.querySelectorAll('.badge.bg-primary').forEach((badge, index) => {
                            badge.textContent = index + 1;
                        });
                    }
                })
                .catch(error => {
                    console.error('Error updating order:', error);
                });
            }
        });
    }
});
</script>

<style>
.hero-image-card {
    transition: all 0.3s ease;
    cursor: move;
}

.hero-image-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}

.sortable-ghost {
    opacity: 0.5;
}

.sortable-chosen {
    transform: rotate(5deg);
}

.sortable-drag {
    transform: rotate(10deg);
}
</style>
@endsection
