@extends('layouts.dashboard')

@section('title', 'View Notice - ' . $notice->title)

@section('content')
<div class="dashboard-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0 text-gray-800">View Notice</h1>
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.notices.index') }}">Notices</a></li>
                    <li class="breadcrumb-item active">{{ $notice->title }}</li>
                </ol>
            </nav>
        </div>
        <div class="dashboard-actions">
            <a href="{{ route('dashboard.notices.edit', $notice->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Notice
            </a>
            <a href="{{ route('dashboard.notices.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>
</div>

<div class="dashboard-content">
    <div class="row">
        <div class="col-lg-8">
            <!-- Notice Content Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Notice Details</h5>
                        <div class="notice-badges">
                            @if($notice->is_featured)
                                <span class="badge bg-warning text-dark me-2">
                                    <i class="fas fa-star me-1"></i>Featured
                                </span>
                            @endif
                            <span class="badge bg-{{ $notice->status === 'published' ? 'success' : ($notice->status === 'draft' ? 'secondary' : 'warning') }}">
                                {{ ucfirst($notice->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Priority Badge -->
                    <div class="mb-3">
                        <span class="badge priority-{{ $notice->priority }} px-3 py-2">
                            <i class="fas fa-{{ $notice->priority === 'urgent' ? 'exclamation-triangle' : ($notice->priority === 'high' ? 'exclamation-circle' : ($notice->priority === 'medium' ? 'info-circle' : 'info')) }} me-2"></i>
                            {{ strtoupper($notice->priority) }} PRIORITY
                        </span>
                    </div>

                    <!-- Title -->
                    <h2 class="h4 mb-3 text-dark">{{ $notice->title }}</h2>

                    <!-- Excerpt -->
                    @if($notice->excerpt)
                        <div class="alert alert-info">
                            <strong>Excerpt:</strong> {{ $notice->excerpt }}
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="notice-content">
                        {!! $notice->content !!}
                    </div>

                    <!-- Image -->
                    @if($notice->image_url)
                        <div class="mt-4">
                            <h6>Notice Image:</h6>
                            <img src="{{ $notice->image_url }}" 
                                 alt="{{ $notice->title }}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 400px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Notice Information Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Notice Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="info-group mb-3">
                        <label class="fw-bold text-muted">Author:</label>
                        <p class="mb-0">{{ $notice->author }}</p>
                    </div>

                    <div class="info-group mb-3">
                        <label class="fw-bold text-muted">Category:</label>
                        <p class="mb-0">{{ $notice->category ?? 'Uncategorized' }}</p>
                    </div>

                    <div class="info-group mb-3">
                        <label class="fw-bold text-muted">Priority:</label>
                        <p class="mb-0">
                            <span class="badge priority-{{ $notice->priority }}">
                                {{ ucfirst($notice->priority) }}
                            </span>
                        </p>
                    </div>

                    <div class="info-group mb-3">
                        <label class="fw-bold text-muted">Status:</label>
                        <p class="mb-0">
                            <span class="badge bg-{{ $notice->status === 'published' ? 'success' : ($notice->status === 'draft' ? 'secondary' : 'warning') }}">
                                {{ ucfirst($notice->status) }}
                            </span>
                        </p>
                    </div>

                    <div class="info-group mb-3">
                        <label class="fw-bold text-muted">Created:</label>
                        <p class="mb-0">{{ $notice->created_at->format('M j, Y g:i A') }}</p>
                    </div>

                    <div class="info-group mb-3">
                        <label class="fw-bold text-muted">Updated:</label>
                        <p class="mb-0">{{ $notice->updated_at->format('M j, Y g:i A') }}</p>
                    </div>

                    @if($notice->published_at)
                        <div class="info-group mb-3">
                            <label class="fw-bold text-muted">Published:</label>
                            <p class="mb-0">{{ $notice->published_at->format('M j, Y g:i A') }}</p>
                        </div>
                    @endif

                    @if($notice->expires_at)
                        <div class="info-group mb-3">
                            <label class="fw-bold text-muted">Expires:</label>
                            <p class="mb-0 {{ $notice->expires_at->isPast() ? 'text-danger' : 'text-warning' }}">
                                {{ $notice->expires_at->format('M j, Y g:i A') }}
                                @if($notice->expires_at->isPast())
                                    <small class="text-danger">(Expired)</small>
                                @endif
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.notices.edit', $notice->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>Edit Notice
                        </a>
                        
                        <a href="{{ route('notices.show', $notice) }}" class="btn btn-info btn-sm" target="_blank">
                            <i class="fas fa-eye me-2"></i>View Public Page
                        </a>

                        @if($notice->status === 'published')
                            <form action="{{ route('dashboard.notices.toggle-status', $notice->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm w-100">
                                    <i class="fas fa-pause me-2"></i>Unpublish
                                </button>
                            </form>
                        @else
                            <form action="{{ route('dashboard.notices.toggle-status', $notice->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="fas fa-play me-2"></i>Publish
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('dashboard.notices.toggle-featured', $notice->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-{{ $notice->is_featured ? 'outline-warning' : 'warning' }} btn-sm w-100">
                                <i class="fas fa-star me-2"></i>
                                {{ $notice->is_featured ? 'Remove Featured' : 'Make Featured' }}
                            </button>
                        </form>

                        <form action="{{ route('dashboard.notices.destroy', $notice->id) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this notice? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                <i class="fas fa-trash me-2"></i>Delete Notice
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Priority Badge Styles */
.priority-urgent {
    background: linear-gradient(135deg, #dc3545, #c82333);
    color: white;
}

.priority-high {
    background: linear-gradient(135deg, #fd7e14, #e8590c);
    color: white;
}

.priority-medium {
    background: linear-gradient(135deg, #ffc107, #e0a800);
    color: #212529;
}

.priority-low {
    background: linear-gradient(135deg, #28a745, #218838);
    color: white;
}

.notice-content {
    line-height: 1.6;
}

.notice-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.375rem;
    margin: 1rem 0;
}

.info-group label {
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-group p {
    font-size: 0.95rem;
}

.card {
    border: none;
    border-radius: 0.5rem;
}

.card-header {
    border-bottom: 1px solid #dee2e6;
    border-radius: 0.5rem 0.5rem 0 0 !important;
}

.notice-badges .badge {
    font-size: 0.75rem;
    font-weight: 500;
}
</style>
@endsection
