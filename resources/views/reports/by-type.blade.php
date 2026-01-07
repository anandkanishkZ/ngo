@extends('layouts.app')

@section('title', ucfirst($type) . ' Reports | JIDS Nepal')
@section('description', 'Browse our ' . strtolower($type) . ' reports including detailed documentation and analysis from JIDS Nepal.')

@section('content')
<div class="reports-by-type-page">
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('reports.index') }}">Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($type) }} Reports</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Page Header -->
    <section class="page-header-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="page-header">
                        <h1 class="page-title">
                            {{ ucfirst($type) }} <span class="text-gradient">Reports</span>
                        </h1>
                        <p class="page-subtitle">
                            @switch($type)
                                @case('annual')
                                    Comprehensive annual reports showcasing our yearly achievements, financial performance, and impact across all programs.
                                    @break
                                @case('financial')
                                    Detailed financial statements, audited reports, and transparency documents showing how we manage and utilize funds.
                                    @break
                                @case('impact')
                                    In-depth analysis of our programs' effectiveness, beneficiary outcomes, and long-term community impact.
                                    @break
                                @case('project')
                                    Specific project documentation, progress reports, and outcomes from our various initiatives and programs.
                                    @break
                                @case('research')
                                    Research studies, policy papers, and analytical reports that inform our work and contribute to sector knowledge.
                                    @break
                                @case('governance')
                                    Board reports, governance documents, and institutional policies that guide our organizational operations.
                                    @break
                                @default
                                    Explore our collection of {{ strtolower($type) }} reports with detailed insights and documentation.
                            @endswitch
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="page-stats">
                        <div class="stat-item">
                            <div class="stat-number">{{ $reports->total() }}</div>
                            <div class="stat-label">{{ ucfirst($type) }} Reports</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters-section py-4 bg-white border-bottom">
        <div class="container">
            <form method="GET" action="{{ route('reports.by-type', $type) }}" class="filter-form">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label">Search {{ ucfirst($type) }} Reports</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search {{ strtolower($type) }} reports..." 
                               value="{{ request('search') }}">
                    </div>
                    @if($categories->isNotEmpty())
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
                    @endif
                    @if($fiscalYears->isNotEmpty())
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
                    @endif
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">Sort By</label>
                        <select name="sort" class="form-select">
                            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title A-Z</option>
                            <option value="downloads" {{ request('sort') === 'downloads' ? 'selected' : '' }}>Most Downloaded</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="filter-buttons">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('reports.by-type', $type) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-1"></i> Clear
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Reports Grid -->
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
                                    @if($report->fiscal_year)
                                    <span class="fiscal-year">
                                        <i class="fas fa-chart-line me-1"></i>
                                        FY {{ $report->fiscal_year }}
                                    </span>
                                    @endif
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
                                
                                <div class="report-info">
                                    <div class="author">
                                        <i class="fas fa-user me-1"></i>
                                        <span>{{ $report->author }}</span>
                                    </div>
                                    @if($report->pdf_file)
                                    <div class="downloads">
                                        <i class="fas fa-download me-1"></i>
                                        <span>{{ $report->download_count }} downloads</span>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="report-actions">
                                    <a href="{{ route('reports.show', $report) }}" class="btn btn-primary">
                                        <i class="fas fa-eye me-1"></i> View Report
                                    </a>
                                    @if($report->pdf_file)
                                    <a href="{{ route('reports.download', $report) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-download me-1"></i> Download
                                    </a>
                                    @endif
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
                    <h3 class="empty-title">No {{ ucfirst($type) }} Reports Found</h3>
                    <p class="empty-text">
                        @if(request()->anyFilled(['search', 'category', 'fiscal_year']))
                            No {{ strtolower($type) }} reports match your current filters. Try adjusting your search criteria.
                        @else
                            We're working on publishing our {{ strtolower($type) }} reports. Please check back soon.
                        @endif
                    </p>
                    <div class="empty-actions">
                        @if(request()->anyFilled(['search', 'category', 'fiscal_year']))
                        <a href="{{ route('reports.by-type', $type) }}" class="btn btn-primary me-3">
                            <i class="fas fa-undo me-1"></i> View All {{ ucfirst($type) }} Reports
                        </a>
                        @endif
                        <a href="{{ route('reports.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-1"></i> Browse All Reports
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Type Information Section -->
    <section class="type-info-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="type-info">
                        <h3 class="info-title">About {{ ucfirst($type) }} Reports</h3>
                        <p class="info-description">
                            @switch($type)
                                @case('annual')
                                    Our annual reports provide a comprehensive overview of JIDS Nepal's activities, achievements, and financial performance throughout the fiscal year. These reports demonstrate our commitment to transparency and accountability to our stakeholders.
                                    @break
                                @case('financial')
                                    Financial transparency is crucial to our mission. Our financial reports include audited statements, budget allocations, and detailed breakdowns of how donations and grants are utilized to maximize impact in our communities.
                                    @break
                                @case('impact')
                                    Impact reports showcase the real-world changes our programs create in communities. Through data analysis, beneficiary stories, and outcome measurements, these reports demonstrate the effectiveness of our interventions.
                                    @break
                                @case('project')
                                    Project reports provide detailed documentation of specific initiatives, including objectives, methodologies, outcomes, and lessons learned. These reports help us improve future programs and share knowledge with partners.
                                    @break
                                @case('research')
                                    Our research reports contribute to the broader development sector knowledge base. These studies inform policy decisions, improve program design, and advance understanding of effective development practices.
                                    @break
                                @case('governance')
                                    Governance reports outline our organizational structure, policies, and decision-making processes. These documents ensure transparency in our institutional management and demonstrate our commitment to good governance practices.
                                    @break
                                @default
                                    These reports provide valuable insights into our work and demonstrate our commitment to transparency, accountability, and continuous improvement in all our activities.
                            @endswitch
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Reports By Type Page Styles */
.reports-by-type-page {
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

.page-header-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.text-gradient {
    background: linear-gradient(45deg, #ffd700, #ffed4e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 0;
}

.page-stats {
    display: flex;
    justify-content: flex-end;
}

.stat-item {
    text-align: center;
    background: rgba(255,255,255,0.1);
    padding: 20px;
    border-radius: 10px;
    backdrop-filter: blur(10px);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-top: 5px;
}

.filters-section {
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.filter-form {
    padding: 20px;
    background: white;
    border-radius: 10px;
}

.filter-buttons {
    display: flex;
    gap: 10px;
}

/* Report Cards */
.report-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.report-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
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

.report-card:hover .report-image img {
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
    flex: 1;
    display: flex;
    flex-direction: column;
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
    flex: 1;
}

.report-category {
    display: inline-block;
    background: #e9ecef;
    color: #495057;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    margin-bottom: 15px;
}

.report-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 0.85rem;
    color: #666;
}

.report-actions {
    display: flex;
    gap: 10px;
    margin-top: auto;
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
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.empty-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Type Info Section */
.type-info-section {
    border-top: 1px solid #dee2e6;
}

.info-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 20px;
}

.info-description {
    color: #666;
    line-height: 1.7;
    font-size: 1.05rem;
}

/* Responsive */
@media (max-width: 768px) {
    .page-title {
        font-size: 2.2rem;
    }
    
    .page-subtitle {
        font-size: 1rem;
    }
    
    .page-stats {
        justify-content: center;
        margin-top: 20px;
    }
    
    .filter-buttons {
        justify-content: center;
    }
    
    .empty-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .report-actions {
        justify-content: center;
    }
}
</style>
@endsection
