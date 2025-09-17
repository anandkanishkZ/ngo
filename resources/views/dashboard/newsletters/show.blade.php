@extends('layouts.dashboard')

@section('title', 'Subscriber Details')

@section('content')
<div class="container-fluid">
  <div class="row g-3">
    <!-- Header Section -->
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <h4 class="mb-1">
            <i class="fa-solid fa-envelope me-2"></i>Subscriber Details
          </h4>
          <p class="text-muted mb-0">View detailed information about this newsletter subscriber</p>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('dashboard.newsletters.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to List
          </a>
        </div>
      </div>
    </div>

    <!-- Subscriber Details Card -->
    <div class="col-lg-8">
      <div class="ds-card">
        <div class="card-header">
          <h5 class="card-title mb-0">
            <i class="fa-solid fa-user me-2"></i>Subscriber Information
          </h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Email Address</label>
              <div class="form-control-plaintext fw-bold">
                <i class="fa-solid fa-envelope me-2 text-primary"></i>
                {{ $newsletter->email }}
              </div>
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Status</label>
              <div class="form-control-plaintext">
                <span class="badge {{ $newsletter->is_active ? 'bg-success' : 'bg-secondary' }} fs-6">
                  <i class="fa-solid {{ $newsletter->is_active ? 'fa-eye' : 'fa-eye-slash' }} me-1"></i>
                  {{ $newsletter->status }}
                </span>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Subscribed Date</label>
              <div class="form-control-plaintext">
                <i class="fa-solid fa-calendar me-2 text-info"></i>
                {{ $newsletter->subscribed_at->format('F j, Y g:i A') }}
                <br>
                <small class="text-muted">{{ $newsletter->subscribed_at->diffForHumans() }}</small>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">IP Address</label>
              <div class="form-control-plaintext">
                <i class="fa-solid fa-globe me-2 text-warning"></i>
                {{ $newsletter->ip_address ?? 'Not recorded' }}
              </div>
            </div>

            @if($newsletter->unsubscribed_at)
              <div class="col-12 mb-3">
                <label class="form-label text-muted">Unsubscribed Date</label>
                <div class="form-control-plaintext">
                  <i class="fa-solid fa-calendar-times me-2 text-danger"></i>
                  {{ $newsletter->unsubscribed_at->format('F j, Y g:i A') }}
                  <br>
                  <small class="text-muted">{{ $newsletter->unsubscribed_at->diffForHumans() }}</small>
                </div>
              </div>
            @endif

            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Subscriber ID</label>
              <div class="form-control-plaintext">
                <code>#{{ $newsletter->id }}</code>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label text-muted">Created At</label>
              <div class="form-control-plaintext">
                <i class="fa-solid fa-clock me-2 text-secondary"></i>
                {{ $newsletter->created_at->format('F j, Y g:i A') }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Actions Card -->
    <div class="col-lg-4">
      <div class="ds-card">
        <div class="card-header">
          <h5 class="card-title mb-0">
            <i class="fa-solid fa-tools me-2"></i>Actions
          </h5>
        </div>
        <div class="card-body">
          <!-- Toggle Status -->
          <button class="btn {{ $newsletter->is_active ? 'btn-warning' : 'btn-success' }} w-100 mb-3"
                  onclick="toggleStatus({{ $newsletter->id }}, this)">
            <i class="fa-solid {{ $newsletter->is_active ? 'fa-eye-slash' : 'fa-eye' }} me-2"></i>
            {{ $newsletter->is_active ? 'Deactivate Subscriber' : 'Reactivate Subscriber' }}
          </button>

          <!-- Delete Subscriber -->
          <form method="POST" action="{{ route('dashboard.newsletters.destroy', $newsletter) }}" 
                onsubmit="return confirm('Are you sure you want to permanently delete this subscriber? This action cannot be undone.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100">
              <i class="fa-solid fa-trash me-2"></i>Delete Subscriber
            </button>
          </form>
        </div>
      </div>

      <!-- Statistics Card -->
      <div class="ds-card mt-3">
        <div class="card-header">
          <h5 class="card-title mb-0">
            <i class="fa-solid fa-chart-line me-2"></i>Quick Stats
          </h5>
        </div>
        <div class="card-body">
          <div class="row text-center">
            <div class="col-12 mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Subscription Duration:</span>
                <strong>{{ $newsletter->subscribed_at->diffForHumans(null, true) }}</strong>
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">Domain:</span>
                <strong>{{ Str::after($newsletter->email, '@') }}</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  function toggleStatus(id, button) {
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Processing...';

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
        // Show success message
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show';
        alert.innerHTML = `
          <i class="fa-solid fa-check-circle me-2"></i>${data.message}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.container-fluid .row').prepend(alert);

        // Reload page after a short delay to show updated status
        setTimeout(() => {
          window.location.reload();
        }, 1500);
      } else {
        // Show error message
        const alert = document.createElement('div');
        alert.className = 'alert alert-danger alert-dismissible fade show';
        alert.innerHTML = `
          <i class="fa-solid fa-exclamation-triangle me-2"></i>Failed to update status. Please try again.
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        document.querySelector('.container-fluid .row').prepend(alert);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      const alert = document.createElement('div');
      alert.className = 'alert alert-danger alert-dismissible fade show';
      alert.innerHTML = `
        <i class="fa-solid fa-exclamation-triangle me-2"></i>Network error. Please check your connection and try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `;
      document.querySelector('.container-fluid .row').prepend(alert);
    })
    .finally(() => {
      button.disabled = false;
      button.innerHTML = originalText;
    });
  }
</script>
@endpush
@endsection
