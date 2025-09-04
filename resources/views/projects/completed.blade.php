@extends('layouts.app')

@section('title', 'Completed Projects | Hope Foundation')
@section('description', 'Explore our successfully completed projects and the lasting impact we\'ve made in communities worldwide through sustainable development initiatives.')

@push('styles')
<style>
    .projects-hero {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
        background: url('/images/success-pattern.png') repeat;
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
        position: relative;
    }
    
    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    }
    
    .project-card.completed::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(46, 204, 113, 0.05) 0%, rgba(26, 188, 156, 0.05) 100%);
        z-index: 1;
        pointer-events: none;
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
        background: linear-gradient(135deg, #2ecc71 0%, #1abc9c 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(46, 204, 113, 0.4);
        z-index: 2;
    }
    
    .completion-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.9);
        color: #27ae60;
        padding: 8px;
        border-radius: 50%;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        z-index: 2;
    }
    
    .project-content {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        position: relative;
        z-index: 2;
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
    
    .completion-stats {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #dee2e6;
    }
    
    .completion-stats h6 {
        color: #495057;
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }
    
    .completion-stats h6 i {
        color: #28a745;
        margin-right: 8px;
    }
    
    .achievement-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }
    
    .achievement-item i {
        color: #28a745;
        margin-right: 10px;
        width: 16px;
    }
    
    .impact-metrics {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 20px;
    }
    
    .metric-item {
        text-align: center;
        background: rgba(40, 167, 69, 0.1);
        border-radius: 10px;
        padding: 15px 10px;
        border: 1px solid rgba(40, 167, 69, 0.2);
    }
    
    .metric-number {
        font-size: 1.5rem;
        font-weight: 800;
        color: #28a745;
        display: block;
        margin-bottom: 5px;
    }
    
    .metric-label {
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .project-footer {
        padding: 0 30px 30px;
        position: relative;
        z-index: 2;
    }
    
    .btn-view-details {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }
    
    .btn-view-details:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .btn-view-details i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }
    
    .btn-view-details:hover i {
        transform: translateX(3px);
    }
    
    .featured-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        background: linear-gradient(135deg, #2c3e50 0%, #27ae60 100%);
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
    
    .timeline-indicator {
        background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%);
        border-left: 4px solid #28a745;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 0 10px 10px 0;
    }
    
    .timeline-date {
        font-size: 0.9rem;
        color: #28a745;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .timeline-duration {
        font-size: 0.8rem;
        color: #6c757d;
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
        background: #28a745;
        border-color: #28a745;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }
    
    .success-badge {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 10px;
        border: 1px solid #c3e6cb;
    }
    
    .success-badge i {
        margin-right: 5px;
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
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1000;
    }
    
    .floating-action:hover {
        transform: scale(1.1);
        box-shadow: 0 12px 35px rgba(40, 167, 69, 0.5);
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
                    Completed Projects
                </h1>
                <p class="lead mb-0" data-aos="fade-up" data-aos-delay="100">
                    Celebrating our successful initiatives and the lasting impact we've made in communities worldwide. Each completed project represents a milestone in our mission to create positive change through sustainable development.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Completed Projects -->
@if($featuredProjects->count() > 0)
<section class="featured-section">
    <div class="container">
        <div class="section-header">
            <h2 class="text-white fw-bold" data-aos="fade-up">Featured Success Stories</h2>
            <p class="text-white-50 mb-0" data-aos="fade-up" data-aos-delay="100">
                Highlighting our most impactful completed projects
            </p>
        </div>
        
        <div class="row g-4">
            @foreach($featuredProjects as $index => $project)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="project-card completed">
                    <div class="project-image">
                        @if($project->featured_image)
                            <img src="{{ asset('storage/' . $project->featured_image) }}" 
                                 alt="{{ $project->title }}" loading="lazy">
                        @else
                            <div style="height: 250px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-circle text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                            </div>
                        @endif
                        <div class="project-status">
                            <i class="fas fa-check-circle me-1"></i>
                            Completed
                        </div>
                        <div class="completion-badge">
                            <i class="fas fa-trophy"></i>
                        </div>
                    </div>
                    
                    <div class="project-content">
                        <div class="success-badge">
                            <i class="fas fa-medal"></i>
                            Successfully Completed
                        </div>
                        
                        @if($project->category)
                            <div class="project-category">{{ ucfirst($project->category) }}</div>
                        @endif
                        
                        <h3 class="project-title">{{ $project->title }}</h3>
                        <p class="project-description">{{ Str::limit($project->description, 120) }}</p>
                        
                        <div class="timeline-indicator">
                            <div class="timeline-date">
                                {{ $project->start_date->format('M Y') }} - {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                            </div>
                            <div class="timeline-duration">
                                Duration: {{ $project->start_date->diffInMonths($project->end_date ?? now()) }} months
                            </div>
                        </div>
                        
                        @if($project->beneficiaries || $project->achievements)
                        <div class="completion-stats">
                            <h6><i class="fas fa-chart-line"></i>Project Impact</h6>
                            
                            @if($project->beneficiaries)
                            <div class="impact-metrics">
                                <div class="metric-item">
                                    <span class="metric-number">{{ number_format($project->beneficiaries) }}</span>
                                    <span class="metric-label">Beneficiaries</span>
                                </div>
                                @if($project->budget)
                                <div class="metric-item">
                                    <span class="metric-number">${{ number_format($project->budget) }}</span>
                                    <span class="metric-label">Investment</span>
                                </div>
                                @endif
                            </div>
                            @endif
                            
                            @if($project->achievements)
                                @php
                                    $achievements = is_array($project->achievements) 
                                        ? $project->achievements 
                                        : explode("\n", $project->achievements);
                                @endphp
                                @foreach(array_slice($achievements, 0, 2) as $achievement)
                                <div class="achievement-item">
                                    <i class="fas fa-check"></i>
                                    <span>{{ trim($achievement) }}</span>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        @endif
                    </div>
                    
                    <div class="project-footer">
                        <a href="{{ route('projects.show', $project) }}" class="btn-view-details">
                            View Details
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

<!-- All Completed Projects Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title" data-aos="fade-up">All Completed Projects</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                Browse through our comprehensive archive of successfully completed projects and see the lasting positive impact we've created across various communities and sectors.
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
                    <div class="project-card completed">
                        <div class="project-image">
                            @if($project->featured_image)
                                <img src="{{ asset('storage/' . $project->featured_image) }}" 
                                     alt="{{ $project->title }}" loading="lazy">
                            @else
                                <div style="height: 250px; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-check-circle text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                                </div>
                            @endif
                            <div class="project-status">
                                <i class="fas fa-check-circle me-1"></i>
                                Completed
                            </div>
                            <div class="completion-badge">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                        
                        <div class="project-content">
                            <div class="success-badge">
                                <i class="fas fa-medal"></i>
                                Successfully Completed
                            </div>
                            
                            @if($project->category)
                                <div class="project-category">{{ ucfirst($project->category) }}</div>
                            @endif
                            
                            <h3 class="project-title">{{ $project->title }}</h3>
                            <p class="project-description">{{ Str::limit($project->description, 120) }}</p>
                            
                            <div class="timeline-indicator">
                                <div class="timeline-date">
                                    {{ $project->start_date->format('M Y') }} - {{ $project->end_date ? $project->end_date->format('M Y') : 'Present' }}
                                </div>
                                <div class="timeline-duration">
                                    Duration: {{ $project->start_date->diffInMonths($project->end_date ?? now()) }} months
                                </div>
                            </div>
                            
                            @if($project->beneficiaries || $project->achievements)
                            <div class="completion-stats">
                                <h6><i class="fas fa-chart-line"></i>Project Impact</h6>
                                
                                @if($project->beneficiaries)
                                <div class="impact-metrics">
                                    <div class="metric-item">
                                        <span class="metric-number">{{ number_format($project->beneficiaries) }}</span>
                                        <span class="metric-label">Beneficiaries</span>
                                    </div>
                                    @if($project->budget)
                                    <div class="metric-item">
                                        <span class="metric-number">${{ number_format($project->budget) }}</span>
                                        <span class="metric-label">Investment</span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                                
                                @if($project->achievements)
                                    @php
                                        $achievements = is_array($project->achievements) 
                                            ? $project->achievements 
                                            : explode("\n", $project->achievements);
                                    @endphp
                                    @foreach(array_slice($achievements, 0, 2) as $achievement)
                                    <div class="achievement-item">
                                        <i class="fas fa-check"></i>
                                        <span>{{ trim($achievement) }}</span>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            @endif
                        </div>
                        
                        <div class="project-footer">
                            <a href="{{ route('projects.show', $project) }}" class="btn-view-details">
                                View Details
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
                <i class="fas fa-check-circle"></i>
                <h3>No Completed Projects Found</h3>
                <p>We're working hard to complete our ongoing initiatives. Check back soon for success stories!</p>
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
    
    // Add success animation to completed cards
    const completedCards = document.querySelectorAll('.project-card.completed');
    const cardObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'successPulse 0.6s ease-out';
            }
        });
    }, { threshold: 0.3 });
    
    completedCards.forEach(card => {
        cardObserver.observe(card);
    });
});

// CSS animation for success pulse
const style = document.createElement('style');
style.textContent = `
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }
`;
document.head.appendChild(style);
</script>
@endpush
