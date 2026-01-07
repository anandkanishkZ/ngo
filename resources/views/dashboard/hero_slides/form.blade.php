@csrf

<!-- Enhanced Styles for Hero Slide Form -->
<style>
/* Gradient Card Headers */
.bg-gradient {
    position: relative;
    overflow: hidden;
}

.bg-gradient::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    transition: left 0.5s;
}

.bg-gradient:hover::before {
    left: 100%;
}

/* Enhanced Form Controls */
.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
    transform: scale(1.01);
    transition: all 0.3s ease;
}

/* Color Picker Enhancements */
.color-picker-wrapper .form-control-color {
    cursor: pointer;
    transition: transform 0.2s ease;
}

.color-picker-wrapper .form-control-color:hover {
    transform: scale(1.1);
}

/* Button Group Enhancements */
.btn-check:checked + .btn {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Card Hover Effects */
.card {
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.card:hover {
    border-color: rgba(102, 126, 234, 0.2);
}

/* Upload Area Enhancements */
.upload-area {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.upload-area::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: conic-gradient(from 0deg, transparent, rgba(102, 126, 234, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
    animation: rotate 10s linear infinite;
}

.upload-area:hover::before {
    opacity: 1;
}

@keyframes rotate {
    100% { transform: rotate(360deg); }
}

/* Status Indicators */
.status-indicator {
    transition: all 0.3s ease;
}

/* Form Section Headers */
.text-uppercase.small {
    letter-spacing: 1px;
    font-weight: 600;
}

/* Enhanced Switches */
.form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

/* Input Group Enhancements */
.input-group-text {
    font-weight: 500;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Alert Enhancements */
.alert {
    border: none;
    border-left: 4px solid;
    border-radius: 8px;
}

/* Button Enhancements */
.btn {
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

/* Responsive Enhancements */
@media (max-width: 991.98px) {
    .col-lg-4 .card {
        margin-bottom: 1.5rem;
    }
    
    .btn-group.d-flex .btn {
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
    }
}

/* WordPress-Style Sidebar */
.col-lg-4 {
    position: sticky;
    top: 20px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: #667eea transparent;
}

.col-lg-4::-webkit-scrollbar {
    width: 6px;
}

.col-lg-4::-webkit-scrollbar-track {
    background: transparent;
}

.col-lg-4::-webkit-scrollbar-thumb {
    background: #667eea;
    border-radius: 3px;
}

.col-lg-4::-webkit-scrollbar-thumb:hover {
    background: #5a6fd8;
}

/* WordPress-Style Card Layout */
.col-lg-4 .card {
    border: 1px solid #e1e5e9;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.col-lg-4 .card-header {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    font-weight: 600;
}

.col-lg-4 .card-body {
    padding: 16px;
}

/* Professional Form Controls */
.col-lg-4 .form-control,
.col-lg-4 .form-select {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 8px 12px;
    font-size: 14px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.col-lg-4 .form-control:focus,
.col-lg-4 .form-select:focus {
    border-color: #2271b1;
    box-shadow: 0 0 0 1px #2271b1;
    outline: 0;
}

/* WordPress-Style Labels */
.col-lg-4 .form-label {
    font-weight: 600;
    color: #1d2327;
    margin-bottom: 6px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* WordPress-Style Buttons */
.col-lg-4 .btn-group .btn {
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 500;
    border-color: #2271b1;
    color: #2271b1;
}

.col-lg-4 .btn-group .btn:hover,
.col-lg-4 .btn-group .btn.active {
    background-color: #2271b1;
    border-color: #2271b1;
    color: white;
}

/* WordPress-Style Switches */
.col-lg-4 .form-check-input {
    width: 2.5em;
    height: 1.25em;
    border-radius: 2em;
    background-color: #8c8f94;
    border-color: #8c8f94;
}

.col-lg-4 .form-check-input:checked {
    background-color: #2271b1;
    border-color: #2271b1;
}

/* Sidebar Responsiveness */
@media (max-width: 991.98px) {
    .col-lg-4 {
        position: static;
        max-height: none;
        margin-top: 2rem;
    }
    
    .col-lg-8 {
        margin-bottom: 0;
    }
}

/* Enhanced Grid Layout */
.row.g-4 {
    margin-right: -1.5rem;
    margin-left: -1.5rem;
}

.row.g-4 > * {
    padding-right: 1.5rem;
    padding-left: 1.5rem;
}

/* Professional WordPress-like spacing */
.col-lg-8 .card:last-child {
    margin-bottom: 0;
}

/* Smooth scrolling for form sections */
html {
    scroll-behavior: smooth;
}

/* Loading states */
.btn[disabled] {
    opacity: 0.6;
    transform: none !important;
}

/* Focus indicators */
.form-control:focus,
.form-select:focus,
.btn-check:focus + .btn {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}
</style>

<!-- Hero Slide Form Header -->
<div class="mb-4">
  <div class="d-flex align-items-center justify-content-between">
    <div>
      <h4 class="mb-1">{{ isset($slide) ? 'Edit Hero Slide' : 'Create New Hero Slide' }}</h4>
      <p class="text-muted mb-0">Design an engaging hero section for your homepage</p>
    </div>
    <div class="d-flex gap-2">
      <button type="button" class="btn btn-outline-secondary" onclick="togglePreview()">
        <i class="fa-solid fa-eye me-1"></i>Preview
      </button>
      <a href="{{ route('dashboard.hero.index') }}" class="btn btn-outline-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i>Back
      </a>
    </div>
  </div>
</div>

<div class="container-fluid">
<div class="row g-4">
  <!-- Main Content Section -->
  <div class="col-lg-8 order-1">
    <!-- Content Card -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white border-0 py-3">
        <h6 class="mb-0 d-flex align-items-center">
          <i class="fa-solid fa-text-width me-2 text-primary"></i>Content & Text
        </h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-4">
          <div class="col-12">
            <label class="form-label fw-semibold">Hero Title <span class="text-danger">*</span></label>
            <input type="text" name="title" value="{{ old('title', $slide->title ?? '') }}" 
                   class="form-control form-control-lg @error('title') is-invalid @enderror" 
                   placeholder="Enter compelling hero title..." required>
            @error('title')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
            <small class="text-muted">The main headline that grabs attention</small>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-semibold">Title Link URL <span class="text-muted">(Optional)</span></label>
            <input type="url" name="title_url" value="{{ old('title_url', $slide->title_url ?? '') }}" 
                   class="form-control @error('title_url') is-invalid @enderror" 
                   placeholder="https://example.com or /about-us">
            @error('title_url')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
            <small class="text-muted">
              <i class="fas fa-link me-1"></i>Make the title clickable by adding a URL (leave empty for no link)
            </small>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-semibold">Hero Subtitle</label>
            <textarea name="subtitle" rows="3" class="form-control @error('subtitle') is-invalid @enderror" 
                      placeholder="Add supporting text that complements your title...">{{ old('subtitle', $slide->subtitle ?? '') }}</textarea>
            @error('subtitle')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
            <small class="text-muted">Supporting message that provides context or call-to-action</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Media Card -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white border-0 py-3">
        <h6 class="mb-0 d-flex align-items-center">
          <i class="fa-solid fa-image me-2 text-primary"></i>Background Image
        </h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-4">
          <div class="col-md-8">
            <div class="upload-area border-2 border-dashed rounded-3 p-4 text-center position-relative">
              <input type="file" name="bg_image" id="bgImageInput" 
                     class="form-control opacity-0 position-absolute w-100 h-100 @error('bg_image') is-invalid @enderror" 
                     accept="image/jpeg,image/png,image/webp,image/avif"
                     onchange="previewImage(this)" style="top: 0; left: 0; cursor: pointer;">
              
              <div class="upload-content">
                <i class="fa-solid fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                <h6 class="mb-2">Drag & drop or click to upload</h6>
                <p class="text-muted small mb-0">Supports JPG, PNG, WebP, AVIF up to 4MB</p>
              </div>
            </div>
            
            <div id="bgImagePreview" class="mt-3">
              @if(isset($slide))
                @if($slide->bgImage)
                  <div class="current-image-preview border rounded-3 p-3 bg-light">
                    <div class="d-flex align-items-center">
                      <img src="{{ $slide->bgImage->full_url }}" alt="{{ $slide->bgImage->title }}" 
                           class="rounded-2 me-3" style="width: 60px; height: 60px; object-fit: cover;">
                      <div>
                        <div class="fw-medium">{{ $slide->bgImage->title }}</div>
                        <small class="text-success">
                          <i class="fa-solid fa-check-circle me-1"></i>Media Library Image
                        </small>
                      </div>
                    </div>
                  </div>
                @elseif($slide->bg_image)
                  <div class="current-image-preview border rounded-3 p-3 bg-light">
                    <div class="d-flex align-items-center">
                      <img src="{{ $slide->background_image_url }}" alt="Background" 
                           class="rounded-2 me-3" style="width: 60px; height: 60px; object-fit: cover;">
                      <div>
                        <div class="fw-medium">{{ basename($slide->bg_image) }}</div>
                        <small class="text-primary">
                          <i class="fa-solid fa-upload me-1"></i>Uploaded Image
                        </small>
                      </div>
                    </div>
                  </div>
                @endif
              @endif
            </div>
            @error('bg_image')
                <div class="invalid-feedback d-block mt-2">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
          </div>
          
          <div class="col-md-4">
            <div class="d-flex flex-column gap-3">
              <div>
                <label class="form-label fw-semibold">Display Order</label>
                <input type="number" name="position" value="{{ old('position',$slide->position ?? 1) }}" 
                       class="form-control @error('position') is-invalid @enderror" placeholder="1">
                @error('position')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <small class="text-muted">Lower numbers appear first</small>
              </div>
              
              <div class="form-check form-switch">
                <!-- Hidden field to ensure a value is always sent -->
                <input type="hidden" name="is_active" value="0">
                <input class="form-check-input @error('is_active') is-invalid @enderror" type="checkbox" name="is_active" value="1" id="is_active" 
                       {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="is_active">
                  Active Status
                </label>
                @error('is_active')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <div><small class="text-muted">Show this slide on the website</small></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Action Buttons Card -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-white border-0 py-3">
        <h6 class="mb-0 d-flex align-items-center">
          <i class="fa-solid fa-mouse-pointer me-2 text-primary"></i>Call-to-Action Buttons
        </h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-4">
          <!-- Button 1 -->
          <div class="col-lg-6">
            <div class="border rounded-3 p-3 bg-light">
              <h6 class="mb-3 text-primary">Primary Button</h6>
              <div class="mb-3">
                <label class="form-label fw-semibold">Button Text</label>
                <input type="text" name="button1_text" value="{{ old('button1_text',$slide->button1_text ?? '') }}" 
                       class="form-control @error('button1_text') is-invalid @enderror" placeholder="Get Started">
                @error('button1_text')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Button URL</label>
                <input type="url" name="button1_url" value="{{ old('button1_url',$slide->button1_url ?? '') }}" 
                       class="form-control @error('button1_url') is-invalid @enderror" placeholder="https://example.com">
                @error('button1_url')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
              </div>
              <div class="mb-0">
                <label class="form-label fw-semibold">Button Style</label>
                <select name="button1_style" class="form-select @error('button1_style') is-invalid @enderror">
                  @php($b1 = old('button1_style', $slide->button1_style ?? 'primary'))
                  <option value="primary" {{ $b1==='primary'?'selected':'' }}>Solid Primary</option>
                  <option value="outline" {{ $b1==='outline'?'selected':'' }}>Outline Primary</option>
                </select>
                @error('button1_style')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
              </div>
            </div>
          </div>
          
          <!-- Button 2 -->
          <div class="col-lg-6">
            <div class="border rounded-3 p-3 bg-light">
              <h6 class="mb-3 text-secondary">Secondary Button</h6>
              <div class="mb-3">
                <label class="form-label fw-semibold">Button Text</label>
                <input type="text" name="button2_text" value="{{ old('button2_text',$slide->button2_text ?? '') }}" 
                       class="form-control @error('button2_text') is-invalid @enderror" placeholder="Learn More">
                @error('button2_text')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold">Button URL</label>
                <input type="url" name="button2_url" value="{{ old('button2_url',$slide->button2_url ?? '') }}" 
                       class="form-control @error('button2_url') is-invalid @enderror" placeholder="https://example.com">
                @error('button2_url')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
              </div>
              <div class="mb-0">
                <label class="form-label fw-semibold">Button Style</label>
                <select name="button2_style" class="form-select @error('button2_style') is-invalid @enderror">
                  @php($b2 = old('button2_style', $slide->button2_style ?? 'outline'))
                  <option value="primary" {{ $b2==='primary'?'selected':'' }}>Solid Secondary</option>
                  <option value="outline" {{ $b2==='outline'?'selected':'' }}>Outline Secondary</option>
                </select>
                @error('button2_style')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sidebar: Advanced Settings -->
  <div class="col-lg-4 order-2 order-lg-2">
    <!-- Typography Settings Card -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <h6 class="card-title mb-0 d-flex align-items-center">
          <i class="fas fa-font me-2"></i>Typography Settings
        </h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-3">
          <div class="col-6">
            <label class="form-label fw-bold text-muted small text-uppercase">Title Size</label>
            <div class="input-group input-group-sm">
              <input type="text" name="title_size" value="{{ old('title_size',$slide->title_size ?? '3.5rem') }}" 
                     class="form-control @error('title_size') is-invalid @enderror" placeholder="3.5rem">
              <span class="input-group-text bg-light">rem</span>
            </div>
            @error('title_size')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
            <small class="text-muted">e.g., 2rem, 48px, 3.5rem</small>
          </div>
          <div class="col-6">
            <label class="form-label fw-bold text-muted small text-uppercase">Subtitle Size</label>
            <div class="input-group input-group-sm">
              <input type="text" name="subtitle_size" value="{{ old('subtitle_size',$slide->subtitle_size ?? '1.25rem') }}" 
                     class="form-control @error('subtitle_size') is-invalid @enderror" placeholder="1.25rem">
              <span class="input-group-text bg-light">rem</span>
            </div>
            @error('subtitle_size')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
            <small class="text-muted">e.g., 1rem, 18px, 1.25rem</small>
          </div>
          <div class="col-6">
            <label class="form-label fw-bold text-muted small text-uppercase">Title Color</label>
            <div class="color-picker-wrapper">
              <div class="input-group input-group-sm">
                <span class="input-group-text p-1">
                  <input type="color" name="title_color" value="{{ old('title_color',$slide->title_color ?? '#ffffff') }}" 
                         class="form-control-color border-0 @error('title_color') is-invalid @enderror" style="width: 30px; height: 30px; border-radius: 4px;">
                </span>
                <input type="text" class="form-control color-value @error('title_color') is-invalid @enderror" value="{{ old('title_color',$slide->title_color ?? '#ffffff') }}" readonly>
              </div>
              @error('title_color')
                  <div class="invalid-feedback d-block">
                      <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                  </div>
              @enderror
            </div>
          </div>
          <div class="col-6">
            <label class="form-label fw-bold text-muted small text-uppercase">Subtitle Color</label>
            <div class="color-picker-wrapper">
              <div class="input-group input-group-sm">
                <span class="input-group-text p-1">
                  <input type="color" name="subtitle_color" value="{{ old('subtitle_color',$slide->subtitle_color ?? '#ffffff') }}" 
                         class="form-control-color border-0 @error('subtitle_color') is-invalid @enderror" style="width: 30px; height: 30px; border-radius: 4px;">
                </span>
                <input type="text" class="form-control color-value @error('subtitle_color') is-invalid @enderror" value="{{ old('subtitle_color',$slide->subtitle_color ?? '#ffffff') }}" readonly>
              </div>
              @error('subtitle_color')
                  <div class="invalid-feedback d-block">
                      <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                  </div>
              @enderror
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Position & Alignment Card -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white;">
        <h6 class="card-title mb-0 d-flex align-items-center">
          <i class="fas fa-arrows-alt me-2"></i>Position & Alignment
        </h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label fw-bold text-muted small text-uppercase">Horizontal Alignment</label>
            <div class="btn-group d-flex" role="group">
              @php($pos = old('text_position', $slide->text_position ?? 'center'))
              <input type="radio" class="btn-check @error('text_position') is-invalid @enderror" name="text_position" id="pos-left" value="left" {{ $pos==='left'?'checked':'' }}>
              <label class="btn btn-outline-primary btn-sm" for="pos-left">
                <i class="fas fa-align-left"></i> Left
              </label>
              
              <input type="radio" class="btn-check @error('text_position') is-invalid @enderror" name="text_position" id="pos-center" value="center" {{ $pos==='center'?'checked':'' }}>
              <label class="btn btn-outline-primary btn-sm" for="pos-center">
                <i class="fas fa-align-center"></i> Center
              </label>
              
              <input type="radio" class="btn-check @error('text_position') is-invalid @enderror" name="text_position" id="pos-right" value="right" {{ $pos==='right'?'checked':'' }}>
              <label class="btn btn-outline-primary btn-sm" for="pos-right">
                <i class="fas fa-align-right"></i> Right
              </label>
            </div>
            @error('text_position')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
          </div>
          <div class="col-12">
            <label class="form-label fw-bold text-muted small text-uppercase">Vertical Position</label>
            <div class="btn-group d-flex" role="group">
              @php($vpos = old('vertical_position', $slide->vertical_position ?? 'middle'))
              <input type="radio" class="btn-check @error('vertical_position') is-invalid @enderror" name="vertical_position" id="vpos-top" value="top" {{ $vpos==='top'?'checked':'' }}>
              <label class="btn btn-outline-success btn-sm" for="vpos-top">
                <i class="fas fa-arrow-up"></i> Top
              </label>
              
              <input type="radio" class="btn-check @error('vertical_position') is-invalid @enderror" name="vertical_position" id="vpos-middle" value="middle" {{ $vpos==='middle'?'checked':'' }}>
              <label class="btn btn-outline-success btn-sm" for="vpos-middle">
                <i class="fas fa-minus"></i> Middle
              </label>
              
              <input type="radio" class="btn-check @error('vertical_position') is-invalid @enderror" name="vertical_position" id="vpos-bottom" value="bottom" {{ $vpos==='bottom'?'checked':'' }}>
              <label class="btn btn-outline-success btn-sm" for="vpos-bottom">
                <i class="fas fa-arrow-down"></i> Bottom
              </label>
            </div>
            @error('vertical_position')
                <div class="invalid-feedback d-block">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
          </div>
        </div>
      </div>
    </div>

    <!-- Animation & Effects Card -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-gradient" style="background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%); color: #8b4513;">
        <h6 class="card-title mb-0 d-flex align-items-center">
          <i class="fas fa-magic me-2"></i>Animation & Effects
        </h6>
      </div>
      <div class="card-body p-4">
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label fw-bold text-muted small text-uppercase">Entrance Animation</label>
            <select name="animation" class="form-select form-select-sm @error('animation') is-invalid @enderror">
              @php($anim = old('animation', $slide->animation ?? 'fadeIn'))
              <option value="none" {{ $anim==='none'?'selected':'' }}>🚫 No Animation</option>
              <option value="fadeIn" {{ $anim==='fadeIn'?'selected':'' }}>✨ Fade In</option>
              <option value="slideInLeft" {{ $anim==='slideInLeft'?'selected':'' }}>⬅️ Slide In Left</option>
              <option value="slideInRight" {{ $anim==='slideInRight'?'selected':'' }}>➡️ Slide In Right</option>
              <option value="slideInUp" {{ $anim==='slideInUp'?'selected':'' }}>⬆️ Slide In Up</option>
              <option value="zoomIn" {{ $anim==='zoomIn'?'selected':'' }}>🔍 Zoom In</option>
            </select>
            @error('animation')
                <div class="invalid-feedback">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
          </div>
          <div class="col-12">
            <label class="form-label fw-bold text-muted small text-uppercase">Animation Speed</label>
            <div class="position-relative">
              <select name="animation_duration" class="form-select form-select-sm @error('animation_duration') is-invalid @enderror">
                @php($duration = old('animation_duration', $slide->animation_duration ?? '1s'))
                <option value="0.5s" {{ $duration==='0.5s'?'selected':'' }}>⚡ 0.5s - Fast</option>
                <option value="1s" {{ $duration==='1s'?'selected':'' }}>🚀 1s - Normal</option>
                <option value="1.5s" {{ $duration==='1.5s'?'selected':'' }}>🐌 1.5s - Slow</option>
                <option value="2s" {{ $duration==='2s'?'selected':'' }}>🐢 2s - Very Slow</option>
              </select>
              @error('animation_duration')
                  <div class="invalid-feedback">
                      <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                  </div>
              @enderror
            </div>
          </div>
          <div class="col-12">
            <div class="bg-light rounded p-3">
              <div class="form-check form-switch">
                <!-- Hidden field to ensure a value is always sent -->
                <input type="hidden" name="overlay_enabled" value="0">
                <input class="form-check-input @error('overlay_enabled') is-invalid @enderror" type="checkbox" name="overlay_enabled" id="overlay_toggle" value="1"
                       {{ old('overlay_enabled', $slide->overlay_enabled ?? false) ? 'checked' : '' }}>
                <label class="form-check-label fw-semibold" for="overlay_toggle">
                  🎭 Enable Background Overlay
                </label>
                @error('overlay_enabled')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
              </div>
              <small class="text-muted d-block mt-1">
                Adds a semi-transparent overlay to improve text readability over background images
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Action Buttons -->
<div class="row mt-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center">
      <a href="{{ route('dashboard.hero.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Hero Slides
      </a>
      <div>
        @if(isset($slide) && $slide->id)
          <button type="button" class="btn btn-outline-danger me-2" onclick="confirmDelete()">
            <i class="fas fa-trash me-2"></i>Delete Slide
          </button>
        @endif
        <button type="submit" class="btn btn-primary px-4">
          <i class="fas fa-save me-2"></i>
          {{ isset($slide) && $slide->id ? 'Update Slide' : 'Create Slide' }}
        </button>
      </div>
    </div>
  </div>
</form>

<!-- Enhanced JavaScript for Modern Functionality -->
<script>
function previewImage(input) {
    const preview = document.getElementById('bgImagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="text-center p-3">
                    <img src="${e.target.result}" alt="Preview" class="img-fluid rounded mb-3" style="max-height: 200px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <div class="small text-success fw-semibold">
                        <i class="fas fa-check-circle me-1"></i>New image selected: ${input.files[0].name}
                    </div>
                    <div class="small text-muted">
                        Size: ${(input.files[0].size / 1024 / 1024).toFixed(2)} MB
                    </div>
                </div>
            `;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

@if(isset($slide) && $slide->id)
function confirmDelete() {
    if (confirm('Are you sure you want to delete this hero slide? This action cannot be undone.')) {
        // Create a form to submit DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("dashboard.hero.destroy", $slide->id) }}';
        
        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);
        
        // Add method override for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}
@endif

// Real-time form validation and enhancement
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced color picker functionality
    document.querySelectorAll('input[type="color"]').forEach(colorInput => {
        colorInput.addEventListener('input', function() {
            const textInput = this.closest('.color-picker-wrapper').querySelector('.color-value');
            if (textInput) {
                textInput.value = this.value;
            }
        });
    });
    
    // Status toggle visual feedback
    const activeToggle = document.getElementById('active_toggle');
    if (activeToggle) {
        activeToggle.addEventListener('change', function() {
            const statusIndicator = document.querySelector('.status-indicator i');
            const statusText = document.querySelector('.status-indicator');
            
            if (this.checked) {
                statusIndicator.className = 'fas fa-circle text-success me-2';
                statusText.innerHTML = '<i class="fas fa-circle text-success me-2"></i>Active Slide';
            } else {
                statusIndicator.className = 'fas fa-circle text-muted me-2';
                statusText.innerHTML = '<i class="fas fa-circle text-muted me-2"></i>Inactive Slide';
            }
        });
    }
    
    // Overlay toggle visual feedback
    const overlayToggle = document.getElementById('overlay_toggle');
    if (overlayToggle) {
        overlayToggle.addEventListener('change', function() {
            const label = this.nextElementSibling;
            if (this.checked) {
                label.innerHTML = '🎭 Background Overlay Enabled';
                this.closest('.bg-light').style.background = 'linear-gradient(135deg, #e8f5e8 0%, #f0f8ff 100%)';
            } else {
                label.innerHTML = '🎭 Enable Background Overlay';
                this.closest('.bg-light').style.background = '';
                this.closest('.bg-light').className = 'bg-light rounded p-3';
            }
        });
    }
    
    // Position button visual feedback
    document.querySelectorAll('input[name="text_position"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Add visual feedback for selection
            document.querySelectorAll('label[for^="pos-"]').forEach(label => {
                label.classList.remove('active');
            });
            this.nextElementSibling.classList.add('active');
        });
    });
    
    document.querySelectorAll('input[name="vertical_position"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Add visual feedback for selection
            document.querySelectorAll('label[for^="vpos-"]').forEach(label => {
                label.classList.remove('active');
            });
            this.nextElementSibling.classList.add('active');
        });
    });
    
    // Add drag and drop functionality to file upload
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.querySelector('#bgImageInput');
    
    if (uploadArea && fileInput) {
        ['dragenter', 'dragover', 'drayleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        uploadArea.addEventListener('drop', handleDrop, false);
    }
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight(e) {
        uploadArea.classList.add('border-primary', 'bg-primary-subtle');
        uploadArea.style.transform = 'scale(1.02)';
        uploadArea.style.transition = 'all 0.3s ease';
    }
    
    function unhighlight(e) {
        uploadArea.classList.remove('border-primary', 'bg-primary-subtle');
        uploadArea.style.transform = 'scale(1)';
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            fileInput.files = files;
            previewImage(fileInput);
        }
    }
    
    // Form validation feedback with better UX
    const form = document.querySelector('#hero-slide-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const titleInput = form.querySelector('input[name="title"]');
            if (titleInput && !titleInput.value.trim()) {
                e.preventDefault();
                
                // Create and show custom alert
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed';
                alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 350px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);';
                alertDiv.innerHTML = `
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Validation Error:</strong> Please enter a title for the hero slide.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.body.appendChild(alertDiv);
                
                // Focus on title input with visual feedback
                titleInput.focus();
                titleInput.style.borderColor = '#dc3545';
                titleInput.style.boxShadow = '0 0 0 0.25rem rgba(220, 53, 69, 0.25)';
                
                setTimeout(() => {
                    titleInput.style.borderColor = '';
                    titleInput.style.boxShadow = '';
                }, 3000);
                
                // Auto remove alert
                setTimeout(() => {
                    alertDiv.remove();
                }, 6000);
                
                return false;
            }
        });
    }
    
    // Add smooth animations for card interactions
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.12)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
});
</script>

<!-- Success/Error Message Handling -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
        alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alert.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.body.appendChild(alert);
        
        setTimeout(() => {
            alert.remove();
        }, 5000);
    });
</script>
@endif
