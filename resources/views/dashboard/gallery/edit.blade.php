@extends('layouts.dashboard')

@section('title', 'Edit Gallery Photo - Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h1 class="h3 mb-2">Edit Gallery Photo</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.gallery.index') }}">Gallery Photos</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Photo Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.gallery.update', $galleryPhoto) }}">
                        @csrf
                        @method('PUT')

                        <!-- Current Photo -->
                        <div class="mb-4">
                            <label class="form-label">Current Photo</label>
                            <div>
                                <img src="{{ $galleryPhoto->media->full_url }}" alt="{{ $galleryPhoto->title }}" 
                                     class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <!-- Media Selection -->
                        <div class="mb-4">
                            <label class="form-label">Change Photo <span class="text-danger">*</span></label>
                            <select name="media_id" id="mediaSelect" class="form-select @error('media_id') is-invalid @enderror" required>
                                @foreach($availableMedia as $media)
                                    <option value="{{ $media->id }}" 
                                            data-url="{{ $media->full_url }}"
                                            {{ old('media_id', $galleryPhoto->media_id) == $media->id ? 'selected' : '' }}>
                                        {{ $media->title }} ({{ $media->width }}x{{ $media->height }})
                                    </option>
                                @endforeach
                            </select>
                            @error('media_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Preview -->
                            <div id="photoPreview" class="mt-3" style="display: none;">
                                <p class="small text-muted mb-2">New photo preview:</p>
                                <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $galleryPhoto->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $galleryPhoto->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', $galleryPhoto->category) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" 
                                   value="{{ old('tags', $galleryPhoto->tags) }}">
                            <small class="form-text text-muted">Separate multiple tags with commas</small>
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" 
                                   value="{{ old('location', $galleryPhoto->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo Date -->
                        <div class="mb-3">
                            <label class="form-label">Photo Date</label>
                            <input type="date" name="photo_date" class="form-control @error('photo_date') is-invalid @enderror" 
                                   value="{{ old('photo_date', $galleryPhoto->photo_date?->format('Y-m-d')) }}">
                            @error('photo_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photographer -->
                        <div class="mb-3">
                            <label class="form-label">Photographer</label>
                            <input type="text" name="photographer" class="form-control @error('photographer') is-invalid @enderror" 
                                   value="{{ old('photographer', $galleryPhoto->photographer) }}">
                            @error('photographer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="mb-4">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" min="0" class="form-control @error('display_order') is-invalid @enderror" 
                                   value="{{ old('display_order', $galleryPhoto->display_order) }}">
                            <small class="form-text text-muted">Lower numbers appear first</small>
                            @error('display_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Checkboxes -->
                        <div class="mb-4">
                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" 
                                       {{ old('is_featured', $galleryPhoto->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <i class="fas fa-star text-warning me-1"></i>Featured Photo
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" 
                                       {{ old('is_active', $galleryPhoto->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-eye text-success me-1"></i>Active
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Photo
                            </button>
                            <a href="{{ route('dashboard.gallery.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Photo Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Views:</span>
                        <strong>{{ $galleryPhoto->views_count }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Category:</span>
                        <span class="badge bg-{{ $galleryPhoto->category_badge_color }}">
                            {{ $galleryPhoto->category_label }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-{{ $galleryPhoto->is_active ? 'success' : 'secondary' }}">
                            {{ $galleryPhoto->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Featured:</span>
                        <span class="badge bg-{{ $galleryPhoto->is_featured ? 'warning' : 'secondary' }}">
                            {{ $galleryPhoto->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Added:</span>
                        <small>{{ $galleryPhoto->created_at->format('M j, Y') }}</small>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Media Details</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dimensions:</span>
                        <small>{{ $galleryPhoto->media->width }}x{{ $galleryPhoto->media->height }}</small>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">File Size:</span>
                        <small>{{ $galleryPhoto->media->size_formatted }}</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Format:</span>
                        <small>{{ strtoupper(pathinfo($galleryPhoto->media->filename, PATHINFO_EXTENSION)) }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaSelect = document.getElementById('mediaSelect');
    const photoPreview = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');
    const currentMediaId = {{ $galleryPhoto->media_id }};

    mediaSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const imageUrl = selectedOption.getAttribute('data-url');
        const selectedId = parseInt(this.value);

        if (imageUrl && selectedId !== currentMediaId) {
            previewImage.src = imageUrl;
            photoPreview.style.display = 'block';
        } else {
            photoPreview.style.display = 'none';
        }
    });
});
</script>
@endsection
