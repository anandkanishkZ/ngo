@extends('layouts.app')

@section('title', 'Our Projects | Hope Foundation')
@section('description', 'Explore our comprehensive portfolio of ongoing and completed projects making a positive impact in communities worldwide through sustainable development initiatives.')

@push('styles')
<style>
    .projects-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 120px 0 80px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .projects-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 1000,0 1000,80 0,100"/></svg>');
        background-size: cover;
        z-index: 1;
    }
    
    .projects-hero .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-content {
        text-align: center;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 25px;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.3rem;
        line-height: 1.6;
        opacity: 0.9;
        margin-bottom: 40px;
    }
    
    .stats-overview {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        padding: 40px;
        margin-top: 60px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .stat-item {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        display: block;
        margin-bottom: 10px;
        color: #fff;
    }
    
    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .section-tabs {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .tab-navigation {
        display: flex;
        justify-content: center;
        margin-bottom: 60px;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .tab-btn {
        background: white;
        border: 3px solid #e9ecef;
        color: #6c757d;
        padding: 20px 40px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1.1rem;
    }
    
    .tab-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .tab-btn:hover::before {
        left: 100%;
    }
    
    .tab-btn.ongoing.active,
    .tab-btn.ongoing:hover {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border-color: #4facfe;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
    }
    
    .tab-btn.completed.active,
    .tab-btn.completed:hover {
        background: linear-gradient(135deg, #2ecc71 0%, #1abc9c 100%);
        border-color: #2ecc71;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(46, 204, 113, 0.4);
    }
    
    .project-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .project-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
    }
    
    .project-image {
        position: relative;
        height: 280px;
        overflow: hidden;
    }
    
    .project-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .project-card:hover .project-image img {
        transform: scale(1.15);
    }
    
    .project-status {
        position: absolute;
        top: 20px;
        left: 20px;
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        z-index: 2;
    }
    
    .project-status.ongoing {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
    }
    
    .project-status.completed {
        background: linear-gradient(135deg, #2ecc71 0%, #1abc9c 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(46, 204, 113, 0.4);
    }
    
    .project-featured {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 193, 7, 0.9);
        color: white;
        padding: 8px;
        border-radius: 50%;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
        z-index: 2;
    }
    
    .project-content {
        padding: 35px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .project-category {
        color: var(--accent-color);
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }
    
    .project-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #2c3e50;
        margin-bottom: 18px;
        line-height: 1.3;
    }
    
    .project-description {
        color: #6c757d;
        line-height: 1.7;
        margin-bottom: 25px;
        flex-grow: 1;
        font-size: 1rem;
    }
    
    .project-meta {
        margin-bottom: 25px;
        padding-top: 20px;
        border-top: 1px solid #f8f9fa;
    }
    
    .meta-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .meta-item i {
        margin-right: 8px;
        color: var(--accent-color);
        width: 16px;
    }
    
    .progress-section {
        margin-bottom: 25px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.9rem;
        font-weight: 700;
    }
    
    .progress {
        height: 10px;
        border-radius: 15px;
        background: #f8f9fa;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar {
        border-radius: 15px;
        transition: width 1.5s ease-in-out;
        position: relative;
    }
    
    .progress-bar.ongoing {
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .progress-bar.completed {
        background: linear-gradient(90deg, #2ecc71 0%, #1abc9c 100%);
    }
    
    .btn-learn-more {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #c0392b 100%);
        color: white;
        border: none;
        padding: 15px 35px;
        border-radius: 30px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }
    
    .btn-learn-more:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(231, 76, 60, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-learn-more i {
        margin-left: 10px;
        transition: transform 0.3s ease;
    }
    
    .btn-learn-more:hover i {
        transform: translateX(5px);
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        justify-content: center;
    }
    
    .btn-view-all {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 18px 40px;
        border-radius: 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1rem;
    }
    
    .btn-view-all:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-view-all i {
        margin-left: 10px;
        transition: transform 0.3s ease;
    }
    
    .btn-view-all:hover i {
        transform: translateX(5px);
    }
    
    .impact-section {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        padding: 100px 0;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .impact-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><circle cx="100" cy="50" r="40"/><circle cx="300" cy="30" r="20"/><circle cx="500" cy="70" r="30"/><circle cx="700" cy="40" r="25"/><circle cx="900" cy="60" r="35"/></svg>');
        background-size: cover;
        animation: float 20s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateX(0) translateY(0); }
        50% { transform: translateX(20px) translateY(-10px); }
    }
    
    .impact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-top: 60px;
    }
    
    .impact-item {
        text-align: center;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 40px 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease;
    }
    
    .impact-item:hover {
        transform: translateY(-5px);
    }
    
    .impact-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        opacity: 0.9;
    }
    
    .impact-number {
        font-size: 2.5rem;
        font-weight: 800;
        display: block;
        margin-bottom: 10px;
    }
    
    .impact-label {
        font-size: 1.1rem;
        opacity: 0.9;
        line-height: 1.4;
    }
    
    .empty-state {
        text-align: center;
        padding: 100px 20px;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 5rem;
        margin-bottom: 30px;
        opacity: 0.5;
    }
    
    .empty-state h3 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #495057;
    }
    
    .floating-action {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, var(--accent-color) 0%, #e67e22 100%);
        color: white;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(243, 156, 18, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1000;
        font-size: 1.5rem;
    }
    
    .floating-action:hover {
        transform: scale(1.15);
        box-shadow: 0 15px 40px rgba(243, 156, 18, 0.5);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="projects-hero">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1 class="hero-title">Our Projects</h1>
            <p class="hero-subtitle">
                Discover our comprehensive portfolio of initiatives creating lasting positive change in communities worldwide. From ongoing projects actively transforming lives to completed success stories that showcase our impact.
            </p>
        </div>
        
        <div class="stats-overview" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalOngoing }}</span>
                        <span class="stat-label">Ongoing Projects</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">{{ $totalCompleted }}</span>
                        <span class="stat-label">Completed Projects</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">
                            @if($totalBeneficiaries > 1000)
                                {{ number_format($totalBeneficiaries / 1000, 1) }}K
                            @else
                                {{ number_format($totalBeneficiaries) }}
                            @endif
                        </span>
                        <span class="stat-label">Lives Impacted</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">
                            ${{ number_format($totalFundsRaised / 1000) }}K
                        </span>
                        <span class="stat-label">Funds Raised</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Project Sections -->
<section class="section-tabs">
    <div class="container">
        <!-- Tab Navigation -->
        <div class="tab-navigation" data-aos="fade-up">
            <a href="#ongoing" class="tab-btn ongoing active" onclick="showTab('ongoing')">
                <i class="fas fa-play-circle me-2"></i>
                Ongoing Projects
            </a>
            <a href="#completed" class="tab-btn completed" onclick="showTab('completed')">
                <i class="fas fa-check-circle me-2"></i>
                Completed Projects
            </a>
        </div>
        
        <!-- Ongoing Projects Tab -->
        <div id="ongoing-tab" class="tab-content active">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title" style="font-size: 2.5rem; font-weight: 800; color: #2c3e50; margin-bottom: 20px;">
                    Active Initiatives
                </h2>
                <p class="section-subtitle" style="font-size: 1.1rem; color: #6c757d; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                    Projects currently making a difference and actively transforming communities
                </p>
            </div>
            
            @if($ongoingProjects->count() > 0)
                <div class="row g-4 mb-5">
                    @foreach($ongoingProjects as $index => $project)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="project-card">
                            <div class="project-image">
                                @if($project->featured_image)
                                    <img src="{{ asset('storage/' . $project->featured_image) }}" 
                                         alt="{{ $project->title }}" loading="lazy">
                                @else
                                    <div style="height: 280px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-project-diagram text-white" style="font-size: 3.5rem; opacity: 0.7;"></i>
                                    </div>
                                @endif
                                <div class="project-status ongoing">
                                    <i class="fas fa-play-circle me-1"></i>
                                    Ongoing
                                </div>
                                @if($project->is_featured)
                                    <div class="project-featured">
                                        <i class="fas fa-star"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="project-content">
                                @if($project->category)
                                    <div class="project-category">{{ ucfirst($project->category) }}</div>
                                @endif
                                
                                <h3 class="project-title">{{ $project->title }}</h3>
                                <p class="project-description">{{ Str::limit($project->description, 140) }}</p>
                                
                                <div class="project-meta">
                                    <div class="meta-row">
                                        @if($project->location)
                                            <div class="meta-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $project->location }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($project->beneficiaries)
                                            <div class="meta-item">
                                                <i class="fas fa-users"></i>
                                                <span>{{ number_format($project->beneficiaries) }} people</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="meta-row">
                                        <div class="meta-item">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>Started {{ $project->start_date->format('M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($project->budget && $project->funds_raised)
                                    <div class="progress-section">
                                        <div class="progress-label">
                                            <span>Funding Progress</span>
                                            <span>{{ $project->funding_progress }}%</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar ongoing" 
                                                 style="width: {{ min($project->funding_progress, 100) }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <a href="{{ route('projects.show', $project) }}" class="btn-learn-more">
                                    Learn More
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="action-buttons" data-aos="fade-up">
                    <a href="{{ route('projects.ongoing') }}" class="btn-view-all">
                        View All Ongoing Projects
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-project-diagram"></i>
                    <h3>No Ongoing Projects</h3>
                    <p>We're currently preparing new initiatives. Check back soon for exciting projects!</p>
                </div>
            @endif
        </div>
        
        <!-- Completed Projects Tab -->
        <div id="completed-tab" class="tab-content">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title" style="font-size: 2.5rem; font-weight: 800; color: #2c3e50; margin-bottom: 20px;">
                    Success Stories
                </h2>
                <p class="section-subtitle" style="font-size: 1.1rem; color: #6c757d; max-width: 600px; margin: 0 auto; line-height: 1.6;">
                    Celebrating our successfully completed projects and their lasting impact
                </p>
            </div>
            
            @if($completedProjects->count() > 0)
                <div class="row g-4 mb-5">
                    @foreach($completedProjects as $index => $project)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="project-card">
                            <div class="project-image">
                                @if($project->featured_image)
                                    <img src="{{ asset('storage/' . $project->featured_image) }}" 
                                         alt="{{ $project->title }}" loading="lazy">
                                @else
                                    <div style="height: 280px; background: linear-gradient(135deg, #2ecc71 0%, #1abc9c 100%); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-check-circle text-white" style="font-size: 3.5rem; opacity: 0.7;"></i>
                                    </div>
                                @endif
                                <div class="project-status completed">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Completed
                                </div>
                                @if($project->is_featured)
                                    <div class="project-featured">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="project-content">
                                @if($project->category)
                                    <div class="project-category">{{ ucfirst($project->category) }}</div>
                                @endif
                                
                                <h3 class="project-title">{{ $project->title }}</h3>
                                <p class="project-description">{{ Str::limit($project->description, 140) }}</p>
                                
                                <div class="project-meta">
                                    <div class="meta-row">
                                        @if($project->location)
                                            <div class="meta-item">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>{{ $project->location }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($project->beneficiaries)
                                            <div class="meta-item">
                                                <i class="fas fa-users"></i>
                                                <span>{{ number_format($project->beneficiaries) }} people</span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="meta-row">
                                        <div class="meta-item">
                                            <i class="fas fa-calendar-check"></i>
                                            <span>Completed {{ $project->end_date ? $project->end_date->format('M Y') : 'Recently' }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($project->budget)
                                    <div class="progress-section">
                                        <div class="progress-label">
                                            <span>Project Investment</span>
                                            <span>${{ number_format($project->budget) }}</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar completed" style="width: 100%"></div>
                                        </div>
                                    </div>
                                @endif
                                
                                <a href="{{ route('projects.show', $project) }}" class="btn-learn-more">
                                    View Success Story
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="action-buttons" data-aos="fade-up">
                    <a href="{{ route('projects.completed') }}" class="btn-view-all">
                        View All Completed Projects
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-check-circle"></i>
                    <h3>No Completed Projects</h3>
                    <p>We're working hard to complete our ongoing initiatives. Check back soon for success stories!</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Impact Overview -->
<section class="impact-section">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h2 style="font-size: 3rem; font-weight: 800; margin-bottom: 20px;">Our Collective Impact</h2>
            <p style="font-size: 1.2rem; opacity: 0.9; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                Through our comprehensive project portfolio, we've created meaningful change across multiple sectors and communities worldwide.
            </p>
        </div>
        
        <div class="impact-grid">
            <div class="impact-item" data-aos="fade-up" data-aos-delay="100">
                <div class="impact-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span class="impact-number">
                    {{ number_format($totalBeneficiaries * 0.4) }}+
                </span>
                <div class="impact-label">
                    Students Educated & Empowered
                </div>
            </div>
            
            <div class="impact-item" data-aos="fade-up" data-aos-delay="200">
                <div class="impact-icon">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <span class="impact-number">
                    {{ number_format($totalBeneficiaries * 0.3) }}+
                </span>
                <div class="impact-label">
                    Healthcare Services Provided
                </div>
            </div>
            
            <div class="impact-item" data-aos="fade-up" data-aos-delay="300">
                <div class="impact-icon">
                    <i class="fas fa-home"></i>
                </div>
                <span class="impact-number">
                    {{ number_format($totalBeneficiaries * 0.2) }}+
                </span>
                <div class="impact-label">
                    Families Supported
                </div>
            </div>
            
            <div class="impact-item" data-aos="fade-up" data-aos-delay="400">
                <div class="impact-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <span class="impact-number">
                    {{ number_format($totalBeneficiaries * 0.1) }}+
                </span>
                <div class="impact-label">
                    Environmental Initiatives
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating Action Button -->
<div class="floating-action" onclick="window.scrollTo({top: 0, behavior: 'smooth'})" title="Back to top">
    <i class="fas fa-arrow-up"></i>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    window.showTab = function(tabName) {
        // Remove active class from all tabs and buttons
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.remove('active');
        });
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Add active class to selected tab and button
        document.getElementById(tabName + '-tab').classList.add('active');
        document.querySelector('.tab-btn.' + tabName).classList.add('active');
    };
    
    // Progress bar animation on scroll
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
                }, 200);
            }
        });
    }, observerOptions);
    
    progressBars.forEach(bar => {
        progressObserver.observe(bar);
    });
    
    // Show/hide floating action button
    const floatingAction = document.querySelector('.floating-action');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            floatingAction.style.opacity = '1';
            floatingAction.style.visibility = 'visible';
        } else {
            floatingAction.style.opacity = '0';
            floatingAction.style.visibility = 'hidden';
        }
    });
    
    // Smooth scrolling for tab links
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('href').substring(1);
            showTab(target);
            
            // Smooth scroll to section
            document.querySelector('.section-tabs').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
    
    // Add stagger animation to project cards
    const cards = document.querySelectorAll('.project-card');
    const cardObserver = new IntersectionObserver(function(entries) {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                }, index * 100);
            }
        });
    }, { threshold: 0.1 });
    
    cards.forEach(card => {
        cardObserver.observe(card);
    });
});

// CSS animations
const style = document.createElement('style');
style.textContent = `
    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease-in-out;
    }
    
    .tab-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeInUp {
        from { 
            opacity: 0; 
            transform: translateY(30px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }
`;
document.head.appendChild(style);
</script>
@endpush
