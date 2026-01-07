@extends('layouts.app')
@php use Illuminate\Support\Facades\Storage; use Illuminate\Support\Str; use Illuminate\Support\Facades\File; @endphp

@section('title', 'JIDS Nepal - Empowering Communities Since 1995')
@section('description', 'Jalpa Integrated Development Society (JIDS) is a non-profit organization in Udayapur, Nepal, working to uplift marginalized families through education, health, and community development since 1995.')

@section('content')
    <!-- Hero Section (Dynamic Slider) -->
    <section class="hero-section p-0">
        <div class="hero-slider">
            @forelse(($heroSlides ?? collect()) as $slide)
                @php
                    $overlay = "linear-gradient(135deg, {$slide->overlay_from}, {$slide->overlay_to})";
                    $hMap = ['left'=>'flex-start','center'=>'center','right'=>'flex-end'];
                    $vMap = ['top'=>'flex-start','center'=>'center','bottom'=>'flex-end'];
                    
                    // Use model accessor for clean, production-ready URL
                    $bgStyle = $slide->background_image_url ? "background-image: url('{$slide->background_image_url}');" : '';
                @endphp
                <div class="hero-slide" style="--overlay: {{ $overlay }}; --overlay-opacity: {{ $slide->overlay_opacity }}; {{ $bgStyle }}">
                                        <div class="container d-flex" style="position:relative; z-index:3; height:100%; align-items: {{ $vMap[$slide->content_y ?? 'center'] }}; justify-content: {{ $hMap[$slide->content_x ?? 'center'] }};">
                                                <div class="hero-content text-{{ ($slide->content_x ?? 'center') === 'left' ? 'start' : ((($slide->content_x ?? 'center') === 'right') ? 'end' : 'center') }}" data-aos="fade-up">
                            @if($slide->title_url)
                                <h1 class="hero-title" style="color: {{ $slide->title_color }}; font-size: {{ $slide->title_size }};">
                                    <a href="{{ $slide->title_url }}" style="color: inherit; text-decoration: none; transition: opacity 0.3s ease;" 
                                       onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'">
                                        {!! nl2br(e($slide->title)) !!}
                                    </a>
                                </h1>
                            @else
                                <h1 class="hero-title" style="color: {{ $slide->title_color }}; font-size: {{ $slide->title_size }};">{!! nl2br(e($slide->title)) !!}</h1>
                            @endif
                            @if($slide->subtitle)
                              <p class="hero-subtitle" style="color: {{ $slide->subtitle_color }}; font-size: {{ $slide->subtitle_size }};">{{ $slide->subtitle }}</p>
                            @endif
                            <div class="hero-buttons">
                                @if($slide->button1_text && $slide->button1_url)
                                  <a href="{{ $slide->button1_url }}" class="btn btn-{{ $slide->button1_style === 'outline' ? 'secondary' : 'primary' }} btn-lg">{{ $slide->button1_text }}</a>
                                @endif
                                @if($slide->button2_text && $slide->button2_url)
                                  <a href="{{ $slide->button2_url }}" class="btn btn-{{ $slide->button2_style === 'outline' ? 'secondary' : 'primary' }} btn-lg">{{ $slide->button2_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="hero-slide" style="--overlay: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); --overlay-opacity: .55;">
                    <div class="container">
                        <div class="hero-content" data-aos="fade-up">
                            <h1 class="hero-title">Empowering Communities <br><span class="text-warning">Since 1995</span></h1>
                            <p class="hero-subtitle">Join JIDS Nepal in creating lasting change in Udayapur and beyond through education, health, nutrition, and community development programs.</p>
                            <div class="hero-buttons">
                                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Get Involved</a>
                                <a href="{{ route('about') }}" class="btn btn-secondary btn-lg">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Floating Elements -->
        <div class="floating-elements">
            <div class="float-1"></div>
            <div class="float-2"></div>
            <div class="float-3"></div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                @forelse($statistics as $index => $statistic)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}">
                            <div class="stat-number" data-target="{{ $statistic->value }}" style="color: {{ $statistic->color }};">0</div>
                            <div class="stat-label">{{ $statistic->label }}</div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback to default statistics if none are configured -->
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="stat-number" data-target="1250">0</div>
                            <div class="stat-label">Lives Impacted</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="stat-number" data-target="{{ $totalDonors ?? 85 }}">0</div>
                            <div class="stat-label">Generous Donors</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="stat-number" data-target="42">0</div>
                            <div class="stat-label">Active Projects</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="stat-number" data-target="15">0</div>
                            <div class="stat-label">Countries Served</div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4" data-aos="fade-right">
                    <h2 class="section-title text-start">About JIDS Nepal</h2>
                    <p class="lead mb-4">Jalpa Integrated Development Society (JIDS) is a non-profit social organization based in Udayapur, Nepal, dedicated to uplifting marginalized communities since 1995.</p>
                    <p>We work tirelessly to improve the lives of poor, marginalized families and children by enhancing education, health, nutrition, livelihood opportunities, water and sanitation access, disaster resilience, and climate change adaptation throughout Nepal.</p>
                    <p>Through strategic community mobilization and partnerships with local governments, national and international organizations—including World Vision International Nepal—we empower adolescents, protect children from abuse, discrimination, and violence, and advocate for inclusive and equitable development.</p>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-3 fs-4"></i>
                                <span>Community Mobilization</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-3 fs-4"></i>
                                <span>Child Protection</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-3 fs-4"></i>
                                <span>International Partnerships</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-check-circle text-success me-3 fs-4"></i>
                                <span>Climate Adaptation</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary mt-3">Read Our Story</a>
                </div>
                <div class="col-lg-6">
                    <div class="about-image-wrapper position-relative" style="overflow: hidden; border-radius: 12px; background: #f0f0f0; min-height: 400px; display: flex; align-items: center; justify-content: center;" data-aos="fade-left">
                        <img src="{{ asset('images/photo-jids.jpg') }}" alt="JIDS Nepal - About Us" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);" loading="lazy" decoding="async">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(37, 99, 235, 0.08), transparent); pointer-events: none; border-radius: 12px;"></div>
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
                                <h3 style="
                                    font-size: 1.05rem;
                                    font-weight: 600;
                                    color: #1e293b;
                                    margin: 0;
                                    line-height: 1.4;
                                ">{{ $value['title'] }}</h3>
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

    <!-- Our Impact Section -->
    <section class="modern-impact-section section-padding" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f1f3f4 100%); position: relative; overflow: hidden;">
        <!-- Background Elements -->
        <div class="impact-bg-elements">
            <div class="bg-shape bg-shape-1" style="position: absolute; top: 10%; right: 5%; width: 100px; height: 100px; background: linear-gradient(45deg, rgba(52, 152, 219, 0.1), rgba(155, 89, 182, 0.1)); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
            <div class="bg-shape bg-shape-2" style="position: absolute; bottom: 15%; left: 8%; width: 80px; height: 80px; background: linear-gradient(45deg, rgba(231, 76, 60, 0.1), rgba(243, 156, 18, 0.1)); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
            <div class="bg-shape bg-shape-3" style="position: absolute; top: 50%; left: 3%; width: 60px; height: 60px; background: linear-gradient(45deg, rgba(46, 204, 113, 0.1), rgba(26, 188, 156, 0.1)); border-radius: 50%; animation: float 7s ease-in-out infinite;"></div>
        </div>

        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="section-badge" style="display: inline-block; padding: 8px 24px; background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(155, 89, 182, 0.1)); border-radius: 50px; margin-bottom: 20px;">
                    <span style="color: #3498db; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Making a Difference</span>
                </div>
                <h2 class="modern-section-title" style="font-size: 3rem; font-weight: 800; background: linear-gradient(135deg, #2c3e50, #3498db); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 16px;">Thematic Areas</h2>
                <p class="section-subtitle" style="font-size: 1.2rem; color: #666; max-width: 600px; margin: 0 auto; line-height: 1.6;">Discover how we're creating lasting change across multiple sectors, empowering communities and building a better tomorrow for everyone.</p>
            </div>

            <!-- Impact Areas Grid -->
            <div class="row g-4">
                @forelse($impactAreas as $index => $area)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ 150 + ($index * 100) }}">
                        <div class="modern-impact-card" style="
                            background: white; 
                            border-radius: 20px; 
                            padding: 40px 30px; 
                            text-align: center; 
                            box-shadow: 0 10px 40px rgba(0,0,0,0.08); 
                            border: 1px solid rgba(255,255,255,0.8); 
                            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); 
                            position: relative; 
                            overflow: hidden;
                            height: 100%;
                        ">
                            <!-- Card Background Gradient -->
                            <div class="card-bg-gradient" style="
                                position: absolute; 
                                top: 0; 
                                left: 0; 
                                right: 0; 
                                height: 6px; 
                                background: linear-gradient(90deg, {{ $area->color }}, {{ $area->color }}99);
                                opacity: 0;
                                transition: opacity 0.3s ease;
                            "></div>
                            
                            <!-- Icon Container -->
                            <div class="icon-container" style="
                                position: relative; 
                                margin-bottom: 24px;
                            ">
                                <div class="icon-bg" style="
                                    position: absolute; 
                                    top: 50%; 
                                    left: 50%; 
                                    transform: translate(-50%, -50%); 
                                    width: 90px; 
                                    height: 90px; 
                                    background: linear-gradient(135deg, {{ $area->color }}15, {{ $area->color }}25); 
                                    border-radius: 50%; 
                                    transition: all 0.4s ease;
                                "></div>
                                @if($area->icon)
                                    <i class="{{ $area->icon }}" style="
                                        font-size: 3rem; 
                                        color: {{ $area->color }}; 
                                        position: relative; 
                                        z-index: 2; 
                                        transition: all 0.4s ease;
                                    "></i>
                                @else
                                    <div style="
                                        width: 60px; 
                                        height: 60px; 
                                        background: {{ $area->color }}; 
                                        border-radius: 50%; 
                                        display: inline-flex; 
                                        align-items: center; 
                                        justify-content: center; 
                                        position: relative; 
                                        z-index: 2;
                                    ">
                                        <i class="fa-solid fa-question fa-2x text-white"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="card-content">
                                <h4 style="
                                    font-size: 1.5rem; 
                                    font-weight: 700; 
                                    color: #2c3e50; 
                                    margin-bottom: 16px; 
                                    transition: color 0.3s ease;
                                ">{{ $area->title }}</h4>
                                <p style="
                                    color: #666; 
                                    line-height: 1.6; 
                                    font-size: 1rem; 
                                    margin-bottom: 0;
                                ">{{ $area->description }}</p>
                            </div>

                            <!-- Hover Effect Overlay -->
                            <div class="hover-overlay" style="
                                position: absolute; 
                                bottom: 0; 
                                left: 0; 
                                right: 0; 
                                height: 4px; 
                                background: linear-gradient(90deg, {{ $area->color }}, {{ $area->color }}cc); 
                                transform: scaleX(0); 
                                transition: transform 0.4s ease;
                            "></div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback to default impact areas if none are configured -->
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="150">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #3498db15, #3498db25); border-radius: 50%;"></div>
                                <i class="fas fa-graduation-cap" style="font-size: 3rem; color: #3498db; position: relative; z-index: 2;"></i>
                            </div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Education</h3>
                            <p style="color: #666; line-height: 1.6;">Providing quality education and learning opportunities to underserved communities, building brighter futures for children worldwide.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="250">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #e74c3c15, #e74c3c25); border-radius: 50%;"></div>
                                <i class="fas fa-heartbeat" style="font-size: 3rem; color: #e74c3c; position: relative; z-index: 2;"></i>
                            </div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Healthcare</h3>
                            <p style="color: #666; line-height: 1.6;">Delivering essential medical care and health education to communities lacking access to basic healthcare services.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="350">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #27ae6015, #27ae6025); border-radius: 50%;"></div>
                                <i class="fas fa-leaf" style="font-size: 3rem; color: #27ae60; position: relative; z-index: 2;"></i>
                            </div>
                            <h3 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Environment</h3>
                            <p style="color: #666; line-height: 1.6;">Protecting our planet through conservation efforts, sustainable practices, and environmental education programs.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="450">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #17a2b815, #17a2b825); border-radius: 50%;"></div>
                                <i class="fas fa-home" style="font-size: 3rem; color: #17a2b8; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Housing</h4>
                            <p style="color: #666; line-height: 1.6;">Building safe, affordable housing solutions and supporting families in creating stable, secure homes.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="550">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #f39c1215, #f39c1225); border-radius: 50%;"></div>
                                <i class="fas fa-utensils" style="font-size: 3rem; color: #f39c12; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Nutrition</h4>
                            <p style="color: #666; line-height: 1.6;">Fighting hunger and malnutrition by providing nutritious meals and teaching sustainable food production methods.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="650">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #6c757d15, #6c757d25); border-radius: 50%;"></div>
                                <i class="fas fa-hands-helping" style="font-size: 3rem; color: #6c757d; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Community</h4>
                            <p style="color: #666; line-height: 1.6;">Strengthening communities through capacity building, leadership development, and collaborative partnerships.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Events section removed -->

    <!-- Partners & Sponsors Section -->
    <section class="partners-section section-padding" style="background: #f8f9fa;">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="modern-section-title" style="font-size: 2.5rem; font-weight: 800; color: #2c3e50; margin-bottom: 16px;">Our Trusted Partners</h2>
                <p class="section-subtitle" style="font-size: 1.1rem; color: #666; max-width: 500px; margin: 0 auto;">Working together with leading organizations to amplify our impact worldwide.</p>
            </div>

            <!-- Partners Grid -->
            @if($partners && $partners->count() > 0)
                <div class="row align-items-center justify-content-center g-4">
                    @foreach($partners as $index => $partner)
                        <div class="col-lg-2 col-md-3 col-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="partner-logo" 
                                 style="background: {{ $partner->background_color ?? 'white' }}; 
                                        border-radius: 15px; 
                                        padding: 2rem; 
                                        text-align: center; 
                                        box-shadow: 0 5px 20px rgba(0,0,0,0.05); 
                                        transition: all 0.3s ease; 
                                        height: 120px; 
                                        display: flex; 
                                        align-items: center; 
                                        justify-content: center;
                                        cursor: {{ $partner->website_url ? 'pointer' : 'default' }};"
                                 @if($partner->website_url)
                                     onclick="window.open('{{ $partner->website_url }}', '_blank')"
                                     onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.12)'"
                                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 20px rgba(0,0,0,0.05)'"
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
                <div class="row align-items-center justify-content-center g-4">
                    <!-- Hide fallback partners if there are actual partners -->
                    <div class="col-12 text-center text-muted py-5">
                        <p>We're proud to collaborate with various organizations. Partner logos will appear here once configured.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Newsletter Subscription Section - Horizontal Design -->
    <section class="newsletter-section horizontal-newsletter" 
             style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); 
                    padding: 60px 0; position: relative; overflow: hidden;">
        
        <!-- Background Pattern -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; 
                    background-image: radial-gradient(circle at 20px 20px, rgba(148, 163, 184, 0.1) 1px, transparent 0);
                    background-size: 40px 40px; opacity: 0.5;"></div>
        
        <div class="container" style="position: relative; z-index: 10;">
            <!-- Horizontal Newsletter Layout -->
            <div class="horizontal-newsletter-container" 
                 style="background: white; border-radius: 20px; 
                        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.1);
                        border: 1px solid #e2e8f0; overflow: hidden;">
                
                <div class="row align-items-center g-0">
                    <!-- Left Side - Content -->
                    <div class="col-lg-6" data-aos="fade-right">
                        <div style="padding: 50px 60px;">
                            <!-- Header -->
                            <div class="mb-4">
                                <div style="display: inline-flex; align-items: center; 
                                           background: #ecfdf5; color: #059669; 
                                           padding: 8px 16px; border-radius: 50px; 
                                           font-size: 12px; font-weight: 600; 
                                           text-transform: uppercase; letter-spacing: 1px;
                                           margin-bottom: 20px;">
                                    <div style="width: 8px; height: 8px; background: #10b981; 
                                               border-radius: 50%; margin-right: 8px;
                                               animation: pulse 2s infinite;"></div>
                                    Newsletter
                                </div>
                                
                                <h2 style="font-size: 2.8rem; font-weight: 800; color: #1e293b; 
                                           margin-bottom: 16px; line-height: 1.2;">
                                    Stay in the Loop
                                </h2>
                                
                                <p style="font-size: 1.1rem; color: #64748b; 
                                          line-height: 1.6; margin: 0;">
                                    Get exclusive updates on our impact, upcoming events, and ways to make a difference in your community.
                                </p>
                            </div>
                            
                            <!-- Benefits List -->
                            <div class="benefits-list">
                                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                    <div style="width: 20px; height: 20px; background: #10b981; 
                                               border-radius: 50%; display: flex; align-items: center; 
                                               justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                        <i class="fas fa-check" style="color: white; font-size: 10px;"></i>
                                    </div>
                                    <span style="color: #374151; font-weight: 500; font-size: 15px;">
                                        Monthly impact reports
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; margin-bottom: 12px;">
                                    <div style="width: 20px; height: 20px; background: #10b981; 
                                               border-radius: 50%; display: flex; align-items: center; 
                                               justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                        <i class="fas fa-check" style="color: white; font-size: 10px;"></i>
                                    </div>
                                    <span style="color: #374151; font-weight: 500; font-size: 15px;">
                                        Exclusive event invitations
                                    </span>
                                </div>
                                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                                    <div style="width: 20px; height: 20px; background: #10b981; 
                                               border-radius: 50%; display: flex; align-items: center; 
                                               justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                        <i class="fas fa-check" style="color: white; font-size: 10px;"></i>
                                    </div>
                                    <span style="color: #374151; font-weight: 500; font-size: 15px;">
                                        Success stories from the field
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Form -->
                    <div class="col-lg-6" data-aos="fade-left">
                        <div style="background: linear-gradient(135deg, #059669 0%, #047857 100%); 
                                    padding: 50px 60px; height: 100%; display: flex; 
                                    flex-direction: column; justify-content: center; position: relative;">
                            
                            <!-- Decorative Elements -->
                            <div style="position: absolute; top: 20px; right: 20px; 
                                        width: 100px; height: 100px; 
                                        background: rgba(255,255,255,0.1); 
                                        border-radius: 50%; opacity: 0.3;"></div>
                            <div style="position: absolute; bottom: 30px; left: 30px; 
                                        width: 60px; height: 60px; 
                                        background: rgba(255,255,255,0.08); 
                                        border-radius: 50%; opacity: 0.5;"></div>
                            
                            <!-- Form Header -->
                            <div class="text-center mb-4" style="position: relative; z-index: 2;">
                                <h3 style="color: white; font-weight: 700; font-size: 1.5rem; 
                                           margin-bottom: 8px;">
                                    Subscribe Today
                                </h3>
                                <p style="color: rgba(255,255,255,0.8); margin: 0; font-size: 15px;">
                                    Join our community of changemakers
                                </p>
                            </div>
                            
                            <!-- Horizontal Form -->
                            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="horizontal-form" novalidate 
                                  style="position: relative; z-index: 2;" id="newsletter-form">
                                @csrf
                                
                                <!-- Email Input with Button -->
                                <div class="horizontal-input-group" style="position: relative;">
                                    <div class="input-container" style="display: flex; background: white; border-radius: 28px; 
                                               padding: 6px; box-shadow: 0 12px 40px rgba(0,0,0,0.15);
                                               border: 3px solid rgba(255,255,255,0.3); position: relative;">
                                        <input type="email" name="email" class="horizontal-input" 
                                               placeholder="Enter your email address" 
                                               style="flex: 1; background: transparent; border: none; 
                                                      padding: 18px 28px; font-size: 16px; color: #1f2937; 
                                                      font-weight: 500; outline: none; border-radius: 22px;
                                                      line-height: 1.2;">
                                        <button type="submit" class="horizontal-submit-btn" 
                                                style="background: linear-gradient(135deg, #10b981, #059669); 
                                                       color: white; border: none; padding: 18px 36px; 
                                                       border-radius: 22px; font-weight: 700; font-size: 16px;
                                                       transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
                                                       white-space: nowrap; box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
                                                       display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-paper-plane me-2"></i>Subscribe
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Enhanced Consent Checkbox -->
                                <div class="mt-4">
                                    <div class="enhanced-checkbox" style="display: flex; align-items: flex-start; padding: 0;">
                                        <div class="checkbox-wrapper" style="position: relative; margin-top: 2px; margin-right: 12px;">
                                            <input class="custom-checkbox" type="checkbox" id="horizontal-consent"
                                                   style="appearance: none; width: 20px; height: 20px; 
                                                          background: rgba(255,255,255,0.2); border: 2px solid rgba(255,255,255,0.4); 
                                                          border-radius: 6px; position: relative; cursor: pointer; 
                                                          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                                            <div class="checkbox-checkmark" style="position: absolute; top: 50%; left: 50%; 
                                                                                   transform: translate(-50%, -50%) scale(0); 
                                                                                   color: #059669; font-size: 12px; font-weight: bold; 
                                                                                   transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                                                                                   pointer-events: none;">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                        <label class="checkbox-label" for="horizontal-consent" 
                                               style="color: rgba(255,255,255,0.95); font-size: 14px; 
                                                      line-height: 1.5; font-weight: 500; cursor: pointer; flex: 1;">
                                            I agree to receive newsletters and updates. I can unsubscribe at any time.
                                        </label>
                                    </div>
                                </div>
                            </form>
                            
                            <!-- Trust Indicators -->
                            <div class="text-center mt-4" style="position: relative; z-index: 2;">
                                <p style="color: rgba(255,255,255,0.7); margin: 0; font-size: 12px;">
                                    <i class="fas fa-lock me-2"></i>
                                    100% Secure • No Spam • Unsubscribe Anytime
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hero-slider { position: relative; width: 100%; height: 100vh; }
    .hero-slide {
        position: absolute; inset: 0; background-size: cover; background-position: center;
        opacity: 0; transition: opacity .8s ease; z-index: 1;
    }
    .hero-slide:not([style*='background-image']) { background: radial-gradient(ellipse at center, rgba(255,255,255,.06), rgba(0,0,0,.1)), #222; }
    .hero-slide::after { /* overlay */
        content: ""; position: absolute; inset: 0; z-index: 2;
        background: var(--overlay);
        opacity: var(--overlay-opacity, .55);
    }
    .hero-slide.active { opacity: 1; z-index: 3; }
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
    }

    .float-1, .float-2, .float-3 {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: floatUp 6s infinite ease-in-out;
    }

    .float-1 {
        width: 80px;
        height: 80px;
        left: 10%;
        animation-delay: 0s;
    }

    .float-2 {
        width: 120px;
        height: 120px;
        left: 70%;
        animation-delay: 2s;
    }

    .float-3 {
        width: 100px;
        height: 100px;
        left: 40%;
        animation-delay: 4s;
    }

    @keyframes floatUp {
        0% {
            opacity: 0;
            transform: translateY(100vh) rotate(0deg);
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            opacity: 0;
            transform: translateY(-100px) rotate(360deg);
        }
    }

    .icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }

    .custom-card:hover .icon-wrapper {
        transform: scale(1.1);
        background: rgba(0,0,0,0.1);
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.1;
    }
    
    /* New sections styles */
    .testimonial-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important;
    }
    
    .partner-logo:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
    }
    
    .partner-logo:hover img {
        filter: grayscale(0%) !important;
    }
    
    .process-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15) !important;
    }
    
    .newsletter-form input::placeholder {
        color: rgba(255,255,255,0.7);
    }
    
    .newsletter-form input:focus {
        background: rgba(255,255,255,0.3) !important;
        border-color: rgba(255,255,255,0.5) !important;
        box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25) !important;
        color: white !important;
    }
    
    .modern-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .modern-card:hover {
        transform: translateY(-10px) scale(1.02);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modern-section-title {
            font-size: 2.5rem !important;
        }
        
        .section-subtitle {
            font-size: 1rem !important;
        }
        
        .process-card {
            margin-bottom: 3rem;
        }
        
        .newsletter-form {
            padding: 2rem !important;
        }
        
        .newsletter-section h2 {
            font-size: 2rem !important;
        }
        
        .testimonial-card {
            padding: 2rem !important;
        }
        
        .partner-logo {
            padding: 1.5rem !important;
            height: 100px !important;
        }
        
        .process-number {
            top: -20px !important;
            width: 40px !important;
            height: 40px !important;
            font-size: 1rem !important;
        }
        
        .process-icon i {
            font-size: 2.5rem !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    (function(){
        const slides = Array.from(document.querySelectorAll('.hero-slide'));
        if (slides.length === 0) return;
        let i = 0; slides[0].classList.add('active');
        setInterval(()=>{
            slides[i].classList.remove('active');
            i = (i + 1) % slides.length;
            slides[i].classList.add('active');
        }, 6000);
    })();
</script>
@endpush
