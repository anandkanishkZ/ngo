@extends('layouts.app')

@section('title', '403 - Access Forbidden')

@section('content')
<div class="error-403-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <!-- Animated 403 Section -->
                <div class="error-animation-wrapper">
                    <div class="error-number" data-aos="zoom-in" data-aos-delay="200">
                        <span class="digit-4 shake-digit">4</span>
                        <div class="digit-0-wrapper">
                            <span class="digit-0 lock-digit">0</span>
                            <div class="lock-icon">
                                <i class="fas fa-lock lock-animation"></i>
                            </div>
                        </div>
                        <span class="digit-3 shake-digit delay">3</span>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="error-content" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="error-title">Access Denied</h1>
                    <p class="error-description">
                        You don't have permission to access this resource. This area is restricted 
                        to authorized personnel only. If you believe this is an error, please contact us.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="error-actions" data-aos="fade-up" data-aos-delay="600">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>

                <!-- Security Notice -->
                <div class="security-notice" data-aos="fade-up" data-aos-delay="800">
                    <div class="notice-card">
                        <i class="fas fa-shield-alt security-icon"></i>
                        <p class="notice-text">
                            <strong>Security Notice:</strong> Access to this resource requires proper 
                            authorization. All access attempts are logged for security purposes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Background -->
    <div class="security-background">
        <div class="floating-shields">
            <i class="fas fa-shield-alt shield-1"></i>
            <i class="fas fa-user-shield shield-2"></i>
            <i class="fas fa-lock shield-3"></i>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .error-403-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #e74c3c 0%, #8e44ad 50%, #3498db 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 60px 0;
    }

    .error-number {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 8rem;
        font-weight: 900;
        color: rgba(255, 255, 255, 0.9);
        text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 2rem;
    }

    .shake-digit {
        animation: shake 2s ease-in-out infinite;
    }

    .shake-digit.delay {
        animation-delay: -1s;
    }

    .lock-digit {
        animation: lockPulse 3s ease-in-out infinite;
    }

    .digit-0-wrapper {
        position: relative;
        margin: 0 1rem;
    }

    .lock-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .lock-animation {
        animation: lockGlow 2s ease-in-out infinite;
    }

    .error-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1rem;
        text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .error-description {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 3rem;
        line-height: 1.6;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .error-actions {
        margin-bottom: 3rem;
    }

    .notice-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        max-width: 600px;
        margin: 0 auto;
    }

    .security-icon {
        font-size: 2rem;
        color: #e74c3c;
        margin-right: 1rem;
        animation: securityPulse 2s ease-in-out infinite;
    }

    .notice-text {
        margin: 0;
        color: #495057;
        font-size: 0.95rem;
        line-height: 1.5;
        text-align: left;
    }

    .floating-shields {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-shields i {
        position: absolute;
        font-size: 3rem;
        opacity: 0.1;
        color: #ffffff;
        animation: float 8s ease-in-out infinite;
    }

    .shield-1 { top: 20%; left: 15%; animation-delay: 0s; }
    .shield-2 { top: 60%; right: 15%; animation-delay: -2.5s; }
    .shield-3 { bottom: 20%; left: 50%; animation-delay: -5s; }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
        20%, 40%, 60%, 80% { transform: translateX(2px); }
    }

    @keyframes lockPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    @keyframes lockGlow {
        0%, 100% { 
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        50% { 
            color: #ffc107;
            text-shadow: 0 0 20px rgba(255, 193, 7, 0.8);
        }
    }

    @keyframes securityPulse {
        0%, 100% { 
            transform: scale(1);
            color: #e74c3c;
        }
        50% { 
            transform: scale(1.1);
            color: #c0392b;
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-20px) rotate(120deg); }
        66% { transform: translateY(10px) rotate(240deg); }
    }

    @media (max-width: 768px) {
        .error-number { font-size: 5rem; }
        .error-title { font-size: 2rem; }
        .error-description { font-size: 1rem; }
        .notice-card { flex-direction: column; text-align: center; padding: 1.5rem; }
        .security-icon { margin-right: 0; margin-bottom: 1rem; }
        .floating-shields i { font-size: 2.5rem; }
    }
</style>
@endpush
