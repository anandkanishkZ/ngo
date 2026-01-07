<!-- Partner Form -->
<form method="POST" action="{{ isset($partner) ? route('dashboard.partners.update', $partner) : route('dashboard.partners.store') }}" 
      enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf
    @if(isset($partner))
        @method('PUT')
    @endif

    <div class="row">
        <!-- Basic Information -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle"></i> Basic Information
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Partner Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            Partner Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $partner->name ?? '') }}" 
                               required 
                               maxlength="255"
                               placeholder="Enter partner organization name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  maxlength="1000"
                                  placeholder="Brief description about the partner (optional)">{{ old('description', $partner->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="description-count">{{ strlen(old('description', $partner->description ?? '')) }}</span>/1000 characters
                        </div>
                    </div>

                    <!-- Website URL -->
                    <div class="mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-globe"></i>
                            </span>
                            <input type="url" 
                                   class="form-control @error('website_url') is-invalid @enderror" 
                                   id="website_url" 
                                   name="website_url" 
                                   value="{{ old('website_url', $partner->website_url ?? '') }}" 
                                   placeholder="https://example.com">
                            @error('website_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Partner Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">
                            Partner Type <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                                id="type" 
                                name="type" 
                                required>
                            <option value="">Select partner type</option>
                            <option value="sponsor" 
                                    {{ old('type', $partner->type ?? '') === 'sponsor' ? 'selected' : '' }}>
                                Sponsor
                            </option>
                            <option value="partner" 
                                    {{ old('type', $partner->type ?? '') === 'partner' ? 'selected' : '' }}>
                                Partner
                            </option>
                            <option value="collaborator" 
                                    {{ old('type', $partner->type ?? '') === 'collaborator' ? 'selected' : '' }}>
                                Collaborator
                            </option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>
                                <strong>Sponsor:</strong> Financial supporters | 
                                <strong>Partner:</strong> Strategic collaborators | 
                                <strong>Collaborator:</strong> Working partners
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo and Settings -->
        <div class="col-lg-4">
            <!-- Logo Upload -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-image"></i> Partner Logo
                    </h6>
                </div>
                <div class="card-body text-center">
                    <!-- Current Logo Preview -->
                    <div id="logo-preview" class="mb-3">
                        @if(isset($partner) && $partner->logo_url)
                            <div class="current-logo" 
                                 style="width: 120px; height: 120px; 
                                        background: {{ $partner->background_color ?? '#f8f9fa' }}; 
                                        border-radius: 12px; 
                                        display: flex; 
                                        align-items: center; 
                                        justify-content: center;
                                        margin: 0 auto;
                                        border: 2px solid #dee2e6;">
                                <img src="{{ $partner->logo_url }}" 
                                     alt="{{ $partner->name }}" 
                                     class="img-fluid"
                                     style="max-width: 100px; max-height: 100px; object-fit: contain;">
                            </div>
                        @else
                            <div class="no-logo" 
                                 style="width: 120px; height: 120px; 
                                        background: #f8f9fa; 
                                        border: 2px dashed #dee2e6; 
                                        border-radius: 12px; 
                                        display: flex; 
                                        flex-direction: column;
                                        align-items: center; 
                                        justify-content: center;
                                        margin: 0 auto;">
                                <i class="fas fa-image fa-2x text-muted mb-2"></i>
                                <small class="text-muted">No logo uploaded</small>
                            </div>
                        @endif
                    </div>

                    <!-- Logo Upload Input -->
                    <div class="mb-3">
                        <input type="file" 
                               class="form-control @error('logo') is-invalid @enderror" 
                               id="logo" 
                               name="logo" 
                               accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml,image/webp">
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>Supported: JPEG, PNG, JPG, GIF, SVG, WebP (Max: 2MB)</small>
                        </div>
                    </div>

                    <!-- Background Color -->
                    <div class="mb-3">
                        <label for="background_color" class="form-label">Logo Background Color</label>
                        <div class="input-group">
                            <input type="color" 
                                   class="form-control form-control-color @error('background_color') is-invalid @enderror" 
                                   id="background_color" 
                                   name="background_color" 
                                   value="{{ old('background_color', $partner->background_color ?? '#ffffff') }}"
                                   title="Choose background color">
                            <input type="text" 
                                   class="form-control" 
                                   id="background_color_hex" 
                                   placeholder="#ffffff" 
                                   value="{{ old('background_color', $partner->background_color ?? '#ffffff') }}"
                                   maxlength="7">
                        </div>
                        @error('background_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>Background color for logo display area</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display Settings -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cogs"></i> Display Settings
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Sort Order -->
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" 
                               class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" 
                               name="sort_order" 
                               value="{{ old('sort_order', $partner->sort_order ?? 0) }}" 
                               min="0"
                               placeholder="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>Lower numbers appear first (0 = highest priority)</small>
                        </div>
                    </div>

                    <!-- Status Toggles -->
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1"
                                   {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <strong>Active</strong>
                                <br><small class="text-muted">Show partner on the website</small>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="featured" 
                                   name="featured" 
                                   value="1"
                                   {{ old('featured', $partner->featured ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="featured">
                                <strong>Featured</strong>
                                <br><small class="text-muted">Highlight as important partner</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('dashboard.partners.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Partners
                        </a>
                        <div>
                            @if(isset($partner))
                                <a href="{{ route('dashboard.partners.show', $partner) }}" class="btn btn-outline-info me-2">
                                    <i class="fas fa-eye"></i> View Partner
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> 
                                {{ isset($partner) ? 'Update Partner' : 'Create Partner' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
$(document).ready(function() {
    // Character counter for description
    $('#description').on('input', function() {
        const length = $(this).val().length;
        $('#description-count').text(length);
        
        if (length > 900) {
            $('#description-count').addClass('text-warning');
        } else {
            $('#description-count').removeClass('text-warning');
        }
    });

    // Logo preview
    $('#logo').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const backgroundColor = $('#background_color').val() || '#f8f9fa';
                const logoPreview = `
                    <div class="current-logo" 
                         style="width: 120px; height: 120px; 
                                background: ${backgroundColor}; 
                                border-radius: 12px; 
                                display: flex; 
                                align-items: center; 
                                justify-content: center;
                                margin: 0 auto;
                                border: 2px solid #dee2e6;">
                        <img src="${e.target.result}" 
                             alt="Logo Preview" 
                             class="img-fluid"
                             style="max-width: 100px; max-height: 100px; object-fit: contain;">
                    </div>
                `;
                $('#logo-preview').html(logoPreview);
            };
            reader.readAsDataURL(file);
        }
    });

    // Sync color picker and text input
    $('#background_color').on('input', function() {
        $('#background_color_hex').val($(this).val());
        updateLogoBackground($(this).val());
    });

    $('#background_color_hex').on('input', function() {
        const color = $(this).val();
        if (/^#[0-9A-F]{6}$/i.test(color)) {
            $('#background_color').val(color);
            updateLogoBackground(color);
        }
    });

    function updateLogoBackground(color) {
        $('#logo-preview .current-logo').css('background', color);
    }

    // Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
});
</script>
@endpush
