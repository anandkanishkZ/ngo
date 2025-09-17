@extends('layouts.app')

@section('title', 'Ongoing Projects | Hope Foundation')
@section('description', 'Explore our current initiatives and ongoing projects that are actively creating positive change in communities worldwide.')

@push('styles')
<style>
    .projects-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 80px 0;
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
        background: url('/images/projects-pattern.png') repeat;
        opacity: 0.1;
        z-index: 1;
    }
    
    .projects-hero .container {
        position: relative;
        z-index: 2;
    }
    
    .hero-stats {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        margin-top: 40px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .stat-item {
        text-align: center;
        margin-bottom: 20px;
    }
    
    .stat-number {
        font-size: 2.5rem;
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
    
    .project-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }
    
    .project-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }
    
    .project-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .project-card:hover .project-image img {
        transform: scale(1.1);
    }
    
    .project-status {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
    }
    
    .project-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .project-category {
        color: var(--accent-color);
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }
    
    .project-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 15px;
        line-height: 1.3;
    }
    
    .project-description {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 20px;
        flex-grow: 1;
    }
    
    .project-meta {
        margin-bottom: 20px;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .meta-item i {
        width: 20px;
        color: var(--accent-color);
        margin-right: 10px;
    }
    
    .progress-section {
        margin-bottom: 25px;
    }
    
    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .progress {
        height: 8px;
        border-radius: 10px;
        background: #f8f9fa;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .progress-bar {
        background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
        border-radius: 10px;
        transition: width 1s ease-in-out;
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
    
    .project-footer {
        padding: 0 30px 30px;
    }
    
    .btn-learn-more {
        background: linear-gradient(135deg, var(--secondary-color) 0%, #c0392b 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }
    
    .btn-learn-more:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-learn-more i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }
    
    .btn-learn-more:hover i {
        transform: translateX(3px);
    }
    
    .featured-section {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        padding: 80px 0;
        margin-bottom: 80px;
        color: white;
        position: relative;
    }
    
    .featured-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,0 1000,0 1000,100 0,80"/></svg>');
        background-size: cover;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    .filter-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 50px;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .filter-btn.active,
    .filter-btn:hover {
        background: var(--secondary-color);
        border-color: var(--secondary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }
    
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #6c757d;
    }
    
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }
    
    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #495057;
    }
    
    .floating-action {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, var(--accent-color) 0%, #e67e22 100%);
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1000;
    }
    
    .floating-action:hover {
        transform: scale(1.1);
        box-shadow: 0 12px 35px rgba(243, 156, 18, 0.5);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="projects-hero">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">
                    Ongoing Projects
                </h1>
                <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">
                    Discover our current initiatives that are actively creating positive change in communities worldwide. Each project represents our commitment to building a better future through sustainable development and compassionate action.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects -->
@if($featuredProjects->count() > 0)
<section class="featured-section">
    <div class="container">
        <div class="section-header">
            <h2 class="text-white fw-bold" data-aos="fade-up">Featured Ongoing Projects</h2>
            <p class="text-white-50 mb-0" data-aos="fade-up" data-aos-delay="100">
                Highlighting our most impactful current initiatives
            </p>
        </div>
        
        <div class="row g-4">
            @foreach($featuredProjects as $index => $project)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="project-card">
                    <div class="project-image">
                        @if($project->featured_image)
                            <img src="{{ asset('storage/' . $project->featured_image) }}" 
                                 alt="{{ $project->title }}" loading="lazy">
                        @else
                            <div style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-project-diagram text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                            </div>
                        @endif
                        <div class="project-status">
                            <i class="fas fa-play-circle me-1"></i>
                            Ongoing
                        </div>
                    </div>
                    
                    <div class="project-content">
                        @if($project->category)
                            <div class="project-category">{{ ucfirst($project->category) }}</div>
                        @endif
                        
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <p class="project-description">{{ Str::limit($project->description, 120) }}</p>
                        
                        <div class="project-meta">
                            @if($project->location)
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $project->location }}</span>
                                </div>
                            @endif
                            
                            @if($project->beneficiaries)
                                <div class="meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>{{ number_format($project->beneficiaries) }} beneficiaries</span>
                                </div>
                            @endif
                            
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>Started {{ $project->start_date->format('M Y') }}</span>
                            </div>
                        </div>
                        
                        @if($project->budget && $project->funds_raised)
                            <div class="progress-section">
                                <div class="progress-label">
                                    <span>Funding Progress</span>
                                    <span>{{ $project->funding_progress }}%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" 
                                         style="width: {{ min($project->funding_progress, 100) }}%"
                                         data-aos="width-animate" 
                                         data-aos-delay="{{ ($index + 1) * 200 }}">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="project-footer">
                        <a href="{{ route('projects.show', $project) }}" class="btn-learn-more">
                            Learn More
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- All Projects Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-aos="fade-up">All Ongoing Projects</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Explore our comprehensive portfolio of active projects making a difference across various sectors and communities.
            </p>
        </div>
        
        <!-- Filter Tabs -->
        <div class="filter-tabs" data-aos="fade-up" data-aos-delay="200">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="education">Education</button>
            <button class="filter-btn" data-filter="healthcare">Healthcare</button>
            <button class="filter-btn" data-filter="environment">Environment</button>
            <button class="filter-btn" data-filter="community">Community</button>
        </div>
        
        @if($projects->count() > 0)
            <div class="row g-4">
                @foreach($projects as $index => $project)
                <div class="col-lg-4 col-md-6 project-item" 
                     data-category="{{ $project->category }}"
                     data-aos="fade-up" 
                     data-aos-delay="{{ ($index % 6 + 1) * 100 }}">
                    <div class="project-card">
                        <div class="project-image">
                            @if($project->featured_image)
                                <img src="{{ asset('storage/' . $project->featured_image) }}" 
                                     alt="{{ $project->title }}" loading="lazy">
                            @else
                                <div style="height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-project-diagram text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                                </div>
                            @endif
                            <div class="project-status">
                                <i class="fas fa-play-circle me-1"></i>
                                Ongoing
                            </div>
                        </div>
                        
                        <div class="project-content">
                            @if($project->category)
                                <div class="project-category">{{ ucfirst($project->category) }}</div>
                            @endif
                            
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <p class="project-description">{{ Str::limit($project->description, 120) }}</p>
                            
                            <div class="project-meta">
                                @if($project->location)
                                    <div class="meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $project->location }}</span>
                                    </div>
                                @endif
                                
                                @if($project->beneficiaries)
                                    <div class="meta-item">
                                        <i class="fas fa-users"></i>
                                        <span>{{ number_format($project->beneficiaries) }} beneficiaries</span>
                                    </div>
                                @endif
                                
                                <div class="meta-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Started {{ $project->start_date->format('M Y') }}</span>
                                </div>
                            </div>
                            
                            @if($project->budget && $project->funds_raised)
                                <div class="progress-section">
                                    <div class="progress-label">
                                        <span>Funding Progress</span>
                                        <span>{{ $project->funding_progress }}%</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" 
                                             style="width: {{ min($project->funding_progress, 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="project-footer">
                            <a href="{{ route('projects.show', $project) }}" class="btn-learn-more">
                                Learn More
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                {{ $projects->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-project-diagram"></i>
                <h3>No Ongoing Projects Found</h3>
                <p>We're currently preparing new initiatives. Check back soon for exciting projects!</p>
            </div>
        @endif
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
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.project-item');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter projects
            projectItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.5s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
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
                }, 100);
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
});
</script>
@endpush
