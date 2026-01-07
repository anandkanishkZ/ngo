@extends('layouts.app')

@section('title', 'Our Team | Hope Foundation')

@section('content')
<section class="section-padding">
  <div class="container">
    @if($teamMembers->isEmpty())
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="empty-state">
            <div class="empty-icon">
              <i class="fas fa-users"></i>
            </div>
            <h4 class="empty-title">Team Information Coming Soon</h4>
            <p class="empty-text">We're currently updating our team information. Please check back soon!</p>
          </div>
        </div>
      </div>
    @else
      <!-- Featured Members Section -->
      @php $featuredMembers = $teamMembers->where('featured', true); @endphp
      @if($featuredMembers->count() > 0)
        <div class="mb-5">
          <div class="text-center mb-4">
            <h2 class="section-title">Leadership Team</h2>
            <p class="text-muted">Guiding our organization with vision and dedication</p>
          </div>
          <div class="row justify-content-center">
            @foreach($featuredMembers as $member)
              <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="team-card featured">
                  <div class="card-image">
                    @if($member->image_url)
                      <img src="{{ $member->image_url }}" alt="{{ $member->name }}">
                    @else
                      <div class="image-placeholder">
                        <i class="fas fa-user"></i>
                      </div>
                    @endif
                    <div class="card-overlay">
                      <div class="social-links">
                        @if($member->linkedin_url)
                          <a href="{{ $member->linkedin_url }}" target="_blank" class="social-link linkedin" title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                          </a>
                        @endif
                        @if($member->twitter_url)
                          <a href="{{ $member->twitter_url }}" target="_blank" class="social-link twitter" title="Twitter">
                            <i class="fab fa-twitter"></i>
                          </a>
                        @endif
                        @if($member->facebook_url)
                          <a href="{{ $member->facebook_url }}" target="_blank" class="social-link facebook" title="Facebook">
                            <i class="fab fa-facebook"></i>
                          </a>
                        @endif
                        @if($member->email)
                          <a href="mailto:{{ $member->email }}" class="social-link email" title="Email">
                            <i class="fas fa-envelope"></i>
                          </a>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="card-content">
                    <h5 class="member-name">{{ $member->name }}</h5>
                    <p class="member-position">{{ $member->position }}</p>
                    @if($member->department)
                      <span class="department-badge">{{ ucfirst($member->department) }}</span>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @endif

      <!-- All Team Members Section -->
      <div class="mb-5">
        <div class="text-center mb-4">
          <h2 class="section-title">Our Team</h2>
          <p class="text-muted">The dedicated professionals making a difference</p>
        </div>
        <div class="row">
          @foreach($teamMembers as $member)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
              <div class="team-card">
                <div class="card-image">
                  @if($member->image_url)
                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}">
                  @else
                    <div class="image-placeholder">
                      <i class="fas fa-user"></i>
                    </div>
                  @endif
                  <div class="card-overlay">
                    <div class="social-links">
                      @if($member->linkedin_url)
                        <a href="{{ $member->linkedin_url }}" target="_blank" class="social-link linkedin" title="LinkedIn">
                          <i class="fab fa-linkedin"></i>
                        </a>
                      @endif
                      @if($member->twitter_url)
                        <a href="{{ $member->twitter_url }}" target="_blank" class="social-link twitter" title="Twitter">
                          <i class="fab fa-twitter"></i>
                        </a>
                      @endif
                      @if($member->facebook_url)
                        <a href="{{ $member->facebook_url }}" target="_blank" class="social-link facebook" title="Facebook">
                          <i class="fab fa-facebook"></i>
                        </a>
                      @endif
                      @if($member->email)
                        <a href="mailto:{{ $member->email }}" class="social-link email" title="Email">
                          <i class="fas fa-envelope"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="card-content">
                  <h5 class="member-name">{{ $member->name }}</h5>
                  <p class="member-position">{{ $member->position }}</p>
                  @if($member->department)
                    <span class="department-badge">{{ ucfirst($member->department) }}</span>
                  @endif
                  @if($member->bio)
                    <p class="member-bio">{{ Str::limit($member->bio, 80) }}</p>
                  @endif
                  @if($member->achievements)
                    <div class="achievements">
                      <small class="achievements-text">
                        <strong>Key Achievements:</strong><br>
                        {{ Str::limit($member->achievements, 60) }}
                      </small>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>

<style>
/* Header Styling */
.divider {
  width: 80px;
  height: 4px;
  background: linear-gradient(135deg, #007bff, #0056b3);
  border-radius: 2px;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: #212529;
  margin-bottom: 1rem;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  background: #f8f9fa;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.empty-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #e9ecef, #dee2e6);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
}

.empty-icon i {
  font-size: 2rem;
  color: #6c757d;
}

.empty-title {
  color: #495057;
  font-weight: 600;
  margin-bottom: 1rem;
}

.empty-text {
  color: #6c757d;
  margin: 0;
}

/* Team Card Base Styles */
.team-card {
  background: #ffffff;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  position: relative;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.team-card:hover {
  transform: translateY(-12px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.team-card.featured {
  border: 3px solid transparent;
  background: linear-gradient(white, white) padding-box,
              linear-gradient(135deg, #007bff, #0056b3) border-box;
}

/* Card Image Section */
.card-image {
  position: relative;
  height: 350px;
  overflow: hidden;
}

.card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.team-card:hover .card-image img {
  transform: scale(1.08);
}

.image-placeholder {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #f8f9fa, #e9ecef);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #6c757d;
}

.image-placeholder i {
  font-size: 2.5rem;
}

/* Card Overlay */
.card-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  pointer-events: none;
}

.team-card:hover .card-overlay {
  opacity: 0;
}

/* Social Links */
.social-links {
  display: flex;
  gap: 0.8rem;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.social-link {
  width: 42px;
  height: 42px;
  background: rgba(255, 255, 255, 0.2);
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  text-decoration: none;
  transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  backdrop-filter: blur(10px);
  transform: translateY(20px);
}

.team-card:hover .social-link {
  transform: translateY(0);
}

.social-link:hover {
  background: rgba(255, 255, 255, 0.3);
  border-color: rgba(255, 255, 255, 0.5);
  color: white;
  transform: scale(1.1) translateY(-3px);
}

.social-link i {
  font-size: 1.1rem;
}

/* Staggered animation for social links */
.social-link:nth-child(1) { transition-delay: 0.1s; }
.social-link:nth-child(2) { transition-delay: 0.2s; }
.social-link:nth-child(3) { transition-delay: 0.3s; }
.social-link:nth-child(4) { transition-delay: 0.4s; }

/* Card Content */
.card-content {
  padding: 1.5rem;
  text-align: center;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.member-name {
  font-size: 1.3rem;
  font-weight: 700;
  color: #212529;
  margin-bottom: 0.4rem;
  line-height: 1.2;
}

.member-position {
  color: #007bff;
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0.8rem;
  line-height: 1.3;
}

.department-badge {
  display: inline-block;
  padding: 0.4rem 0.8rem;
  background: linear-gradient(135deg, #e3f2fd, #bbdefb);
  color: #1565c0;
  border-radius: 15px;
  font-size: 0.8rem;
  font-weight: 600;
  margin-bottom: 0.8rem;
}

.member-bio {
  color: #6c757d;
  font-size: 0.9rem;
  line-height: 1.5;
  margin-bottom: 0.8rem;
}

.achievements {
  margin-top: 0.8rem;
  padding: 0.8rem;
  background: #f8f9fa;
  border-radius: 10px;
  border-left: 3px solid #007bff;
}

.achievements-text {
  color: #495057;
  font-size: 0.85rem;
  line-height: 1.4;
}

.achievements-text strong {
  color: #212529;
}

/* Responsive Design */
@media (max-width: 1200px) {
  /* Large screens: still 4 cards per row */
}

@media (max-width: 992px) {
  /* Medium screens: 3 cards per row */
  .section-title {
    font-size: 2.2rem;
  }
  
  .card-image {
    height: 320px;
  }
  
  .card-content {
    padding: 1.3rem;
  }
  
  .member-name {
    font-size: 1.2rem;
  }
  
  .social-link {
    width: 38px;
    height: 38px;
  }
  
  .social-links {
    gap: 0.6rem;
  }
}

@media (max-width: 768px) {
  /* Small screens: 2 cards per row */
  .section-title {
    font-size: 2rem;
  }
  
  .card-image {
    height: 300px;
  }
  
  .card-content {
    padding: 1.2rem;
  }
  
  .member-name {
    font-size: 1.1rem;
  }
  
  .member-position {
    font-size: 0.95rem;
  }
  
  .social-link {
    width: 36px;
    height: 36px;
  }
  
  .social-links {
    gap: 0.5rem;
  }
  
  .social-link i {
    font-size: 1rem;
  }
}

@media (max-width: 576px) {
  /* Extra small screens: 1 card per row */
  .card-image {
    height: 280px;
  }
  
  .card-content {
    padding: 1rem;
  }
  
  .member-name {
    font-size: 1rem;
  }
  
  .member-position {
    font-size: 0.9rem;
  }
  
  .social-link {
    width: 34px;
    height: 34px;
  }
  
  .social-link i {
    font-size: 0.9rem;
  }
}

/* Animation keyframes */
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

.team-card {
  animation: fadeInUp 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
}

/* Staggered animation for cards */
.team-card:nth-child(1) { animation-delay: 0.1s; opacity: 0; }
.team-card:nth-child(2) { animation-delay: 0.2s; opacity: 0; }
.team-card:nth-child(3) { animation-delay: 0.3s; opacity: 0; }
.team-card:nth-child(4) { animation-delay: 0.4s; opacity: 0; }
.team-card:nth-child(5) { animation-delay: 0.5s; opacity: 0; }
.team-card:nth-child(6) { animation-delay: 0.6s; opacity: 0; }
</style>

@endsection
