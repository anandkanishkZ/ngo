@extends('layouts.app')

@section('title', $project->title . ' | Hope Foundation')
@section('description', Str::limit($project->description, 160))

@push('styles')
<style>
    .project-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 100px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .project-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }
    
    .project-hero .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    
    .breadcrumb-nav {
        margin-bottom: 30px;
    }
    
    .breadcrumb-nav a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .breadcrumb-nav a:hover {
        color: white;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 20px;
        font-size: 0.9rem;
    }
    
    .status-badge.ongoing {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
    }
    
    .status-badge.completed {
        background: linear-gradient(135deg, #2ecc71 0%, #1abc9c 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(46, 204, 113, 0.4);
    }
    
    .project-title {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }
    
    .project-lead {
        font-size: 1.2rem;
        line-height: 1.6;
        opacity: 0.9;
        margin-bottom: 30px;
    }
    
    .hero-stats {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .stat-item {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        display: block;
        margin-bottom: 5px;
        color: #fff;
    }
    
    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .content-section {
        padding: 80px 0;
    }
    
    .project-content {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }
    
    .content-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #f8f9fa;
    }
    
    .content-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .content-text {
        color: #6c757d;
        line-height: 1.8;
        font-size: 1.1rem;
    }
    
    .sidebar-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .sidebar-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    
    .sidebar-title i {
        margin-right: 10px;
        color: var(--accent-color);
    }
    
    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 10px 0;
        border-bottom: 1px solid #f8f9fa;
    }
    
    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
        width: 40%;
        display: flex;
        align-items: center;
    }
    
    .info-label i {
        margin-right: 8px;
        color: var(--accent-color);
        width: 16px;
    }
    
    .info-value {
        color: #6c757d;
        flex: 1;
    }
    
    .progress-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 25px;
        border: 1px solid #dee2e6;
    }
    
    .progress-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .progress-title {
        font-weight: 700;
        color: #495057;
        margin: 0;
    }
    
    .progress-percentage {
        font-size: 1.5rem;
        font-weight: 800;
        color: #4facfe;
    }
    
    .progress {
        height: 12px;
        border-radius: 10px;
        background: white;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }
    
    .progress-bar {
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        border-radius: 10px;
        transition: width 1.5s ease-in-out;
        position: relative;
    }
    
    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
        animation: shimmer 2s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .achievement-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .achievement-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px;
        padding: 15px;
        background: rgba(46, 204, 113, 0.1);
        border-radius: 10px;
        border-left: 4px solid #2ecc71;
    }
    
    .achievement-item i {
        color: #2ecc71;
        margin-right: 12px;
        margin-top: 2px;
        font-size: 1.1rem;
    }
    
    .achievement-text {
        color: #495057;
        line-height: 1.6;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }
    
    .gallery-item {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    
    .gallery-item:hover {
        transform: translateY(-5px);
    }
    
    .gallery-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .partners-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .partner-item {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .partner-item:hover {
        background: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .partner-name {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }
    
    .related-projects {
        background: #f8f9fa;
        padding: 60px 0;
    }
    
    .related-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
    }
    
    .related-image {
        height: 200px;
        overflow: hidden;
    }
    
    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .related-card:hover .related-image img {
        transform: scale(1.1);
    }
    
    .related-content {
        padding: 25px;
    }
    
    .related-category {
        color: var(--accent-color);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }
    
    .related-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 10px;
        line-height: 1.3;
    }
    
    .related-description {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 15px;
    }
    
    .btn-view-project {
        background: var(--secondary-color);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .btn-view-project:hover {
        background: #c0392b;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
    }
    
    .floating-actions {
        position: fixed;
        bottom: 30px;
        right: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 1000;
    }
    
    .floating-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }
    
    .floating-btn:hover {
        transform: scale(1.1);
        color: white;
        text-decoration: none;
    }
    
    .btn-back {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    
    .btn-up {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #c0392b 100%);
    }
    
    .timeline {
        position: relative;
        padding: 20px 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 30px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 70px;
        margin-bottom: 30px;
    }
    
    .timeline-marker {
        position: absolute;
        left: 22px;
        top: 0;
        width: 16px;
        height: 16px;
        background: var(--accent-color);
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px #e9ecef;
    }
    
    .timeline-content {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid var(--accent-color);
    }
    
    .timeline-date {
        font-weight: 600;
        color: var(--accent-color);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    
    .timeline-text {
        color: #6c757d;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Professional Share Buttons Styling - Horizontal Icons */
    .social-share-buttons {
        display: flex;
        flex-direction: row;
        gap: 12px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .share-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: white;
        font-size: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .share-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }
    
    /* Facebook Styling */
    .share-btn-facebook {
        background: linear-gradient(135deg, #1877F2 0%, #1557B7 100%);
    }
    
    .share-btn-facebook:hover {
        background: linear-gradient(135deg, #166FE5 0%, #0E4A9D 100%);
    }
    
    /* Twitter Styling */
    .share-btn-twitter {
        background: linear-gradient(135deg, #1DA1F2 0%, #0C85D0 100%);
    }
    
    .share-btn-twitter:hover {
        background: linear-gradient(135deg, #0D95E8 0%, #0A75BE 100%);
    }
    
    /* LinkedIn Styling */
    .share-btn-linkedin {
        background: linear-gradient(135deg, #0A66C2 0%, #004182 100%);
    }
    
    .share-btn-linkedin:hover {
        background: linear-gradient(135deg, #095DAD 0%, #003870 100%);
    }
    
    /* Copy Link Styling */
    .share-btn-copy {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    }
    
    .share-btn-copy:hover {
        background: linear-gradient(135deg, #5a6268 0%, #3d4349 100%);
    }
    
    /* Success Message */
    #linkCopiedMessage {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        margin-top: 12px;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(46, 204, 113, 0.3);
        animation: slideInUp 0.3s ease-out;
    }
    
    #linkCopiedMessage i {
        margin-right: 8px;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .share-btn {
            padding: 14px 16px;
        }
        
        .share-btn-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
            margin-right: 12px;
        }
        
        .share-btn-label {
            font-size: 14px;
        }
        
        .share-btn-text {
            font-size: 11px;
        }
    }
</style>
@endpush

@section('content')
<!-- Project Hero -->
<section class="project-hero">
    @if($project->featured_image)
        <img src="{{ asset('storage/' . $project->featured_image) }}" 
             alt="{{ $project->title }}" class="hero-background">
    @endif
    
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav" data-aos="fade-up">
            <a href="{{ route('home') }}">Home</a> / 
            <a href="{{ route('projects.' . $project->status) }}">{{ ucfirst($project->status) }} Projects</a> / 
            <span>{{ $project->title }}</span>
        </nav>
        
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="status-badge {{ $project->status }}" data-aos="fade-up">
                    <i class="fas fa-{{ $project->status === 'completed' ? 'check-circle' : 'play-circle' }} me-2"></i>
                    {{ ucfirst($project->status) }} Project
                </div>
                
                @if($project->category)
                    <div class="text-white-50 mb-3" data-aos="fade-up" data-aos-delay="100">
                        <i class="fas fa-tag me-2"></i>{{ ucfirst($project->category) }}
                    </div>
                @endif
                
                <h1 class="project-title" data-aos="fade-up" data-aos-delay="200">
                    {{ $project->title }}
                </h1>
                
                <p class="project-lead" data-aos="fade-up" data-aos-delay="300">
                    {{ $project->description }}
                </p>
            </div>
            
            <div class="col-lg-4">
                <div class="hero-stats" data-aos="fade-left" data-aos-delay="400">
                    <div class="row">
                        @if($project->beneficiaries)
                        <div class="col-6">
                            <div class="stat-item">
                                <span class="stat-number">{{ number_format($project->beneficiaries) }}</span>
                                <span class="stat-label">Beneficiaries</span>
                            </div>
                        </div>
                        @endif
                        
                        @if($project->budget)
                        <div class="col-6">
                            <div class="stat-item">
                                <span class="stat-number">${{ number_format($project->budget / 1000) }}K</span>
                                <span class="stat-label">Investment</span>
                            </div>
                        </div>
                        @endif
                        
                        <div class="col-12">
                            <div class="stat-item">
                                <span class="stat-number">
                                    {{ $project->start_date->diffInMonths($project->end_date ?? now()) }}
                                </span>
                                <span class="stat-label">Months Duration</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content-section">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Project Overview -->
                <div class="project-content" data-aos="fade-up">
                    <div class="content-header">
                        <h2 class="content-title">Project Overview</h2>
                    </div>
                    <div class="content-text">
                        {!! nl2br(e($project->detailed_description ?? $project->description)) !!}
                    </div>
                </div>
                
                <!-- Goals and Objectives -->
                @if($project->goals)
                <div class="project-content" data-aos="fade-up" data-aos-delay="100">
                    <div class="content-header">
                        <h2 class="content-title">Goals & Objectives</h2>
                    </div>
                    <div class="content-text">
                        {!! nl2br(e($project->goals)) !!}
                    </div>
                </div>
                @endif
                
                <!-- Achievements -->
                @if($project->achievements)
                <div class="project-content" data-aos="fade-up" data-aos-delay="200">
                    <div class="content-header">
                        <h2 class="content-title">
                            {{ $project->status === 'completed' ? 'Achievements' : 'Progress So Far' }}
                        </h2>
                    </div>
                    <ul class="achievement-list">
                        @php
                            $achievements = is_array($project->achievements) 
                                ? $project->achievements 
                                : explode("\n", $project->achievements);
                        @endphp
                        @foreach($achievements as $achievement)
                            @if(trim($achievement))
                            <li class="achievement-item">
                                <i class="fas fa-check-circle"></i>
                                <span class="achievement-text">{{ trim($achievement) }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Project Images -->
                @if($project->images)
                <div class="project-content" data-aos="fade-up" data-aos-delay="300">
                    <div class="content-header">
                        <h2 class="content-title">Project Gallery</h2>
                    </div>
                    <div class="gallery-grid">
                        @foreach($project->images as $image)
                        <div class="gallery-item" onclick="openLightbox('{{ asset('storage/' . $image) }}')">
                            <img src="{{ asset('storage/' . $image) }}" alt="Project Image" loading="lazy">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Project Information -->
                <div class="sidebar-card" data-aos="fade-left">
                    <h3 class="sidebar-title">
                        <i class="fas fa-info-circle"></i>
                        Project Information
                    </h3>
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-alt"></i>
                            Start Date
                        </div>
                        <div class="info-value">{{ $project->start_date->format('M d, Y') }}</div>
                    </div>
                    
                    @if($project->end_date)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-calendar-check"></i>
                            End Date
                        </div>
                        <div class="info-value">{{ $project->end_date->format('M d, Y') }}</div>
                    </div>
                    @endif
                    
                    @if($project->location)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Location
                        </div>
                        <div class="info-value">{{ $project->location }}</div>
                    </div>
                    @endif
                    
                    @if($project->category)
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-tag"></i>
                            Category
                        </div>
                        <div class="info-value">{{ ucfirst($project->category) }}</div>
                    </div>
                    @endif
                    
                    <div class="info-item">
                        <div class="info-label">
                            <i class="fas fa-flag"></i>
                            Status
                        </div>
                        <div class="info-value">
                            <span class="badge bg-{{ $project->status_badge }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Funding Progress -->
                @if($project->budget && $project->funds_raised && $project->status === 'ongoing')
                <div class="sidebar-card" data-aos="fade-left" data-aos-delay="100">
                    <h3 class="sidebar-title">
                        <i class="fas fa-chart-line"></i>
                        Funding Progress
                    </h3>
                    
                    <div class="progress-card">
                        <div class="progress-header">
                            <h4 class="progress-title">Funds Raised</h4>
                            <span class="progress-percentage">{{ $project->funding_progress }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" 
                                 style="width: {{ min($project->funding_progress, 100) }}%">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">${{ number_format($project->funds_raised) }} raised</span>
                            <span class="text-muted">${{ number_format($project->budget) }} goal</span>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Partners -->
                @if($project->partners)
                <div class="sidebar-card" data-aos="fade-left" data-aos-delay="200">
                    <h3 class="sidebar-title">
                        <i class="fas fa-handshake"></i>
                        Partners
                    </h3>
                    
                    <div class="partners-grid">
                        @foreach($project->partners as $partner)
                        <div class="partner-item">
                            <div class="partner-name">{{ $partner }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Share Project -->
                <div class="sidebar-card share-card" data-aos="fade-left" data-aos-delay="300">
                    <h3 class="sidebar-title" style="margin-bottom: 1.5rem;">
                        <i class="fas fa-share-nodes" style="color: #3498db;"></i>
                        Share This Project
                    </h3>
                    
                    <div class="social-share-buttons">
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="share-btn share-btn-facebook"
                           title="Share on Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        
                        <!-- Twitter -->
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($project->title) }}" 
                           target="_blank" 
                           class="share-btn share-btn-twitter"
                           title="Share on Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="share-btn share-btn-linkedin"
                           title="Share on LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        
                        <!-- Copy Link -->
                        <button type="button" 
                                class="share-btn share-btn-copy"
                                onclick="copyProjectLink()"
                                title="Copy Link">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                    
                    <div id="linkCopiedMessage" style="display: none; margin-top: 1rem; padding: 0.75rem; background: #d4edda; color: #155724; border-radius: 8px; font-size: 0.875rem; text-align: center;">
                        <i class="fas fa-check-circle me-1"></i> Link copied to clipboard!
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
<section class="related-projects">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title" data-aos="fade-up">Related Projects</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Discover other impactful projects in the {{ $project->category }} sector
            </p>
        </div>
        
        <div class="row g-4">
            @foreach($relatedProjects as $index => $relatedProject)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="related-card">
                    <div class="related-image">
                        @if($relatedProject->featured_image)
                            <img src="{{ asset('storage/' . $relatedProject->featured_image) }}" 
                                 alt="{{ $relatedProject->title }}" loading="lazy">
                        @else
                            <div style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-project-diagram text-white" style="font-size: 2rem; opacity: 0.7;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="related-content">
                        @if($relatedProject->category)
                            <div class="related-category">{{ ucfirst($relatedProject->category) }}</div>
                        @endif
                        <h4 class="related-title">{{ $relatedProject->title }}</h4>
                        <p class="related-description">{{ Str::limit($relatedProject->description, 100) }}</p>
                        <a href="{{ route('projects.show', $relatedProject) }}" class="btn-view-project">
                            View Project
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Floating Actions -->
<div class="floating-actions">
    <a href="javascript:history.back()" class="floating-btn btn-back" title="Go Back">
        <i class="fas fa-arrow-left"></i>
    </a>
    <div class="floating-btn btn-up" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Progress bar animation
    const progressBars = document.querySelectorAll('.progress-bar');
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const progressObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const width = progressBar.style.width;
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.width = width;
                }, 300);
            }
        });
    }, observerOptions);
    
    progressBars.forEach(bar => {
        progressObserver.observe(bar);
    });
    
    // Show/hide floating buttons
    const floatingActions = document.querySelector('.floating-actions');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            floatingActions.style.opacity = '1';
            floatingActions.style.visibility = 'visible';
        } else {
            floatingActions.style.opacity = '0';
            floatingActions.style.visibility = 'hidden';
        }
    });
});

// Simple lightbox function for gallery
function openLightbox(imageSrc) {
    const lightbox = document.createElement('div');
    lightbox.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        cursor: pointer;
    `;
    
    const img = document.createElement('img');
    img.src = imageSrc;
    img.style.cssText = 'max-width: 90%; max-height: 90%; border-radius: 10px;';
    
    lightbox.appendChild(img);
    document.body.appendChild(lightbox);
    
    lightbox.onclick = () => document.body.removeChild(lightbox);
}

// Copy project link to clipboard
function copyProjectLink() {
    const url = window.location.href;
    
    // Try modern clipboard API first
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(url).then(() => {
            showCopyMessage();
        }).catch(() => {
            fallbackCopyLink(url);
        });
    } else {
        fallbackCopyLink(url);
    }
}

// Fallback method for older browsers
function fallbackCopyLink(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-9999px';
    document.body.appendChild(textArea);
    textArea.select();
    
    try {
        document.execCommand('copy');
        showCopyMessage();
    } catch (err) {
        console.error('Failed to copy:', err);
    }
    
    document.body.removeChild(textArea);
}

// Show success message
function showCopyMessage() {
    const message = document.getElementById('linkCopiedMessage');
    message.style.display = 'block';
    
    setTimeout(() => {
        message.style.display = 'none';
    }, 3000);
}
</script>
@endpush
