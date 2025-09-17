@extends('layouts.dashboard')

@section('title', 'Edit Statistic')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <div class="col-12">
      <div class="d-flex align-items-center gap-2 mb-3">
        <a href="{{ route('dashboard.statistics.index') }}" class="btn btn-outline-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
          <h4 class="mb-1"><i class="fa-solid fa-pencil me-2"></i>Edit Statistic</h4>
          <p class="text-muted mb-0">Update "{{ $statistic->label }}" statistic</p>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="ds-card p-4">
        <form method="POST" action="{{ route('dashboard.statistics.update', $statistic) }}">
          @csrf
          @method('PUT')

          <div class="row g-3">
            <!-- Key -->
            <div class="col-md-6">
              <label class="form-label">Key <span class="text-danger">*</span></label>
              <input type="text" name="key" value="{{ old('key', $statistic->key) }}" class="form-control @error('key') is-invalid @enderror" 
                     placeholder="e.g., lives_impacted" required>
              <div class="form-text">Unique identifier (lowercase, underscore only)</div>
              @error('key')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Label -->
            <div class="col-md-6">
              <label class="form-label">Display Label <span class="text-danger">*</span></label>
              <input type="text" name="label" value="{{ old('label', $statistic->label) }}" class="form-control @error('label') is-invalid @enderror" 
                     placeholder="e.g., Lives Impacted" required>
              <div class="form-text">Text shown below the number</div>
              @error('label')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Value -->
            <div class="col-md-6">
              <label class="form-label">Value <span class="text-danger">*</span></label>
              <input type="number" name="value" value="{{ old('value', $statistic->value) }}" class="form-control @error('value') is-invalid @enderror" 
                     min="0" required>
              <div class="form-text">The numeric value to display</div>
              @error('value')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Sort Order -->
            <div class="col-md-6">
              <label class="form-label">Sort Order <span class="text-danger">*</span></label>
              <input type="number" name="sort_order" value="{{ old('sort_order', $statistic->sort_order) }}" class="form-control @error('sort_order') is-invalid @enderror" 
                     min="0" required>
              <div class="form-text">Lower numbers appear first</div>
              @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Icon -->
            <div class="col-md-6">
              <label class="form-label">Icon (Optional)</label>
              <div class="input-group">
                <span class="input-group-text">
                  <i id="iconPreview" class="{{ old('icon', $statistic->icon ?: 'fa-solid fa-chart-line') }}"></i>
                </span>
                <input type="text" name="icon" value="{{ old('icon', $statistic->icon) }}" class="form-control @error('icon') is-invalid @enderror" 
                       placeholder="fa-solid fa-heart" onkeyup="updateIconPreview(this.value)">
              </div>
              <div class="form-text">Font Awesome class (e.g., fa-solid fa-heart)</div>
              @error('icon')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Color -->
            <div class="col-md-6">
              <label class="form-label">Color <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="color" name="color" value="{{ old('color', $statistic->color) }}" class="form-control form-control-color @error('color') is-invalid @enderror" 
                       onchange="document.getElementById('colorText').value = this.value">
                <input type="text" id="colorText" value="{{ old('color', $statistic->color) }}" class="form-control" 
                       onkeyup="document.querySelector('input[name=color]').value = this.value" placeholder="#f39c12">
              </div>
              <div class="form-text">Color for the number and icon</div>
              @error('color')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Description -->
            <div class="col-12">
              <label class="form-label">Description (Optional)</label>
              <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror" 
                        placeholder="Internal note about this statistic...">{{ old('description', $statistic->description) }}</textarea>
              <div class="form-text">Internal description for admin reference</div>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Active Status -->
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" 
                       {{ old('is_active', $statistic->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                  <strong>Active</strong> - Display this statistic on the homepage
                </label>
              </div>
            </div>
          </div>

          <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-floppy-disk me-1"></i> Update Statistic
            </button>
            <a href="{{ route('dashboard.statistics.index') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>

    <!-- Preview -->
    <div class="col-lg-4">
      <div class="ds-card p-4">
        <h6 class="mb-3"><i class="fa-solid fa-eye me-2"></i>Preview</h6>
        <div class="text-center p-3 rounded" style="background: var(--ds-soft);">
          <div class="stat-item">
            <div class="stat-number" style="color: {{ $statistic->color }}; font-size: 3rem; font-weight: 700;">
              <span id="previewNumber">{{ number_format($statistic->value) }}</span>
            </div>
            <div class="stat-label" style="font-size: 1.2rem; margin-top: 10px;">
              <span id="previewLabel">{{ $statistic->label }}</span>
            </div>
          </div>
        </div>
        
        <div class="mt-3">
          <h6>Common Icons:</h6>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa-solid fa-heart')">
              <i class="fa-solid fa-heart"></i> Heart
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa-solid fa-users')">
              <i class="fa-solid fa-users"></i> Users
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa-solid fa-globe')">
              <i class="fa-solid fa-globe"></i> Globe
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setIcon('fa-solid fa-hand-holding-heart')">
              <i class="fa-solid fa-hands-helping"></i> Volunteers
            </button>
          </div>
        </div>

        <div class="mt-3">
          <h6>Common Colors:</h6>
          <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-sm" style="background: #f39c12; color: white;" onclick="setColor('#f39c12')">Orange</button>
            <button type="button" class="btn btn-sm" style="background: #e74c3c; color: white;" onclick="setColor('#e74c3c')">Red</button>
            <button type="button" class="btn btn-sm" style="background: #3498db; color: white;" onclick="setColor('#3498db')">Blue</button>
            <button type="button" class="btn btn-sm" style="background: #27ae60; color: white;" onclick="setColor('#27ae60')">Green</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function updateIconPreview(iconClass) {
    document.getElementById('iconPreview').className = iconClass || 'fa-solid fa-chart-line';
  }

  function setIcon(iconClass) {
    document.querySelector('input[name="icon"]').value = iconClass;
    updateIconPreview(iconClass);
  }

  function setColor(color) {
    document.querySelector('input[name="color"]').value = color;
    document.getElementById('colorText').value = color;
    updatePreview();
  }

  function updatePreview() {
    const value = document.querySelector('input[name="value"]').value || '0';
    const label = document.querySelector('input[name="label"]').value || 'Lives Impacted';
    const color = document.querySelector('input[name="color"]').value || '#f39c12';
    
    document.getElementById('previewNumber').textContent = parseInt(value).toLocaleString();
    document.getElementById('previewLabel').textContent = label;
    document.getElementById('previewNumber').style.color = color;
  }

  // Update preview on input changes
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[name="value"]').addEventListener('input', updatePreview);
    document.querySelector('input[name="label"]').addEventListener('input', updatePreview);
    document.querySelector('input[name="color"]').addEventListener('input', updatePreview);
    updatePreview();
  });
</script>
@endpush
@endsection
