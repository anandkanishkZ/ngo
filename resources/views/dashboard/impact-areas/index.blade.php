@extends('layouts.dashboard')

@section('title', 'Impact Areas Management')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h4 class="mb-1"><i class="fa-solid fa-hands-helping me-2"></i>Impact Areas Management</h4>
          <p class="text-muted mb-0">Manage homepage impact areas section</p>
        </div>
        <a href="{{ route('dashboard.impact-areas.create') }}" class="btn btn-primary">
          <i class="fa-solid fa-plus me-1"></i> Add New Impact Area
        </a>
      </div>
    </div>

    @if (session('success'))
      <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>
    @endif

    <div class="col-12">
      <div class="ds-card">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th width="50">#</th>
                <th>Title</th>
                <th>Description</th>
                <th width="80" class="text-center">Icon</th>
                <th width="100" class="text-center">Color</th>
                <th width="100" class="text-center">Status</th>
                <th width="80" class="text-center">Order</th>
                <th width="200" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($impactAreas as $area)
                <tr>
                  <td>{{ $area->id }}</td>
                  <td>
                    <strong>{{ $area->title }}</strong>
                  </td>
                  <td>
                    <span class="text-muted">{{ Str::limit($area->description, 60) }}</span>
                  </td>
                  <td class="text-center">
                    @if($area->icon)
                      <i class="{{ $area->icon }} fa-lg" style="color: {{ $area->color }};"></i>
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                      <div class="color-preview rounded-circle" style="width: 20px; height: 20px; background-color: {{ $area->color }};"></div>
                      <small class="text-muted">{{ $area->color }}</small>
                    </div>
                  </td>
                  <td class="text-center">
                    <div class="form-check form-switch d-flex justify-content-center">
                      <input class="form-check-input status-toggle" type="checkbox" 
                             data-id="{{ $area->id }}" {{ $area->is_active ? 'checked' : '' }}>
                    </div>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-secondary">{{ $area->sort_order }}</span>
                  </td>
                  <td class="text-center">
                    <div class="btn-group btn-group-sm">
                      <a href="{{ route('dashboard.impact-areas.show', $area) }}" class="btn btn-outline-info" title="View">
                        <i class="fa-solid fa-eye"></i>
                      </a>
                      <a href="{{ route('dashboard.impact-areas.edit', $area) }}" class="btn btn-outline-primary" title="Edit">
                        <i class="fa-solid fa-pencil"></i>
                      </a>
                      <button type="button" class="btn btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $area->id }}">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center py-5">
                    <div class="text-muted">
                      <i class="fa-solid fa-hands-helping fa-3x mb-3"></i>
                      <h5>No Impact Areas Found</h5>
                      <p>Start by creating your first impact area to showcase your organization's work.</p>
                      <a href="{{ route('dashboard.impact-areas.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-1"></i> Create Impact Area
                      </a>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Delete Modals -->
    @foreach($impactAreas as $area)
      <div class="modal fade" id="deleteModal{{ $area->id }}" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirm Deletion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete the impact area <strong>"{{ $area->title }}"</strong>?</p>
              <p class="text-danger mb-0"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form method="POST" action="{{ route('dashboard.impact-areas.destroy', $area) }}" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Handle status toggle
  document.querySelectorAll('.status-toggle').forEach(function(toggle) {
    toggle.addEventListener('change', function() {
      const areaId = this.dataset.id;
      const isActive = this.checked;
      
      fetch(`/dashboard/impact-areas/${areaId}/toggle`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(response => response.json())
      .then(data => {
        if (!data.success) {
          // Revert the toggle if the request failed
          this.checked = !isActive;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        // Revert the toggle on error
        this.checked = !isActive;
      });
    });
  });
});
</script>
@endpush
