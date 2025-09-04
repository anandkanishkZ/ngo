@extends('layouts.app')

@section('title', 'About Us - Our Story | Hope Foundation')
@section('description', 'Learn about Hope Foundation\'s mission, vision, and the passionate team working to create positive change worldwide.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="min-height: 60vh;">
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">Our <span class="text-warning">Story</span></h1>
                <p class="hero-subtitle">Driven by compassion, united by purpose, creating lasting change together.</p>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="section-title text-start">How It All Began</h2>
                    <p class="lead">Hope Foundation was born from a simple yet powerful belief: that every person deserves the opportunity to live with dignity, hope, and purpose.</p>
                    <p>Founded in 2015 by a group of passionate individuals who witnessed firsthand the challenges facing communities around the world, our organization started with a mission to bridge the gap between those who want to help and those who need it most.</p>
                    <p>What began as a small grassroots initiative has grown into a global movement, touching lives across 15 countries and impacting thousands of individuals and families. Our journey has been one of learning, growth, and unwavering commitment to our core values.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Our Beginning" class="img-fluid rounded shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission, Vision & Goals Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Our Foundation</h2>
                <p class="section-subtitle" style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                    Driven by a clear purpose, guided by our vision, and focused on achieving measurable goals that create lasting impact.
                </p>
            </div>

            <div class="row g-4">
                <!-- Mission Card -->
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="foundation-card mission-card h-100">
                        <div class="icon-wrapper mb-4">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h3>Our Mission</h3>
                        <p class="card-description">To empower communities through sustainable programs that address education, healthcare, poverty, and environmental challenges, creating lasting positive change that transforms lives and builds stronger, more resilient societies.</p>
                        <div class="mission-points mt-3">
                            <div class="point-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>Sustainable community development</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>Education and capacity building</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>Healthcare accessibility</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Card -->
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="foundation-card vision-card h-100">
                        <div class="icon-wrapper mb-4">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3>Our Vision</h3>
                        <p class="card-description">A world where every individual has access to the resources, opportunities, and support they need to thrive. We envision communities that are self-sufficient, educated, healthy, and environmentally sustainable.</p>
                        <div class="vision-points mt-3">
                            <div class="point-item">
                                <i class="fas fa-star text-warning me-2"></i>
                                <small>Global equality and inclusion</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-star text-warning me-2"></i>
                                <small>Self-sufficient communities</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-star text-warning me-2"></i>
                                <small>Environmental sustainability</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Goals Card -->
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="foundation-card goals-card h-100">
                        <div class="icon-wrapper mb-4">
                            <i class="fas fa-target"></i>
                        </div>
                        <h3>Our Goals</h3>
                        <p class="card-description">Strategic objectives that guide our work and measure our impact, ensuring we create meaningful change in the communities we serve while maintaining accountability and transparency.</p>
                        <div class="goals-list mt-3">
                            <div class="goal-item">
                                <span class="goal-number">2030</span>
                                <small>Impact 100,000 lives globally</small>
                            </div>
                            <div class="goal-item">
                                <span class="goal-number">25+</span>
                                <small>Countries with active programs</small>
                            </div>
                            <div class="goal-item">
                                <span class="goal-number">100%</span>
                                <small>Transparent fund allocation</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Strategic Objectives Section -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Strategic Objectives</h2>
                <p class="section-subtitle" style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                    Our key focus areas that drive measurable impact and sustainable change in communities worldwide.
                </p>
            </div>

            <div class="row g-4">
                <!-- Education Objective -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Education Access</h4>
                        <p>Provide quality education and skill development programs to underserved communities, focusing on literacy, digital skills, and vocational training.</p>
                        <div class="objective-target">
                            <span class="target-number">50,000</span>
                            <small class="text-muted">Students by 2030</small>
                        </div>
                    </div>
                </div>

                <!-- Healthcare Objective -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h4>Healthcare Access</h4>
                        <p>Improve healthcare accessibility through mobile clinics, preventive care programs, and health education initiatives in remote areas.</p>
                        <div class="objective-target">
                            <span class="target-number">30,000</span>
                            <small class="text-muted">Lives impacted</small>
                        </div>
                    </div>
                </div>

                <!-- Economic Empowerment -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h4>Economic Growth</h4>
                        <p>Create sustainable livelihood opportunities through microfinance, entrepreneurship training, and community-based economic development projects.</p>
                        <div class="objective-target">
                            <span class="target-number">15,000</span>
                            <small class="text-muted">Entrepreneurs supported</small>
                        </div>
                    </div>
                </div>

                <!-- Environmental Sustainability -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4>Environmental Care</h4>
                        <p>Promote environmental conservation through reforestation, clean energy projects, and sustainable agriculture practices.</p>
                        <div class="objective-target">
                            <span class="target-number">1M+</span>
                            <small class="text-muted">Trees planted</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="section-padding">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Our Core Values</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="value-card text-center">
                        <div class="value-icon">
                            <i class="fas fa-heart text-danger"></i>
                        </div>
                        <h4>Compassion</h4>
                        <p>We approach every situation with empathy, understanding, and genuine care for those we serve.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-card text-center">
                        <div class="value-icon">
                            <i class="fas fa-handshake text-primary"></i>
                        </div>
                        <h4>Integrity</h4>
                        <p>We maintain the highest standards of honesty, transparency, and ethical conduct in all our operations.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-card text-center">
                        <div class="value-icon">
                            <i class="fas fa-users text-success"></i>
                        </div>
                        <h4>Collaboration</h4>
                        <p>We believe in the power of partnerships and work closely with local communities and organizations.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="value-card text-center">
                        <div class="value-icon">
                            <i class="fas fa-seedling text-warning"></i>
                        </div>
                        <h4>Sustainability</h4>
                        <p>We focus on creating long-term solutions that communities can maintain and build upon.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Trusted Partners Section -->
    <section class="partners-section section-padding bg-light">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Our Trusted Partners</h2>
                <p class="section-subtitle" style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                    Working together with leading organizations to amplify our impact and create meaningful change worldwide.
                </p>
            </div>

            <!-- Partners Grid -->
            @if($partners && $partners->count() > 0)
                <div class="row align-items-center justify-content-center g-4" data-aos="fade-up" data-aos-delay="100">
                    @foreach($partners as $index => $partner)
                        <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="partner-logo" 
                                 style="background: {{ $partner->background_color ?? 'white' }}; 
                                        border-radius: 15px; 
                                        padding: 2rem; 
                                        text-align: center; 
                                        box-shadow: 0 5px 20px rgba(0,0,0,0.08); 
                                        transition: all 0.3s ease; 
                                        height: 120px; 
                                        display: flex; 
                                        align-items: center; 
                                        justify-content: center;
                                        cursor: {{ $partner->website_url ? 'pointer' : 'default' }};"
                                 @if($partner->website_url)
                                     onclick="window.open('{{ $partner->website_url }}', '_blank')"
                                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'"
                                 @endif>
                                @if($partner->logo_url)
                                    <img src="{{ $partner->logo_url }}" 
                                         alt="{{ $partner->name }}" 
                                         style="max-width: 100%; 
                                                max-height: 60px; 
                                                filter: grayscale(100%); 
                                                transition: filter 0.3s ease;"
                                         onmouseover="this.style.filter='grayscale(0%)'"
                                         onmouseout="this.style.filter='grayscale(100%)'">
                                @else
                                    <div style="font-size: 1.2rem; font-weight: 600; color: #666; text-align: center; max-width: 100%;">
                                        {{ $partner->name }}
                                    </div>
                                @endif
                                @if($partner->featured)
                                    <div style="position: absolute; top: 10px; right: 10px;">
                                        <i class="fas fa-star" style="color: #f39c12; font-size: 14px;"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if(($index + 1) % 6 === 0 && !$loop->last)
                            </div>
                            <div class="row align-items-center justify-content-center g-4 mt-4">
                        @endif
                    @endforeach
                </div>
            @else
                <!-- Fallback content when no partners are available -->
                <div class="row align-items-center justify-content-center g-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="partner-logo-fallback">
                            <img src="https://via.placeholder.com/120x60/3498db/ffffff?text=UNICEF" alt="UNICEF">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="partner-logo-fallback">
                            <img src="https://via.placeholder.com/120x60/e74c3c/ffffff?text=WHO" alt="World Health Organization">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="partner-logo-fallback">
                            <img src="https://via.placeholder.com/120x60/27ae60/ffffff?text=UNESCO" alt="UNESCO">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="partner-logo-fallback">
                            <img src="https://via.placeholder.com/120x60/9b59b6/ffffff?text=Gates+Found" alt="Gates Foundation">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="partner-logo-fallback">
                            <img src="https://via.placeholder.com/120x60/f39c12/ffffff?text=Oxfam" alt="Oxfam">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="partner-logo-fallback">
                            <img src="https://via.placeholder.com/120x60/2c3e50/ffffff?text=UN+WFP" alt="UN World Food Programme">
                        </div>
                    </div>
                </div>
            @endif

            <!-- Call to Action for Partnership -->
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="700">
                <p class="text-muted mb-3" style="font-size: 1.1rem;">Interested in partnering with us to create greater impact?</p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-handshake me-2"></i>Become a Partner
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Foundation Cards (Mission, Vision, Goals) */
    .foundation-card {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }

    .foundation-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        transition: height 0.3s ease;
    }

    .foundation-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    .foundation-card:hover::before {
        height: 6px;
    }

    .foundation-card .icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .foundation-card h3 {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        text-align: center;
    }

    .foundation-card .card-description {
        color: #666;
        line-height: 1.7;
        font-size: 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    /* Mission Card Specific */
    .mission-card .icon-wrapper {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    .mission-points .point-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: #666;
    }

    /* Vision Card Specific */
    .vision-card .icon-wrapper {
        background: linear-gradient(135deg, #3498db, #2980b9);
    }

    .vision-points .point-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: #666;
    }

    /* Goals Card Specific */
    .goals-card .icon-wrapper {
        background: linear-gradient(135deg, #27ae60, #229954);
    }

    .goals-list .goal-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.8rem;
        padding: 0.5rem;
        background: rgba(0,0,0,0.03);
        border-radius: 8px;
    }

    .goal-number {
        font-weight: 700;
        color: var(--secondary-color);
        font-size: 1.1rem;
    }

    .goal-item small {
        color: #666;
        font-size: 0.85rem;
    }

    /* Strategic Objectives */
    .objective-card {
        background: white;
        padding: 2.5rem 2rem;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
        overflow: hidden;
    }

    .objective-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .objective-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .objective-card:hover::before {
        transform: scaleX(1);
    }

    .objective-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(44, 62, 80, 0.1), rgba(231, 76, 60, 0.1));
        border-radius: 50%;
        position: relative;
    }

    .objective-icon i {
        font-size: 1.8rem;
        color: var(--primary-color);
    }

    .objective-card h4 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }

    .objective-card p {
        color: #666;
        line-height: 1.6;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }

    .objective-target {
        border-top: 2px solid rgba(0,0,0,0.05);
        padding-top: 1rem;
        margin-top: 1.5rem;
    }

    .target-number {
        display: block;
        font-size: 2rem;
        font-weight: 700;
        color: var(--secondary-color);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .value-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
    }

    .value-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .value-icon {
        width: 70px;
        height: 70px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.05);
        border-radius: 50%;
    }

    .value-icon i {
        font-size: 1.8rem;
    }

    /* Partners Section Styles */
    .partners-section {
        background: #f8f9fa;
    }

    .partner-logo {
        position: relative;
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .partner-logo:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .partner-logo img {
        max-width: 100%;
        max-height: 60px;
        filter: grayscale(100%);
        transition: filter 0.3s ease;
    }

    .partner-logo:hover img {
        filter: grayscale(0%);
    }

    .partner-logo-fallback {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .partner-logo-fallback:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .partner-logo-fallback img {
        max-width: 100%;
        max-height: 60px;
        filter: grayscale(100%);
        transition: filter 0.3s ease;
    }

    .partner-logo-fallback:hover img {
        filter: grayscale(0%);
    }

    @media (max-width: 768px) {
        .foundation-card {
            padding: 2rem 1.5rem;
        }
        
        .foundation-card .icon-wrapper {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .objective-card {
            padding: 2rem 1.5rem;
        }
        
        .objective-icon {
            width: 60px;
            height: 60px;
        }
        
        .objective-icon i {
            font-size: 1.5rem;
        }
        
        .target-number {
            font-size: 1.8rem;
        }
        
        .partner-logo, .partner-logo-fallback {
            height: 100px;
            padding: 1.5rem;
        }
        
        .partner-logo img, .partner-logo-fallback img {
            max-height: 50px;
        }
        
        .cta-buttons .btn {
            display: block;
            width: 100%;
            margin: 0.5rem 0;
        }
    }

    @media (max-width: 576px) {
        .foundation-card {
            padding: 1.5rem;
        }
        
        .foundation-card h3 {
            font-size: 1.3rem;
        }
        
        .objective-card {
            padding: 1.5rem;
        }
        
        .objective-card h4 {
            font-size: 1.2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }
</style>
@endpush
