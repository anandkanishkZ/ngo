@extends('layouts.dashboard')

@section('title', 'Statistics Management')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h4 class="mb-1"><i class="fa-solid fa-chart-line me-2"></i>Statistics Management</h4>
          <p class="text-muted mb-0">Manage homepage statistics counters</p>
        </div>
        <a href="{{ route('dashboard.statistics.create') }}" class="btn btn-primary">
          <i class="fa-solid fa-plus me-1"></i> Add New Statistic
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
                <th>Label</th>
                <th>Key</th>
                <th width="120" class="text-center">Value</th>
                <th width="80" class="text-center">Icon</th>
                <th width="100" class="text-center">Status</th>
                <th width="80" class="text-center">Order</th>
                <th width="200" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($statistics as $statistic)
                <tr>
                  <td>{{ $statistic->id }}</td>
                  <td>
                    <strong>{{ $statistic->label }}</strong>
                    @if($statistic->description)
                      <br><small class="text-muted">{{ $statistic->description }}</small>
                    @endif
                  </td>
                  <td><code>{{ $statistic->key }}</code></td>
                  <td class="text-center">
                    <span class="badge" style="background: {{ $statistic->color }}; color: #fff; font-size: 0.9rem;">
                      {{ number_format($statistic->value) }}
                    </span>
                  </td>
                  <td class="text-center">
                    @if($statistic->icon)
                      <i class="{{ $statistic->icon }}" style="color: {{ $statistic->color }}; font-size: 1.2rem;"></i>
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm {{ $statistic->is_active ? 'btn-success' : 'btn-outline-secondary' }}" 
                            onclick="toggleActive({{ $statistic->id }}, this)">
                      <i class="fa-solid {{ $statistic->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                      {{ $statistic->is_active ? 'Active' : 'Hidden' }}
                    </button>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-secondary">{{ $statistic->sort_order }}</span>
                  </td>
                  <td class="text-center">
                    <div class="btn-group btn-group-sm" role="group">
                      <a href="{{ route('dashboard.statistics.edit', $statistic) }}" 
                         class="btn btn-outline-primary" title="Edit">
                        <i class="fa-solid fa-pencil"></i>
                      </a>
                      <form method="POST" action="{{ route('dashboard.statistics.destroy', $statistic) }}" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete the statistic \'{{ $statistic->label }}\'? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                          <i class="fa-solid fa-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="8" class="text-center py-4">
                    <div class="text-muted">
                      <i class="fa-solid fa-chart-line fa-2x mb-3"></i>
                      <h5>No Statistics Found</h5>
                      <p>Create your first statistic to display on the homepage.</p>
                      <a href="{{ route('dashboard.statistics.create') }}" class="btn btn-primary">
                        <i class="fa-solid fa-plus me-1"></i> Create Statistic
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
  </div>
</div>


@push('scripts')
<script>
  function toggleActive(id, button) {
    fetch(`/dashboard/statistics/${id}/toggle`, {
      method: 'PATCH',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json',
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const icon = button.querySelector('i');
        const text = button.lastChild;
        
        if (data.is_active) {
          button.className = 'btn btn-sm btn-success';
          icon.className = 'fa-solid fa-eye';
          text.textContent = ' Active';
        } else {
          button.className = 'btn btn-sm btn-outline-secondary';
          icon.className = 'fa-solid fa-eye-slash';
          text.textContent = ' Hidden';
        }
      }
    })
    .catch(error => console.error('Error:', error));
  }
</script>
@endpush
@endsection
