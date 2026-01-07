@extends('layouts.dashboard')

@section('title', 'Reports Management')

@section('content')
<div class="reports-management">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Reports Management</h1>
            <p class="text-muted">Manage organizational reports, publications, and documentation</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('dashboard.reports.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add New Report
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon bg-primary">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">{{ $stats['total'] }}</h3>
                    <p class="stats-label">Total Reports</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon bg-success">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">{{ $stats['published'] }}</h3>
                    <p class="stats-label">Published</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">{{ $stats['draft'] }}</h3>
                    <p class="stats-label">Draft</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon bg-info">
                    <i class="fas fa-download"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">{{ number_format($stats['total_downloads']) }}</h3>
                    <p class="stats-label">Total Downloads</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="filters-section mb-4">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('dashboard.reports.index') }}" class="filter-form">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label">Search Reports</label>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search by title, author..." 
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <option value="annual" {{ request('type') === 'annual' ? 'selected' : '' }}>Annual</option>
                                <option value="financial" {{ request('type') === 'financial' ? 'selected' : '' }}>Financial</option>
                                <option value="impact" {{ request('type') === 'impact' ? 'selected' : '' }}>Impact</option>
                                <option value="project" {{ request('type') === 'project' ? 'selected' : '' }}>Project</option>
                                <option value="research" {{ request('type') === 'research' ? 'selected' : '' }}>Research</option>
                                <option value="governance" {{ request('type') === 'governance' ? 'selected' : '' }}>Governance</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" 
                                   placeholder="Category..." 
                                   value="{{ request('category') }}">
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Sort By</label>
                            <select name="sort" class="form-select">
                                <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="downloads" {{ request('sort') === 'downloads' ? 'selected' : '' }}>Most Downloaded</option>
                            </select>
                        </div>
                        <div class="col-lg-1 col-md-6">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Reports List</h5>
            <div class="table-actions">
                @if($reports->isNotEmpty())
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="toggleBulkActions()">
                        <i class="fas fa-check-square me-1"></i> Bulk Actions
                    </button>
                    <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-undo me-1"></i> Reset Filters
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            @if($reports->isNotEmpty())
                <!-- Bulk Actions Bar (Hidden by default) -->
                <div id="bulk-actions" class="bulk-actions-bar" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" id="select-all" class="form-check-input me-2">
                            <span id="selected-count">0</span> reports selected
                        </div>
                        <div class="bulk-buttons">
                            <button type="button" class="btn btn-sm btn-success" onclick="bulkPublish()">
                                <i class="fas fa-eye me-1"></i> Publish
                            </button>
                            <button type="button" class="btn btn-sm btn-warning" onclick="bulkDraft()">
                                <i class="fas fa-eye-slash me-1"></i> Draft
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="bulkDelete()">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" id="select-all-header" class="form-check-input">
                                </th>
                                <th width="60">Cover</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Downloads</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input report-checkbox" 
                                           value="{{ $report->id }}">
                                </td>
                                <td>
                                    <div class="report-cover">
                                        <img src="{{ $report->cover_image_url }}" alt="{{ $report->title }}" 
                                             class="cover-thumbnail">
                                    </div>
                                </td>
                                <td>
                                    <div class="report-title-cell">
                                        <h6 class="mb-1">
                                            <a href="{{ route('dashboard.reports.show', $report) }}" 
                                               class="text-decoration-none">
                                                {{ Str::limit($report->title, 40) }}
                                            </a>
                                        </h6>
                                        @if($report->is_featured)
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star me-1"></i> Featured
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ $report->formatted_type }}</span>
                                </td>
                                <td>
                                    @if($report->category)
                                        <span class="text-muted">{{ $report->category }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ $report->author }}</td>
                                <td>
                                    <small class="text-muted">
                                        {{ $report->report_date->format('M j, Y') }}
                                    </small>
                                </td>
                                <td>
                                    @if($report->is_published)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">
                                        {{ $report->download_count }}
                                        @if($report->pdf_file)
                                            <i class="fas fa-file-pdf text-danger ms-1"></i>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('dashboard.reports.show', $report) }}" 
                                           class="btn btn-sm btn-outline-primary" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('dashboard.reports.edit', $report) }}" 
                                           class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('reports.show', $report) }}" target="_blank">
                                                        <i class="fas fa-external-link-alt me-2"></i> View on Site
                                                    </a>
                                                </li>
                                                @if($report->pdf_file)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('reports.download', $report) }}">
                                                        <i class="fas fa-download me-2"></i> Download PDF
                                                    </a>
                                                </li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
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
                                                    <a class="dropdown-item text-danger" href="#" 
                                                       onclick="deleteReport({{ $report->id }}, '{{ $report->title }}')">
                                                        <i class="fas fa-trash me-2"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($reports->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info">
                            Showing {{ $reports->firstItem() }} to {{ $reports->lastItem() }} 
                            of {{ $reports->total() }} results
                        </div>
                        <div>
                            {{ $reports->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
                @endif
            @else
                <div class="empty-state text-center py-5">
                    <div class="empty-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h5 class="empty-title">No Reports Found</h5>
                    <p class="empty-text text-muted">
                        @if(request()->anyFilled(['search', 'type', 'status', 'category']))
                            No reports match your current filters.
                        @else
                            Start by creating your first report.
                        @endif
                    </p>
                    <div class="empty-actions">
                        <a href="{{ route('dashboard.reports.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Create First Report
                        </a>
                        @if(request()->anyFilled(['search', 'type', 'status', 'category']))
                        <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary ms-2">
                            <i class="fas fa-undo me-1"></i> Clear Filters
                        </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Reports Management Styles */
.header-actions {
    display: flex;
    gap: 10px;
}

.stats-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 15px;
}

.stats-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stats-number {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
    color: #333;
}

.stats-label {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.bulk-actions-bar {
    background: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
}

.bulk-buttons {
    display: flex;
    gap: 8px;
}

.cover-thumbnail {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 5px;
}

.report-title-cell h6 {
    margin-bottom: 5px;
}

.empty-state {
    padding: 60px 20px;
}

.empty-icon {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-title {
    color: #6c757d;
    margin-bottom: 10px;
}

.empty-text {
    color: #6c757d;
    margin-bottom: 30px;
}

.empty-actions {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.pagination-info {
    color: #6c757d;
    font-size: 0.9rem;
}

/* Responsive */
@media (max-width: 768px) {
    .header-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .bulk-actions-bar {
        flex-direction: column;
        gap: 10px;
    }
    
    .bulk-buttons {
        justify-content: center;
    }
}
</style>

<script>
// Bulk Actions
function toggleBulkActions() {
    const bulkBar = document.getElementById('bulk-actions');
    bulkBar.style.display = bulkBar.style.display === 'none' ? 'block' : 'none';
}

// Select All Functionality
document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.report-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateSelectedCount();
});

document.getElementById('select-all-header').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.report-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateSelectedCount();
});

// Update selected count
function updateSelectedCount() {
    const checked = document.querySelectorAll('.report-checkbox:checked').length;
    document.getElementById('selected-count').textContent = checked;
}

// Add event listeners to individual checkboxes
document.querySelectorAll('.report-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

// Toggle Status
function toggleStatus(reportId, status) {
    if (confirm('Are you sure you want to change the status of this report?')) {
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
    if (confirm('Are you sure you want to change the featured status of this report?')) {
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
                location.reload();
            } else {
                alert('Error deleting report');
            }
        });
    }
}

// Bulk Actions
function bulkPublish() {
    const selected = getSelectedReports();
    if (selected.length === 0) {
        alert('Please select reports to publish');
        return;
    }
    
    if (confirm(`Publish ${selected.length} selected reports?`)) {
        performBulkAction('publish', selected);
    }
}

function bulkDraft() {
    const selected = getSelectedReports();
    if (selected.length === 0) {
        alert('Please select reports to make draft');
        return;
    }
    
    if (confirm(`Make ${selected.length} selected reports draft?`)) {
        performBulkAction('draft', selected);
    }
}

function bulkDelete() {
    const selected = getSelectedReports();
    if (selected.length === 0) {
        alert('Please select reports to delete');
        return;
    }
    
    if (confirm(`Delete ${selected.length} selected reports? This action cannot be undone.`)) {
        performBulkAction('delete', selected);
    }
}

function getSelectedReports() {
    const checkboxes = document.querySelectorAll('.report-checkbox:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

function performBulkAction(action, reportIds) {
    fetch('/dashboard/reports/bulk-action', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: action,
            report_ids: reportIds
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error performing bulk action');
        }
    });
}
</script>
@endsection
