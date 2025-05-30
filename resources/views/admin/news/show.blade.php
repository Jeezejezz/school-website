@extends('admin.layouts.app')

@section('title', 'Detail Berita')
@section('page-title', 'Detail Berita')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>
                    Detail Berita
                </h5>
                <div>
                    <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('news.show', $news->id) }}" class="btn btn-outline-secondary btn-sm" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Lihat di Website
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- News Header -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h1 class="h3 fw-bold">{{ $news->title }}</h1>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="fas fa-user me-2"></i>
                            <span class="me-3">{{ $news->author }}</span>
                            <i class="fas fa-calendar me-2"></i>
                            <span class="me-3">{{ $news->published_at->format('d F Y') }}</span>
                            <i class="fas fa-clock me-2"></i>
                            <span>{{ $news->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        @if($news->is_published)
                        <span class="badge bg-success fs-6">
                            <i class="fas fa-check me-1"></i>Published
                        </span>
                        @else
                        <span class="badge bg-warning fs-6">
                            <i class="fas fa-clock me-1"></i>Draft
                        </span>
                        @endif
                    </div>
                </div>
                
                <!-- News Image -->
                @if($news->image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $news->image) }}" 
                         alt="{{ $news->title }}" 
                         class="img-fluid rounded shadow"
                         style="max-height: 400px; object-fit: cover;">
                </div>
                @endif
                
                <!-- News Content -->
                <div class="content">
                    <div class="bg-light p-4 rounded">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>
                
                <hr class="my-4">
                
                <!-- News Meta Information -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Informasi Berita</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>ID:</strong></td>
                                <td>{{ $news->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Penulis:</strong></td>
                                <td>{{ $news->author }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($news->is_published)
                                    <span class="badge bg-success">Published</span>
                                    @else
                                    <span class="badge bg-warning">Draft</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Publish:</strong></td>
                                <td>{{ $news->published_at->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat:</strong></td>
                                <td>{{ $news->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Diupdate:</strong></td>
                                <td>{{ $news->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Statistik</h6>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="card bg-primary text-white">
                                    <div class="card-body py-3">
                                        <h4 class="mb-0">{{ strlen(strip_tags($news->content)) }}</h4>
                                        <small>Karakter</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card bg-info text-white">
                                    <div class="card-body py-3">
                                        <h4 class="mb-0">{{ str_word_count(strip_tags($news->content)) }}</h4>
                                        <small>Kata</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($news->image)
                        <div class="mt-3">
                            <h6 class="fw-bold text-primary">Informasi Gambar</h6>
                            <p class="small text-muted mb-1">
                                <strong>File:</strong> {{ basename($news->image) }}
                            </p>
                            <p class="small text-muted mb-0">
                                <strong>Path:</strong> storage/{{ $news->image }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
                
                <hr class="my-4">
                
                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                    
                    <div>
                        <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-2"></i>Edit Berita
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
                <p>Apakah Anda yakin ingin menghapus berita <strong>"{{ $news->title }}"</strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST" style="display: inline;">
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
