@extends('layouts.dashboard')

@section('title', 'View Impact Area')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <div class="col-12">
      <div class="d-flex align-items-center gap-2 mb-3">
        <a href="{{ route('dashboard.impact-areas.index') }}" class="btn btn-outline-secondary btn-sm">
          <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
          <h4 class="mb-1"><i class="fa-solid fa-eye me-2"></i>Impact Area Details</h4>
          <p class="text-muted mb-0">Viewing "{{ $impactArea->title }}" impact area</p>
        </div>
        <div class="ms-auto">
          <a href="{{ route('dashboard.impact-areas.edit', $impactArea) }}" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-pencil me-1"></i> Edit
          </a>
        </div>
      </div>
    </div>

    <div class="col-lg-8">
      <div class="ds-card p-4">
        <div class="row g-4">
          <!-- Basic Info -->
          <div class="col-12">
            <h5 class="border-bottom pb-2 mb-3">Basic Information</h5>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label text-muted">Title</label>
                <p class="mb-0"><strong>{{ $impactArea->title }}</strong></p>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted">Sort Order</label>
                <p class="mb-0"><span class="badge bg-secondary">{{ $impactArea->sort_order }}</span></p>
              </div>
              <div class="col-md-3">
                <label class="form-label text-muted">Status</label>
                <p class="mb-0">
                  @if($impactArea->is_active)
                    <span class="badge bg-success">Active</span>
                  @else
                    <span class="badge bg-danger">Inactive</span>
                  @endif
                </p>
              </div>
            </div>
          </div>

          <!-- Description -->
          <div class="col-12">
            <h5 class="border-bottom pb-2 mb-3">Description</h5>
            <p class="mb-0">{{ $impactArea->description }}</p>
          </div>

          <!-- Visual Elements -->
          <div class="col-12">
            <h5 class="border-bottom pb-2 mb-3">Visual Elements</h5>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label text-muted">Icon</label>
                <div class="d-flex align-items-center gap-3">
                  @if($impactArea->icon)
                    <i class="{{ $impactArea->icon }} fa-2x" style="color: {{ $impactArea->color }};"></i>
                    <code>{{ $impactArea->icon }}</code>
                  @else
                    <span class="text-muted">No icon specified</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label text-muted">Color</label>
                <div class="d-flex align-items-center gap-3">
                  <div class="color-preview rounded-circle" style="width: 30px; height: 30px; background-color: {{ $impactArea->color }};"></div>
                  <code>{{ $impactArea->color }}</code>
                </div>
              </div>
            </div>
          </div>

          <!-- Timestamps -->
          <div class="col-12">
            <h5 class="border-bottom pb-2 mb-3">Timestamps</h5>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label text-muted">Created</label>
                <p class="mb-0">{{ $impactArea->created_at->format('M d, Y \a\t g:i A') }}</p>
              </div>
              <div class="col-md-6">
                <label class="form-label text-muted">Last Updated</label>
                <p class="mb-0">{{ $impactArea->updated_at->format('M d, Y \a\t g:i A') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Preview -->
    <div class="col-lg-4">
      <div class="ds-card p-4">
        <h6 class="mb-3"><i class="fa-solid fa-eye me-2"></i>Homepage Preview</h6>
        <div class="text-center p-4 rounded shadow-sm" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
          <div class="impact-area-preview">
            <div class="icon-wrapper mb-3">
              @if($impactArea->icon)
                <i class="{{ $impactArea->icon }} fa-3x" style="color: {{ $impactArea->color }};"></i>
              @else
                <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                  <i class="fa-solid fa-question fa-2x text-white"></i>
                </div>
              @endif
            </div>
            <h5 class="mb-3">{{ $impactArea->title }}</h5>
            <p class="text-muted mb-0">{{ $impactArea->description }}</p>
          </div>
        </div>

        <!-- Actions -->
        <div class="d-grid gap-2 mt-4">
          <a href="{{ route('dashboard.impact-areas.edit', $impactArea) }}" class="btn btn-primary">
            <i class="fa-solid fa-pencil me-2"></i>Edit Impact Area
          </a>
          <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="fa-solid fa-trash me-2"></i>Delete Impact Area
          </button>
        </div>
      </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm Deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete the impact area <strong>"{{ $impactArea->title }}"</strong>?</p>
            <p class="text-danger mb-0"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form method="POST" action="{{ route('dashboard.impact-areas.destroy', $impactArea) }}" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
