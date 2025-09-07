@extends('layouts.app')

@section('title', 'Reports | JIDS Nepal')
@section('description', 'Access our comprehensive reports including annual reports, financial statements, impact assessments, and project documentation from JIDS Nepal.')

@section('content')
<div class="reports-page">
    <!-- Hero Section -->
    <section class="reports-hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-60">
                <div class="col-lg-10 mx-auto text-center">
                    <div class="hero-content">
                        <h1 class="hero-title mb-4">
                            Our <span class="text-gradient">Reports</span> & Documentation
                        </h1>
                        <p class="hero-subtitle mb-5">
                            Transparent documentation of our work, impact, and financial accountability. Access our annual reports, project documentation, and impact assessments.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Reports Section -->
    @if($featuredReports->isNotEmpty())
    <section class="featured-reports-section py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Featured Reports</h2>
                <p class="section-subtitle">Our most important and recent publications</p>
            </div>
            
            <div class="row g-4">
                @foreach($featuredReports as $report)
                <div class="col-lg-4 col-md-6">
                    <div class="featured-report-card">
                        <div class="report-image">
                            <img src="{{ $report->cover_image_url }}" alt="{{ $report->title }}">
                            <div class="report-overlay">
                                <span class="report-type-badge">{{ $report->formatted_type }}</span>
                                <div class="featured-label">
                                    <i class="fas fa-star"></i> Featured
                                </div>
                            </div>
                        </div>
                        <div class="report-content">
                            <div class="report-meta">
                                <span class="report-date">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $report->report_date->format('M Y') }}
                                </span>
                                @if($report->pdf_file)
                                <span class="download-count">
                                    <i class="fas fa-download me-1"></i>
                                    {{ $report->download_count }} downloads
                                </span>
                                @endif
                            </div>
                            <h3 class="report-title">{{ $report->title }}</h3>
                            <p class="report-description">{{ Str::limit($report->description, 120) }}</p>
                            <div class="report-actions">
                                <a href="{{ route('reports.show', $report) }}" class="btn btn-primary">
                                    <i class="fas fa-eye me-1"></i> View Report
                                </a>
                                @if($report->pdf_file)
                                <a href="{{ route('reports.download', $report) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-download me-1"></i> Download PDF
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Filters and Search Section -->
    <section class="reports-filters-section py-4 border-bottom">
        <div class="container">
            <form method="GET" action="{{ route('reports.index') }}" class="reports-filter-form">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Search Reports</label>
                        <input type="text" name="search" class="form-control" placeholder="Search reports..." value="{{ request('search') }}">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="">All Types</option>
                            @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                {{ ucfirst($category) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">Fiscal Year</label>
                        <select name="fiscal_year" class="form-select">
                            <option value="">All Years</option>
                            @foreach($fiscalYears as $year)
                            <option value="{{ $year }}" {{ request('fiscal_year') === $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="filter-buttons">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i> Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Reports Grid Section -->
    <section class="reports-grid-section py-5">
        <div class="container">
            @if($reports->isNotEmpty())
                <div class="row g-4">
                    @foreach($reports as $report)
                    <div class="col-lg-4 col-md-6">
                        <div class="report-card">
                            <div class="report-image">
                                <img src="{{ $report->cover_image_url }}" alt="{{ $report->title }}">
                                <div class="report-overlay">
                                    <span class="report-type-badge">{{ $report->formatted_type }}</span>
                                    @if($report->is_featured)
                                    <div class="featured-label">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="report-content">
                                <div class="report-meta">
                                    <span class="report-date">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $report->report_date->format('M j, Y') }}
                                    </span>
                                    <span class="report-author">
                                        <i class="fas fa-user me-1"></i>
                                        {{ $report->author }}
                                    </span>
                                </div>
                                <h3 class="report-title">
                                    <a href="{{ route('reports.show', $report) }}">{{ $report->title }}</a>
                                </h3>
                                <p class="report-description">{{ Str::limit($report->description, 100) }}</p>
                                @if($report->category)
                                <span class="report-category">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $report->category }}
                                </span>
                                @endif
                                <div class="report-actions mt-3">
                                    <a href="{{ route('reports.show', $report) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                    @if($report->pdf_file)
                                    <a href="{{ route('reports.download', $report) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-download me-1"></i> PDF
                                    </a>
                                    @endif
                                    <small class="text-muted ms-2">
                                        {{ $report->download_count }} downloads
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($reports->hasPages())
                <div class="pagination-wrapper mt-5">
                    {{ $reports->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
                @endif
            @else
                <div class="empty-state text-center py-5">
                    <div class="empty-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="empty-title">No Reports Found</h3>
                    <p class="empty-text">
                        @if(request()->anyFilled(['search', 'type', 'category', 'fiscal_year']))
                            No reports match your current filters. Try adjusting your search criteria.
                        @else
                            We're working on publishing our reports. Please check back soon.
                        @endif
                    </p>
                    @if(request()->anyFilled(['search', 'type', 'category', 'fiscal_year']))
                    <a href="{{ route('reports.index') }}" class="btn btn-primary">
                        <i class="fas fa-undo me-1"></i> View All Reports
                    </a>
                    @endif
                </div>
            @endif
        </div>
    </section>
</div>

<style>
/* Reports Page Styles */
.reports-page {
    background: #f8f9fa;
}

.reports-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
}

.text-gradient {
    background: linear-gradient(45deg, #ffd700, #ffed4e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
}

.hero-subtitle {
    font-size: 1.2rem;
    line-height: 1.6;
    max-width: 800px;
    margin: 0 auto;
}

/* Featured Reports */
.featured-report-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.featured-report-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.report-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.report-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.featured-report-card:hover .report-image img {
    transform: scale(1.05);
}

.report-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 15px;
}

.report-type-badge {
    background: rgba(255,255,255,0.9);
    color: #333;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.featured-label {
    background: linear-gradient(45deg, #ffd700, #ffed4e);
    color: #333;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.report-content {
    padding: 20px;
}

.report-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 0.85rem;
    color: #666;
}

.report-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.4;
}

.report-title a {
    color: #333;
    text-decoration: none;
}

.report-title a:hover {
    color: #667eea;
}

.report-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
}

.report-actions {
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
}

/* Regular Report Cards */
.report-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.report-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.report-card .report-image {
    height: 180px;
}

.report-card .report-content {
    padding: 15px;
}

.report-category {
    display: inline-block;
    background: #e9ecef;
    color: #495057;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    margin-bottom: 10px;
}

/* Filters */
.reports-filter-form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.filter-buttons {
    display: flex;
    gap: 10px;
}

/* Empty State */
.empty-state {
    padding: 60px 20px;
}

.empty-icon {
    font-size: 4rem;
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
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .filter-buttons {
        justify-content: center;
    }
}
</style>
@endsection
