@extends('layouts.app')

@section('title', $report->title . ' | JIDS Nepal')
@section('description', Str::limit($report->description, 160))

@section('content')
<div class="report-detail-page">
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($report->title, 50) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Report Header -->
    <section class="report-header-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="report-header">
                        @if($report->is_featured)
                        <div class="featured-badge mb-3">
                            <i class="fas fa-star me-1"></i> Featured Report
                        </div>
                        @endif
                        
                        <div class="report-meta mb-3">
                            <span class="report-type-badge">{{ $report->formatted_type }}</span>
                            @if($report->category)
                            <span class="report-category-badge">{{ $report->category }}</span>
                            @endif
                        </div>
                        
                        <h1 class="report-title">{{ $report->title }}</h1>
                        
                        <div class="report-info mt-4">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="info-item">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        <strong>Report Date:</strong> {{ $report->report_date->format('F j, Y') }}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-item">
                                        <i class="fas fa-user text-primary me-2"></i>
                                        <strong>Author:</strong> {{ $report->author }}
                                    </div>
                                </div>
                                @if($report->fiscal_year)
                                <div class="col-sm-6">
                                    <div class="info-item">
                                        <i class="fas fa-chart-line text-primary me-2"></i>
                                        <strong>Fiscal Year:</strong> {{ $report->fiscal_year }}
                                    </div>
                                </div>
                                @endif
                                @if($report->pdf_file)
                                <div class="col-sm-6">
                                    <div class="info-item">
                                        <i class="fas fa-download text-primary me-2"></i>
                                        <strong>Downloads:</strong> {{ $report->download_count }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        @if($report->pdf_file)
                        <div class="report-actions mt-4">
                            <a href="{{ route('reports.download', $report) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-download me-2"></i> Download PDF Report
                            </a>
                            <button class="btn btn-outline-secondary btn-lg" onclick="openPreview()">
                                <i class="fas fa-eye me-2"></i> Preview
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Report Content -->
    <section class="report-content-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="report-content">
                        @if($report->cover_image)
                        <div class="report-cover-image mb-4">
                            <img src="{{ $report->cover_image_url }}" alt="{{ $report->title }}" class="img-fluid rounded">
                        </div>
                        @endif
                        
                        <div class="report-description">
                            <h3 class="content-title">About This Report</h3>
                            <div class="content-text">
                                {!! nl2br(e($report->description)) !!}
                            </div>
                        </div>
                        
                        @if($report->content)
                        <div class="report-full-content mt-5">
                            <h3 class="content-title">Report Content</h3>
                            <div class="content-text">
                                {!! $report->content !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($report->executive_summary)
                        <div class="executive-summary mt-5">
                            <h3 class="content-title">Executive Summary</h3>
                            <div class="content-text">
                                {!! nl2br(e($report->executive_summary)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($report->key_findings)
                        <div class="key-findings mt-5">
                            <h3 class="content-title">Key Findings</h3>
                            <div class="content-text">
                                {!! nl2br(e($report->key_findings)) !!}
                            </div>
                        </div>
                        @endif
                        
                        @if($report->recommendations)
                        <div class="recommendations mt-5">
                            <h3 class="content-title">Recommendations</h3>
                            <div class="content-text">
                                {!! nl2br(e($report->recommendations)) !!}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="report-sidebar">
                        <!-- Quick Info -->
                        <div class="sidebar-widget">
                            <h4 class="widget-title">Report Information</h4>
                            <div class="widget-content">
                                <div class="info-list">
                                    <div class="info-item">
                                        <strong>Type:</strong> {{ $report->formatted_type }}
                                    </div>
                                    @if($report->category)
                                    <div class="info-item">
                                        <strong>Category:</strong> {{ $report->category }}
                                    </div>
                                    @endif
                                    <div class="info-item">
                                        <strong>Published:</strong> {{ $report->report_date->format('M j, Y') }}
                                    </div>
                                    <div class="info-item">
                                        <strong>Author:</strong> {{ $report->author }}
                                    </div>
                                    @if($report->fiscal_year)
                                    <div class="info-item">
                                        <strong>Fiscal Year:</strong> {{ $report->fiscal_year }}
                                    </div>
                                    @endif
                                    @if($report->pdf_file)
                                    <div class="info-item">
                                        <strong>Format:</strong> PDF Document
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @if($report->pdf_file)
                        <!-- Download Widget -->
                        <div class="sidebar-widget">
                            <h4 class="widget-title">Download</h4>
                            <div class="widget-content">
                                <a href="{{ route('reports.download', $report) }}" class="btn btn-primary w-100 mb-3">
                                    <i class="fas fa-download me-2"></i> Download PDF
                                </a>
                                <p class="download-info">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Downloaded {{ $report->download_count }} times
                                    </small>
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Related Reports -->
                        @if($relatedReports->isNotEmpty())
                        <div class="sidebar-widget">
                            <h4 class="widget-title">Related Reports</h4>
                            <div class="widget-content">
                                @foreach($relatedReports as $relatedReport)
                                <div class="related-report-item">
                                    <h6 class="related-title">
                                        <a href="{{ route('reports.show', $relatedReport) }}">
                                            {{ $relatedReport->title }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">{{ $relatedReport->report_date->format('M Y') }}</small>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Share Widget -->
                        <div class="sidebar-widget">
                            <h4 class="widget-title">Share Report</h4>
                            <div class="widget-content">
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                       target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-facebook-f me-1"></i> Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($report->title) }}" 
                                       target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="fab fa-twitter me-1"></i> Twitter
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                                       target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin-in me-1"></i> LinkedIn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PDF Preview Modal -->
    @if($report->pdf_file)
    <div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $report->title }} - Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <iframe src="{{ $report->pdf_url }}#toolbar=1&navpanes=0&scrollbar=1" 
                            width="100%" height="600" frameborder="0">
                        <p>Your browser does not support iframes. 
                           <a href="{{ route('reports.download', $report) }}">Download the PDF</a> instead.
                        </p>
                    </iframe>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('reports.download', $report) }}" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i> Download Full PDF
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
/* Report Detail Page Styles */
.report-detail-page {
    background: #f8f9fa;
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: #667eea;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.report-header-section {
    background: white;
}

.featured-badge {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(45deg, #ffd700, #ffed4e);
    color: #333;
    padding: 8px 16px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.9rem;
}

.report-meta {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.report-type-badge {
    background: #667eea;
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.report-category-badge {
    background: #28a745;
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.report-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    line-height: 1.2;
    margin: 20px 0;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.report-actions {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.report-content {
    background: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.report-cover-image img {
    max-height: 400px;
    width: 100%;
    object-fit: cover;
}

.content-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #667eea;
}

.content-text {
    line-height: 1.8;
    color: #555;
    font-size: 1.05rem;
}

.report-sidebar {
    position: sticky;
    top: 20px;
}

.sidebar-widget {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.widget-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.info-list .info-item {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
    margin-bottom: 0;
}

.info-list .info-item:last-child {
    border-bottom: none;
}

.related-report-item {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.related-report-item:last-child {
    border-bottom: none;
}

.related-title a {
    color: #333;
    text-decoration: none;
    font-size: 0.95rem;
}

.related-title a:hover {
    color: #667eea;
}

.share-buttons {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.download-info {
    margin: 0;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .report-title {
        font-size: 2rem;
    }
    
    .report-content {
        padding: 25px;
    }
    
    .report-actions {
        justify-content: center;
    }
    
    .report-meta {
        justify-content: center;
    }
}
</style>

<script>
function openPreview() {
    var modal = new bootstrap.Modal(document.getElementById('pdfPreviewModal'));
    modal.show();
}
</script>
@endsection
