@extends('layouts.dashboard')

@section('title', 'Edit Report')

@section('content')
<div class="edit-report-page">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Report</h1>
            <p class="text-muted">Update report information and settings</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('dashboard.reports.show', $report) }}" class="btn btn-outline-info">
                <i class="fas fa-eye me-1"></i> View Report
            </a>
            <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Reports
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('dashboard.reports.update', $report) }}" method="POST" enctype="multipart/form-data" id="reportForm">
                @csrf
                @method('PUT')
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Report Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Report Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $report->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description', $report->description) }}</textarea>
                            <div class="form-text">Brief description of the report (will be shown in listings)</div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type and Category Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Report Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" name="type" required>
                                        <option value="">Select Report Type</option>
                                        <option value="annual" {{ old('type', $report->type) === 'annual' ? 'selected' : '' }}>Annual Report</option>
                                        <option value="financial" {{ old('type', $report->type) === 'financial' ? 'selected' : '' }}>Financial Report</option>
                                        <option value="impact" {{ old('type', $report->type) === 'impact' ? 'selected' : '' }}>Impact Assessment</option>
                                        <option value="project" {{ old('type', $report->type) === 'project' ? 'selected' : '' }}>Project Report</option>
                                        <option value="research" {{ old('type', $report->type) === 'research' ? 'selected' : '' }}>Research Study</option>
                                        <option value="governance" {{ old('type', $report->type) === 'governance' ? 'selected' : '' }}>Governance Document</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                           id="category" name="category" value="{{ old('category', $report->category) }}" 
                                           placeholder="e.g., Education, Health, Community Development">
                                    <div class="form-text">Optional category for better organization</div>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Author and Report Date Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                           id="author" name="author" value="{{ old('author', $report->author) }}" required>
                                    @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_date" class="form-label">Report Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('report_date') is-invalid @enderror" 
                                           id="report_date" name="report_date" value="{{ old('report_date', $report->report_date->format('Y-m-d')) }}" required>
                                    @error('report_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Fiscal Year -->
                        <div class="mb-3">
                            <label for="fiscal_year" class="form-label">Fiscal Year</label>
                            <input type="text" class="form-control @error('fiscal_year') is-invalid @enderror" 
                                   id="fiscal_year" name="fiscal_year" value="{{ old('fiscal_year', $report->fiscal_year) }}" 
                                   placeholder="e.g., 2023-24">
                            <div class="form-text">Optional fiscal year for financial and annual reports</div>
                            @error('fiscal_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Report Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="8">{{ old('content', $report->content) }}</textarea>
                            <div class="form-text">Detailed content of the report (supports HTML)</div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Executive Summary -->
                        <div class="mb-3">
                            <label for="executive_summary" class="form-label">Executive Summary</label>
                            <textarea class="form-control @error('executive_summary') is-invalid @enderror" 
                                      id="executive_summary" name="executive_summary" rows="4">{{ old('executive_summary', $report->executive_summary) }}</textarea>
                            <div class="form-text">Brief executive summary highlighting key points</div>
                            @error('executive_summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Key Findings -->
                        <div class="mb-3">
                            <label for="key_findings" class="form-label">Key Findings</label>
                            <textarea class="form-control @error('key_findings') is-invalid @enderror" 
                                      id="key_findings" name="key_findings" rows="4">{{ old('key_findings', $report->key_findings) }}</textarea>
                            <div class="form-text">Main findings and insights from the report</div>
                            @error('key_findings')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Recommendations -->
                        <div class="mb-3">
                            <label for="recommendations" class="form-label">Recommendations</label>
                            <textarea class="form-control @error('recommendations') is-invalid @enderror" 
                                      id="recommendations" name="recommendations" rows="4">{{ old('recommendations', $report->recommendations) }}</textarea>
                            <div class="form-text">Recommendations and action items</div>
                            @error('recommendations')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- File Uploads Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">File Uploads</h5>
                    </div>
                    <div class="card-body">
                        <!-- Current Cover Image -->
                        @if($report->cover_image)
                        <div class="current-files mb-4">
                            <h6>Current Cover Image:</h6>
                            <div class="current-cover">
                                <img src="{{ $report->cover_image_url }}" alt="Current Cover" class="img-thumbnail" style="max-height: 150px;">
                                <div class="file-actions mt-2">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeCoverImage()">
                                        <i class="fas fa-trash me-1"></i> Remove Current Image
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Cover Image -->
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">
                                {{ $report->cover_image ? 'Replace Cover Image' : 'Cover Image' }}
                            </label>
                            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                                   id="cover_image" name="cover_image" accept="image/*">
                            <div class="form-text">Upload a cover image for the report (JPG, PNG, max 2MB)</div>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="cover-preview" class="mt-2" style="display: none;">
                                <img id="cover-preview-img" src="" alt="Cover Preview" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>

                        <!-- Current PDF File -->
                        @if($report->pdf_file)
                        <div class="current-files mb-4">
                            <h6>Current PDF Document:</h6>
                            <div class="current-pdf">
                                <div class="alert alert-info">
                                    <i class="fas fa-file-pdf me-2"></i>
                                    <strong>{{ basename($report->pdf_file) }}</strong>
                                    <small class="text-muted ms-2">({{ $report->download_count }} downloads)</small>
                                </div>
                                <div class="file-actions">
                                    <a href="{{ route('reports.download', $report) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download me-1"></i> Download Current PDF
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removePdfFile()">
                                        <i class="fas fa-trash me-1"></i> Remove Current PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- PDF File -->
                        <div class="mb-3">
                            <label for="pdf_file" class="form-label">
                                {{ $report->pdf_file ? 'Replace PDF Document' : 'PDF Document' }}
                            </label>
                            <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" 
                                   id="pdf_file" name="pdf_file" accept=".pdf">
                            <div class="form-text">Upload the PDF version of the report (PDF only, max 10MB)</div>
                            @error('pdf_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="pdf-preview" class="mt-2" style="display: none;">
                                <div class="alert alert-info">
                                    <i class="fas fa-file-pdf me-2"></i>
                                    <span id="pdf-filename"></span>
                                    <small class="text-muted ms-2" id="pdf-size"></small>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden fields for file removal -->
                        <input type="hidden" name="remove_cover_image" id="remove_cover_image" value="0">
                        <input type="hidden" name="remove_pdf_file" id="remove_pdf_file" value="0">
                    </div>
                </div>

                <!-- Settings Card -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Publication Settings</h5>
                    </div>
                    <div class="card-body">
                        <!-- Status Options -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           id="is_published" name="is_published" value="1" 
                                           {{ old('is_published', $report->is_published) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        <strong>Publish Report</strong>
                                        <div class="form-text">Make this report visible to the public</div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           id="is_featured" name="is_featured" value="1" 
                                           {{ old('is_featured', $report->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        <strong>Featured Report</strong>
                                        <div class="form-text">Highlight this report on the homepage</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-save me-1"></i> Update Report
                                </button>
                                <button type="submit" name="action" value="draft" class="btn btn-outline-secondary btn-lg ms-2">
                                    <i class="fas fa-file-alt me-1"></i> Save as Draft
                                </button>
                            </div>
                            <div>
                                <a href="{{ route('dashboard.reports.show', $report) }}" class="btn btn-outline-info btn-lg me-2">
                                    <i class="fas fa-eye me-1"></i> View Report
                                </a>
                                <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-content">
                <!-- Report Stats -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-bar text-primary me-1"></i> Report Statistics
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="stat-item mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Downloads:</span>
                                <strong>{{ $report->download_count }}</strong>
                            </div>
                        </div>
                        <div class="stat-item mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Status:</span>
                                <span class="badge {{ $report->is_published ? 'bg-success' : 'bg-warning' }}">
                                    {{ $report->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                        <div class="stat-item mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Featured:</span>
                                <span class="badge {{ $report->is_featured ? 'bg-warning' : 'bg-secondary' }}">
                                    {{ $report->is_featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>
                        <div class="stat-item mb-3">
                            <div class="d-flex justify-content-between">
                                <span>Created:</span>
                                <small class="text-muted">{{ $report->created_at->format('M j, Y') }}</small>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="d-flex justify-content-between">
                                <span>Updated:</span>
                                <small class="text-muted">{{ $report->updated_at->format('M j, Y') }}</small>
                            </div>
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
                            <a href="{{ route('reports.show', $report) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i> View on Site
                            </a>
                            @if($report->pdf_file)
                            <a href="{{ route('reports.download', $report) }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-download me-1"></i> Download PDF
                            </a>
                            @endif
                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="duplicateReport()">
                                <i class="fas fa-copy me-1"></i> Duplicate Report
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-lightbulb text-warning me-1"></i> Update Tips
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> Changes are saved immediately</small>
                            </li>
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> New files replace existing ones</small>
                            </li>
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> Downloads count is preserved</small>
                            </li>
                            <li>
                                <small><i class="fas fa-check text-success me-1"></i> Publishing changes are instant</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Edit Report Page Styles */
.edit-report-page .card {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: none;
}

.edit-report-page .card-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.sidebar-content {
    position: sticky;
    top: 20px;
}

.current-files h6 {
    color: #495057;
    font-weight: 600;
    margin-bottom: 10px;
}

.current-cover img {
    border-radius: 8px;
}

.file-actions {
    margin-top: 10px;
}

.stat-item {
    padding: 8px 0;
    border-bottom: 1px solid #f0f0f0;
}

.stat-item:last-child {
    border-bottom: none;
}

/* Responsive */
@media (max-width: 992px) {
    .sidebar-content {
        position: static;
        margin-top: 30px;
    }
}
</style>

<script>
// File removal functions
function removeCoverImage() {
    if (confirm('Are you sure you want to remove the current cover image?')) {
        document.getElementById('remove_cover_image').value = '1';
        document.querySelector('.current-cover').style.display = 'none';
    }
}

function removePdfFile() {
    if (confirm('Are you sure you want to remove the current PDF file?')) {
        document.getElementById('remove_pdf_file').value = '1';
        document.querySelector('.current-pdf').style.display = 'none';
    }
}

// File preview functions
document.addEventListener('DOMContentLoaded', function() {
    // Cover Image Preview
    document.getElementById('cover_image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('cover-preview-img');
                previewImg.src = e.target.result;
                document.getElementById('cover-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // PDF File Preview
    document.getElementById('pdf_file').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            document.getElementById('pdf-filename').textContent = file.name;
            document.getElementById('pdf-size').textContent = `(${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            document.getElementById('pdf-preview').style.display = 'block';
        }
    });

    // Form submission handling
    document.getElementById('reportForm').addEventListener('submit', function(e) {
        const submitBtn = e.submitter;
        if (submitBtn && submitBtn.name === 'action' && submitBtn.value === 'draft') {
            // If saving as draft, uncheck published
            document.getElementById('is_published').checked = false;
        }
    });
});

// Duplicate report function
function duplicateReport() {
    if (confirm('Create a duplicate of this report?')) {
        // Here you would implement the duplication logic
        // For now, we'll redirect to create with pre-filled data
        window.location.href = '{{ route("dashboard.reports.create") }}?duplicate={{ $report->id }}';
    }
}
</script>
@endsection
