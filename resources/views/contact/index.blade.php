@extends('layouts.app')

@section('title', 'Contact Us - Get in Touch | JIDS Nepal')
@section('description', 'Contact JIDS Nepal for inquiries about our programs, partnerships, media, or support. We\'re here to help and answer your questions.')

@section('content')
    <!-- Modern Hero Section -->
    <section class="modern-hero-section">
        <div class="hero-background"></div>
        <div class="container">
            <div class="row align-items-center min-vh-60">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="hero-content" data-aos="fade-up">
                        <span class="hero-badge">Contact Us</span>
                        <h1 class="hero-title">Let's Start a <span class="hero-highlight">Conversation</span></h1>
                        <p class="hero-subtitle">We're here to help and answer any questions you might have. We look forward to hearing from you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="main-contact-section">
        <div class="container">
            <div class="row g-0 contact-wrapper">
                <!-- Left Side - Contact Information -->
                <div class="col-lg-5">
                    <div class="contact-info-panel">
                        <div class="contact-info-content">
                            <h2 class="contact-info-title">Get in Touch</h2>
                            <p class="contact-info-subtitle">Ready to take the next step? We'd love to hear from you and discuss how we can work together.</p>
                            
                            <!-- Contact Methods -->
                            <div class="contact-methods">
                                <div class="contact-method" data-aos="fade-right" data-aos-delay="100">
                                    <div class="method-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="method-content">
                                        <h4>Visit Our Office</h4>
                                        <p>Triyuga Municipality 11, Udayapur<br>Sangam Tole, Pragati Marg, Nepal</p>
                                        <a href="https://maps.google.com/?q=Triyuga+Municipality+Udayapur+Nepal" target="_blank" class="method-link">
                                            View on Map <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="contact-method" data-aos="fade-right" data-aos-delay="200">
                                    <div class="method-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="method-content">
                                        <h4>Call Us</h4>
                                        <p><a href="tel:+977035420928" class="phone-number">+977 035 420928</a></p>
                                        <span class="availability">Mon-Fri 9:00 AM - 6:00 PM</span>
                                    </div>
                                </div>

                                <div class="contact-method" data-aos="fade-right" data-aos-delay="300">
                                    <div class="method-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="method-content">
                                        <h4>Email Us</h4>
                                        <p><a href="mailto:info@jidsnepal.org.np" class="email-address">info@jidsnepal.org.np</a></p>
                                        <span class="availability">We respond within 24 hours</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Links -->
                            <div class="social-links" data-aos="fade-right" data-aos-delay="400">
                                <h4>Follow Us</h4>
                                <div class="social-icons">
                                    <a href="#" class="social-icon facebook" aria-label="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="social-icon twitter" aria-label="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="social-icon linkedin" aria-label="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="social-icon instagram" aria-label="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form-panel">
                        <div class="form-header" data-aos="fade-left">
                            <h3>Send Us a Message</h3>
                            <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                        </div>

                        <!-- Success/Error Messages -->
                        @if(session('success'))
                            <div class="alert alert-success modern-alert" role="alert" data-aos="fade-left">
                                <div class="alert-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="alert-content">
                                    <strong>Success!</strong>
                                    <span>{{ session('success') }}</span>
                                </div>
                                <button type="button" class="alert-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger modern-alert" role="alert" data-aos="fade-left">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="alert-content">
                                    <strong>Error!</strong>
                                    <span>{{ session('error') }}</span>
                                </div>
                                <button type="button" class="alert-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="modern-contact-form" data-aos="fade-left" data-aos-delay="100" id="contactForm">
                            @csrf
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        Full Name <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input 
                                            type="text" 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name" 
                                            value="{{ old('name') }}" 
                                            required
                                            placeholder="Enter your full name"
                                        >
                                        <span class="input-border"></span>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        Email Address <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input 
                                            type="email" 
                                            class="form-control @error('email') is-invalid @enderror" 
                                            id="email" 
                                            name="email" 
                                            value="{{ old('email') }}" 
                                            required
                                            placeholder="your@email.com"
                                        >
                                        <span class="input-border"></span>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        Phone Number <span class="optional">(Optional)</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                        <input 
                                            type="tel" 
                                            class="form-control @error('phone') is-invalid @enderror" 
                                            id="phone" 
                                            name="phone" 
                                            value="{{ old('phone') }}"
                                            placeholder="+977 98XXXXXXXX"
                                        >
                                        <span class="input-border"></span>
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inquiry_type" class="form-label">
                                        Inquiry Type <span class="required">*</span>
                                    </label>
                                    <div class="input-wrapper">
                                        <span class="input-icon">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <select 
                                            class="form-control @error('inquiry_type') is-invalid @enderror" 
                                            id="inquiry_type" 
                                            name="inquiry_type" 
                                            required
                                        >
                                            <option value="">Select inquiry type</option>
                                            @php($qt = request('type'))
                                            <option value="general" {{ old('inquiry_type', $qt) == 'general' ? 'selected' : '' }}>General Information</option>
                                            <option value="partnership" {{ old('inquiry_type', $qt) == 'partnership' ? 'selected' : '' }}>Partnerships</option>
                                            <option value="media" {{ old('inquiry_type', $qt) == 'media' ? 'selected' : '' }}>Media & Press</option>
                                            <option value="support" {{ old('inquiry_type', $qt) == 'support' ? 'selected' : '' }}>Technical Support</option>
                                        </select>
                                        <span class="select-arrow">
                                            <i class="fas fa-chevron-down"></i>
                                        </span>
                                        <span class="input-border"></span>
                                    </div>
                                    @error('inquiry_type')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subject" class="form-label">
                                    Subject <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <span class="input-icon">
                                        <i class="fas fa-heading"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        class="form-control @error('subject') is-invalid @enderror" 
                                        id="subject" 
                                        name="subject" 
                                        value="{{ old('subject', match(request('type')) {
                                            'partnership' => 'Partnership enquiry',
                                            'media' => 'Media enquiry',
                                            'support' => 'Support request',
                                            default => ''
                                        }) }}" 
                                        required
                                        placeholder="Brief summary of your message"
                                    >
                                    <span class="input-border"></span>
                                </div>
                                @error('subject')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message" class="form-label">
                                    Your Message <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <span class="input-icon textarea-icon">
                                        <i class="fas fa-comment-dots"></i>
                                    </span>
                                    <textarea 
                                        class="form-control @error('message') is-invalid @enderror" 
                                        id="message" 
                                        name="message" 
                                        rows="6" 
                                        required
                                        placeholder="Tell us more about your inquiry... (minimum 10 characters)"
                                    >{{ old('message') }}</textarea>
                                    <span class="input-border"></span>
                                    <div class="char-counter">
                                        <span id="charCount">0</span> / 1000 characters
                                    </div>
                                </div>
                                @error('message')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-submit">
                                <button type="submit" class="btn-modern-submit" id="submitBtn">
                                    <span class="btn-text">Send Message</span>
                                    <span class="btn-icon">
                                        <i class="fas fa-paper-plane"></i>
                                    </span>
                                    <span class="btn-loader">
                                        <i class="fas fa-circle-notch fa-spin"></i>
                                    </span>
                                </button>
                                <p class="form-privacy">
                                    <i class="fas fa-shield-alt"></i>
                                    Your information is secure and protected. We'll respond within 24 hours.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="modern-map-section">
        <div class="container-fluid px-0">
            <div class="map-container" data-aos="fade-up">
                <div class="map-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2>Find Us on the Map</h2>
                                <p>Visit our office in Udayapur for a personal consultation or meeting.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="map-wrapper">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d147081.39534763477!2d86.53494047598234!3d26.831352832902404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eec3001c25174d%3A0x29fc30cf70530d6e!2sJalpa%20Integrated%20Development%20Society%20JIDS%20Udaypur!5e0!3m2!1sen!2snp!4v1757298630408!5m2!1sen!2snp" 
                        width="100%" 
                        height="500" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="JIDS Nepal Location">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Professional Contact Page Styles */
    :root {
        --contact-primary: var(--primary-color);
        --contact-accent: #16a34a;
        --contact-light-bg: #f8f9fa;
        --contact-lighter-bg: #ffffff;
        --contact-info-bg: #e8f5e9;
        --contact-border: #e2e8f0;
        --contact-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        --contact-shadow-lg: 0 15px 35px rgba(0, 0, 0, 0.1);
        --contact-white: #ffffff;
        --contact-gray: #64748b;
        --contact-dark-text: #1e293b;
        --contact-success: #22c55e;
        --contact-error: #ef4444;
    }

    /* Professional Hero Section */
    .modern-hero-section {
        position: relative;
        min-height: 50vh;
        display: flex;
        align-items: center;
        background: var(--contact-primary);
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        animation: floatPattern 20s ease-in-out infinite;
    }

    @keyframes floatPattern {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .min-vh-60 {
        min-height: 60vh;
    }

    .hero-badge {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        color: white;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
        backdrop-filter: blur(10px);
        margin-bottom: 1.5rem;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .text-gradient, .hero-highlight {
        color: white;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 400;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Main Contact Section */
    .main-contact-section {
        padding: 0;
        margin-top: -50px;
        position: relative;
        z-index: 10;
    }

    .contact-wrapper {
        background: var(--contact-white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--contact-shadow-lg);
        margin: 0 15px;
    }

    /* Professional Contact Info Panel (Left Side) - Light Design */
    .contact-info-panel {
        background: linear-gradient(135deg, #e8f5e9 0%, #f1f8f4 100%);
        color: var(--contact-dark-text);
        padding: 4rem 3rem;
        height: 100%;
        position: relative;
        border-right: 1px solid rgba(0, 0, 0, 0.05);
    }

    .contact-info-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2322c55e' fill-opacity='0.04'%3E%3Cpath d='M30 15a15 15 0 0 1 15 15 15 15 0 0 1-15 15 15 15 0 0 1-15-15 15 15 0 0 1 15-15zm0 2a13 13 0 0 0-13 13 13 13 0 0 0 13 13 13 13 0 0 0 13-13 13 13 0 0 0-13-13z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
        opacity: 0.5;
    }

    .contact-info-content {
        position: relative;
        z-index: 2;
    }

    .contact-info-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--contact-dark-text);
        background: linear-gradient(135deg, var(--contact-primary) 0%, var(--contact-accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-info-subtitle {
        font-size: 1.1rem;
        color: #475569;
        margin-bottom: 3rem;
        line-height: 1.6;
    }

    /* Contact Methods - Light Design */
    .contact-methods {
        margin-bottom: 3rem;
    }

    .contact-method {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
        padding: 1.75rem;
        background: white;
        border-radius: 16px;
        border: 2px solid #e0f2e9;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .contact-method:hover {
        transform: translateX(8px);
        background: white;
        border-color: var(--contact-accent);
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.12);
    }

    .method-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--contact-primary) 0%, var(--contact-accent) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        flex-shrink: 0;
        font-size: 1.5rem;
        color: white;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.25);
    }

    .method-content h4 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--contact-dark-text);
    }

    .method-content p {
        margin-bottom: 0.5rem;
        color: #64748b;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .method-link, .phone-number, .email-address {
        color: var(--contact-accent);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .method-link:hover, .phone-number:hover, .email-address:hover {
        color: var(--contact-primary);
        text-decoration: none;
        gap: 0.75rem;
    }

    .availability {
        font-size: 0.85rem;
        color: #94a3b8;
        font-weight: 500;
    }

    /* Social Links - Light Design */
    .social-links h4 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: var(--contact-dark-text);
    }

    .social-icons {
        display: flex;
        gap: 0.875rem;
    }

    .social-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid #e0f2e9;
        background: white;
        color: var(--contact-accent);
    }

    .social-icon:hover {
        transform: translateY(-4px) scale(1.05);
        background: linear-gradient(135deg, var(--contact-primary) 0%, var(--contact-accent) 100%);
        color: white;
        border-color: transparent;
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.25);
    }

    .social-icon.facebook:hover {
        background: #1877f2;
        border-color: #1877f2;
    }

    .social-icon.twitter:hover {
        background: #1da1f2;
        border-color: #1da1f2;
    }

    .social-icon.linkedin:hover {
        background: #0a66c2;
        border-color: #0a66c2;
    }

    .social-icon.instagram:hover {
        background: linear-gradient(135deg, #f58529, #dd2a7b, #8134af);
        border-color: transparent;
    }

    /* Professional Contact Form Panel (Right Side) */
    .contact-form-panel {
        padding: 4rem 3rem;
        background: var(--contact-white);
    }

    .form-header {
        margin-bottom: 2.5rem;
    }

    .form-header h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--contact-dark-text);
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: var(--contact-gray);
        font-size: 1.05rem;
    }

    /* Professional Alert - Enhanced */
    .modern-alert {
        padding: 1.25rem 1.5rem;
        border-radius: 15px;
        border: none;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        animation: slideInDown 0.4s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 1.25rem;
    }

    .modern-alert.alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border: 1px solid #6ee7b7;
    }

    .modern-alert.alert-success .alert-icon {
        background: #10b981;
        color: white;
    }

    .modern-alert.alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: 1px solid #fca5a5;
    }

    .modern-alert.alert-danger .alert-icon {
        background: #ef4444;
        color: white;
    }

    .alert-content {
        flex: 1;
    }

    .alert-content strong {
        display: block;
        margin-bottom: 0.25rem;
        font-weight: 700;
        font-size: 1rem;
    }

    .alert-close {
        background: none;
        border: none;
        color: inherit;
        opacity: 0.5;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0.5rem;
        border-radius: 8px;
    }

    .alert-close:hover {
        opacity: 1;
        background: rgba(0, 0, 0, 0.1);
    }

    /* Professional Form - Enhanced */
    .modern-contact-form {
        max-width: none;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        color: var(--contact-dark-text);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
    }

    .required {
        color: #ef4444;
        font-weight: 700;
    }

    .optional {
        color: var(--contact-gray);
        font-weight: 400;
        font-size: 0.85rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--contact-gray);
        z-index: 5;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .textarea-icon {
        top: 1.25rem;
        transform: translateY(0);
    }

    .form-control {
        width: 100%;
        padding: 1.125rem 1.25rem 1.125rem 3.5rem;
        border: 2px solid var(--contact-border);
        border-radius: 14px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background: #fafbfc;
        color: var(--contact-dark);
        font-family: inherit;
        appearance: none;
    }

    .form-control:hover {
        border-color: #cbd5e1;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--contact-primary);
        box-shadow: 0 0 0 4px rgba(var(--contact-primary), 0.08);
        background: var(--contact-white);
    }

    .form-control:focus + .input-border {
        width: 100%;
    }

    .form-control:focus ~ .input-icon {
        color: var(--contact-primary);
        transform: translateY(-50%) scale(1.1);
    }

    .input-border {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 3px;
        background: var(--contact-primary);
        transition: width 0.4s ease;
        border-radius: 0 0 14px 14px;
    }

    .form-control.is-invalid {
        border-color: var(--contact-error);
        background: #fef2f2;
        animation: shake 0.4s ease;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .form-control.is-valid {
        border-color: var(--contact-success);
        background: #f0fdf4;
    }

    .invalid-feedback {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--contact-error);
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    /* Select Dropdown Enhancement */
    .select-arrow {
        position: absolute;
        right: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: var(--contact-gray);
        transition: all 0.3s ease;
    }

    .form-control:focus ~ .select-arrow {
        color: var(--contact-primary);
        transform: translateY(-50%) rotate(180deg);
    }

    /* Character Counter */
    .char-counter {
        position: absolute;
        bottom: 1rem;
        right: 1.25rem;
        font-size: 0.8rem;
        color: var(--contact-gray);
        background: rgba(255, 255, 255, 0.9);
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        backdrop-filter: blur(10px);
    }

    #charCount {
        font-weight: 600;
        color: var(--contact-primary);
    }

    /* Professional Button - Enhanced with Light Colors */
    .btn-modern-submit {
        background: linear-gradient(135deg, var(--contact-accent) 0%, #059669 100%);
        border: none;
        padding: 1.125rem 3rem;
        border-radius: 14px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.25);
        position: relative;
        overflow: hidden;
    }

    .btn-modern-submit::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .btn-modern-submit:hover::before {
        width: 400px;
        height: 400px;
    }

    .btn-modern-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    .btn-modern-submit:active {
        transform: translateY(-1px);
    }

    .btn-text, .btn-icon {
        position: relative;
        z-index: 1;
    }

    .btn-loader {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-modern-submit.loading .btn-text,
    .btn-modern-submit.loading .btn-icon {
        opacity: 0;
    }

    .btn-modern-submit.loading .btn-loader {
        opacity: 1;
    }

    .btn-modern-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    .form-submit {
        text-align: center;
        margin-top: 2rem;
    }

    .form-privacy {
        margin-top: 1.25rem;
        color: var(--contact-gray);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        line-height: 1.5;
    }

    .form-privacy i {
        color: var(--contact-primary);
    }

    /* Professional Map Section - Light Design */
    .modern-map-section {
        padding: 5rem 0;
        background: linear-gradient(135deg, #f8fafb 0%, #e8f5e9 100%);
    }

    .map-header {
        margin-bottom: 3rem;
    }

    .map-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--contact-dark-text);
        margin-bottom: 1rem;
    }

    .map-header p {
        font-size: 1.1rem;
        color: var(--contact-gray);
    }

    .map-wrapper {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--contact-shadow);
    }

    .map-wrapper iframe {
        display: block;
        width: 100%;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .contact-wrapper {
            margin: 0 10px;
        }
        
        .contact-info-panel,
        .contact-form-panel {
            padding: 3rem 2rem;
        }
        
        .hero-title {
            font-size: 2.5rem;
        }
        
        .contact-info-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .contact-method {
            flex-direction: column;
            text-align: center;
        }
        
        .method-icon {
            margin: 0 auto 1rem;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .contact-info-panel,
        .contact-form-panel {
            padding: 2rem 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .main-contact-section {
            margin-top: -30px;
        }
        
        .contact-wrapper {
            margin: 0 5px;
        }
        
        .modern-hero-section {
            min-height: 40vh;
        }
        
        .hero-title {
            font-size: 1.75rem;
        }
        
        .social-icons {
            justify-content: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Modern Enhanced Contact Form Script
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');
        const messageField = document.getElementById('message');
        const charCountSpan = document.getElementById('charCount');
        const inputs = form.querySelectorAll('input, select, textarea');

        // Character counter for message field
        if (messageField && charCountSpan) {
            messageField.addEventListener('input', function() {
                const length = this.value.length;
                charCountSpan.textContent = length;
                
                if (length > 950) {
                    charCountSpan.style.color = '#ef4444';
                } else if (length > 800) {
                    charCountSpan.style.color = '#f59e0b';
                } else {
                    charCountSpan.style.color = 'var(--contact-primary)';
                }
            });
        }

        // Enhanced input validation
        inputs.forEach(input => {
            // Focus animation
            input.addEventListener('focus', function() {
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) {
                    wrapper.style.transform = 'translateY(-2px)';
                }
            });

            input.addEventListener('blur', function() {
                const wrapper = this.closest('.input-wrapper');
                if (wrapper) {
                    wrapper.style.transform = 'translateY(0)';
                }
                validateField(this);
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });

        function validateField(field) {
            const value = field.value.trim();
            let isValid = true;

            field.classList.remove('is-valid', 'is-invalid');

            if (field.hasAttribute('required') && !value) {
                isValid = false;
            } else if (field.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                isValid = emailRegex.test(value);
            } else if (field.name === 'message' && value && value.length < 10) {
                isValid = false;
            }

            if (value) {
                field.classList.add(isValid ? 'is-valid' : 'is-invalid');
            }

            return isValid;
        }

        // Form submission with loading state
        form.addEventListener('submit', function(e) {
            let isFormValid = true;
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isFormValid = false;
                }
            });

            if (!isFormValid) {
                e.preventDefault();
                
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    setTimeout(() => firstInvalid.focus(), 500);
                }
            } else {
                // Show loading state
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });

        // Auto-dismiss alerts
        const alerts = document.querySelectorAll('.modern-alert');
        alerts.forEach(alert => {
            const closeBtn = alert.querySelector('.alert-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 300);
                });
            }
            
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 300);
                }
            }, 6000);
        });

        // Parallax effect for hero
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const heroBackground = document.querySelector('.hero-background');
            if (heroBackground && scrolled < 800) {
                heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    });
</script>
@endpush
