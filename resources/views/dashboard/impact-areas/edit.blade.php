@extends('layouts.dashboard')

@section('title', 'Edit Impact Area')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <div class="col-12">
      <div class="d-flex align-items-center gap-2 mb-3">
        <a href="{{ route('dashboard.impact-areas.index') }}" class="btn btn-outline-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
          <h4 class="mb-1"><i class="fa-solid fa-pencil me-2"></i>Edit Impact Area</h4>
          <p class="text-muted mb-0">Update "{{ $impactArea->title }}" impact area</p>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="ds-card p-4">
        <form method="POST" action="{{ route('dashboard.impact-areas.update', $impactArea) }}">
          @csrf
          @method('PUT')

          <div class="row g-3">
            <!-- Title -->
            <div class="col-md-6">
              <label class="form-label">Title <span class="text-danger">*</span></label>
              <input type="text" name="title" value="{{ old('title', $impactArea->title) }}" class="form-control @error('title') is-invalid @enderror" 
                     placeholder="e.g., Education" required>
              <div class="form-text">Impact area title</div>
              @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Sort Order -->
            <div class="col-md-6">
              <label class="form-label">Sort Order <span class="text-danger">*</span></label>
              <input type="number" name="sort_order" value="{{ old('sort_order', $impactArea->sort_order) }}" min="0" class="form-control @error('sort_order') is-invalid @enderror" required>
              <div class="form-text">Display order (lower numbers appear first)</div>
              @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Description -->
            <div class="col-12">
              <label class="form-label">Description <span class="text-danger">*</span></label>
              <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" 
                        placeholder="Describe the impact area and your organization's work in this field..." required>{{ old('description', $impactArea->description) }}</textarea>
              <div class="form-text">Detailed description of this impact area</div>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Icon -->
            <div class="col-md-6">
              <label class="form-label">Icon (Optional)</label>
              <input type="text" name="icon" value="{{ old('icon', $impactArea->icon) }}" class="form-control @error('icon') is-invalid @enderror" 
                     placeholder="fa-solid fa-graduation-cap" onkeyup="updateIconPreview(this.value)">
              <div class="form-text">Font Awesome class (e.g., fa-solid fa-heart)</div>
              @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Color -->
            <div class="col-md-6">
              <label class="form-label">Color <span class="text-danger">*</span></label>
              <div class="d-flex gap-2">
                <input type="color" name="color" value="{{ old('color', $impactArea->color) }}" class="form-control form-control-color @error('color') is-invalid @enderror" 
                       style="max-width: 60px;" onchange="updateColorText(this.value)" required>
                <input type="text" id="colorText" value="{{ old('color', $impactArea->color) }}" class="form-control @error('color') is-invalid @enderror" 
                       placeholder="#3498db" readonly>
              </div>
              <div class="form-text">Color for the icon and accent elements</div>
              @error('color')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Active Status -->
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                       {{ old('is_active', $impactArea->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                  <strong>Active</strong> - Display this impact area on the homepage
                </label>
              </div>
            </div>
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk me-1"></i> Update Impact Area
            </button>
            <a href="{{ route('dashboard.impact-areas.index') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>

    <!-- Preview -->
    <div class="col-lg-4">
      <div class="ds-card p-4">
        <h6 class="mb-3"><i class="fa-solid fa-eye me-2"></i>Preview</h6>
        <div class="text-center p-3 rounded" style="background: var(--ds-soft);">
          <div class="impact-area-preview">
            <div class="icon-wrapper mb-3">
              <i id="previewIcon" class="{{ $impactArea->icon ?: 'fa-solid fa-graduation-cap' }} fa-3x" style="color: {{ $impactArea->color }};"></i>
            </div>
            <h5 id="previewTitle">{{ $impactArea->title }}</h5>
            <p id="previewDescription" class="text-muted">{{ $impactArea->description }}</p>
          </div>
        </div>
        
        <!-- Common Icons -->
        <div class="mt-4">
          <h6>Common Icons:</h6>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setIcon('fa-solid fa-graduation-cap')">
              <i class="fa-solid fa-graduation-cap me-1"></i> Education
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setIcon('fa-solid fa-heartbeat')">
              <i class="fa-solid fa-heartbeat me-1"></i> Health
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setIcon('fa-solid fa-leaf')">
              <i class="fa-solid fa-leaf me-1"></i> Environment
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setIcon('fa-solid fa-home')">
              <i class="fa-solid fa-home me-1"></i> Housing
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setIcon('fa-solid fa-utensils')">
              <i class="fa-solid fa-utensils me-1"></i> Nutrition
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setIcon('fa-solid fa-users')">
              <i class="fa-solid fa-users me-1"></i> Community
            </button>
          </div>
        </div>

        <!-- Common Colors -->
        <div class="mt-4">
          <h6>Common Colors:</h6>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-sm" style="background-color: #3498db; color: white;" onclick="setColor('#3498db')">Blue</button>
            <button type="button" class="btn btn-sm" style="background-color: #e74c3c; color: white;" onclick="setColor('#e74c3c')">Red</button>
            <button type="button" class="btn btn-sm" style="background-color: #27ae60; color: white;" onclick="setColor('#27ae60')">Green</button>
            <button type="button" class="btn btn-sm" style="background-color: #f39c12; color: white;" onclick="setColor('#f39c12')">Orange</button>
            <button type="button" class="btn btn-sm" style="background-color: #9b59b6; color: white;" onclick="setColor('#9b59b6')">Purple</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function updateIconPreview(iconClass) {
    const previewIcon = document.getElementById('previewIcon');
    if (iconClass.trim()) {
      previewIcon.className = iconClass + ' fa-3x';
    } else {
      previewIcon.className = 'fa-solid fa-graduation-cap fa-3x';
    }
  }

  function setIcon(iconClass) {
    document.querySelector('input[name="icon"]').value = iconClass;
    updateIconPreview(iconClass);
  }

  function updateColorText(color) {
    document.getElementById('colorText').value = color;
    updatePreview();
  }

  function setColor(color) {
    document.querySelector('input[name="color"]').value = color;
    document.getElementById('colorText').value = color;
    updatePreview();
  }

  function updatePreview() {
    const title = document.querySelector('input[name="title"]').value || '{{ $impactArea->title }}';
    const description = document.querySelector('textarea[name="description"]').value || '{{ $impactArea->description }}';
    const color = document.querySelector('input[name="color"]').value || '{{ $impactArea->color }}';
    
    document.getElementById('previewTitle').textContent = title;
    document.getElementById('previewDescription').textContent = description;
    document.getElementById('previewIcon').style.color = color;
  }

  // Update preview on input changes
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[name="title"]').addEventListener('input', updatePreview);
    document.querySelector('textarea[name="description"]').addEventListener('input', updatePreview);
    document.querySelector('input[name="color"]').addEventListener('input', updatePreview);
    updatePreview();
  });
</script>
@endpush
