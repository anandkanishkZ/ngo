@extends('layouts.app')

@section('title', 'Contact Us - Get in Touch | JIDS Nepal')
@section('description', 'Contact JIDS Nepal for inquiries about our programs, partnerships, media, or support. We\'re here to help and answer your questions.')

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
                        <p>JIDS Nepal<br>
                        Triyuga Municipality 11, Udayapur<br>
                        Sangam Tole, Pragati Marg<br>
                        Nepal</p>
                        <a href="https://maps.google.com/?q=Triyuga+Municipality+Udayapur+Nepal" target="_blank" class="contact-link">
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
                        <p>Main Office: <a href="tel:+977035420928" class="phone-link">+977035420928</a></p>
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
                        <p>General Inquiries: <a href="mailto:info@jidsnepal.org.np" class="email-link">info@jidsnepal.org.np</a></p>
                        <small class="text-muted">We typically respond within 24 hours</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Location Map Section -->
        <section class="section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="section-header text-center mb-4" data-aos="fade-up">
                            <h2 class="section-title">Find Us on Google Maps</h2>
                            <p class="section-subtitle">Jalpa Integrated Development Society (JIDS) Udayapur</p>
                        </div>
                        <div class="ratio ratio-16x9 shadow-sm rounded-3 overflow-hidden" data-aos="fade-up" data-aos-delay="50">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d147081.39534763477!2d86.53494047598234!3d26.831352832902404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eec3001c25174d%3A0x29fc30cf70530d6e!2sJalpa%20Integrated%20Development%20Society%20JIDS%20Udaypur!5e0!3m2!1sen!2snp!4v1757298630408!5m2!1sen!2snp" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                title="JIDS Nepal Location">
                            </iframe>
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
                                        @php($qt = request('type'))
                                        <option value="general" {{ old('inquiry_type', $qt) == 'general' ? 'selected' : '' }}>General Information</option>
                                        {{-- Volunteering option removed --}}
                                        <option value="partnership" {{ old('inquiry_type', $qt) == 'partnership' ? 'selected' : '' }}>Partnerships</option>
                                        <option value="media" {{ old('inquiry_type', $qt) == 'media' ? 'selected' : '' }}>Media & Press</option>
                                        <option value="support" {{ old('inquiry_type', $qt) == 'support' ? 'selected' : '' }}>Technical Support</option>
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
                                        value="{{ old('subject', match(request('type')) {
                                            'partnership' => 'Partnership enquiry',
                                            'media' => 'Media enquiry',
                                            'support' => 'Support request',
                                            default => ''
                                        }) }}" 
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

    <!-- FAQ section intentionally removed -->

    <!-- Removed legacy bottom map section -->
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
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px !important;
        margin-bottom: 1rem;
        overflow: hidden;
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
