@extends('admin.layouts.app')

@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Edit Menu: {{ $menu->title }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Main Settings -->
                        <div class="col-md-8">
                            <h6 class="text-primary fw-bold mb-3">Informasi Menu</h6>
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul Menu <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title', $menu->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="route_name" class="form-label">Route Name</label>
                                        <select class="form-select @error('route_name') is-invalid @enderror" 
                                                id="route_name" name="route_name">
                                            <option value="">Pilih Route (Opsional)</option>
                                            <option value="home" {{ old('route_name', $menu->route_name) == 'home' ? 'selected' : '' }}>home</option>
                                            <option value="about" {{ old('route_name', $menu->route_name) == 'about' ? 'selected' : '' }}>about</option>
                                            <option value="academics" {{ old('route_name', $menu->route_name) == 'academics' ? 'selected' : '' }}>academics</option>
                                            <option value="gallery" {{ old('route_name', $menu->route_name) == 'gallery' ? 'selected' : '' }}>gallery</option>
                                            <option value="news" {{ old('route_name', $menu->route_name) == 'news' ? 'selected' : '' }}>news</option>
                                            <option value="contact" {{ old('route_name', $menu->route_name) == 'contact' ? 'selected' : '' }}>contact</option>
                                        </select>
                                        @error('route_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Pilih route Laravel atau isi URL manual di bawah</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="url" class="form-label">URL Manual</label>
                                        <input type="text" class="form-control @error('url') is-invalid @enderror" 
                                               id="url" name="url" value="{{ old('url', $menu->getOriginal('url')) }}" 
                                               placeholder="https://example.com atau /custom-page">
                                        @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Gunakan jika tidak ada route yang sesuai</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="icon" class="form-label">Icon (FontAwesome)</label>
                                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                               id="icon" name="icon" value="{{ old('icon', $menu->icon) }}" 
                                               placeholder="fas fa-home">
                                        @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Contoh: fas fa-home, fas fa-user, dll</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="css_class" class="form-label">CSS Class</label>
                                        <input type="text" class="form-control @error('css_class') is-invalid @enderror" 
                                               id="css_class" name="css_class" value="{{ old('css_class', $menu->css_class) }}" 
                                               placeholder="custom-menu-class">
                                        @error('css_class')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">CSS class tambahan untuk styling</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sidebar Settings -->
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">Pengaturan Menu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="parent_id" class="form-label">Parent Menu</label>
                                        <select class="form-select @error('parent_id') is-invalid @enderror" 
                                                id="parent_id" name="parent_id">
                                            <option value="">Main Menu (No Parent)</option>
                                            @foreach($parentMenus as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Pilih parent untuk membuat sub-menu</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="sort_order" class="form-label">Urutan <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                               id="sort_order" name="sort_order" value="{{ old('sort_order', $menu->sort_order) }}" 
                                               min="0" required>
                                        @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Angka kecil akan tampil lebih dulu</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                                   {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Menu Aktif
                                            </label>
                                        </div>
                                        <small class="text-muted">Menu akan ditampilkan di website</small>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="open_new_tab" name="open_new_tab" value="1" 
                                                   {{ old('open_new_tab', $menu->open_new_tab) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="open_new_tab">
                                                Buka di Tab Baru
                                            </label>
                                        </div>
                                        <small class="text-muted">Link akan dibuka di tab/window baru</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Menu Info -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Informasi Menu</h6>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <strong>ID:</strong> {{ $menu->id }}<br>
                                        <strong>Dibuat:</strong> {{ $menu->created_at->format('d M Y H:i') }}<br>
                                        <strong>Diupdate:</strong> {{ $menu->updated_at->format('d M Y H:i') }}<br>
                                        @if($menu->children->count() > 0)
                                        <strong>Sub-menu:</strong> {{ $menu->children->count() }} item<br>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            
                            <!-- Preview -->
                            <div class="card bg-light mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">Preview Menu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="bg-primary text-white p-2 rounded">
                                        <div class="d-flex align-items-center">
                                            <span id="preview-icon">
                                                @if($menu->icon)
                                                <i class="{{ $menu->icon }}"></i>
                                                @endif
                                            </span>
                                            <span id="preview-title" class="ms-2">{{ $menu->title }}</span>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-2 d-block">
                                        URL: <span id="preview-url">
                                            @if($menu->route_name)
                                            route('{{ $menu->route_name }}')
                                            @elseif($menu->getOriginal('url'))
                                            {{ $menu->getOriginal('url') }}
                                            @else
                                            -
                                            @endif
                                        </span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Menu
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
    const titleInput = document.getElementById('title');
    const iconInput = document.getElementById('icon');
    const routeSelect = document.getElementById('route_name');
    const urlInput = document.getElementById('url');
    
    const previewTitle = document.getElementById('preview-title');
    const previewIcon = document.getElementById('preview-icon');
    const previewUrl = document.getElementById('preview-url');
    
    function updatePreview() {
        // Update title
        previewTitle.textContent = titleInput.value || 'Menu Title';
        
        // Update icon
        if (iconInput.value) {
            previewIcon.innerHTML = `<i class="${iconInput.value}"></i>`;
        } else {
            previewIcon.innerHTML = '';
        }
        
        // Update URL
        if (routeSelect.value) {
            previewUrl.textContent = `route('${routeSelect.value}')`;
        } else if (urlInput.value) {
            previewUrl.textContent = urlInput.value;
        } else {
            previewUrl.textContent = '-';
        }
    }
    
    titleInput.addEventListener('input', updatePreview);
    iconInput.addEventListener('input', updatePreview);
    routeSelect.addEventListener('change', updatePreview);
    urlInput.addEventListener('input', updatePreview);
    
    // Clear URL when route is selected
    routeSelect.addEventListener('change', function() {
        if (this.value) {
            urlInput.value = '';
        }
    });
    
    // Clear route when URL is entered
    urlInput.addEventListener('input', function() {
        if (this.value) {
            routeSelect.value = '';
        }
    });
});
</script>
@endsection
