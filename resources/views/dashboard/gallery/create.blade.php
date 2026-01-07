@extends('layouts.dashboard')

@section('title', 'Add Gallery Photo - Dashboard')

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<style>
.select2-container--bootstrap-5 .select2-selection {
    min-height: 38px;
}
.select2-results__option img {
    border: 1px solid #dee2e6;
}
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <div class="mb-4">
        <h1 class="h3 mb-2">Add Gallery Photo</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.gallery.index') }}">Gallery Photos</a></li>
                <li class="breadcrumb-item active">Add Photo</li>
            </ol>
        </nav>
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Photo Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.gallery.store') }}" id="galleryForm">
                        @csrf

                        <!-- Media Selection -->
                        <div class="mb-4">
                            <label class="form-label">Select Photo <span class="text-danger">*</span></label>
                            <select name="media_id" id="mediaSelect" class="form-select @error('media_id') is-invalid @enderror" required>
                                <option value="">Choose a photo from media library...</option>
                                @foreach($availableMedia as $media)
                                    <option value="{{ $media->id }}" 
                                            data-url="{{ $media->full_url }}"
                                            data-thumb="{{ $media->full_url }}"
                                            data-title="{{ $media->title }}"
                                            data-dimensions="{{ $media->width }}x{{ $media->height }}"
                                            {{ old('media_id') == $media->id ? 'selected' : '' }}>
                                        {{ $media->title }} ({{ $media->width }}x{{ $media->height }})
                                    </option>
                                @endforeach
                            </select>
                            @error('media_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>Don't see your photo? 
                                <a href="{{ route('dashboard.media.index') }}" target="_blank">Upload to Media Library first</a>
                            </small>
                            
                            <!-- Preview -->
                            <div id="photoPreview" class="mt-3" style="display: none;">
                                <img id="previewImage" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" required placeholder="Enter photo title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Enter photo description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', 'general') == $key ? 'selected' : '' }}>
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
                                   value="{{ old('tags') }}" placeholder="e.g., education, children, community">
                            <small class="form-text text-muted">Separate multiple tags with commas</small>
                            @error('tags')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" 
                                   value="{{ old('location') }}" placeholder="Where was this photo taken?">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo Date -->
                        <div class="mb-3">
                            <label class="form-label">Photo Date</label>
                            <input type="date" name="photo_date" class="form-control @error('photo_date') is-invalid @enderror" 
                                   value="{{ old('photo_date') }}">
                            <small class="form-text text-muted">When was this photo taken?</small>
                            @error('photo_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photographer -->
                        <div class="mb-3">
                            <label class="form-label">Photographer</label>
                            <input type="text" name="photographer" class="form-control @error('photographer') is-invalid @enderror" 
                                   value="{{ old('photographer') }}" placeholder="Photo credit">
                            @error('photographer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display Order -->
                        <div class="mb-4">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" min="0" class="form-control @error('display_order') is-invalid @enderror" 
                                   value="{{ old('display_order', 0) }}">
                            <small class="form-text text-muted">Lower numbers appear first. Use 0 for automatic ordering.</small>
                            @error('display_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Checkboxes -->
                        <div class="mb-4">
                            <div class="form-check mb-2">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" 
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <i class="fas fa-star text-warning me-1"></i>Featured Photo
                                </label>
                                <small class="d-block text-muted ms-4">Show in featured section</small>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <i class="fas fa-eye text-success me-1"></i>Active
                                </label>
                                <small class="d-block text-muted ms-4">Visible in public gallery</small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Add to Gallery
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
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Guidelines</h6>
                </div>
                <div class="card-body">
                    <h6 class="text-primary mb-2">
                        <i class="fas fa-lightbulb me-2"></i>Photo Tips
                    </h6>
                    <ul class="small text-muted mb-4">
                        <li>Use high-quality images (min 1200px width)</li>
                        <li>Choose descriptive, engaging titles</li>
                        <li>Add relevant tags for better searchability</li>
                        <li>Organize photos by category</li>
                        <li>Credit photographers when applicable</li>
                    </ul>

                    <h6 class="text-primary mb-2">
                        <i class="fas fa-folder me-2"></i>Categories
                    </h6>
                    <ul class="small text-muted mb-0">
                        @foreach($categories as $key => $label)
                            <li><strong>{{ $label }}:</strong> {{ ucfirst($key) }}-related photos</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mediaSelect = document.getElementById('mediaSelect');
    const photoPreview = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');

    // Custom template function for Select2 with image preview
    function formatMediaOption(option) {
        if (!option.id) {
            return option.text;
        }
        
        const imageUrl = option.element.getAttribute('data-thumb');
        const title = option.element.getAttribute('data-title');
        const dimensions = option.element.getAttribute('data-dimensions');
        
        if (imageUrl) {
            return $(`
                <div class="d-flex align-items-center">
                    <img src="${imageUrl}" style="width: 60px; height: 60px; object-fit: cover; margin-right: 12px; border-radius: 4px;" onerror="this.style.display='none'" />
                    <div>
                        <div style="font-weight: 500;">${title}</div>
                        <div style="font-size: 0.875rem; color: #6c757d;">${dimensions}</div>
                    </div>
                </div>
            `);
        }
        
        return option.text;
    }

    // Initialize Select2 with custom template
    $(mediaSelect).select2({
        templateResult: formatMediaOption,
        templateSelection: function(option) {
            if (!option.id) {
                return option.text;
            }
            const title = option.element.getAttribute('data-title');
            const dimensions = option.element.getAttribute('data-dimensions');
            return title ? `${title} (${dimensions})` : option.text;
        },
        theme: 'bootstrap-5',
        width: '100%',
        placeholder: 'Choose a photo from media library...'
    });

    // Update preview on change
    $(mediaSelect).on('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const imageUrl = selectedOption.getAttribute('data-url');

        if (imageUrl) {
            previewImage.src = imageUrl;
            previewImage.onerror = function() {
                console.error('Failed to load image:', imageUrl);
                photoPreview.innerHTML = '<div class="alert alert-warning">Image preview not available</div>';
            };
            photoPreview.style.display = 'block';
        } else {
            photoPreview.style.display = 'none';
        }
    });

    // Trigger change on page load if there's a selected option
    if (mediaSelect.value) {
        $(mediaSelect).trigger('change');
    }

    // Form validation
    const form = document.getElementById('galleryForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
        let isValid = true;
        const errors = [];

        // Check media selection
        if (!mediaSelect.value) {
            isValid = false;
            errors.push('Please select a photo from media library');
            $(mediaSelect).next('.select2-container').addClass('is-invalid');
        } else {
            $(mediaSelect).next('.select2-container').removeClass('is-invalid');
        }

        // Check title
        const titleInput = form.querySelector('[name="title"]');
        if (!titleInput.value.trim()) {
            isValid = false;
            errors.push('Please enter a title');
            titleInput.classList.add('is-invalid');
        } else {
            titleInput.classList.remove('is-invalid');
        }

        // Check category
        const categoryInput = form.querySelector('[name="category"]');
        if (!categoryInput.value) {
            isValid = false;
            errors.push('Please select a category');
            categoryInput.classList.add('is-invalid');
        } else {
            categoryInput.classList.remove('is-invalid');
        }

        if (!isValid) {
            e.preventDefault();
            
            // Show error message at top
            const errorAlert = document.createElement('div');
            errorAlert.className = 'alert alert-danger alert-dismissible fade show';
            errorAlert.innerHTML = `
                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:</h5>
                <ul class="mb-0">${errors.map(err => `<li>${err}</li>`).join('')}</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            // Remove existing error alerts
            const existingAlerts = document.querySelectorAll('.alert-danger');
            existingAlerts.forEach(alert => alert.remove());
            
            // Insert at top of form container
            const container = document.querySelector('.container-fluid');
            container.insertBefore(errorAlert, container.children[1]);
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            return false;
        }

        // Disable button to prevent double submission
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
    });
});
</script>
@endpush
