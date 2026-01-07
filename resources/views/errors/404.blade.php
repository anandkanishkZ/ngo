@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<div class="error-404-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 text-center">
                <!-- Animated 404 Section -->
                <div class="error-animation-wrapper">
                    <div class="error-number" data-aos="zoom-in" data-aos-delay="200">
                        <span class="digit-4 floating-digit">4</span>
                        <div class="digit-0-wrapper">
                            <span class="digit-0 rotating-digit">0</span>
                            <div class="search-icon">
                                <i class="fas fa-search pulse-animation"></i>
                            </div>
                        </div>
                        <span class="digit-4 floating-digit delay">4</span>
                    </div>
                </div>

                <!-- Error Message -->
                <div class="error-content" data-aos="fade-up" data-aos-delay="400">
                    <h1 class="error-title">Oops! Page Not Found</h1>
                    <p class="error-description">
                        The page you're looking for seems to have wandered off on its own mission. 
                        Don't worry, even the best explorers sometimes take a wrong turn!
                    </p>
                </div>

                <!-- Helpful Suggestions -->
                <div class="error-suggestions" data-aos="fade-up" data-aos-delay="600">
                    <div class="suggestion-cards">
                        <div class="suggestion-card">
                            <div class="suggestion-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <h4>Go Home</h4>
                            <p>Return to our homepage</p>
                            <a href="{{ route('home') }}" class="btn-suggestion btn-primary">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </div>

                        <div class="suggestion-card">
                            <div class="suggestion-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h4>Make a Donation</h4>
                            <p>Support our cause</p>
                            <a href="{{ route('contact') }}" class="btn-suggestion btn-success">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                        </div>

                        <div class="suggestion-card">
                            <div class="suggestion-icon">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <h4>Volunteer</h4>
                            <p>Join our mission</p>
                            <a href="{{ route('contact') }}" class="btn-suggestion btn-warning">
                                <i class="fas fa-envelope me-2"></i>Contact Us
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search Alternative -->
                <div class="error-search" data-aos="fade-up" data-aos-delay="800">
                    <div class="search-wrapper">
                        <h5 class="search-title">Or search for what you need:</h5>
                        <form class="search-form" action="{{ route('home') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control search-input" 
                                       placeholder="What are you looking for?">
                                <button type="submit" class="btn btn-search">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Fun Facts -->
                <div class="error-fact" data-aos="fade-up" data-aos-delay="1000">
                    <div class="fact-card">
                        <i class="fas fa-lightbulb fact-icon"></i>
                        <p class="fact-text">
                            <strong>Did you know?</strong> While you're here, we've helped over 10,000 people 
                            in our community through various programs and initiatives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-heart floating-element-1">💝</div>
        <div class="floating-star floating-element-2">⭐</div>
        <div class="floating-hands floating-element-3">🤝</div>
        <div class="floating-globe floating-element-4">🌍</div>
        <div class="floating-hope floating-element-5">🕊️</div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* 404 Error Page Styles */
    .error-404-container {
        min-height: 100vh;
        background: linear-gradient(135deg, 
            var(--primary-color) 0%, 
            var(--secondary-color) 50%, 
            var(--accent-color) 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 60px 0;
    }

    /* Animated 404 Number */
    .error-animation-wrapper {
        margin-bottom: 2rem;
    }

    .error-number {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 8rem;
        font-weight: 900;
        color: rgba(255, 255, 255, 0.9);
        text-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 1rem;
    }

    .floating-digit {
        animation: float 3s ease-in-out infinite;
    }

    .floating-digit.delay {
        animation-delay: -1.5s;
    }

    .digit-0-wrapper {
        position: relative;
        margin: 0 1rem;
    }

    .rotating-digit {
        animation: rotate 4s ease-in-out infinite;
        display: inline-block;
        transform-origin: center;
    }

    .search-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .pulse-animation {
        animation: pulse 2s ease-in-out infinite;
    }

    /* Error Content */
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

    /* Suggestion Cards */
    .suggestion-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .suggestion-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .suggestion-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
    }

    .suggestion-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 1.8rem;
        color: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .suggestion-card h4 {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .suggestion-card p {
        color: #6c757d;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .btn-suggestion {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-suggestion.btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: #ffffff;
    }

    .btn-suggestion.btn-success {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: #ffffff;
    }

    .btn-suggestion.btn-warning {
        background: linear-gradient(135deg, #ffc107, #fd7e14);
        color: #ffffff;
    }

    .btn-suggestion:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: #ffffff;
    }

    /* Search Section */
    .search-wrapper {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .search-title {
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .search-input {
        border: 2px solid #e9ecef;
        border-radius: 50px 0 0 50px;
        padding: 1rem 1.5rem;
        font-size: 1rem;
        border-right: none;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.1);
        outline: none;
    }

    .btn-search {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border: 2px solid var(--primary-color);
        border-radius: 0 50px 50px 0;
        padding: 1rem 1.5rem;
        color: #ffffff;
        transition: all 0.3s ease;
        border-left: none;
    }

    .btn-search:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Fun Facts */
    .fact-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        text-align: left;
        max-width: 600px;
        margin: 0 auto;
    }

    .fact-icon {
        font-size: 2rem;
        color: #ffc107;
        margin-right: 1rem;
        animation: bounce 2s ease-in-out infinite;
    }

    .fact-text {
        margin: 0;
        color: #495057;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Floating Background Elements */
    .floating-elements {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-elements div {
        position: absolute;
        font-size: 2rem;
        opacity: 0.1;
        animation: floatAround 20s ease-in-out infinite;
    }

    .floating-element-1 { top: 10%; left: 10%; animation-delay: 0s; }
    .floating-element-2 { top: 20%; right: 15%; animation-delay: -4s; }
    .floating-element-3 { top: 60%; left: 15%; animation-delay: -8s; }
    .floating-element-4 { bottom: 20%; right: 20%; animation-delay: -12s; }
    .floating-element-5 { bottom: 10%; left: 20%; animation-delay: -16s; }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    @keyframes rotate {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(-5deg); }
        75% { transform: rotate(5deg); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    @keyframes floatAround {
        0%, 100% { transform: translateX(0px) translateY(0px) rotate(0deg); }
        25% { transform: translateX(20px) translateY(-20px) rotate(90deg); }
        50% { transform: translateX(40px) translateY(10px) rotate(180deg); }
        75% { transform: translateX(-10px) translateY(20px) rotate(270deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .error-number {
            font-size: 5rem;
        }

        .error-title {
            font-size: 2rem;
        }

        .error-description {
            font-size: 1rem;
        }

        .suggestion-cards {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .suggestion-card {
            padding: 1.5rem;
        }

        .search-wrapper {
            padding: 1.5rem;
        }

        .fact-card {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }

        .fact-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .floating-elements div {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .error-number {
            font-size: 4rem;
        }

        .error-title {
            font-size: 1.8rem;
        }

        .search-input, .btn-search {
            padding: 0.75rem 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Add some interactive animations
    document.addEventListener('DOMContentLoaded', function() {
        // Add parallax effect to floating elements
        document.addEventListener('mousemove', function(e) {
            const elements = document.querySelectorAll('.floating-elements div');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            elements.forEach((element, index) => {
                const speed = (index + 1) * 0.5;
                const xPos = x * speed * 10;
                const yPos = y * speed * 10;
                
                element.style.transform = `translate(${xPos}px, ${yPos}px)`;
            });
        });

        // Add click animation to suggestion cards
        const cards = document.querySelectorAll('.suggestion-card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Auto-focus search input when page loads
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            setTimeout(() => {
                searchInput.focus();
            }, 1500);
        }
    });
</script>
@endpush
