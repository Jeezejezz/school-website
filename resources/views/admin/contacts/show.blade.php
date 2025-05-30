@extends('admin.layouts.app')

@section('title', 'Detail Pesan Kontak')
@section('page-title', 'Detail Pesan Kontak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-envelope me-2"></i>
                    Pesan dari {{ $contact->name }}
                </h5>
                <div>
                    @if(!$contact->is_read)
                    <span class="badge bg-warning me-2">
                        <i class="fas fa-envelope me-1"></i>Unread
                    </span>
                    @else
                    <span class="badge bg-success me-2">
                        <i class="fas fa-check me-1"></i>Read
                    </span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <!-- Contact Information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Informasi Pengirim</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>Nama:</strong></td>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>
                                    <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                        {{ $contact->email }}
                                    </a>
                                </td>
                            </tr>
                            @if($contact->phone)
                            <tr>
                                <td><strong>Telepon:</strong></td>
                                <td>
                                    <a href="tel:{{ $contact->phone }}" class="text-decoration-none">
                                        {{ $contact->phone }}
                                    </a>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td><strong>Subjek:</strong></td>
                                <td>{{ $contact->subject }}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Informasi Pesan</h6>
                        <table class="table table-sm">
                            <tr>
                                <td width="30%"><strong>ID:</strong></td>
                                <td>{{ $contact->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($contact->is_read)
                                    <span class="badge bg-success">Read</span>
                                    @else
                                    <span class="badge bg-warning">Unread</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Diterima:</strong></td>
                                <td>{{ $contact->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Waktu Lalu:</strong></td>
                                <td>{{ $contact->created_at->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Message Content -->
                <div class="mb-4">
                    <h6 class="fw-bold text-primary">Isi Pesan</h6>
                    <div class="bg-light p-4 rounded">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $contact->message }}</p>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">Quick Actions</h6>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-reply me-1"></i>Balas via Email
                            </a>
                            
                            @if($contact->phone)
                            <a href="tel:{{ $contact->phone }}" class="btn btn-success btn-sm">
                                <i class="fas fa-phone me-1"></i>Telepon
                            </a>
                            @endif
                            
                            <button type="button" class="btn btn-info btn-sm" onclick="copyToClipboard('{{ $contact->email }}')">
                                <i class="fas fa-copy me-1"></i>Copy Email
                            </button>
                            
                            @if(!$contact->is_read)
                            <form action="{{ route('admin.contacts.mark-read', $contact->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-check me-1"></i>Tandai Dibaca
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                    
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>Hapus Pesan
                    </button>
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
                <p>Apakah Anda yakin ingin menghapus pesan dari <strong>{{ $contact->name }}</strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
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

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        btn.classList.remove('btn-info');
        btn.classList.add('btn-success');
        
        setTimeout(function() {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-info');
        }, 2000);
    });
}
</script>
@endsection
