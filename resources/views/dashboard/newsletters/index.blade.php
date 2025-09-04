@extends('layouts.dashboard')

@section('title', 'Newsletter Subscribers')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <!-- Header Section -->
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h4 class="mb-1"><i class="fa-solid fa-envelope me-2"></i>Newsletter Subscribers</h4>
          <p class="text-muted mb-0">Manage your email subscribers and newsletter campaigns</p>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('dashboard.newsletters.export') }}" class="btn btn-outline-success">
            <i class="fa-solid fa-download me-1"></i> Export CSV
          </a>
        </div>
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

    <!-- Statistics Cards -->
    <div class="col-lg-3 col-md-6">
      <div class="ds-card bg-primary text-white">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h5 class="card-title mb-1">{{ number_format($stats['total']) }}</h5>
              <p class="card-text mb-0 opacity-75">Total Subscribers</p>
            </div>
            <div class="fs-1 opacity-50">
              <i class="fa-solid fa-users"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="ds-card bg-success text-white">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h5 class="card-title mb-1">{{ number_format($stats['active']) }}</h5>
              <p class="card-text mb-0 opacity-75">Active Subscribers</p>
            </div>
            <div class="fs-1 opacity-50">
              <i class="fa-solid fa-eye"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="ds-card bg-warning text-white">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h5 class="card-title mb-1">{{ number_format($stats['unsubscribed']) }}</h5>
              <p class="card-text mb-0 opacity-75">Unsubscribed</p>
            </div>
            <div class="fs-1 opacity-50">
              <i class="fa-solid fa-eye-slash"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="ds-card bg-info text-white">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h5 class="card-title mb-1">{{ number_format($stats['today']) }}</h5>
              <p class="card-text mb-0 opacity-75">New Today</p>
            </div>
            <div class="fs-1 opacity-50">
              <i class="fa-solid fa-calendar-day"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Subscribers Table -->
    <div class="col-12">
      <div class="ds-card">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th width="50">#</th>
                <th>Email Address</th>
                <th width="120" class="text-center">Status</th>
                <th width="150" class="text-center">Subscribed Date</th>
                <th width="120" class="text-center">IP Address</th>
                <th width="200" class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($subscribers as $subscriber)
                <tr>
                  <td>{{ $subscriber->id }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <i class="fa-solid fa-envelope text-muted me-2"></i>
                      <strong>{{ $subscriber->email }}</strong>
                    </div>
                    @if($subscriber->unsubscribed_at)
                      <small class="text-muted d-block">
                        Unsubscribed: {{ $subscriber->unsubscribed_at->format('M j, Y g:i A') }}
                      </small>
                    @endif
                  </td>
                  <td class="text-center">
                    <button class="btn btn-sm {{ $subscriber->is_active ? 'btn-success' : 'btn-outline-secondary' }}"
                            onclick="toggleStatus({{ $subscriber->id }}, this)">
                      <i class="fa-solid {{ $subscriber->is_active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                      {{ $subscriber->status }}
                    </button>
                  </td>
                  <td class="text-center">
                    <small class="text-muted">
                      {{ $subscriber->subscribed_at->format('M j, Y') }}<br>
                      <span class="text-xs">{{ $subscriber->subscribed_at->format('g:i A') }}</span>
                    </small>
                  </td>
                  <td class="text-center">
                    <small class="text-muted">{{ $subscriber->ip_address ?? 'N/A' }}</small>
                  </td>
                  <td class="text-center">
                    <div class="btn-group btn-group-sm" role="group">
                      <a href="{{ route('dashboard.newsletters.show', $subscriber) }}" 
                         class="btn btn-outline-info" title="View Details">
                        <i class="fa-solid fa-eye"></i>
                      </a>
                      <form method="POST" action="{{ route('dashboard.newsletters.destroy', $subscriber) }}" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this subscriber? This action cannot be undone.')">
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
                  <td colspan="6" class="text-center py-4">
                    <div class="text-muted">
                      <i class="fa-solid fa-envelope fa-2x mb-3"></i>
                      <h5>No Subscribers Found</h5>
                      <p>Newsletter subscriptions will appear here once users start subscribing.</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Pagination -->
    @if($subscribers->hasPages())
      <div class="col-12">
        <div class="d-flex justify-content-center">
          {{ $subscribers->links() }}
        </div>
      </div>
    @endif
  </div>
</div>

@push('scripts')
<script>
  function toggleStatus(id, button) {
    fetch(`/dashboard/newsletters/${id}/toggle`, {
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
          text.textContent = ' Unsubscribed';
        }
      }
    })
    .catch(error => console.error('Error:', error));
  }
</script>
@endpush
@endsection