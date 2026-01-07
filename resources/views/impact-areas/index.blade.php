@extends('layouts.app')

@section('title', 'Our Thematic Areas - JIDS Nepal')
@section('description', 'Explore the key thematic areas where JIDS Nepal creates lasting impact: Education, Healthcare, Environment, Housing, Nutrition, and Community Development.')

@section('content')
    <!-- Page Header -->
    <section class="page-header" style="
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        padding: 100px 0 80px;
        position: relative;
        overflow: hidden;
    ">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up">
                    <div class="section-badge" style="display: inline-block; padding: 8px 24px; background: rgba(255, 255, 255, 0.15); border-radius: 50px; margin-bottom: 20px; backdrop-filter: blur(10px);">
                        <span style="color: white; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Making a Difference</span>
                    </div>
                    <h1 style="font-size: 3.5rem; font-weight: 800; color: white; margin-bottom: 20px; text-shadow: 0 4px 20px rgba(0,0,0,0.2);">Our Thematic Areas</h1>
                    <p style="font-size: 1.3rem; color: rgba(255, 255, 255, 0.95); max-width: 700px; margin: 0 auto; line-height: 1.6;">Discover how we're creating lasting change across multiple sectors, empowering communities and building a better tomorrow for everyone.</p>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(255, 255, 255, 0.05); border-radius: 50%; z-index: 1;"></div>
        <div style="position: absolute; bottom: -100px; left: -100px; width: 400px; height: 400px; background: rgba(255, 255, 255, 0.03); border-radius: 50%; z-index: 1;"></div>
    </section>

    <!-- Thematic Areas Content -->
    <section class="section-padding" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f1f3f4 100%); position: relative;">
        <div class="container">
            <!-- Impact Areas Grid -->
            <div class="row g-4">
                @forelse($impactAreas as $index => $area)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}">
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
                        "
                        onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 20px 60px rgba(0,0,0,0.15)'; this.querySelector('.card-bg-gradient').style.opacity='1'; this.querySelector('.hover-overlay').style.transform='scaleX(1)'; this.querySelector('.icon-bg').style.transform='translate(-50%, -50%) scale(1.15)'; this.querySelector('.icon-bg').style.background='linear-gradient(135deg, {{ $area->color }}25, {{ $area->color }}35)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.08)'; this.querySelector('.card-bg-gradient').style.opacity='0'; this.querySelector('.hover-overlay').style.transform='scaleX(0)'; this.querySelector('.icon-bg').style.transform='translate(-50%, -50%) scale(1)'; this.querySelector('.icon-bg').style.background='linear-gradient(135deg, {{ $area->color }}15, {{ $area->color }}25)'">
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
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #3498db15, #3498db25); border-radius: 50%;"></div>
                                <i class="fas fa-graduation-cap" style="font-size: 3rem; color: #3498db; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Education</h4>
                            <p style="color: #666; line-height: 1.6;">Providing quality education and learning opportunities to underserved communities, building brighter futures for children worldwide.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #e74c3c15, #e74c3c25); border-radius: 50%;"></div>
                                <i class="fas fa-heartbeat" style="font-size: 3rem; color: #e74c3c; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Healthcare</h4>
                            <p style="color: #666; line-height: 1.6;">Delivering essential medical care and health education to communities lacking access to basic healthcare services.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #27ae6015, #27ae6025); border-radius: 50%;"></div>
                                <i class="fas fa-leaf" style="font-size: 3rem; color: #27ae60; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Environment</h4>
                            <p style="color: #666; line-height: 1.6;">Protecting our planet through conservation efforts, sustainable practices, and environmental education programs.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #17a2b815, #17a2b825); border-radius: 50%;"></div>
                                <i class="fas fa-home" style="font-size: 3rem; color: #17a2b8; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Housing</h4>
                            <p style="color: #666; line-height: 1.6;">Building safe, affordable housing solutions and supporting families in creating stable, secure homes.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #f39c1215, #f39c1225); border-radius: 50%;"></div>
                                <i class="fas fa-utensils" style="font-size: 3rem; color: #f39c12; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Nutrition</h4>
                            <p style="color: #666; line-height: 1.6;">Fighting hunger and malnutrition by providing nutritious meals and teaching sustainable food production methods.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="600">
                        <div class="modern-impact-card" style="background: white; border-radius: 20px; padding: 40px 30px; text-align: center; box-shadow: 0 10px 40px rgba(0,0,0,0.08); transition: all 0.4s ease; height: 100%; position: relative; overflow: hidden;">
                            <div class="icon-container" style="margin-bottom: 24px; position: relative;">
                                <div class="icon-bg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 90px; height: 90px; background: linear-gradient(135deg, #6c757d15, #6c757d25); border-radius: 50%;"></div>
                                <i class="fas fa-hands-helping" style="font-size: 3rem; color: #6c757d; position: relative; z-index: 2;"></i>
                            </div>
                            <h4 style="font-size: 1.5rem; font-weight: 700; color: #2c3e50; margin-bottom: 16px;">Community Development</h4>
                            <p style="color: #666; line-height: 1.6;">Strengthening communities through capacity building, leadership development, and collaborative partnerships.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Call to Action -->
            <div class="row mt-5">
                <div class="col-12 text-center" data-aos="fade-up" data-aos-delay="700">
                    <div style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border-radius: 20px; padding: 50px 30px; border: 2px solid #bfdbfe;">
                        <h3 style="font-size: 2rem; font-weight: 700; color: #1e3a8a; margin-bottom: 20px;">Get Involved in Our Mission</h3>
                        <p style="font-size: 1.15rem; color: #475569; max-width: 700px; margin: 0 auto 30px; line-height: 1.6;">Join us in creating lasting change across these vital thematic areas. Your support enables us to continue making a meaningful impact in communities.</p>
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg" style="padding: 14px 32px; font-weight: 600; border-radius: 12px;">Contact Us</a>
                            <a href="{{ route('projects.ongoing') }}" class="btn btn-outline-primary btn-lg" style="padding: 14px 32px; font-weight: 600; border-radius: 12px;">View Our Projects</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
