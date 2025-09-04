@extends('layouts.app')

@section('title', '500 - Server Error')

@section('content')
<div class="error-500-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <!-- Animated 500 Section -->
                <div class="error-animation-wrapper">
                    <div class="error-number" data-aos="zoom-in" data-aos-delay="200">
                        <span class="digit-5 glitch-digit">5</span>
                        <div class="digit-0-wrapper">
                            <span class="digit-0 spinning-digit">0</span>
                            <div class="gear-icon">
                                <i class="fas fa-cog spinning-gear"></i>
                            </div>
                        </div>
                        <span class="digit-0 spinning-digit delay">0</span>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="error-content" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="error-title">Oops! Something Went Wrong</h1>
                    <p class="error-description">
                        Our server encountered an unexpected issue while processing your request. 
                        Don't worry, our team has been notified and is working to fix this!
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="error-actions" data-aos="fade-up" data-aos-delay="600">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-home me-2"></i>Go Home
                    </a>
                    <button onclick="location.reload()" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-redo me-2"></i>Try Again
                    </button>
                </div>

                <!-- Status Message -->
                <div class="status-message" data-aos="fade-up" data-aos-delay="800">
                    <div class="status-card">
                        <i class="fas fa-tools status-icon"></i>
                        <p class="status-text">
                            <strong>We're on it!</strong> Our technical team has been automatically notified 
                            and is working to resolve this issue. Please try again in a few moments.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Background -->
    <div class="error-background">
        <div class="floating-gears">
            <i class="fas fa-cog gear-1"></i>
            <i class="fas fa-cog gear-2"></i>
            <i class="fas fa-cog gear-3"></i>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .error-500-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #dc3545 0%, #6f42c1 50%, #fd7e14 100%);
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

    .glitch-digit {
        animation: glitch 2s ease-in-out infinite;
    }

    .spinning-digit {
        animation: spin 3s linear infinite;
        display: inline-block;
    }

    .spinning-digit.delay {
        animation-delay: -1.5s;
    }

    .digit-0-wrapper {
        position: relative;
        margin: 0 1rem;
    }

    .gear-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .spinning-gear {
        animation: spin 2s linear infinite;
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

    .status-card {
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

    .status-icon {
        font-size: 2rem;
        color: #17a2b8;
        margin-right: 1rem;
        animation: bounce 2s ease-in-out infinite;
    }

    .status-text {
        margin: 0;
        color: #495057;
        font-size: 0.95rem;
        line-height: 1.5;
        text-align: left;
    }

    .floating-gears {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-gears i {
        position: absolute;
        font-size: 4rem;
        opacity: 0.1;
        color: #ffffff;
        animation: spin 10s linear infinite;
    }

    .gear-1 { top: 20%; left: 20%; animation-duration: 8s; }
    .gear-2 { top: 60%; right: 20%; animation-duration: 12s; animation-direction: reverse; }
    .gear-3 { bottom: 20%; left: 50%; animation-duration: 15s; }

    @keyframes glitch {
        0%, 100% { text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); }
        20% { text-shadow: 2px 0 #ff0000, -2px 0 #0000ff; }
        40% { text-shadow: -2px 0 #ff0000, 2px 0 #0000ff; }
        60% { text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); }
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    @media (max-width: 768px) {
        .error-number { font-size: 5rem; }
        .error-title { font-size: 2rem; }
        .error-description { font-size: 1rem; }
        .status-card { flex-direction: column; text-align: center; padding: 1.5rem; }
        .status-icon { margin-right: 0; margin-bottom: 1rem; }
        .floating-gears i { font-size: 3rem; }
    }
</style>
@endpush
