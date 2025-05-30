@extends('admin.layouts.app')

@section('title', 'Manajemen Berita')
@section('page-title', 'Manajemen Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-newspaper me-2"></i>
                    Daftar Berita
                </h5>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Berita
                </a>
            </div>
            <div class="card-body">
                @if($news->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">Gambar</th>
                                <th width="30%">Judul</th>
                                <th width="15%">Penulis</th>
                                <th width="15%">Tanggal Publish</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $index => $item)
                            <tr>
                                <td>{{ $news->firstItem() + $index }}</td>
                                <td>
                                    @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                         alt="{{ $item->title }}" 
                                         class="img-thumbnail" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <h6 class="mb-1">{{ Str::limit($item->title, 50) }}</h6>
                                    <small class="text-muted">{{ Str::limit(strip_tags($item->content), 80) }}</small>
                                </td>
                                <td>{{ $item->author }}</td>
                                <td>{{ $item->published_at->format('d M Y') }}</td>
                                <td>
                                    @if($item->is_published)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Published
                                    </span>
                                    @else
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock me-1"></i>Draft
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.news.show', $item->id) }}" 
                                           class="btn btn-outline-info" 
                                           title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $item->id) }}" 
                                           class="btn btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                title="Hapus"
                                                onclick="confirmDelete({{ $item->id }}, '{{ $item->title }}')">
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
                    {{ $news->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Berita</h4>
                    <p class="text-muted">Mulai tambahkan berita pertama untuk website sekolah.</p>
                    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Berita Pertama
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
                <p>Apakah Anda yakin ingin menghapus berita <strong id="newsTitle"></strong>?</p>
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
function confirmDelete(newsId, newsTitle) {
    document.getElementById('newsTitle').textContent = newsTitle;
    document.getElementById('deleteForm').action = `/admin/news/${newsId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
