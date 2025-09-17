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
                                <i class="fas fa-check-circle"></i>
                                <span>{{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger modern-alert" role="alert" data-aos="fade-left">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>{{ session('error') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="modern-contact-form" data-aos="fade-left" data-aos-delay="100">
                            @csrf
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <div class="input-group">
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
                                            placeholder="John Doe"
                                        >
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <div class="input-group">
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
                                            placeholder="john@example.com"
                                        >
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
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
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="inquiry_type" class="form-label">Inquiry Type *</label>
                                    <div class="input-group">
                                        <span class="input-icon">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                        <select 
                                            class="form-control @error('inquiry_type') is-invalid @enderror" 
                                            id="inquiry_type" 
                                            name="inquiry_type" 
                                            required
                                        >
                                            <option value="">Choose a type</option>
                                            @php($qt = request('type'))
                                            <option value="general" {{ old('inquiry_type', $qt) == 'general' ? 'selected' : '' }}>General Information</option>
                                            <option value="partnership" {{ old('inquiry_type', $qt) == 'partnership' ? 'selected' : '' }}>Partnerships</option>
                                            <option value="media" {{ old('inquiry_type', $qt) == 'media' ? 'selected' : '' }}>Media & Press</option>
                                            <option value="support" {{ old('inquiry_type', $qt) == 'support' ? 'selected' : '' }}>Technical Support</option>
                                        </select>
                                    </div>
                                    @error('inquiry_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subject" class="form-label">Subject *</label>
                                <div class="input-group">
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
                                        placeholder="What is this about?"
                                    >
                                </div>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="message" class="form-label">Message *</label>
                                <div class="input-group">
                                    <span class="input-icon textarea-icon">
                                        <i class="fas fa-comment"></i>
                                    </span>
                                    <textarea 
                                        class="form-control @error('message') is-invalid @enderror" 
                                        id="message" 
                                        name="message" 
                                        rows="5" 
                                        required
                                        placeholder="Tell us more about your inquiry..."
                                    >{{ old('message') }}</textarea>
                                </div>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-help">
                                    <small class="text-muted">Minimum 10 characters required</small>
                                </div>
                            </div>

                            <div class="form-submit">
                                <button type="submit" class="btn-modern-primary">
                                    <span class="btn-text">Send Message</span>
                                    <span class="btn-icon">
                                        <i class="fas fa-paper-plane"></i>
                                    </span>
                                </button>
                                <p class="form-privacy">
                                    <i class="fas fa-shield-alt"></i>
                                    Your information is secure and will only be used to respond to your inquiry.
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
        --contact-dark: #2d3748;
        --contact-light: #f7fafc;
        --contact-border: #e2e8f0;
        --contact-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        --contact-shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
        --contact-white: #ffffff;
        --contact-gray: #64748b;
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

    /* Professional Contact Info Panel (Left Side) */
    .contact-info-panel {
        background: var(--contact-dark);
        color: white;
        padding: 4rem 3rem;
        height: 100%;
        position: relative;
    }

    .contact-info-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Ccircle cx='20' cy='20' r='2'/%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }

    .contact-info-content {
        position: relative;
        z-index: 2;
    }

    .contact-info-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: white;
    }

    .contact-info-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 3rem;
        line-height: 1.6;
    }

    /* Contact Methods */
    .contact-methods {
        margin-bottom: 3rem;
    }

    .contact-method {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2.5rem;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .contact-method:hover {
        transform: translateX(10px);
        background: rgba(255, 255, 255, 0.1);
    }

    .method-icon {
        width: 60px;
        height: 60px;
        background: var(--contact-primary);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        flex-shrink: 0;
        font-size: 1.5rem;
        color: white;
    }

    .method-content h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: white;
    }

    .method-content p {
        margin-bottom: 0.5rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.5;
    }

    .method-link, .phone-number, .email-address {
        color: var(--contact-primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        filter: brightness(1.3);
    }

    .method-link:hover, .phone-number:hover, .email-address:hover {
        color: var(--contact-primary);
        text-decoration: underline;
        filter: brightness(1.5);
    }

    .availability {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.6);
    }

    /* Social Links */
    .social-links h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: white;
    }

    .social-icons {
        display: flex;
        gap: 1rem;
    }

    .social-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .social-icon:hover {
        transform: translateY(-3px);
        background: var(--contact-primary);
        color: white;
        border-color: var(--contact-primary);
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
        color: var(--contact-dark);
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: var(--contact-gray);
        font-size: 1.1rem;
    }

    /* Professional Alert */
    .modern-alert {
        padding: 1rem 1.5rem;
        border-radius: 12px;
        border: none;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .modern-alert.alert-success {
        background: rgba(34, 197, 94, 0.1);
        color: var(--contact-success);
        border-left: 4px solid var(--contact-success);
    }

    .modern-alert.alert-danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--contact-error);
        border-left: 4px solid var(--contact-error);
    }

    /* Professional Form */
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
        display: block;
        font-weight: 600;
        color: var(--contact-dark);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        color: var(--contact-gray);
        z-index: 5;
        font-size: 1rem;
    }

    .textarea-icon {
        top: 1rem;
        align-self: flex-start;
    }

    .form-control {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid var(--contact-border);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fafbfc;
        color: var(--contact-dark);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--contact-primary);
        box-shadow: 0 0 0 3px rgba(var(--contact-primary), 0.1);
        background: var(--contact-white);
    }

    .form-control.is-invalid {
        border-color: var(--contact-error);
        background: #fef2f2;
    }

    .form-control.is-valid {
        border-color: var(--contact-success);
        background: #f0fdf4;
    }

    .invalid-feedback {
        display: block;
        color: var(--contact-error);
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .form-help {
        margin-top: 0.5rem;
    }

    /* Professional Button */
    .btn-modern-primary {
        background: var(--contact-primary);
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-modern-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        background: var(--contact-primary);
        filter: brightness(1.1);
        color: white;
    }

    .form-submit {
        text-align: center;
        margin-top: 2rem;
    }

    .form-privacy {
        margin-top: 1rem;
        color: var(--contact-gray);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    /* Professional Map Section */
    .modern-map-section {
        padding: 5rem 0;
        background: var(--contact-light);
    }

    .map-header {
        margin-bottom: 3rem;
    }

    .map-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--contact-dark);
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
    // Modern form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.modern-contact-form');
        const inputs = form.querySelectorAll('input, select, textarea');

        // Enhanced real-time validation
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
                
                // Add typing animation
                this.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });

            // Focus effects
            input.addEventListener('focus', function() {
                this.parentNode.style.transform = 'translateY(-2px)';
                this.parentNode.style.transition = 'all 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentNode.style.transform = 'translateY(0)';
            });
        });

        function validateField(field) {
            const value = field.value.trim();
            let isValid = true;
            let message = '';

            // Remove existing validation classes
            field.classList.remove('is-valid', 'is-invalid');

            // Field-specific validation
            switch(field.name) {
                case 'name':
                    if (!value) {
                        isValid = false;
                        message = 'Name is required';
                    } else if (value.length < 2) {
                        isValid = false;
                        message = 'Name must be at least 2 characters';
                    } else if (!/^[a-zA-Z\s]+$/.test(value)) {
                        isValid = false;
                        message = 'Name should only contain letters and spaces';
                    }
                    break;

                case 'email':
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!value) {
                        isValid = false;
                        message = 'Email is required';
                    } else if (!emailRegex.test(value)) {
                        isValid = false;
                        message = 'Please enter a valid email address';
                    }
                    break;

                case 'phone':
                    if (value && (value.length < 10 || !/^[\+]?[\d\s\-\(\)]+$/.test(value))) {
                        isValid = false;
                        message = 'Please enter a valid phone number';
                    }
                    break;

                case 'subject':
                    if (!value) {
                        isValid = false;
                        message = 'Subject is required';
                    } else if (value.length < 3) {
                        isValid = false;
                        message = 'Subject must be at least 3 characters';
                    }
                    break;

                case 'message':
                    if (!value) {
                        isValid = false;
                        message = 'Message is required';
                    } else if (value.length < 10) {
                        isValid = false;
                        message = 'Message must be at least 10 characters';
                    }
                    break;

                case 'inquiry_type':
                    if (!value) {
                        isValid = false;
                        message = 'Please select an inquiry type';
                    }
                    break;
            }

            // Apply validation classes and messages
            if (isValid && value) {
                field.classList.add('is-valid');
                // Add success animation
                animateFieldSuccess(field);
            } else if (!isValid) {
                field.classList.add('is-invalid');
                
                // Update error message
                let feedback = field.parentNode.parentNode.querySelector('.invalid-feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback';
                    field.parentNode.parentNode.appendChild(feedback);
                }
                feedback.textContent = message;
                
                // Add error animation
                animateFieldError(field);
            }

            return isValid;
        }

        function animateFieldSuccess(field) {
            field.style.borderColor = '#22c55e';
            field.style.boxShadow = '0 0 0 3px rgba(34, 197, 94, 0.1)';
        }

        function animateFieldError(field) {
            field.style.borderColor = '#ef4444';
            field.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            
            // Shake animation
            field.style.animation = 'shake 0.5s ease-in-out';
            setTimeout(() => {
                field.style.animation = '';
            }, 500);
        }

        // Enhanced form submission
        form.addEventListener('submit', function(e) {
            let isFormValid = true;
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isFormValid = false;
                }
            });

            if (!isFormValid) {
                e.preventDefault();
                
                // Scroll to first invalid field with smooth animation
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    
                    // Focus with delay for better UX
                    setTimeout(() => {
                        firstInvalid.focus();
                    }, 500);
                }
                
                // Show general error message
                showNotification('Please correct the errors below', 'error');
            } else {
                // Show loading state
                const submitBtn = form.querySelector('.btn-modern-primary');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                submitBtn.disabled = true;
                
                // Re-enable after a delay (form will redirect anyway)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }
        });

        // Enhanced character counter for message field
        const messageField = document.getElementById('message');
        const messageHelp = messageField.closest('.form-group').querySelector('.form-help small');
        
        messageField.addEventListener('input', function() {
            const length = this.value.length;
            const remaining = Math.max(0, 10 - length);
            
            if (remaining > 0) {
                messageHelp.textContent = `${remaining} more characters needed (minimum 10)`;
                messageHelp.style.color = '#64748b';
            } else {
                messageHelp.textContent = `${length} characters`;
                messageHelp.style.color = '#22c55e';
                messageHelp.style.fontWeight = '500';
            }
        });

        // Auto-dismiss alerts with animation
        const alerts = document.querySelectorAll('.modern-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transform = 'translateY(-100%)';
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 300);
            }, 5000);
        });

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            
            // Show animation
            setTimeout(() => {
                notification.classList.add('show');
            }, 100);
            
            // Remove after delay
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 4000);
        }

        // Smooth scrolling for all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const heroBackground = document.querySelector('.hero-background');
            if (heroBackground) {
                heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    });

    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 1000;
            max-width: 300px;
        }
        
        .notification.show {
            transform: translateX(0);
            opacity: 1;
        }
        
        .notification-error {
            border-left: 4px solid #ef4444;
            color: #dc2626;
        }
        
        .notification-info {
            border-left: 4px solid #3b82f6;
            color: #2563eb;
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
