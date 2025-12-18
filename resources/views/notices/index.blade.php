@extends('layouts.app')

@section('title', 'Notices | Hope Foundation')

@section('content')
<!-- Add wrapper class for scoped styling -->
<div class="notices-page">

<!-- Modern Hero Section -->
<section class="modern-hero-section">
  <div class="container">
    <div class="row align-items-center min-vh-60">
      <div class="col-lg-10 mx-auto text-center">
        <div class="hero-content">
          <h1 class="hero-title mb-4">
            Stay <span class="text-gradient">Informed</span> & Updated
          </h1>
          <p class="hero-subtitle mb-5">
            Get the latest announcements, important updates, and urgent notices from Hope Foundation to stay connected with our community.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modern Notices Grid Section -->
<section class="modern-notices-section py-5">
  <div class="container">
    @if($notices->isNotEmpty())
      @php
        $featuredNotice = $notices->first(fn($notice) => $notice->is_featured);
        $regularNotices = $notices->reject(fn($notice) => $notice->is_featured);
      @endphp
      
      @if($featuredNotice)
        <!-- Featured Notice Card -->
        <div class="featured-notice-card mb-5">
          <div class="row g-0 align-items-center">
            <div class="col-lg-6">
              <div class="featured-image-container">
                <img class="featured-image" 
                     src="{{ $featuredNotice->image ? asset('storage/notices/' . $featuredNotice->image) : 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=800&auto=format&fit=crop' }}" 
                     alt="{{ $featuredNotice->title }}">
                <div class="featured-overlay">
                  <div class="priority-indicator priority-{{ $featuredNotice->priority }}">
                    <i class="fas fa-{{ $featuredNotice->priority === 'urgent' ? 'exclamation-triangle' : ($featuredNotice->priority === 'high' ? 'exclamation-circle' : 'info-circle') }}"></i>
                    {{ strtoupper($featuredNotice->priority) }}
                  </div>
                  <div class="featured-label">
                    <i class="fas fa-star"></i>
                    Featured
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="featured-content">
                <div class="notice-badges mb-3">
                  <span class="modern-badge date-badge">
                    <i class="fas fa-calendar me-1"></i>
                    {{ $featuredNotice->published_at ? $featuredNotice->published_at->format('M j, Y') : $featuredNotice->created_at->format('M j, Y') }}
                  </span>
                  <span class="modern-badge author-badge">
                    <i class="fas fa-user me-1"></i>{{ $featuredNotice->author }}
                  </span>
                  @if($featuredNotice->category)
                    <span class="modern-badge category-badge">
                      <i class="fas fa-tag me-1"></i>{{ $featuredNotice->category }}
                    </span>
                  @endif
                </div>
                <h2 class="featured-title">{{ $featuredNotice->title }}</h2>
                <p class="featured-excerpt">{{ $featuredNotice->excerpt }}</p>
                <a href="{{ route('notices.show', $featuredNotice) }}" class="modern-btn primary">
                  <span>Read Full Notice</span>
                  <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      @endif
      
      <!-- Regular Notices Grid (Always shows 4 per row) -->
      @if($regularNotices->isNotEmpty())
        <div class="notices-grid">
          @foreach($regularNotices as $notice)
            <a href="{{ route('notices.show', $notice) }}" class="card-link">
              <div class="notice-card profile-style-card">
                <div class="card-image-section">
                  <img class="notice-image" 
                       src="{{ $notice->image ? asset('storage/notices/' . $notice->image) : 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=600&auto=format&fit=crop' }}" 
                       alt="{{ $notice->title }}">
                  
                  <!-- Top Overlay for Badges -->
                  <div class="image-overlay-top">
                    <div class="left-badges">
                      @if($notice->is_featured)
                        <div class="featured-badge">
                          <i class="fas fa-star"></i>
                        </div>
                      @endif
                    </div>
                    
                    <div class="right-badges">
                      <div class="date-badge">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ $notice->published_at ? $notice->published_at->format('M j') : $notice->created_at->format('M j') }}</span>
                      </div>
                      <div class="priority-badge priority-{{ $notice->priority }}">
                        {{ ucfirst($notice->priority) }}
                      </div>
                    </div>
                  </div>
                  
                  <!-- Bottom Overlay for Title -->
                  <div class="image-overlay-bottom">
                    <div class="title-overlay">
                      <h3 class="overlay-title">{{ $notice->title }}</h3>
                    </div>
                  </div>
                </div>
                
                <div class="card-content-section">
                  <div class="notice-description">
                    {{ $notice->excerpt }}
                  </div>
                  
                  @if($notice->expires_at && $notice->expires_at->isFuture())
                    <div class="expiry-info">
                      <i class="fas fa-clock"></i>
                      Expires {{ $notice->expires_at->diffForHumans() }}
                    </div>
                  @endif
                </div>
              </div>
            </a>
          @endforeach
        </div>
      @endif
    @else
      <div class="empty-state">
        <div class="empty-icon">
          <i class="fas fa-inbox"></i>
        </div>
        <h3 class="empty-title">No Notices Found</h3>
        <p class="empty-text">There are no notices matching your criteria at the moment.</p>
        <a href="{{ route('notices.index') }}" class="modern-btn secondary">
          <span>View All Notices</span>
          <i class="fas fa-list"></i>
        </a>
      </div>
    @endif
    
    <!-- Modern Pagination -->
    @if($notices->hasPages())
      <div class="modern-pagination">
        {{ $notices->links('pagination::bootstrap-4') }}
      </div>
    @endif
  </div>
</section>

<!-- Newsletter subscription CTA removed as requested -->

</div>
<!-- End wrapper class -->

<style>
/* ======================================================
   NOTICES PAGE CONTENT STYLING ONLY
   Header/Navigation styling is handled by layouts/app.blade.php
   ====================================================== */

/* Content-specific color variables using site theme */
.notices-page {
  --content-primary: #2c3e50;
  --content-secondary: #e74c3c;
  --content-accent: #f39c12;
  --content-success: #27ae60;
  --content-light: #f8f9fa;
  --content-dark: #2c3e50;
  
  /* Improved text contrast for better visibility */
  --content-text-primary: #1a1a1a;    /* Darker for better contrast */
  --content-text-secondary: #4a5568;   /* Darker gray for better readability */
  --content-text-muted: #718096;       /* Slightly darker muted text */
  
  --content-bg-primary: #ffffff;
  --content-bg-secondary: #f7fafc;     /* Slightly different light background */
  --content-bg-tertiary: #edf2f7;      /* Better contrast tertiary background */
  
  --content-border: #e2e8f0;
  --content-border-light: #f1f5f9;
  
  --content-shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
  --content-shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  --content-shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
  --content-shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
  
  --content-radius-sm: 0.375rem;
  --content-radius-md: 0.5rem;
  --content-radius-lg: 0.75rem;
  --content-radius-xl: 1rem;
}

/* Hero Section - Content Area Only */
.modern-hero-section {
  background: var(--content-bg-secondary);
  position: relative;
  overflow: hidden;
  padding: 80px 0 60px;
  margin-top: 0; /* No margin to avoid header spacing issues */
}

.modern-hero-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: 
    radial-gradient(circle at 20% 50%, rgba(44, 62, 80, 0.02) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(231, 76, 60, 0.02) 0%, transparent 50%),
    radial-gradient(circle at 40% 80%, rgba(39, 174, 96, 0.02) 0%, transparent 50%);
}

.hero-content {
  position: relative;
  z-index: 2;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  line-height: 1.1;
  color: var(--content-text-primary) !important; /* Force dark text */
  margin-bottom: 1.5rem;
}

.text-gradient {
  background: linear-gradient(135deg, var(--content-primary) 0%, var(--content-secondary) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  /* Fallback for browsers that don't support background-clip */
  color: var(--content-primary);
}

.hero-subtitle {
  font-size: 1.25rem;
  color: var(--content-text-secondary) !important; /* Force readable text */
  line-height: 1.7;
  max-width: 700px;
  margin: 0 auto;
}

/* Notices Section */
.modern-notices-section {
  background: var(--content-bg-secondary);
}

/* Featured Notice Card */
.featured-notice-card {
  background: var(--content-bg-primary);
  border-radius: var(--content-radius-xl);
  overflow: hidden;
  box-shadow: var(--content-shadow-xl);
  border: 1px solid var(--content-border-light);
  position: relative;
}

.featured-image-container {
  position: relative;
  height: 400px;
  overflow: hidden;
}

.featured-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.featured-notice-card:hover .featured-image {
  transform: scale(1.05);
}

.featured-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, transparent 50%);
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 1.5rem;
}

.priority-indicator {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  border-radius: var(--content-radius-lg);
  color: white;
  font-weight: 600;
  font-size: 0.875rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.priority-urgent {
  background: rgba(231, 76, 60, 0.9);
  backdrop-filter: blur(10px);
}

.priority-high {
  background: rgba(243, 156, 18, 0.9);
  backdrop-filter: blur(10px);
}

.priority-medium {
  background: rgba(39, 174, 96, 0.9);
  backdrop-filter: blur(10px);
}

.priority-low {
  background: rgba(149, 165, 166, 0.9);
  backdrop-filter: blur(10px);
}

.featured-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: rgba(243, 156, 18, 0.9);
  backdrop-filter: blur(10px);
  border-radius: var(--content-radius-lg);
  color: white;
  font-weight: 600;
  font-size: 0.875rem;
}

.featured-content {
  padding: 2rem;
}

.notice-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 0.75rem;
}

.modern-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.25rem;
  padding: 0.375rem 0.75rem;
  border-radius: var(--content-radius-md);
  font-size: 0.875rem;
  font-weight: 500;
}

.date-badge {
  background: rgba(44, 62, 80, 0.1);
  color: var(--content-primary);
  border: 1px solid rgba(44, 62, 80, 0.2);
}

.author-badge {
  background: rgba(39, 174, 96, 0.1);
  color: var(--content-success);
  border: 1px solid rgba(39, 174, 96, 0.2);
}

.category-badge {
  background: rgba(231, 76, 60, 0.1);
  color: var(--content-secondary);
  border: 1px solid rgba(231, 76, 60, 0.2);
}

.featured-title {
  font-size: 2rem;
  font-weight: 700;
  color: var(--content-text-primary);
  line-height: 1.3;
  margin: 1.5rem 0 1rem;
}

.featured-excerpt {
  font-size: 1.125rem;
  color: var(--content-text-secondary);
  line-height: 1.7;
  margin-bottom: 2rem;
}

/* Buttons - Content Specific */
.modern-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.875rem 2rem;
  border-radius: var(--content-radius-lg);
  text-decoration: none;
  font-weight: 600;
  font-size: 1rem;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
}

.modern-btn.primary {
  background: var(--content-primary);
  color: white;
  box-shadow: var(--content-shadow-md);
}

.modern-btn.primary:hover {
  background: #1a252f;
  transform: translateY(-2px);
  box-shadow: var(--content-shadow-lg);
  color: white;
}

.modern-btn.secondary {
  background: var(--content-bg-tertiary);
  color: var(--content-text-secondary);
  border: 1px solid var(--content-border);
}

.modern-btn.secondary:hover {
  background: var(--content-bg-primary);
  color: var(--content-primary);
  border-color: var(--content-primary);
  transform: translateY(-1px);
}

/* Notice Grid - Profile Style Cards */
.notices-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
  margin-top: 4rem;
  align-items: start;
}

/* Card Link Wrapper */
.card-link {
  text-decoration: none;
  display: block;
  transition: all 0.3s ease;
}

.card-link:hover {
  text-decoration: none;
  transform: translateY(-4px);
}

.card-link:hover .profile-style-card {
  transform: none; /* Prevent double transform */
}

.profile-style-card {
  background: var(--content-bg-primary);
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 
    0 4px 6px -1px rgba(0, 0, 0, 0.1),
    0 2px 4px -1px rgba(0, 0, 0, 0.06);
  border: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  position: relative;
  display: flex;
  flex-direction: column;
  width: 100%;
  margin: 0;
  height: 480px; /* Reduced from 580px - optimized for cleaner layout */
}

.card-link:hover .profile-style-card {
  box-shadow: 
    0 20px 25px -5px rgba(0, 0, 0, 0.15),
    0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Card Image Section */
.card-image-section {
  position: relative;
  height: 240px; /* Reduced from 280px for better proportions */
  overflow: hidden;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.notice-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.profile-style-card:hover .notice-image {
  transform: scale(1.1);
}

/* Image Overlays */
.image-overlay-top {
  position: absolute;
  top: 16px;
  left: 16px;
  right: 16px;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  z-index: 3;
}

.left-badges {
  display: flex;
  gap: 8px;
}

.right-badges {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 8px;
}

.date-badge {
  display: flex;
  align-items: center;
  gap: 4px;
  padding: 6px 10px;
  background: rgba(255, 255, 255, 0.95);
  color: var(--content-text-primary);
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.date-badge i {
  font-size: 10px;
  opacity: 0.8;
}

.image-overlay-bottom {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(
    to top,
    rgba(0, 0, 0, 0.9) 0%,
    rgba(0, 0, 0, 0.8) 30%,
    rgba(0, 0, 0, 0.6) 50%,
    rgba(0, 0, 0, 0.3) 75%,
    transparent 100%
  );
  padding: 24px 20px 20px;
  z-index: 2;
  transition: all 0.3s ease;
}

.card-link:hover .image-overlay-bottom {
  background: linear-gradient(
    to top,
    rgba(0, 0, 0, 0.95) 0%,
    rgba(0, 0, 0, 0.85) 30%,
    rgba(0, 0, 0, 0.7) 50%,
    rgba(0, 0, 0, 0.4) 75%,
    transparent 100%
  );
}

.title-overlay {
  transform: translateY(0);
  transition: transform 0.3s ease;
}

.card-link:hover .title-overlay {
  transform: translateY(-4px);
}

.card-link:hover .notice-image {
  transform: scale(1.1);
}

.overlay-title {
  color: white;
  font-size: 1.35rem;
  font-weight: 700;
  line-height: 1.2;
  margin: 0;
  text-shadow: 
    0 2px 4px rgba(0, 0, 0, 0.8),
    0 1px 3px rgba(0, 0, 0, 0.6),
    0 1px 2px rgba(0, 0, 0, 0.4);
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.featured-badge {
  width: 32px;
  height: 32px;
  background: rgba(255, 193, 7, 0.9);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 14px;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.priority-badge {
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

.priority-badge.priority-urgent {
  background: rgba(220, 53, 69, 0.9);
  color: white;
}

.priority-badge.priority-high {
  background: rgba(255, 193, 7, 0.9);
  color: white;
}

.priority-badge.priority-medium {
  background: rgba(25, 135, 84, 0.9);
  color: white;
}

.priority-badge.priority-low {
  background: rgba(108, 117, 125, 0.9);
  color: white;
}

/* Card Content Section */
.card-content-section {
  padding: 16px;
  text-align: center;
}

.notice-description {
  color: var(--content-text-secondary);
  font-size: 15px;
  line-height: 1.6;
  margin-bottom: 12px;
  text-align: left;
  display: -webkit-box;
  -webkit-line-clamp: 4; /* Optimized for new height */
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.expiry-info {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  font-size: 13px;
  color: var(--content-accent);
  font-weight: 500;
  padding: 8px 12px;
  background: rgba(243, 156, 18, 0.1);
  border-radius: 20px;
  border: 1px solid rgba(243, 156, 18, 0.2);
  margin: 0;
}

/* Empty State - Legacy styles removed for cleaner code */

.view-notice-btn i {
  transition: transform 0.3s ease;
}

.view-notice-btn:hover i {
  transform: translateX(4px);
}
  transition: all 0.3s ease;
}

.priority-tag.priority-urgent {
  background: rgba(231, 76, 60, 0.9);
  box-shadow: 0 0 20px rgba(231, 76, 60, 0.3);
}

.priority-tag.priority-high {
  background: rgba(243, 156, 18, 0.9);
  box-shadow: 0 0 20px rgba(243, 156, 18, 0.3);
}

.priority-tag.priority-medium {
  background: rgba(39, 174, 96, 0.9);
  box-shadow: 0 0 20px rgba(39, 174, 96, 0.3);
}

.priority-tag.priority-low {
  background: rgba(149, 165, 166, 0.9);
  box-shadow: 0 0 20px rgba(149, 165, 166, 0.3);
}

.featured-star {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 2.5rem;
  height: 2.5rem;
  background: rgba(243, 156, 18, 0.9);
  color: white;
  font-size: 1rem;
  border-radius: 50%;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255, 255, 255, 0.2);
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.notice-content {
  flex: 1;
  padding: 2.5rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.content-header {
  margin-bottom: 1.5rem;
}

.notice-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  margin-bottom: 1rem;
  font-size: 0.875rem;
}

.meta-date {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: var(--content-bg-tertiary);
  color: var(--content-text-secondary);
  border-radius: 50px;
  font-weight: 500;
}

.category-tag {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, var(--content-secondary), #c0392b);
  color: white;
  border-radius: 50px;
  font-size: 0.8rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 2px 8px rgba(231, 76, 60, 0.2);
}

.expiry-notice {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, rgba(243, 156, 18, 0.1), rgba(243, 156, 18, 0.05));
  color: var(--content-accent);
  border-radius: 50px;
  font-size: 0.8rem;
  font-weight: 600;
  border: 1px solid rgba(243, 156, 18, 0.2);
}

.content-body {
  flex: 1;
  margin-bottom: 2rem;
}

.notice-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--content-text-primary);
  line-height: 1.3;
  margin-bottom: 1rem;
  transition: color 0.3s ease;
}

.notice-card:hover .notice-title {
  color: var(--content-primary);
}

.notice-excerpt {
  color: var(--content-text-secondary);
  line-height: 1.7;
  font-size: 1.1rem;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.content-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 1.5rem;
  border-top: 1px solid var(--content-bg-tertiary);
}

.notice-stats {
  display: flex;
  align-items: center;
}

.reading-time {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  color: var(--content-text-muted);
  font-size: 0.875rem;
  font-weight: 500;
}

.expiry-notice {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, rgba(243, 156, 18, 0.1), rgba(243, 156, 18, 0.05));
  color: var(--content-accent);
  border-radius: 50px;
  font-size: 0.8rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  border: 1px solid rgba(243, 156, 18, 0.2);
}

.notice-title {
  font-size: 1.375rem;
  font-weight: 700;
  color: var(--content-text-primary);
  line-height: 1.3;
  margin-bottom: 1rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  transition: color 0.3s ease;
}

.notice-card:hover .notice-title {
  color: var(--content-primary);
}

.notice-excerpt {
  color: var(--content-text-secondary);
  line-height: 1.7;
  margin-bottom: 1.5rem;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  font-size: 1rem;
}

.category-tag {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.375rem 1rem;
  background: linear-gradient(135deg, var(--content-secondary), #c0392b);
  color: white;
  border-radius: 50px;
  font-size: 0.8rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 2px 8px rgba(231, 76, 60, 0.2);
}
  font-size: 0.8rem;
  font-weight: 500;
  margin-bottom: 1.5rem;
}

.notice-footer {
  margin-top: auto;
  padding-top: 1rem;
  border-top: 1px solid var(--content-bg-tertiary);
}

.read-more-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.75rem;
  width: 100%;
  padding: 1rem 1.5rem;
  background: linear-gradient(135deg, var(--content-primary), #1a252f);
  color: white;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.95rem;
  border-radius: 12px;
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  position: relative;
  overflow: hidden;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.read-more-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.5s ease;
}

.read-more-btn:hover::before {
  left: 100%;
}

.read-more-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
  color: white;
  text-decoration: none;
}

.read-more-btn i {
  transition: transform 0.3s ease;
}

.read-more-btn:hover i {
  transform: translateX(4px);
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
}

.empty-icon {
  font-size: 4rem;
  color: var(--content-text-muted);
  margin-bottom: 1.5rem;
}

.empty-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--content-text-secondary);
  margin-bottom: 0.5rem;
}

.empty-text {
  color: var(--content-text-muted);
  margin-bottom: 2rem;
}

/* Pagination - Content Specific */
.modern-pagination {
  display: flex;
  justify-content: center;
  margin-top: 3rem;
}

.modern-pagination .pagination {
  gap: 0.5rem;
}

.modern-pagination .page-link {
  border: none;
  border-radius: var(--content-radius-lg);
  padding: 0.75rem 1rem;
  color: var(--content-text-secondary);
  font-weight: 500;
  transition: all 0.3s ease;
}

.modern-pagination .page-link:hover {
  background: var(--content-primary);
  color: white;
  transform: translateY(-1px);
}

.modern-pagination .page-item.active .page-link {
  background: var(--content-primary);
  color: white;
  box-shadow: var(--content-shadow-md);
}

/* Newsletter Section */
.newsletter-section {
  padding: 4rem 0;
  background: var(--content-bg-primary);
}

.newsletter-card {
  background: linear-gradient(135deg, var(--content-primary) 0%, #1a252f 100%);
  border-radius: var(--content-radius-xl);
  padding: 3rem;
  color: white;
  position: relative;
  overflow: hidden;
}

.newsletter-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
}

.newsletter-content {
  position: relative;
  z-index: 2;
}

.newsletter-title {
  font-size: 1.875rem;
  font-weight: 700;
  margin-bottom: 0.75rem;
}

.newsletter-text {
  font-size: 1.125rem;
  opacity: 0.9;
  margin: 0;
}

.newsletter-form {
  position: relative;
  z-index: 2;
}

.subscription-form {
  margin-top: 1rem;
}

.form-group {
  display: flex;
  gap: 1rem;
  max-width: 400px;
  margin-left: auto;
}

.form-input {
  flex: 1;
  padding: 1rem 1.25rem;
  border: 2px solid rgba(255, 255, 255, 0.2);
  border-radius: var(--content-radius-lg);
  background: rgba(255, 255, 255, 0.1);
  color: white;
  font-size: 1rem;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.form-input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

.form-input:focus {
  outline: none;
  border-color: rgba(255, 255, 255, 0.5);
  background: rgba(255, 255, 255, 0.15);
}

.form-submit {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 1rem 1.5rem;
  background: white;
  color: var(--content-primary);
  border: none;
  border-radius: var(--content-radius-lg);
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.form-submit:hover {
  background: rgba(255, 255, 255, 0.9);
  transform: translateY(-1px);
}

/* Responsive Design */
@media (max-width: 1024px) {
  .notices-grid {
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 1.5rem;
  }
  
  .profile-style-card {
    max-width: none;
    height: 420px; /* Reduced from 520px */
  }
  
  .card-image-section {
    height: 200px; /* Reduced from 240px */
  }
  
  .card-content-section {
    padding: 20px;
  }
  
  .notice-title {
    font-size: 1.25rem;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }
  
  .featured-content {
    padding: 1.5rem;
  }
  
  .featured-title {
    font-size: 1.5rem;
  }
  
  .notices-grid {
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
  }
  
  .profile-style-card {
    margin: 0;
    border-radius: 20px;
    height: 380px; /* Reduced from 450px */
  }
  
  .card-image-section {
    height: 180px; /* Reduced from 200px */
  }
  
  .card-content-section {
    padding: 16px;
  }
  
  .overlay-title {
    font-size: 1.1rem;
  }
  
  .date-badge {
    font-size: 10px;
    padding: 5px 8px;
  }
  
  .notice-description {
    font-size: 14px;
  }
  
  .meta-info {
    flex-direction: column;
    align-items: flex-start;
    gap: 8px;
  }
  
  .view-notice-btn {
    padding: 10px 20px;
    font-size: 13px;
  }
  
  .newsletter-card {
    padding: 2rem 1.5rem;
    text-align: center;
  }
  
  .form-group {
    flex-direction: column;
    max-width: none;
    margin: 1rem 0 0;
  }
}

@media (max-width: 480px) {
  .modern-hero-section {
    padding: 60px 0 40px;
  }
  
  .hero-title {
    font-size: 2rem;
  }
  
  .hero-subtitle {
    font-size: 1rem;
  }
  
  .notices-grid {
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
  }
  
  .profile-style-card {
    height: 340px; /* Reduced from 400px */
  }
  
  .card-image-section {
    height: 160px; /* Reduced from 180px */
  }
  
  .overlay-title {
    font-size: 1rem;
    -webkit-line-clamp: 2; /* Ensure title fits on small screens */
  }
  
  .date-badge {
    font-size: 10px;
    padding: 4px 8px;
  }
  
  .date-badge i {
    font-size: 9px;
  }
  
  .image-overlay-bottom {
    padding: 16px 12px 12px;
  }
  
  .notice-content {
    padding: 1rem;
  }
  
  .featured-notice-card .row {
    flex-direction: column-reverse;
  }
  
  .featured-image-container {
    height: 250px;
  }
}
</style>

@endsection
