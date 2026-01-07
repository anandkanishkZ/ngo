@extends('layouts.dashboard')

@section('title', 'Create Report')

@section('content')
<div class="create-report-page">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Create New Report</h1>
            <p class="text-muted">Add a new report to your publication library</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Reports
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-8">
            <form action="{{ route('dashboard.reports.store') }}" method="POST" enctype="multipart/form-data" id="reportForm">
                @csrf
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Report Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Report Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
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
                                        <option value="annual" {{ old('type') === 'annual' ? 'selected' : '' }}>Annual Report</option>
                                        <option value="financial" {{ old('type') === 'financial' ? 'selected' : '' }}>Financial Report</option>
                                        <option value="impact" {{ old('type') === 'impact' ? 'selected' : '' }}>Impact Assessment</option>
                                        <option value="project" {{ old('type') === 'project' ? 'selected' : '' }}>Project Report</option>
                                        <option value="research" {{ old('type') === 'research' ? 'selected' : '' }}>Research Study</option>
                                        <option value="governance" {{ old('type') === 'governance' ? 'selected' : '' }}>Governance Document</option>
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
                                           id="category" name="category" value="{{ old('category') }}" 
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
                                           id="author" name="author" value="{{ old('author', 'JIDS Nepal') }}" required>
                                    @error('author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="report_date" class="form-label">Report Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('report_date') is-invalid @enderror" 
                                           id="report_date" name="report_date" value="{{ old('report_date') }}" required>
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
                                   id="fiscal_year" name="fiscal_year" value="{{ old('fiscal_year') }}" 
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
                                      id="content" name="content" rows="8">{{ old('content') }}</textarea>
                            <div class="form-text">Detailed content of the report (supports HTML)</div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Executive Summary -->
                        <div class="mb-3">
                            <label for="executive_summary" class="form-label">Executive Summary</label>
                            <textarea class="form-control @error('executive_summary') is-invalid @enderror" 
                                      id="executive_summary" name="executive_summary" rows="4">{{ old('executive_summary') }}</textarea>
                            <div class="form-text">Brief executive summary highlighting key points</div>
                            @error('executive_summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Key Findings -->
                        <div class="mb-3">
                            <label for="key_findings" class="form-label">Key Findings</label>
                            <textarea class="form-control @error('key_findings') is-invalid @enderror" 
                                      id="key_findings" name="key_findings" rows="4">{{ old('key_findings') }}</textarea>
                            <div class="form-text">Main findings and insights from the report</div>
                            @error('key_findings')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Recommendations -->
                        <div class="mb-3">
                            <label for="recommendations" class="form-label">Recommendations</label>
                            <textarea class="form-control @error('recommendations') is-invalid @enderror" 
                                      id="recommendations" name="recommendations" rows="4">{{ old('recommendations') }}</textarea>
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
                        <!-- Cover Image -->
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
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

                        <!-- PDF File -->
                        <div class="mb-3">
                            <label for="pdf_file" class="form-label">PDF Document</label>
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
                                           {{ old('is_published') ? 'checked' : '' }}>
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
                                           {{ old('is_featured') ? 'checked' : '' }}>
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
                                    <i class="fas fa-save me-1"></i> Create Report
                                </button>
                                <button type="submit" name="action" value="draft" class="btn btn-outline-secondary btn-lg ms-2">
                                    <i class="fas fa-file-alt me-1"></i> Save as Draft
                                </button>
                            </div>
                            <div>
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
                <!-- Tips Card -->
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-lightbulb text-warning me-1"></i> Tips for Creating Reports
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> Use clear, descriptive titles</small>
                            </li>
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> Include executive summary for long reports</small>
                            </li>
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> Upload high-quality cover images</small>
                            </li>
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> Optimize PDF files for web viewing</small>
                            </li>
                            <li class="mb-2">
                                <small><i class="fas fa-check text-success me-1"></i> Use appropriate categories for organization</small>
                            </li>
                            <li>
                                <small><i class="fas fa-check text-success me-1"></i> Save as draft first, then publish when ready</small>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- File Requirements -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-info-circle text-info me-1"></i> File Requirements
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="requirement-item mb-3">
                            <strong>Cover Image:</strong>
                            <ul class="small text-muted mb-0 mt-1">
                                <li>Format: JPG, PNG, WEBP</li>
                                <li>Max size: 2MB</li>
                                <li>Recommended: 800x600px</li>
                            </ul>
                        </div>
                        <div class="requirement-item">
                            <strong>PDF Document:</strong>
                            <ul class="small text-muted mb-0 mt-1">
                                <li>Format: PDF only</li>
                                <li>Max size: 10MB</li>
                                <li>Searchable text preferred</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Preview Card -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-eye text-primary me-1"></i> Live Preview
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="live-preview" class="report-preview">
                            <div class="preview-image">
                                <div class="placeholder-image">
                                    <i class="fas fa-image"></i>
                                    <span>Cover Image</span>
                                </div>
                            </div>
                            <div class="preview-content mt-3">
                                <h6 id="preview-title" class="preview-title">Report Title</h6>
                                <div class="preview-meta">
                                    <span id="preview-type" class="badge bg-secondary">Type</span>
                                    <span id="preview-category" class="badge bg-info ms-1" style="display: none;">Category</span>
                                </div>
                                <p id="preview-description" class="preview-description text-muted mt-2">
                                    Report description will appear here...
                                </p>
                                <div class="preview-info">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i> 
                                        <span id="preview-author">Author</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Create Report Page Styles */
.create-report-page .card {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border: none;
}

.create-report-page .card-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.sidebar-content {
    position: sticky;
    top: 20px;
}

.requirement-item {
    border-left: 3px solid #007bff;
    padding-left: 10px;
}

.report-preview {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    overflow: hidden;
}

.preview-image {
    height: 120px;
    background: #f8f9fa;
    position: relative;
}

.placeholder-image {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #6c757d;
}

.placeholder-image i {
    font-size: 2rem;
    margin-bottom: 5px;
}

.preview-content {
    padding: 15px;
}

.preview-title {
    font-weight: 600;
    margin-bottom: 10px;
}

.preview-meta {
    margin-bottom: 10px;
}

.preview-description {
    font-size: 0.9rem;
    line-height: 1.4;
}

.preview-info {
    border-top: 1px solid #eee;
    padding-top: 10px;
    margin-top: 10px;
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
// Live Preview Updates
document.addEventListener('DOMContentLoaded', function() {
    // Title Preview
    document.getElementById('title').addEventListener('input', function() {
        document.getElementById('preview-title').textContent = this.value || 'Report Title';
    });

    // Type Preview
    document.getElementById('type').addEventListener('change', function() {
        const typeText = this.options[this.selectedIndex].text;
        document.getElementById('preview-type').textContent = typeText === 'Select Report Type' ? 'Type' : typeText;
    });

    // Category Preview
    document.getElementById('category').addEventListener('input', function() {
        const categoryBadge = document.getElementById('preview-category');
        if (this.value) {
            categoryBadge.textContent = this.value;
            categoryBadge.style.display = 'inline';
        } else {
            categoryBadge.style.display = 'none';
        }
    });

    // Description Preview
    document.getElementById('description').addEventListener('input', function() {
        document.getElementById('preview-description').textContent = this.value || 'Report description will appear here...';
    });

    // Author Preview
    document.getElementById('author').addEventListener('input', function() {
        document.getElementById('preview-author').textContent = this.value || 'Author';
    });

    // Cover Image Preview
    document.getElementById('cover_image').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('cover-preview-img');
                previewImg.src = e.target.result;
                document.getElementById('cover-preview').style.display = 'block';
                
                // Update live preview
                const previewImage = document.querySelector('.preview-image');
                previewImage.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">`;
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

    // Auto-generate fiscal year based on report date
    document.getElementById('report_date').addEventListener('change', function() {
        const date = new Date(this.value);
        const fiscalYearField = document.getElementById('fiscal_year');
        
        if (date && !fiscalYearField.value) {
            const month = date.getMonth();
            const year = date.getFullYear();
            
            // Assuming fiscal year starts in July (month 6)
            if (month >= 6) {
                fiscalYearField.value = `${year}-${(year + 1).toString().substr(2)}`;
            } else {
                fiscalYearField.value = `${year - 1}-${year.toString().substr(2)}`;
            }
        }
    });
});
</script>
@endsection
