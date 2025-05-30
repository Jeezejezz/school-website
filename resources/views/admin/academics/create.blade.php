@extends('admin.layouts.app')

@section('title', 'Tambah Program Akademik')
@section('page-title', 'Tambah Program Akademik')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Program Akademik Baru
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.academics.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <!-- Main Content -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Program</h6>

                            <div class="mb-3">
                                <label for="program_name" class="form-label">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('program_name') is-invalid @enderror"
                                       id="program_name" name="program_name" value="{{ old('program_name') }}" required>
                                @error('program_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Contoh: Ilmu Pengetahuan Alam (IPA), Ilmu Pengetahuan Sosial (IPS)</small>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Program <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Jelaskan secara detail tentang program akademik ini</small>
                            </div>

                            <div class="mb-3">
                                <label for="curriculum" class="form-label">Kurikulum <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('curriculum') is-invalid @enderror"
                                          id="curriculum" name="curriculum" rows="4" required>{{ old('curriculum') }}</textarea>
                                @error('curriculum')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Daftar mata pelajaran dan struktur kurikulum</small>
                            </div>

                            <div class="mb-3">
                                <label for="career_prospects" class="form-label">Prospek Karir</label>
                                <textarea class="form-control @error('career_prospects') is-invalid @enderror"
                                          id="career_prospects" name="career_prospects" rows="4">{{ old('career_prospects') }}</textarea>
                                @error('career_prospects')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Peluang karir dan profesi yang dapat dijalani setelah lulus</small>
                            </div>

                            <div class="mb-3">
                                <label for="requirements" class="form-label">Persyaratan Masuk</label>
                                <textarea class="form-control @error('requirements') is-invalid @enderror"
                                          id="requirements" name="requirements" rows="4">{{ old('requirements') }}</textarea>
                                @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Syarat dan ketentuan untuk dapat masuk ke program ini</small>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Pengaturan Program</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level/Jenjang <span class="text-danger">*</span></label>
                                        <select class="form-select @error('level') is-invalid @enderror"
                                                id="level" name="level" required>
                                            <option value="">Pilih Level</option>
                                            <option value="SMA" {{ old('level') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                            <option value="SMK" {{ old('level') == 'SMK' ? 'selected' : '' }}>SMK</option>
                                            <option value="SMP" {{ old('level') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                            <option value="SD" {{ old('level') == 'SD' ? 'selected' : '' }}>SD</option>
                                        </select>
                                        @error('level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Durasi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('duration') is-invalid @enderror"
                                               id="duration" name="duration" value="{{ old('duration') }}"
                                               placeholder="3 Tahun" required>
                                        @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Contoh: 3 Tahun, 6 Semester</small>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Program Aktif
                                            </label>
                                        </div>
                                        <small class="text-muted">Program akan ditampilkan di website</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Preview Program</h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-3">
                                        <h6 class="text-primary mb-2" id="preview-name">Nama Program</h6>
                                        <div class="d-flex gap-2 mb-2">
                                            <span class="badge bg-info" id="preview-level">Level</span>
                                            <span class="badge bg-secondary" id="preview-duration">Durasi</span>
                                        </div>
                                        <p class="small text-muted mb-0" id="preview-description">Deskripsi program akan muncul di sini...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.academics.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Program
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Live preview
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('program_name');
    const levelSelect = document.getElementById('level');
    const durationInput = document.getElementById('duration');
    const descriptionTextarea = document.getElementById('description');

    const previewName = document.getElementById('preview-name');
    const previewLevel = document.getElementById('preview-level');
    const previewDuration = document.getElementById('preview-duration');
    const previewDescription = document.getElementById('preview-description');

    function updatePreview() {
        previewName.textContent = nameInput.value || 'Nama Program';
        previewLevel.textContent = levelSelect.value || 'Level';
        previewDuration.textContent = durationInput.value || 'Durasi';
        previewDescription.textContent = descriptionTextarea.value || 'Deskripsi program akan muncul di sini...';
    }

    nameInput.addEventListener('input', updatePreview);
    levelSelect.addEventListener('change', updatePreview);
    durationInput.addEventListener('input', updatePreview);
    descriptionTextarea.addEventListener('input', updatePreview);

    // Initial preview
    updatePreview();
});
</script>
@endsection
