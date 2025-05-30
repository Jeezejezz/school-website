@extends('admin.layouts.app')

@section('title', 'Manajemen Pesan Kontak')
@section('page-title', 'Manajemen Pesan Kontak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-envelope me-2"></i>
                    Daftar Pesan Kontak
                </h5>
            </div>
            <div class="card-body">
                @if($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Nama</th>
                                <th width="20%">Email</th>
                                <th width="25%">Subjek</th>
                                <th width="15%">Tanggal</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $index => $contact)
                            <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                                <td>{{ $contacts->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $contact->name }}</strong>
                                    @if($contact->phone)
                                    <br><small class="text-muted">{{ $contact->phone }}</small>
                                    @endif
                                </td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    {{ Str::limit($contact->subject, 40) }}
                                    @if(!$contact->is_read)
                                    <span class="badge bg-warning text-dark ms-1">New</span>
                                    @endif
                                </td>
                                <td>{{ $contact->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($contact->is_read)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check me-1"></i>Read
                                    </span>
                                    @else
                                    <span class="badge bg-warning">
                                        <i class="fas fa-envelope me-1"></i>Unread
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                                           class="btn btn-outline-info" 
                                           title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(!$contact->is_read)
                                        <form action="{{ route('admin.contacts.mark-read', $contact->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success" title="Tandai Dibaca">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        @endif
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                title="Hapus"
                                                onclick="confirmDelete({{ $contact->id }}, '{{ $contact->name }}')">
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
                    {{ $contacts->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-envelope fa-5x text-muted mb-4"></i>
                    <h4 class="text-muted">Belum Ada Pesan</h4>
                    <p class="text-muted">Pesan dari form kontak akan muncul di sini.</p>
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
                <p>Apakah Anda yakin ingin menghapus pesan dari <strong id="contactName"></strong>?</p>
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
function confirmDelete(contactId, contactName) {
    document.getElementById('contactName').textContent = contactName;
    document.getElementById('deleteForm').action = `/admin/contacts/${contactId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
