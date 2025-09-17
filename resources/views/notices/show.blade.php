@extends('layouts.app')

@section('title', $notice->title . ' | Hope Foundation')

@section('meta')
<meta name="description" content="{{ $notice->excerpt }}">
<meta property="og:title" content="{{ $notice->title }}">
<meta property="og:description" content="{{ $notice->excerpt }}">
<meta property="og:image" content="{{ $notice->image ? asset('storage/notices/' . $notice->image) : asset('images/default-notice.jpg') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')
<!-- Notice Hero Section -->
<section class="notice-detail-hero">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="notice-hero-content text-center">
          <!-- Priority Badge -->
          <div class="priority-indicator priority-{{ $notice->priority }} mb-3">
            <i class="fas fa-{{ $notice->priority === 'urgent' ? 'exclamation-triangle' : ($notice->priority === 'high' ? 'exclamation-circle' : ($notice->priority === 'medium' ? 'info-circle' : 'info')) }} me-2"></i>
            {{ strtoupper($notice->priority) }} PRIORITY
          </div>

          <!-- Featured Badge -->
          @if($notice->is_featured)
            <span class="badge bg-gradient-warning text-white mb-3 px-3 py-2">
              <i class="fas fa-star me-2"></i>Featured Notice
            </span>
          @endif

          <!-- Title -->
          <h1 class="display-4 fw-bold text-dark mb-4">{{ $notice->title }}</h1>

          <!-- Meta Information -->
          <div class="notice-meta d-flex flex-wrap justify-content-center align-items-center gap-4 mb-4">
            <div class="meta-item">
              <i class="fas fa-calendar text-primary me-2"></i>
              <span class="fw-medium">Published:</span> 
              {{ $notice->published_at ? $notice->published_at->format('F j, Y \a\t g:i A') : $notice->created_at->format('F j, Y \a\t g:i A') }}
            </div>
            <div class="meta-item">
              <i class="fas fa-user text-success me-2"></i>
              <span class="fw-medium">By:</span> {{ $notice->author }}
            </div>
            @if($notice->category)
              <div class="meta-item">
                <i class="fas fa-tag text-info me-2"></i>
                <span class="fw-medium">Category:</span> {{ $notice->category }}
              </div>
            @endif
            @if($notice->expires_at)
              <div class="meta-item">
                <i class="fas fa-clock text-warning me-2"></i>
                <span class="fw-medium">Expires:</span> {{ $notice->expires_at->format('F j, Y') }}
              </div>
            @endif
          </div>

          <!-- Excerpt -->
          @if($notice->excerpt)
            <p class="lead text-muted mb-4 mx-auto" style="max-width: 700px;">{{ $notice->excerpt }}</p>
          @endif

          <!-- Action Buttons -->
          <div class="notice-actions">
            <a href="{{ route('notices.index') }}" class="btn btn-outline-primary me-3">
              <i class="fas fa-arrow-left me-2"></i>Back to All Notices
            </a>
            <button class="btn btn-primary" onclick="shareNotice()">
              <i class="fas fa-share-alt me-2"></i>Share Notice
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Notice Content Section -->
<section class="notice-content-section py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <!-- Notice Image -->
        @if($notice->image)
          <div class="notice-image mb-5">
            <img src="{{ asset('storage/notices/' . $notice->image) }}" 
                 class="img-fluid rounded-4 shadow-sm w-100" 
                 alt="{{ $notice->title }}"
                 style="max-height: 500px; object-fit: cover;">
          </div>
        @endif

        <!-- Notice Content -->
        <div class="notice-content-body">
          <div class="content-wrapper">
            {!! nl2br(e($notice->content)) !!}
          </div>
        </div>

        <!-- Notice Footer -->
        <div class="notice-footer mt-5 pt-4 border-top">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="notice-timestamps">
                <small class="text-muted d-block">
                  <i class="fas fa-plus-circle me-1"></i>
                  <strong>Created:</strong> {{ $notice->created_at->format('F j, Y \a\t g:i A') }}
                </small>
                @if($notice->updated_at->gt($notice->created_at))
                  <small class="text-muted d-block mt-1">
                    <i class="fas fa-edit me-1"></i>
                    <strong>Last Updated:</strong> {{ $notice->updated_at->format('F j, Y \a\t g:i A') }}
                  </small>
                @endif
              </div>
            </div>
            <div class="col-md-6 text-md-end">
              <div class="notice-actions-footer">
                <button class="btn btn-sm btn-outline-primary me-2" onclick="printNotice()">
                  <i class="fas fa-print me-1"></i>Print
                </button>
                <button class="btn btn-sm btn-outline-success" onclick="shareNotice()">
                  <i class="fas fa-share-alt me-1"></i>Share
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Urgent Notices Alert -->
@php
  $urgentNotices = \App\Models\Notice::getUrgentNotices()->where('id', '!=', $notice->id);
@endphp

@if($urgentNotices->count() > 0)
<section class="urgent-notices-alert py-4 bg-danger text-white">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-auto">
        <i class="fas fa-exclamation-triangle fa-2x"></i>
      </div>
      <div class="col">
        <h5 class="mb-1">Other Urgent Notices</h5>
        <p class="mb-0">There are {{ $urgentNotices->count() }} other urgent {{ Str::plural('notice', $urgentNotices->count()) }} requiring immediate attention.</p>
      </div>
      <div class="col-auto">
        <a href="{{ route('notices.index', ['priority' => 'urgent']) }}" class="btn btn-light text-danger">
          View All Urgent <i class="fas fa-arrow-right ms-2"></i>
        </a>
      </div>
    </div>
  </div>
</section>
@endif

<!-- Newsletter Subscription -->
<section class="newsletter-section bg-primary-gradient text-white py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="newsletter-content">
          <h4 class="fw-bold mb-2">Stay Updated</h4>
          <p class="mb-0">Subscribe to receive instant notifications about important notices and updates from Hope Foundation.</p>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="newsletter-form">
          <form class="row g-2">
            <div class="col-md-8">
              <input type="email" class="form-control form-control-lg" placeholder="Enter your email address" required>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-light btn-lg text-primary fw-semibold w-100">
                Subscribe
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* Notice Detail Hero */
.notice-detail-hero {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  padding: 4rem 0 3rem;
  position: relative;
  overflow: hidden;
}

.notice-detail-hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23007bff' fill-opacity='0.03'%3E%3Cpath d='M20 20.5V18H0v-2h20v-2H0v-2h20v-2H0V8h20V6H0V4h20V2H0V0h22v20.5L20 20.5z'/%3E%3C/g%3E%3C/svg%3E") repeat;
  z-index: -1;
}

/* Priority Indicator */
.priority-indicator {
  display: inline-block;
  padding: 8px 20px;
  border-radius: 25px;
  color: white;
  font-weight: 700;
  font-size: 0.875rem;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  animation: priorityPulse 2s infinite;
}

.priority-urgent { 
  background: linear-gradient(135deg, #dc3545, #c82333);
  animation: urgentPulse 1.5s infinite;
}

.priority-high { 
  background: linear-gradient(135deg, #fd7e14, #e55a00);
}

.priority-medium { 
  background: linear-gradient(135deg, #17a2b8, #138496);
}

.priority-low { 
  background: linear-gradient(135deg, #6c757d, #5a6268);
}

@keyframes priorityPulse {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.05); opacity: 0.9; }
}

@keyframes urgentPulse {
  0%, 100% { transform: scale(1); box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); }
  50% { transform: scale(1.05); box-shadow: 0 6px 25px rgba(220, 53, 69, 0.5); }
}

/* Notice Meta */
.notice-meta .meta-item {
  font-size: 0.95rem;
  color: #6c757d;
  padding: 0.5rem 0;
}

@media (max-width: 768px) {
  .notice-meta {
    flex-direction: column !important;
    gap: 0.5rem !important;
  }
}

/* Notice Actions */
.notice-actions .btn {
  padding: 12px 24px;
  border-radius: 25px;
  font-weight: 600;
}

/* Content Section */
.notice-content-section {
  background: white;
}

.notice-content-body {
  background: #f8f9fa;
  padding: 2rem;
  border-radius: 16px;
  border: 1px solid #e9ecef;
}

.content-wrapper {
  font-size: 1.1rem;
  line-height: 1.8;
  color: #495057;
}

.content-wrapper p {
  margin-bottom: 1.5rem;
}

/* Notice Footer */
.notice-footer {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 12px;
  margin-top: 2rem;
}

/* Backgrounds */
.bg-primary-gradient {
  background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

/* Newsletter Section */
.newsletter-section {
  position: relative;
  overflow: hidden;
}

.newsletter-section::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
}

/* Urgent Alert */
.urgent-notices-alert {
  animation: alertPulse 2s infinite;
}

@keyframes alertPulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.9; }
}

/* Responsive Design */
@media (max-width: 768px) {
  .notice-detail-hero {
    padding: 2rem 0;
  }
  
  .display-4 {
    font-size: 2rem;
  }
  
  .notice-content-body {
    padding: 1.5rem;
  }
  
  .newsletter-form .row {
    text-align: center;
  }
  
  .newsletter-form .col-md-4 {
    margin-top: 0.5rem;
  }
}

/* Print Styles */
@media print {
  .notice-actions,
  .urgent-notices-alert,
  .newsletter-section {
    display: none;
  }
  
  .notice-detail-hero {
    background: white !important;
    color: black !important;
  }
  
  .priority-indicator {
    border: 2px solid #000;
    background: white !important;
    color: black !important;
  }
}
</style>

<script>
// Share functionality
function shareNotice() {
  if (navigator.share) {
    navigator.share({
      title: '{{ $notice->title }}',
      text: '{{ $notice->excerpt }}',
      url: window.location.href
    });
  } else {
    // Fallback: copy to clipboard
    navigator.clipboard.writeText(window.location.href).then(() => {
      alert('Notice URL copied to clipboard!');
    });
  }
}

// Print functionality
function printNotice() {
  window.print();
}

// Reading progress indicator (optional enhancement)
document.addEventListener('DOMContentLoaded', function() {
  const progressBar = document.createElement('div');
  progressBar.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 3px;
    background: linear-gradient(90deg, #007bff, #28a745);
    z-index: 9999;
    transition: width 0.3s ease;
  `;
  document.body.appendChild(progressBar);

  window.addEventListener('scroll', function() {
    const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
    progressBar.style.width = scrolled + '%';
  });
});
</script>

@endsection
