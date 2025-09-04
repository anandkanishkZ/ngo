@extends('layouts.app')

@section('title', 'Contact Us - Get in Touch | Hope Foundation')
@section('description', 'Contact Hope Foundation for inquiries about our programs, volunteering opportunities, partnerships, or donations. We\'re here to help and answer your questions.')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section" style="min-height: 60vh;">
        <div class="container">
            <div class="hero-content text-center" data-aos="fade-up">
                <h1 class="hero-title">Get In <span class="text-warning">Touch</span></h1>
                <p class="hero-subtitle">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row g-4">
                <!-- Office Location -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3>Visit Our Office</h3>
                        <p>Hope Foundation Headquarters<br>
                        Bhairahawa-11, Rupandehi<br>
                        Lumbini Province, Nepal</p>
                        <a href="https://maps.google.com/?q=Bhairahawa+Rupandehi+Nepal" target="_blank" class="contact-link">
                            <i class="fas fa-external-link-alt"></i> View on Map
                        </a>
                    </div>
                </div>

                <!-- Phone Contact -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3>Call Us</h3>
                        <p>Main Office: <a href="tel:+977-76-561155" class="phone-link">+977-76-561155</a><br>
                        Alternative: <a href="tel:+977-76-561336" class="phone-link">+977-76-561336</a><br>
                        Mobile: <a href="tel:+977-9857050251" class="phone-link">+977-9857050251</a><br>
                        Toll Free: <a href="tel:16607656155" class="phone-link">16607656155</a></p>
                        <small class="text-muted">Available Mon-Fri 9:00 AM - 6:00 PM</small>
                    </div>
                </div>

                <!-- Email Contact -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-info-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p>General Inquiries: <a href="mailto:info@hopefoundation.org" class="email-link">info@hopefoundation.org</a><br>
                        Partnerships: <a href="mailto:partnerships@hopefoundation.org" class="email-link">partnerships@hopefoundation.org</a><br>
                        Media: <a href="mailto:media@hopefoundation.org" class="email-link">media@hopefoundation.org</a></p>
                        <small class="text-muted">We typically respond within 24 hours</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header text-center mb-5" data-aos="fade-up">
                        <h2 class="section-title">Send Us a Message</h2>
                        <p class="section-subtitle">Fill out the form below and we'll get back to you as soon as possible</p>
                    </div>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-up">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-up">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="contact-form-wrapper" data-aos="fade-up" data-aos-delay="100">
                        <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Name Field -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2"></i>Full Name *
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        id="name" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required
                                        placeholder="Enter your full name"
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Email Address *
                                    </label>
                                    <input 
                                        type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required
                                        placeholder="Enter your email address"
                                    >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone Field -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone me-2"></i>Phone Number
                                    </label>
                                    <input 
                                        type="tel" 
                                        class="form-control @error('phone') is-invalid @enderror" 
                                        id="phone" 
                                        name="phone" 
                                        value="{{ old('phone') }}"
                                        placeholder="Enter your phone number"
                                    >
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Inquiry Type -->
                                <div class="col-md-6">
                                    <label for="inquiry_type" class="form-label">
                                        <i class="fas fa-tag me-2"></i>Inquiry Type *
                                    </label>
                                    <select 
                                        class="form-select @error('inquiry_type') is-invalid @enderror" 
                                        id="inquiry_type" 
                                        name="inquiry_type" 
                                        required
                                    >
                                        <option value="">Select inquiry type</option>
                                        <option value="general" {{ old('inquiry_type') == 'general' ? 'selected' : '' }}>General Information</option>
                                        <option value="volunteer" {{ old('inquiry_type') == 'volunteer' ? 'selected' : '' }}>Volunteering</option>
                                        <option value="donation" {{ old('inquiry_type') == 'donation' ? 'selected' : '' }}>Donations</option>
                                        <option value="partnership" {{ old('inquiry_type') == 'partnership' ? 'selected' : '' }}>Partnerships</option>
                                        <option value="media" {{ old('inquiry_type') == 'media' ? 'selected' : '' }}>Media & Press</option>
                                        <option value="support" {{ old('inquiry_type') == 'support' ? 'selected' : '' }}>Technical Support</option>
                                    </select>
                                    @error('inquiry_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Subject Field -->
                                <div class="col-12">
                                    <label for="subject" class="form-label">
                                        <i class="fas fa-heading me-2"></i>Subject *
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('subject') is-invalid @enderror" 
                                        id="subject" 
                                        name="subject" 
                                        value="{{ old('subject') }}" 
                                        required
                                        placeholder="What is this about?"
                                    >
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Message Field -->
                                <div class="col-12">
                                    <label for="message" class="form-label">
                                        <i class="fas fa-comment me-2"></i>Message *
                                    </label>
                                    <textarea 
                                        class="form-control @error('message') is-invalid @enderror" 
                                        id="message" 
                                        name="message" 
                                        rows="5" 
                                        required
                                        placeholder="Tell us more about your inquiry..."
                                    >{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <small class="text-muted">Minimum 10 characters required</small>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane me-2"></i>Send Message
                                    </button>
                                    <div class="form-text mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-shield-alt me-1"></i>
                                            Your information is secure and will only be used to respond to your inquiry.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section-padding bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-header text-center mb-5" data-aos="fade-up">
                        <h2 class="section-title">Frequently Asked Questions</h2>
                        <p class="section-subtitle">Find quick answers to common questions</p>
                    </div>

                    <div class="accordion" id="faqAccordion" data-aos="fade-up" data-aos-delay="100">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="fas fa-question-circle me-2"></i>
                                    How can I volunteer with Hope Foundation?
                                </button>
                            </h3>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We welcome volunteers of all backgrounds! Visit our <a href="{{ route('volunteer') }}">volunteer page</a> to learn about current opportunities, or contact us directly to discuss how your skills can contribute to our mission.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="fas fa-hand-holding-heart me-2"></i>
                                    What's the best way to make a donation?
                                </button>
                            </h3>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can support our mission through various ways including volunteering and spreading awareness. Contact us directly to learn more about how you can help create positive impact in communities.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="fas fa-handshake me-2"></i>
                                    How do I propose a partnership with Hope Foundation?
                                </button>
                            </h3>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We're always interested in meaningful partnerships! Please use the contact form above with "Partnerships" selected as your inquiry type, or email us directly at partnerships@hopefoundation.org with details about your proposal.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <i class="fas fa-clock me-2"></i>
                                    What are your office hours?
                                </button>
                            </h3>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our office is open Monday through Friday, 9:00 AM to 6:00 PM Nepal Time. While our phones are available during these hours, you can reach us anytime via email or this contact form.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-12">
                    <div class="map-wrapper" data-aos="fade-up">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56815.72644968743!2d83.35689!3d27.5031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3996813588b4f979%3A0x5c8e9eb83d5a2c7c!2sBhairahawa%2C%20Nepal!5e0!3m2!1sen!2sus!4v1635000000000!5m2!1sen!2sus" 
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Hope Foundation Location - Bhairahawa, Nepal">
                        </iframe>
                        <div class="map-overlay">
                            <div class="map-info">
                                <h4><i class="fas fa-map-marker-alt me-2"></i>Find Us Here</h4>
                                <p>Hope Foundation<br>Bhairahawa-11, Rupandehi<br>Lumbini Province, Nepal</p>
                                <a href="https://maps.google.com/?q=Bhairahawa+Rupandehi+Nepal" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-directions me-1"></i>Get Directions
                                </a>
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
    /* Contact Page Specific Styles */
    .contact-info-card {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .contact-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .contact-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
        color: white;
    }

    .contact-info-card h3 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.3rem;
    }

    .contact-info-card p {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .phone-link, .email-link {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 500;
    }

    .phone-link:hover, .email-link:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }

    .contact-link {
        color: var(--accent-color);
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .contact-link:hover {
        color: var(--secondary-color);
    }

    /* Contact Form Styling */
    .contact-form-wrapper {
        background: white;
        padding: 2.5rem;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .contact-form .form-label {
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .contact-form .form-control,
    .contact-form .form-select {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .contact-form .form-control:focus,
    .contact-form .form-select:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
    }

    .contact-form textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* FAQ Styling */
    .accordion-item {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px !important;
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .accordion-button {
        background: white;
        border: none;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, rgba(44, 62, 80, 0.1), rgba(231, 76, 60, 0.1));
        color: var(--secondary-color);
        box-shadow: none;
    }

    .accordion-button:focus {
        box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
    }

    .accordion-body {
        padding: 1.5rem;
        background: #f8f9fa;
        color: #6c757d;
        line-height: 1.6;
    }

    .accordion-body a {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 500;
    }

    .accordion-body a:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }

    /* Map Section */
    .map-section {
        position: relative;
    }

    .map-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 0;
    }

    .map-overlay {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.95);
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
        max-width: 300px;
    }

    .map-info h4 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .map-info p {
        color: #6c757d;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    /* Alert Styling */
    .alert {
        border: none;
        border-radius: 10px;
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(39, 174, 96, 0.1), rgba(39, 174, 96, 0.05));
        color: #27ae60;
        border-left: 4px solid #27ae60;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(231, 76, 60, 0.1), rgba(231, 76, 60, 0.05));
        color: #e74c3c;
        border-left: 4px solid #e74c3c;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .contact-form-wrapper {
            padding: 1.5rem;
        }
        
        .map-overlay {
            position: static;
            margin: 1rem;
            max-width: none;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .contact-info-card {
            padding: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .section-padding {
            padding: 3rem 0;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.contact-form');
        const inputs = form.querySelectorAll('input, select, textarea');

        // Add real-time validation
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
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
                    if (value && value.length < 10) {
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
            } else if (!isValid) {
                field.classList.add('is-invalid');
                
                // Update error message
                const feedback = field.parentNode.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.textContent = message;
                }
            }

            return isValid;
        }

        // Form submission validation
        form.addEventListener('submit', function(e) {
            let isFormValid = true;
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isFormValid = false;
                }
            });

            if (!isFormValid) {
                e.preventDefault();
                // Scroll to first invalid field
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
            }
        });

        // Character counter for message field
        const messageField = document.getElementById('message');
        const messageHelp = messageField.parentNode.querySelector('.form-text small');
        
        messageField.addEventListener('input', function() {
            const length = this.value.length;
            const remaining = Math.max(0, 10 - length);
            
            if (remaining > 0) {
                messageHelp.textContent = `${remaining} more characters needed (minimum 10)`;
                messageHelp.style.color = '#6c757d';
            } else {
                messageHelp.textContent = `${length} characters`;
                messageHelp.style.color = '#27ae60';
            }
        });

        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });

    // Smooth scroll for anchor links
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
</script>
@endpush
