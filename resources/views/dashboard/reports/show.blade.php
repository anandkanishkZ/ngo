@extends('layouts.dashboard')

@section('title', $report->title)

@section('content')
<div class="show-report-page">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">{{ Str::limit($report->title, 60) }}</h1>
            <p class="text-muted">{{ $report->formatted_type }} • {{ $report->report_date->format('M j, Y') }}</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('reports.show', $report) }}" target="_blank" class="btn btn-outline-info">
                <i class="fas fa-external-link-alt me-1"></i> View on Site
            </a>
            <a href="{{ route('dashboard.reports.edit', $report) }}" class="btn btn-primary">
                <i class="fas fa-edit me-1"></i> Edit Report
            </a>
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @if($report->pdf_file)
                    <li>
                        <a class="dropdown-item" href="{{ route('reports.download', $report) }}">
                            <i class="fas fa-download me-2"></i> Download PDF
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="#" 
                           onclick="toggleStatus({{ $report->id }}, {{ $report->is_published ? 'false' : 'true' }})">
                            @if($report->is_published)
                                <i class="fas fa-eye-slash me-2"></i> Make Draft
                            @else
                                <i class="fas fa-eye me-2"></i> Publish
                            @endif
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" 
                           onclick="toggleFeatured({{ $report->id }}, {{ $report->is_featured ? 'false' : 'true' }})">
                            @if($report->is_featured)
                                <i class="fas fa-star-o me-2"></i> Remove Featured
                            @else
                                <i class="fas fa-star me-2"></i> Make Featured
                            @endif
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.reports.create') }}?duplicate={{ $report->id }}">
                            <i class="fas fa-copy me-2"></i> Duplicate Report
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" 
                           onclick="deleteReport({{ $report->id }}, '{{ $report->title }}')">
                            <i class="fas fa-trash me-2"></i> Delete Report
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Reports
            </a>
        </div>
    </div>

    <!-- Status Alerts -->
    @if(!$report->is_published)
    <div class="alert alert-warning">
        <i class="fas fa-eye-slash me-2"></i>
        <strong>Draft Status:</strong> This report is not visible to the public. 
        <a href="#" onclick="toggleStatus({{ $report->id }}, true)" class="alert-link">Publish it now</a>
    </div>
    @endif

    @if($report->is_featured)
    <div class="alert alert-info">
        <i class="fas fa-star me-2"></i>
        <strong>Featured Report:</strong> This report is highlighted on the homepage.
    </div>
    @endif

    <!-- Main Content -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Report Details Card -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Report Details</h5>
                </div>
                <div class="card-body">
                    <!-- Cover Image -->
                    @if($report->cover_image)
                    <div class="report-cover mb-4">
                        <img src="{{ $report->cover_image_url }}" alt="{{ $report->title }}" 
                             class="img-fluid rounded" style="max-height: 300px; width: 100%; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Basic Information -->
                    <div class="report-info mb-4">
                        <h3 class="report-title">{{ $report->title }}</h3>
                        
                        <div class="report-meta mb-3">
                            <span class="badge bg-primary me-2">{{ $report->formatted_type }}</span>
                            @if($report->category)
                            <span class="badge bg-secondary me-2">{{ $report->category }}</span>
                            @endif
                            @if($report->is_featured)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-star me-1"></i> Featured
                            </span>
                            @endif
                        </div>

                        <div class="info-grid">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label class="info-label">Author:</label>
                                        <span class="info-value">{{ $report->author }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label class="info-label">Report Date:</label>
                                        <span class="info-value">{{ $report->report_date->format('F j, Y') }}</span>
                                    </div>
                                </div>
                                @if($report->fiscal_year)
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label class="info-label">Fiscal Year:</label>
                                        <span class="info-value">{{ $report->fiscal_year }}</span>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label class="info-label">Downloads:</label>
                                        <span class="info-value">{{ number_format($report->download_count) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="content-section mb-4">
                        <h5>Description</h5>
                        <p class="content-text">{{ $report->description }}</p>
                    </div>

                    <!-- Executive Summary -->
                    @if($report->executive_summary)
                    <div class="content-section mb-4">
                        <h5>Executive Summary</h5>
                        <div class="content-text">{!! nl2br(e($report->executive_summary)) !!}</div>
                    </div>
                    @endif

                    <!-- Key Findings -->
                    @if($report->key_findings)
                    <div class="content-section mb-4">
                        <h5>Key Findings</h5>
                        <div class="content-text">{!! nl2br(e($report->key_findings)) !!}</div>
                    </div>
                    @endif

                    <!-- Recommendations -->
                    @if($report->recommendations)
                    <div class="content-section mb-4">
                        <h5>Recommendations</h5>
                        <div class="content-text">{!! nl2br(e($report->recommendations)) !!}</div>
                    </div>
                    @endif

                    <!-- Full Content -->
                    @if($report->content)
                    <div class="content-section">
                        <h5>Full Content</h5>
                        <div class="content-text">{!! $report->content !!}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- File Information -->
            @if($report->pdf_file)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">PDF Document</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="file-icon me-3">
                            <i class="fas fa-file-pdf text-danger" style="font-size: 2rem;"></i>
                        </div>
                        <div class="file-info flex-grow-1">
                            <h6 class="mb-1">{{ basename($report->pdf_file) }}</h6>
                            <p class="text-muted mb-0">
                                Downloaded {{ number_format($report->download_count) }} times
                            </p>
                        </div>
                        <div class="file-actions">
                            <a href="{{ route('reports.download', $report) }}" class="btn btn-primary">
                                <i class="fas fa-download me-1"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-content">
                <!-- Quick Stats -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-bar text-primary me-1"></i> Statistics
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="stat-item mb-3">
                            <div class="stat-label">Total Downloads</div>
                            <div class="stat-value">{{ number_format($report->download_count) }}</div>
                        </div>
                        <div class="stat-item mb-3">
                            <div class="stat-label">Publication Status</div>
                            <div class="stat-value">
                                <span class="badge {{ $report->is_published ? 'bg-success' : 'bg-warning' }}">
                                    {{ $report->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                        <div class="stat-item mb-3">
                            <div class="stat-label">Featured Status</div>
                            <div class="stat-value">
                                <span class="badge {{ $report->is_featured ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                    {{ $report->is_featured ? 'Featured' : 'Regular' }}
                                </span>
                            </div>
                        </div>
                        <div class="stat-item mb-3">
                            <div class="stat-label">Created Date</div>
                            <div class="stat-value">{{ $report->created_at->format('M j, Y') }}</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-label">Last Updated</div>
                            <div class="stat-value">{{ $report->updated_at->format('M j, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-bolt text-warning me-1"></i> Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('dashboard.reports.edit', $report) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit Report
                            </a>
                            <a href="{{ route('reports.show', $report) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> View on Site
                            </a>
                            @if($report->pdf_file)
                            <a href="{{ route('reports.download', $report) }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-download me-1"></i> Download PDF
                            </a>
                            @endif
                            <button type="button" class="btn btn-outline-secondary btn-sm" 
                                    onclick="toggleStatus({{ $report->id }}, {{ $report->is_published ? 'false' : 'true' }})">
                                @if($report->is_published)
                                    <i class="fas fa-eye-slash me-1"></i> Make Draft
                                @else
                                    <i class="fas fa-eye me-1"></i> Publish
                                @endif
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-sm" 
                                    onclick="toggleFeatured({{ $report->id }}, {{ $report->is_featured ? 'false' : 'true' }})">
                                @if($report->is_featured)
                                    <i class="fas fa-star-o me-1"></i> Remove Featured
                                @else
                                    <i class="fas fa-star me-1"></i> Make Featured
                                @endif
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Share Links -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-share text-info me-1"></i> Share Report
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="share-links">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control form-control-sm" 
                                       value="{{ route('reports.show', $report) }}" 
                                       id="reportUrl" readonly>
                                <button class="btn btn-outline-secondary btn-sm" type="button" onclick="copyUrl()">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="social-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('reports.show', $report)) }}" 
                                   target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('reports.show', $report)) }}&text={{ urlencode($report->title) }}" 
                                   target="_blank" class="btn btn-outline-info btn-sm">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('reports.show', $report)) }}" 
                                   target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Information -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-info-circle text-secondary me-1"></i> Related Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="related-links">
                            <a href="{{ route('dashboard.reports.index') }}?type={{ $report->type }}" class="btn btn-outline-secondary btn-sm w-100 mb-2">
                                <i class="fas fa-list me-1"></i> View Similar Reports
                            </a>
                            @if($report->category)
                            <a href="{{ route('dashboard.reports.index') }}?category={{ $report->category }}" class="btn btn-outline-secondary btn-sm w-100 mb-2">
                                <i class="fas fa-tag me-1"></i> Same Category Reports
                            </a>
                            @endif
                            <a href="{{ route('dashboard.reports.create') }}?duplicate={{ $report->id }}" class="btn btn-outline-secondary btn-sm w-100">
                                <i class="fas fa-copy me-1"></i> Duplicate This Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Show Report Page Styles */
.show-report-page .card {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: none;
}

.show-report-page .card-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.sidebar-content {
    position: sticky;
    top: 20px;
}

.report-title {
    font-size: 1.8rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 15px;
}

.report-meta {
    margin-bottom: 20px;
}

.info-item {
    margin-bottom: 10px;
}

.info-label {
    font-weight: 600;
    color: #6c757d;
    display: inline-block;
    min-width: 100px;
}

.info-value {
    color: #333;
}

.content-section {
    border-left: 3px solid #007bff;
    padding-left: 15px;
}

.content-section h5 {
    color: #333;
    font-weight: 600;
    margin-bottom: 15px;
}

.content-text {
    line-height: 1.7;
    color: #555;
}

.stat-item {
    display: flex;
    justify-content: between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    flex: 1;
}

.stat-value {
    font-weight: 600;
    color: #333;
}

.social-share {
    display: flex;
    gap: 5px;
    justify-content: center;
}

.related-links .btn {
    text-align: left;
}

/* Responsive */
@media (max-width: 992px) {
    .sidebar-content {
        position: static;
        margin-top: 30px;
    }
    
    .header-actions {
        flex-direction: column;
        gap: 10px;
    }
}

@media (max-width: 768px) {
    .header-actions {
        width: 100%;
    }
    
    .header-actions .btn {
        width: 100%;
        margin-bottom: 5px;
    }
    
    .header-actions .btn-group {
        width: 100%;
    }
}
</style>

<script>
// Copy URL function
function copyUrl() {
    const urlInput = document.getElementById('reportUrl');
    urlInput.select();
    document.execCommand('copy');
    
    // Show feedback
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-check"></i>';
    button.classList.remove('btn-outline-secondary');
    button.classList.add('btn-success');
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}

// Toggle Status
function toggleStatus(reportId, status) {
    const action = status ? 'publish' : 'make draft';
    if (confirm(`Are you sure you want to ${action} this report?`)) {
        fetch(`/dashboard/reports/${reportId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ is_published: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating status');
            }
        });
    }
}

// Toggle Featured
function toggleFeatured(reportId, featured) {
    const action = featured ? 'feature' : 'unfeature';
    if (confirm(`Are you sure you want to ${action} this report?`)) {
        fetch(`/dashboard/reports/${reportId}/toggle-featured`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ is_featured: featured })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating featured status');
            }
        });
    }
}

// Delete Report
function deleteReport(reportId, title) {
    if (confirm(`Are you sure you want to delete "${title}"? This action cannot be undone.`)) {
        fetch(`/dashboard/reports/${reportId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("dashboard.reports.index") }}';
            } else {
                alert('Error deleting report');
            }
        });
    }
}
</script>
@endsection
