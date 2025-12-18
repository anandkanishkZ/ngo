@extends('layouts.app')

@section('title', 'About JIDS Nepal - Our Story | JIDS Nepal')
@section('description', 'Learn about JIDS Nepal\'s mission, vision, and our work empowering communities in Udayapur since 1995 through sustainable development programs.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="min-height: 60vh;">
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">About <span class="text-warning">JIDS Nepal</span></h1>
                <p class="hero-subtitle">Empowering communities in Udayapur since 1995, creating sustainable change together.</p>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="section-title text-start">How JIDS Nepal Began</h2>
                    <p class="lead">JIDS Nepal was established in 1995 with a mission to empower marginalized communities and improve living standards through sustainable development programs.</p>
                    <p>Founded in Udayapur, Nepal, our organization emerged from a deep understanding of the challenges facing rural communities lacking access to basic services and facilities. We began as a grassroots initiative committed to creating an equitable society through community-led development.</p>
                    <p>Over nearly three decades, JIDS Nepal has grown into a respected development organization, working in partnership with World Vision International Nepal and other stakeholders to implement comprehensive programs in education, health, water and sanitation, environmental conservation, and income generation.</p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="JIDS Nepal Community Work" class="img-fluid rounded shadow-lg">
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
                        <p class="card-description">To create an equitable society by implementing programs in education, health, drinking water and sanitation, environmental conservation, and income generation for communities lacking access to basic services and facilities.</p>
                        <div class="mission-points mt-3">
                            <div class="point-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>Education and health programs</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>Water and sanitation access</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <small>Environmental conservation</small>
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
                        <p class="card-description">To build a healthy, prosperous, self-reliant, and equitable society.</p>
                        <div class="vision-points mt-3">
                            <div class="point-item">
                                <i class="fas fa-star text-warning me-2"></i>
                                <small>Healthy communities</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-star text-warning me-2"></i>
                                <small>Prosperous society</small>
                            </div>
                            <div class="point-item">
                                <i class="fas fa-star text-warning me-2"></i>
                                <small>Self-reliant and equitable</small>
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
                        <h3>Our Goal</h3>
                        <p class="card-description">To improve the living standards of the community.</p>
                        <div class="goals-list mt-3">
                            <div class="goal-item">
                                <span class="goal-number">1995</span>
                                <small>Serving since</small>
                            </div>
                            <div class="goal-item">
                                <span class="goal-number">Udayapur</span>
                                <small>Based in Nepal</small>
                            </div>
                            <div class="goal-item">
                                <span class="goal-number">100%</span>
                                <small>Community focused</small>
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
                <h2 class="section-title">Objectives of the Organization</h2>
                <p class="section-subtitle" style="font-size: 1.1rem; color: #666; max-width: 600px; margin: 0 auto;">
                    Our key objectives that guide our programs and drive sustainable development in marginalized communities.
                </p>
            </div>

            <div class="row g-4">
                <!-- Income Generation Objective -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <h4>Income Generation</h4>
                        <p>Implement income-generating and service-oriented programs for the upliftment of poor and marginalized groups.</p>
                        <div class="objective-target">
                            <span class="target-number">Programs</span>
                            <small class="text-muted">For marginalized groups</small>
                        </div>
                    </div>
                </div>

                <!-- Coordination Objective -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4>Partnership</h4>
                        <p>Expand coordination with national and international organizations to strengthen program effectiveness and reach.</p>
                        <div class="objective-target">
                            <span class="target-number">Global</span>
                            <small class="text-muted">Partnerships</small>
                        </div>
                    </div>
                </div>

                <!-- Community Development -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Community Leadership</h4>
                        <p>Improve living standards through income-generating and physical infrastructure development programs under community leadership.</p>
                        <div class="objective-target">
                            <span class="target-number">Community</span>
                            <small class="text-muted">Led development</small>
                        </div>
                    </div>
                </div>

                <!-- Health & Water -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <h4>Water & Health</h4>
                        <p>Reduce mortality from waterborne diseases through integrated drinking water, health, education, and sanitation programs.</p>
                        <div class="objective-target">
                            <span class="target-number">Integrated</span>
                            <small class="text-muted">WASH programs</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Objectives Row -->
            <div class="row g-4 mt-4">
                <!-- Environmental -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4>Environment</h4>
                        <p>Carry out environmentally friendly programs to maintain ecological balance in our communities.</p>
                        <div class="objective-target">
                            <span class="target-number">Eco</span>
                            <small class="text-muted">Friendly programs</small>
                        </div>
                    </div>
                </div>

                <!-- Child Rights -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-child"></i>
                        </div>
                        <h4>Child Rights</h4>
                        <p>Advocate for and implement programs to protect and promote child rights and welfare in our communities.</p>
                        <div class="objective-target">
                            <span class="target-number">Child</span>
                            <small class="text-muted">Protection & welfare</small>
                        </div>
                    </div>
                </div>

                <!-- Empowerment -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-female"></i>
                        </div>
                        <h4>Empowerment</h4>
                        <p>Run necessary programs for the empowerment of women, children, Dalits, and indigenous communities.</p>
                        <div class="objective-target">
                            <span class="target-number">Inclusive</span>
                            <small class="text-muted">Empowerment</small>
                        </div>
                    </div>
                </div>

                <!-- Community Development -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="800">
                    <div class="objective-card text-center h-100">
                        <div class="objective-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4>Other Activities</h4>
                        <p>Undertake other activities as needed for comprehensive community development and progress.</p>
                        <div class="objective-target">
                            <span class="target-number">Flexible</span>
                            <small class="text-muted">Development approach</small>
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

    <!-- Norms & Values Section -->
    <section class="norms-values-section section-padding" style="background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%); position: relative; overflow: hidden;">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="section-badge" style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(5, 150, 105, 0.1)); border-radius: 50px; margin-bottom: 20px;">
                    <span style="color: #2563eb; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Our Foundation</span>
                </div>
                <h2 class="modern-section-title" style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #1e3a8a, #2563eb); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 16px;">Norms & Values</h2>
                <p class="section-subtitle" style="font-size: 1.2rem; color: #666; max-width: 700px; margin: 0 auto; line-height: 1.6;">Our guiding principles that shape every decision we make and every action we take in serving communities.</p>
            </div>

            <!-- Values Grid -->
            <div class="row g-4">
                @php
                $values = [
                    ['icon' => 'fa-users', 'title' => 'Locality-based / Community-centered Approach', 'color' => '#2563eb'],
                    ['icon' => 'fa-scale-balanced', 'title' => 'Respect for Human Rights', 'color' => '#dc2626'],
                    ['icon' => 'fa-landmark', 'title' => 'Democratic Practices', 'color' => '#059669'],
                    ['icon' => 'fa-child', 'title' => 'Emphasis on the Participation of Children and Youth', 'color' => '#f59e0b'],
                    ['icon' => 'fa-shield-alt', 'title' => 'Good Governance', 'color' => '#7c3aed'],
                    ['icon' => 'fa-handshake', 'title' => 'Non-partisan and Non-sectarian', 'color' => '#0891b2'],
                    ['icon' => 'fa-chart-line', 'title' => 'Accountability and Transparency', 'color' => '#db2777'],
                    ['icon' => 'fa-hand-holding-heart', 'title' => 'Child Protection and Safeguarding', 'color' => '#ea580c'],
                    ['icon' => 'fa-heart', 'title' => 'Ethics and Integrity', 'color' => '#be123c'],
                    ['icon' => 'fa-hands-helping', 'title' => 'Partnership and Collaboration', 'color' => '#0d9488'],
                    ['icon' => 'fa-lightbulb', 'title' => 'Evidence-based and Learning-oriented Practices', 'color' => '#ca8a04'],
                    ['icon' => 'fa-venus-mars', 'title' => 'Gender Equality and Social Justice', 'color' => '#9333ea'],
                    ['icon' => 'fa-wheelchair', 'title' => 'Disability-inclusive / Disability-friendly Practices', 'color' => '#0369a1'],
                    ['icon' => 'fa-leaf', 'title' => 'Environmental Protection and Climate Justice', 'color' => '#15803d'],
                    ['icon' => 'fa-recycle', 'title' => 'Sustainability', 'color' => '#16a34a']
                ];
                @endphp

                @foreach($values as $index => $value)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 50) }}">
                        <div class="value-card" style="
                            background: white;
                            border-radius: 16px;
                            padding: 28px 24px;
                            display: flex;
                            align-items: flex-start;
                            gap: 20px;
                            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
                            border: 1px solid rgba(0,0,0,0.05);
                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                            height: 100%;
                            position: relative;
                            overflow: hidden;
                        "
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 35px rgba(0,0,0,0.12)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 20px rgba(0,0,0,0.08)'">
                            <!-- Left Border Accent -->
                            <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: {{ $value['color'] }}; border-radius: 4px 0 0 4px;"></div>
                            
                            <!-- Icon Container -->
                            <div class="value-icon" style="
                                flex-shrink: 0;
                                width: 50px;
                                height: 50px;
                                background: {{ $value['color'] }}15;
                                border-radius: 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                transition: all 0.3s ease;
                            ">
                                <i class="fas {{ $value['icon'] }}" style="font-size: 1.5rem; color: {{ $value['color'] }};"></i>
                            </div>
                            
                            <!-- Text Content -->
                            <div class="value-content" style="flex: 1;">
                                <h5 style="
                                    font-size: 1.05rem;
                                    font-weight: 600;
                                    color: #1e293b;
                                    margin: 0;
                                    line-height: 1.4;
                                ">{{ $value['title'] }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bottom Statement -->
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="800">
                <div style="max-width: 800px; margin: 0 auto; padding: 32px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 20px; border: 2px solid #bfdbfe;">
                    <p style="font-size: 1.15rem; color: #1e3a8a; font-weight: 500; margin: 0; line-height: 1.7;">
                        These core values guide our work and ensure that every action we take contributes to building a more just, equitable, and sustainable world for all.
                    </p>
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
                                        position: relative;"
                                 onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.12)'" 
                                 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.08)'"
                                 @if($partner->url)
                                     onclick="window.open('{{ $partner->url }}', '_blank')"
                                     style="cursor: pointer;"
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
