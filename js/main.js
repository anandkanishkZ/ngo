// Main JavaScript for Hope Foundation Website
// Enhanced effects and interactions

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize all effects
    initParticleBackground();
    initTypingEffect();
    initCounterAnimation();
    initSmoothScrolling();
    initScrollEffects();
    initFormValidation();
    initImageLazyLoading();
    initTooltips();
    initProcessAnimations();
    initIntersectionObserver();
    initNewsletterValidation();
    initPremiumNewsletterValidation();
    initSimpleNewsletterValidation();
    initHorizontalNewsletterValidation();
    initHeaderVisibilityController();
    initBackToTopButton();
    
});

// Horizontal Newsletter Form Validation
function initHorizontalNewsletterValidation() {
    const form = document.querySelector('.horizontal-form');
    if (!form) return;

    const emailInput = form.querySelector('.horizontal-input');
    const checkbox = form.querySelector('#horizontal-consent') || form.querySelector('.custom-checkbox');
    const submitBtn = form.querySelector('.horizontal-submit-btn');
    const inputContainer = form.querySelector('.input-container');

    // Enhanced input interactions
    emailInput.addEventListener('focus', () => {
        if (inputContainer) {
            inputContainer.style.transform = 'translateY(-2px)';
            inputContainer.style.boxShadow = '0 8px 25px rgba(16, 185, 129, 0.15)';
        }
    });

    emailInput.addEventListener('blur', () => {
        if (inputContainer) {
            inputContainer.style.transform = 'translateY(0)';
            inputContainer.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.1)';
        }
        
        // Validate on blur
        const email = emailInput.value.trim();
        if (email && !isValidEmail(email)) {
            emailInput.style.borderColor = '#ef4444';
            emailInput.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
        } else {
            emailInput.style.borderColor = '';
            emailInput.style.boxShadow = '';
        }
    });

    // Clear error styling on input
    emailInput.addEventListener('input', () => {
        emailInput.style.borderColor = '';
        emailInput.style.boxShadow = '';
    });

    // Form submission with toast notifications
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const email = emailInput.value.trim();
        const isConsentGiven = checkbox ? checkbox.checked : true;

        // Validate email using global toast function
        if (window.validateNewsletterEmail && !window.validateNewsletterEmail(email)) {
            emailInput.focus();
            return;
        }

        // Validate consent using global toast function
        if (checkbox && window.validateNewsletterConsent && !window.validateNewsletterConsent(checkbox)) {
            return;
        }

        // Show success animation
        submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Processing...';
        submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        form.classList.add('success');
        
        // Animate the entire form
        const inputGroup = form.querySelector('.horizontal-input-group');
        if (inputGroup) {
            inputGroup.style.transform = 'scale(1.02)';
        }
        
        // Simulate processing time
        setTimeout(() => {
            form.reset();
            submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Subscribe';
            submitBtn.style.background = 'linear-gradient(135deg, #059669, #047857)';
            form.classList.remove('success');
            
            if (inputGroup) {
                inputGroup.style.transform = 'scale(1)';
            }
            
            // Show success toast notification
            if (window.showNewsletterSuccess) {
                window.showNewsletterSuccess();
            }
        }, 2000);
    });

    // Email validation function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}

// Simple Newsletter Form Validation
function initSimpleNewsletterValidation() {
    const form = document.querySelector('.simple-form');
    if (!form) return;

    const inputs = form.querySelectorAll('.simple-input');
    const checkbox = form.querySelector('#simple-consent');
    const submitBtn = form.querySelector('.simple-submit-btn');

    // Add validation event listeners
    inputs.forEach(input => {
        input.addEventListener('blur', () => validateSimpleField(input));
        input.addEventListener('input', () => clearSimpleError(input));
    });

    checkbox.addEventListener('change', () => validateSimpleCheckbox(checkbox));

    // Form submission
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        handleSimpleFormSubmit(form, inputs, checkbox, submitBtn);
    });

    // Simple field validation
    function validateSimpleField(field) {
        const value = field.value.trim();
        const fieldType = field.type;
        
        let isValid = true;
        let message = '';

        if (!value) {
            isValid = false;
            message = getSimpleErrorMessage(field.name, 'required');
        } else if (fieldType === 'email' && !isValidEmail(value)) {
            isValid = false;
            message = 'Please enter a valid email address';
        } else if (field.name === 'full_name' && value.length < 2) {
            isValid = false;
            message = 'Please enter your full name';
        }

        if (!isValid) {
            showSimpleError(field, message);
            field.classList.add('error');
        } else {
            clearSimpleError(field);
            field.classList.remove('error');
        }

        return isValid;
    }

    // Simple checkbox validation
    function validateSimpleCheckbox(checkbox) {
        const isValid = checkbox.checked;
        
        if (!isValid) {
            showSimpleError(checkbox, 'Please accept the terms');
        } else {
            clearSimpleError(checkbox);
        }

        return isValid;
    }

    // Show simple error message
    function showSimpleError(field, message) {
        clearSimpleError(field);
        
        const errorElement = field.closest('.mb-3, .mb-4').querySelector('.simple-error-message');
        if (errorElement) {
            errorElement.querySelector('span').textContent = message;
            errorElement.style.display = 'block';
        }
    }

    // Clear simple error message
    function clearSimpleError(field) {
        const errorElement = field.closest('.mb-3, .mb-4, .form-check').querySelector('.simple-error-message');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
        field.classList.remove('error');
    }

    // Get simple error message
    function getSimpleErrorMessage(fieldName, type) {
        const messages = {
            'full_name': {
                'required': 'Please enter your full name'
            },
            'email': {
                'required': 'Please enter your email address'
            }
        };

        return messages[fieldName] && messages[fieldName][type] ? 
               messages[fieldName][type] : 'This field is required';
    }

    // Handle simple form submission
    function handleSimpleFormSubmit(form, inputs, checkbox, submitBtn) {
        let isFormValid = true;

        // Validate all fields
        inputs.forEach(input => {
            if (!validateSimpleField(input)) {
                isFormValid = false;
            }
        });

        // Validate checkbox
        if (!validateSimpleCheckbox(checkbox)) {
            isFormValid = false;
        }

        if (isFormValid) {
            // Show success animation
            submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Subscribed!';
            submitBtn.style.background = '#10b981';
            
            // Reset form after delay
            setTimeout(() => {
                form.reset();
                submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Subscribe';
                submitBtn.style.background = '#059669';
                
                // Show success message
                showSimpleSuccessMessage(form);
            }, 2000);
        }
    }

    // Show success message
    function showSimpleSuccessMessage(form) {
        const successMessage = document.createElement('div');
        successMessage.style.cssText = `
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-radius: 8px;
            padding: 12px 16px;
            margin-top: 16px;
            text-align: center;
            font-weight: 600;
            animation: fadeInUp 0.3s ease;
        `;
        successMessage.innerHTML = '<i class="fas fa-check-circle me-2"></i>Thank you for subscribing! Check your email for confirmation.';
        
        form.appendChild(successMessage);
        
        setTimeout(() => {
            if (successMessage.parentNode) {
                successMessage.parentNode.removeChild(successMessage);
            }
        }, 5000);
    }
}

// Premium Newsletter Form Validation & UX
function initPremiumNewsletterValidation() {
    const form = document.querySelector('.premium-form');
    if (!form) return;

    const inputs = form.querySelectorAll('.premium-input');
    const checkbox = form.querySelector('#premium-consent');
    const submitBtn = form.querySelector('.premium-submit-btn');
    
    // Initialize intersection observer for animations
    initPremiumAnimations();

    // Enhanced validation event listeners
    inputs.forEach((input, index) => {
        // Add focus/blur effects
        input.addEventListener('focus', () => handleInputFocus(input));
        input.addEventListener('blur', () => handleInputBlur(input));
        input.addEventListener('input', () => handleInputChange(input));
        
        // Add staggered animation delay
        setTimeout(() => {
            input.style.opacity = '1';
            input.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Checkbox validation
    checkbox.addEventListener('change', () => validatePremiumCheckbox(checkbox));

    // Form submission with enhanced UX
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        handlePremiumFormSubmit(form, inputs, checkbox, submitBtn);
    });

    // Real-time validation functions
    function handleInputFocus(input) {
        clearPremiumError(input);
        input.closest('.premium-input-group').style.transform = 'translateY(-2px)';
    }

    function handleInputBlur(input) {
        validatePremiumField(input);
        input.closest('.premium-input-group').style.transform = 'translateY(0)';
    }

    function handleInputChange(input) {
        if (input.value.trim()) {
            clearPremiumError(input);
            if (validatePremiumField(input, false)) {
                input.classList.add('success');
                input.classList.remove('error');
            }
        }
    }

    // Enhanced field validation
    function validatePremiumField(field, showError = true) {
        const value = field.value.trim();
        const fieldType = field.type;
        const fieldName = field.name;
        
        let isValid = true;
        let message = '';

        // Validation rules
        if (!value) {
            isValid = false;
            message = getPremiumErrorMessage(fieldName, 'required');
        } else if (fieldType === 'email' && !isValidEmail(value)) {
            isValid = false;
            message = getPremiumErrorMessage(fieldName, 'invalid');
        } else if (fieldName.includes('name') && value.length < 2) {
            isValid = false;
            message = getPremiumErrorMessage(fieldName, 'short');
        }

        // Update field appearance
        if (!isValid && showError) {
            showPremiumError(field, message);
        } else if (isValid) {
            clearPremiumError(field);
            field.classList.add('success');
            field.classList.remove('error');
        }

        return isValid;
    }

    // Checkbox validation
    function validatePremiumCheckbox(checkbox) {
        const errorContainer = checkbox.closest('.mb-4').querySelector('.premium-error-message');
        
        if (!checkbox.checked) {
            showPremiumError(checkbox, 'Please accept our terms and conditions to continue');
            return false;
        } else {
            clearPremiumError(checkbox);
            return true;
        }
    }

    // Enhanced form submission
    function handlePremiumFormSubmit(form, inputs, checkbox, submitBtn) {
        let isValid = true;
        const errors = [];

        // Validate all fields
        inputs.forEach(input => {
            if (!validatePremiumField(input)) {
                isValid = false;
                errors.push(input.name);
            }
        });

        // Validate checkbox
        if (!validatePremiumCheckbox(checkbox)) {
            isValid = false;
            errors.push('consent');
        }

        if (isValid) {
            handleSuccessfulSubmission(submitBtn, form);
        } else {
            handleFailedSubmission(submitBtn, errors);
        }
    }

    // Success submission handling
    function handleSuccessfulSubmission(submitBtn, form) {
        // Show loading state
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<span>Processing...</span>';
        
        // Simulate API call
        setTimeout(() => {
            // Show success state
            submitBtn.classList.remove('loading');
            submitBtn.classList.add('success');
            submitBtn.innerHTML = '<span><i class="fas fa-check me-2"></i>Successfully Subscribed!</span>';
            
            // Show success message
            showPremiumSuccessMessage(form);
            
            // Reset form after delay
            setTimeout(() => {
                resetPremiumForm(form, submitBtn);
            }, 3000);
        }, 2000);
    }

    // Failed submission handling
    function handleFailedSubmission(submitBtn, errors) {
        // Add shake animation to button
        submitBtn.style.animation = 'shake 0.5s ease-in-out';
        setTimeout(() => {
            submitBtn.style.animation = '';
        }, 500);
        
        // Focus first error field
        const firstErrorField = form.querySelector('.premium-input.error');
        if (firstErrorField) {
            firstErrorField.focus();
        }
    }

    // Error message helpers
    function getPremiumErrorMessage(fieldName, type) {
        const messages = {
            'first_name': {
                'required': 'Please enter your first name',
                'short': 'First name must be at least 2 characters'
            },
            'last_name': {
                'required': 'Please enter your last name',
                'short': 'Last name must be at least 2 characters'
            },
            'email': {
                'required': 'Please enter your email address',
                'invalid': 'Please enter a valid email address'
            }
        };
        
        return messages[fieldName]?.[type] || 'Please check this field';
    }

    // Show premium error
    function showPremiumError(field, message) {
        const inputGroup = field.closest('.premium-input-group') || field.closest('.mb-4');
        const errorContainer = inputGroup.querySelector('.premium-error-message');
        
        field.classList.add('error');
        field.classList.remove('success');
        
        if (errorContainer) {
            const errorText = errorContainer.querySelector('span');
            if (errorText) errorText.textContent = message;
            errorContainer.style.display = 'block';
        }
    }

    // Clear premium error
    function clearPremiumError(field) {
        const inputGroup = field.closest('.premium-input-group') || field.closest('.mb-4');
        const errorContainer = inputGroup.querySelector('.premium-error-message');
        
        field.classList.remove('error');
        
        if (errorContainer) {
            errorContainer.style.display = 'none';
        }
    }

    // Success message
    function showPremiumSuccessMessage(form) {
        const successDiv = document.createElement('div');
        successDiv.className = 'premium-success-message';
        successDiv.innerHTML = `
            <div style="background: rgba(16, 185, 129, 0.1); color: #10b981; 
                        border: 1px solid rgba(16, 185, 129, 0.3); 
                        border-radius: 12px; padding: 16px 20px; margin-top: 16px;
                        backdrop-filter: blur(10px); display: flex; align-items: center;
                        animation: slideInUp 0.5s ease;">
                <i class="fas fa-check-circle me-3" style="font-size: 20px;"></i>
                <div>
                    <div style="font-weight: 600; margin-bottom: 4px;">Welcome to our community!</div>
                    <div style="font-size: 13px; opacity: 0.8;">Check your email for confirmation details.</div>
                </div>
            </div>
        `;
        
        form.appendChild(successDiv);
        
        setTimeout(() => {
            successDiv.remove();
        }, 5000);
    }

    // Reset form
    function resetPremiumForm(form, submitBtn) {
        form.reset();
        submitBtn.classList.remove('success');
        submitBtn.innerHTML = '<span><i class="fas fa-paper-plane me-3"></i>Subscribe to Community</span>';
        
        // Clear all field states
        inputs.forEach(input => {
            input.classList.remove('success', 'error');
            clearPremiumError(input);
        });
    }

    // Initialize premium animations
    function initPremiumAnimations() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, { threshold: 0.2 });

        // Observe premium elements
        document.querySelectorAll('.premium-feature-item, .premium-newsletter-form').forEach(el => {
            observer.observe(el);
        });
    }

    // Email validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}

// Shake animation keyframes
const shakeKeyframes = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
`;

// Add shake animation to document
if (!document.querySelector('#shake-animation')) {
    const style = document.createElement('style');
    style.id = 'shake-animation';
    style.textContent = shakeKeyframes;
    document.head.appendChild(style);
}

// Professional Newsletter Form Validation
function initNewsletterValidation() {
    const form = document.querySelector('.newsletter-form form');
    if (!form) return;

    const inputs = form.querySelectorAll('.professional-input');
    const checkbox = form.querySelector('#newsletter-consent');
    const submitBtn = form.querySelector('.professional-submit-btn');

    // Add validation event listeners
    inputs.forEach(input => {
        input.addEventListener('blur', () => validateField(input));
        input.addEventListener('input', () => clearFieldError(input));
    });

    checkbox.addEventListener('change', () => validateCheckbox(checkbox));

    // Form submit validation
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        let isValid = true;
        
        // Validate all fields
        inputs.forEach(input => {
            if (!validateField(input)) {
                isValid = false;
            }
        });

        // Validate checkbox
        if (!validateCheckbox(checkbox)) {
            isValid = false;
        }

        if (isValid) {
            showSubmitSuccess();
        }
    });

    // Field validation function
    function validateField(field) {
        const value = field.value.trim();
        const fieldType = field.type;
        const wrapper = field.closest('.form-group-wrapper') || field.closest('.col-md-6') || field.closest('.col-12');
        const feedback = wrapper.querySelector('.invalid-feedback');
        
        let isValid = true;
        let message = '';

        // Check if field is empty
        if (!value) {
            isValid = false;
            if (field.name === 'first_name') message = 'Please enter your first name';
            else if (field.name === 'last_name') message = 'Please enter your last name';
            else if (field.name === 'email') message = 'Please enter your email address';
        } 
        // Validate email format
        else if (fieldType === 'email' && !isValidEmail(value)) {
            isValid = false;
            message = 'Please enter a valid email address';
        }

        // Show/hide error message
        if (!isValid) {
            showFieldError(field, feedback, message);
        } else {
            hideFieldError(field, feedback);
        }

        return isValid;
    }

    // Checkbox validation
    function validateCheckbox(checkbox) {
        const wrapper = checkbox.closest('.form-check').parentElement;
        const feedback = wrapper.querySelector('.invalid-feedback');
        
        if (!checkbox.checked) {
            showFieldError(checkbox, feedback, 'Please accept our terms and conditions');
            return false;
        } else {
            hideFieldError(checkbox, feedback);
            return true;
        }
    }

    // Show field error
    function showFieldError(field, feedback, message) {
        field.style.borderColor = '#ff6b6b';
        field.style.boxShadow = '0 0 0 0.2rem rgba(255, 107, 107, 0.25)';
        
        if (feedback) {
            feedback.textContent = message;
            feedback.style.display = 'flex';
            feedback.style.animation = 'slideDown 0.3s ease';
        }
    }

    // Hide field error
    function hideFieldError(field, feedback) {
        field.style.borderColor = 'rgba(255,255,255,0.2)';
        field.style.boxShadow = 'none';
        
        if (feedback) {
            feedback.style.display = 'none';
        }
    }

    // Clear field error on input
    function clearFieldError(field) {
        const wrapper = field.closest('.form-group-wrapper') || field.closest('.col-md-6') || field.closest('.col-12');
        const feedback = wrapper.querySelector('.invalid-feedback');
        
        if (field.value.trim()) {
            hideFieldError(field, feedback);
        }
    }

    // Email validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Show success message
    function showSubmitSuccess() {
        // Add success animation to button
        submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        submitBtn.innerHTML = '<span style="position: relative; z-index: 2;"><i class="fas fa-check me-2"></i>Subscribed Successfully!</span>';
        
        // Reset form after delay
        setTimeout(() => {
            form.reset();
            submitBtn.style.background = 'linear-gradient(135deg, #fbbf24, #f59e0b)';
            submitBtn.innerHTML = '<span style="position: relative; z-index: 2;"><i class="fas fa-envelope-open me-2"></i>Subscribe Now</span>';
        }, 2000);
    }
}

// Particle Background Effect
function initParticleBackground() {
    const heroSection = document.querySelector('.hero-section');
    if (!heroSection) return;
    
    // Create particle container
    const particleContainer = document.createElement('div');
    particleContainer.className = 'particle-bg';
    heroSection.appendChild(particleContainer);
    
    // Create particles
    function createParticle() {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random size
        const size = Math.random() * 4 + 2;
        particle.style.width = size + 'px';
        particle.style.height = size + 'px';
        
        // Random position
        particle.style.left = Math.random() * 100 + '%';
        
        // Random animation duration
        particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
        particle.style.animationDelay = Math.random() * 5 + 's';
        
        particleContainer.appendChild(particle);
        
        // Remove particle after animation
        setTimeout(() => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
            }
        }, 20000);
    }
    
    // Create particles periodically
    setInterval(createParticle, 300);
}

// Typing Effect for Hero Title
function initTypingEffect() {
    const heroTitle = document.querySelector('.hero-title');
    if (!heroTitle) return;
    
    const text = heroTitle.textContent;
    const parts = text.split(' ');
    
    if (parts.length > 1) {
        const staticPart = parts.slice(0, -1).join(' ') + ' ';
        const typingPart = parts[parts.length - 1];
        
        heroTitle.innerHTML = staticPart + '<span class="typing-text"></span>';
        
        const typingElement = heroTitle.querySelector('.typing-text');
        let i = 0;
        
        function typeWriter() {
            if (i < typingPart.length) {
                typingElement.textContent += typingPart.charAt(i);
                i++;
                setTimeout(typeWriter, 150);
            } else {
                typingElement.classList.add('typing-animation');
            }
        }
        
        setTimeout(typeWriter, 1000);
    }
}

// Enhanced Counter Animation
function initCounterAnimation() {
    const counters = document.querySelectorAll('.stat-number');
    
    function animateCounter(counter) {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const step = target / (duration / 16); // 60 FPS
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }
    
    // Use Intersection Observer for better performance
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                animateCounter(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    counters.forEach(counter => observer.observe(counter));
}

// Smooth Scrolling Enhancement
function initSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerOffset = 100;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Advanced Scroll Effects with Professional Sticky Header
function initScrollEffects() {
    let ticking = false;
    let lastScrollTop = 0;
    const header = document.querySelector('.main-header');
    const scrollThreshold = 100;
    
    function updateStickyHeader() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollingDown = scrollTop > lastScrollTop;
        
        // Add/remove scrolled class based on scroll position
        if (scrollTop > scrollThreshold) {
            header.classList.add('scrolled');
            
            // Optional: Hide header when scrolling down, show when scrolling up
            // Uncomment below for auto-hide behavior
            /*
            if (scrollingDown && scrollTop > 300) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            */
            
        } else {
            header.classList.remove('scrolled');
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
        
        // Update navbar background with scroll progress
        const scrollProgress = Math.min(scrollTop / scrollThreshold, 1);
        const opacity = 0.95 + (0.05 * scrollProgress);
        
        if (scrollTop > scrollThreshold) {
            header.style.background = `rgba(255, 255, 255, ${opacity})`;
        } else {
            header.style.background = 'white';
        }
    }
    
    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(() => {
                updateStickyHeader();
                ticking = false;
            });
            ticking = true;
        }
    }
    
    // Initialize header styles
    if (header) {
        header.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    }
    
    window.addEventListener('scroll', onScroll, { passive: true });
    
    // Parallax effect for hero section (if exists)
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.3;
            heroSection.style.transform = `translateY(${rate}px)`;
        }, { passive: true });
    }
    
    // Professional smooth scroll for navigation links
    initSmoothScrollForNavigation();
}

// Professional Smooth Scrolling for Navigation Links
function initSmoothScrollForNavigation() {
    document.querySelectorAll('.main-nav a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);
            
            if (target) {
                const headerHeight = document.querySelector('.main-header').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                
                // Professional smooth scroll with easing
                smoothScrollTo(targetPosition, 800);
                
                // Update active navigation state
                updateActiveNavigation(this);
            }
        });
    });
}

// Custom smooth scroll function with easing
function smoothScrollTo(targetPosition, duration) {
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;
    
    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / duration, 1);
        
        // Easing function (ease-in-out-cubic)
        const ease = progress < 0.5 
            ? 4 * progress * progress * progress 
            : (progress - 1) * (2 * progress - 2) * (2 * progress - 2) + 1;
        
        window.scrollTo(0, startPosition + (distance * ease));
        
        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        }
    }
    
    requestAnimationFrame(animation);
}

// Update active navigation state
function updateActiveNavigation(activeLink) {
    // Remove active class from all links
    document.querySelectorAll('.main-nav a').forEach(link => {
        link.classList.remove('active');
    });
    
    // Add active class to clicked link
    activeLink.classList.add('active');
}

// Professional Header Visibility Controller (Optional Enhancement)
function initHeaderVisibilityController() {
    let isHeaderVisible = true;
    let scrollTimer = null;
    const header = document.querySelector('.main-header');
    
    window.addEventListener('scroll', () => {
        if (!isHeaderVisible) {
            header.style.transform = 'translateY(0)';
            isHeaderVisible = true;
        }
        
        // Clear existing timer
        clearTimeout(scrollTimer);
        
        // Set timer to hide header after scroll stops (optional)
        scrollTimer = setTimeout(() => {
            const scrollTop = window.pageYOffset;
            if (scrollTop > 500) {
                // Optional: Uncomment to enable auto-hide after scroll stops
                // header.style.transform = 'translateY(-100%)';
                // isHeaderVisible = false;
            }
        }, 150);
    }, { passive: true });
}

// Enhanced Form Validation
function initFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, textarea, select');
        
        inputs.forEach(input => {
            // Real-time validation
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });
        
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.focus();
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    });
}

function validateField(field) {
    const value = field.value.trim();
    const type = field.type;
    const required = field.hasAttribute('required');
    
    // Remove previous validation classes
    field.classList.remove('is-valid', 'is-invalid');
    
    // Check if required field is empty
    if (required && !value) {
        addValidationFeedback(field, 'This field is required', 'invalid');
        return false;
    }
    
    // Email validation
    if (type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            addValidationFeedback(field, 'Please enter a valid email address', 'invalid');
            return false;
        }
    }
    
    // Phone validation
    if (type === 'tel' && value) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        if (!phoneRegex.test(value.replace(/[\s\-\(\)]/g, ''))) {
            addValidationFeedback(field, 'Please enter a valid phone number', 'invalid');
            return false;
        }
    }
    
    // Number validation for donation amounts
    if (field.name === 'amount' && value) {
        const amount = parseFloat(value);
        if (isNaN(amount) || amount <= 0) {
            addValidationFeedback(field, 'Please enter a valid amount', 'invalid');
            return false;
        }
    }
    
    // If we get here, the field is valid
    addValidationFeedback(field, 'Looks good!', 'valid');
    return true;
}

function addValidationFeedback(field, message, type) {
    // Remove existing feedback
    const existingFeedback = field.parentNode.querySelector('.invalid-feedback, .valid-feedback');
    if (existingFeedback) {
        existingFeedback.remove();
    }
    
    // Add new feedback
    const feedback = document.createElement('div');
    feedback.className = `${type}-feedback`;
    feedback.textContent = message;
    
    field.classList.add(`is-${type}`);
    field.parentNode.appendChild(feedback);
}

// Image Lazy Loading with Intersection Observer
function initImageLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Initialize Tooltips
function initTooltips() {
    // Simple tooltip implementation
    document.querySelectorAll('[data-tooltip]').forEach(element => {
        element.addEventListener('mouseenter', function(e) {
            const tooltip = document.createElement('div');
            tooltip.className = 'custom-tooltip';
            tooltip.textContent = this.getAttribute('data-tooltip');
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
            
            this._tooltip = tooltip;
        });
        
        element.addEventListener('mouseleave', function() {
            if (this._tooltip) {
                this._tooltip.remove();
                this._tooltip = null;
            }
        });
    });
}

// Donation Amount Button Enhancement
document.addEventListener('click', function(e) {
    if (e.target.matches('.donation-amount-btn')) {
        // Remove active class from all buttons
        document.querySelectorAll('.donation-amount-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Add active class to clicked button
        e.target.classList.add('active');
        
        // Update custom amount input
        const amount = e.target.getAttribute('data-amount');
        const customAmountInput = document.getElementById('customAmount');
        if (customAmountInput) {
            customAmountInput.value = amount;
            
            // Trigger impact display update
            if (window.updateImpactDisplay) {
                window.updateImpactDisplay(amount);
            }
        }
    }
});

// Loading Screen Management
window.addEventListener('load', function() {
    const loading = document.getElementById('loading');
    if (loading) {
        loading.style.opacity = '0';
        setTimeout(() => {
            loading.style.display = 'none';
        }, 500);
    }
});

// Add ripple effect to buttons
document.addEventListener('click', function(e) {
    if (e.target.matches('.btn, .ripple')) {
        const button = e.target;
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = size + 'px';
        ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.className = 'ripple-effect';
        
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    }
});

// CSS for ripple effect
const rippleCSS = `
.ripple-effect {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(2);
        opacity: 0;
    }
}

.custom-tooltip {
    position: absolute;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 8px 12px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
    pointer-events: none;
}

.loaded {
    opacity: 1;
    transition: opacity 0.3s ease;
}

img[data-src] {
    opacity: 0;
}
`;

// Inject CSS
const style = document.createElement('style');
style.textContent = rippleCSS;
document.head.appendChild(style);

// Utility function to debounce events
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Professional Process Section Animations - Optimized
function initProcessAnimations() {
    const processCards = document.querySelectorAll('.enhanced-card');
    
    // Optimized hover animations with performance considerations
    processCards.forEach((card, index) => {
        // Preload hover state for better performance
        card.style.willChange = 'transform, box-shadow, filter';
        
        card.addEventListener('mouseenter', function(e) {
            // Use requestAnimationFrame for smooth animations
            requestAnimationFrame(() => {
                // Main card transformation - handled by CSS
                // Just trigger additional effects here
                
                // Smooth progress line animation
                const progressLine = this.querySelector('.progress-line');
                if (progressLine) {
                    progressLine.style.willChange = 'transform';
                }
                
                // Icon wrapper enhancement
                const iconWrapper = this.querySelector('.icon-wrapper');
                if (iconWrapper) {
                    iconWrapper.style.willChange = 'transform';
                }
                
                // Number hover effect - let CSS handle the animation
                const numberElement = this.querySelector('.process-number');
                if (numberElement) {
                    numberElement.style.willChange = 'transform, box-shadow';
                }
            });
        });
        
        card.addEventListener('mouseleave', function(e) {
            requestAnimationFrame(() => {
                // Reset will-change for better performance
                const progressLine = this.querySelector('.progress-line');
                if (progressLine) {
                    progressLine.style.willChange = 'auto';
                }
                
                const iconWrapper = this.querySelector('.icon-wrapper');
                if (iconWrapper) {
                    iconWrapper.style.willChange = 'auto';
                }
                
                const numberElement = this.querySelector('.process-number');
                if (numberElement) {
                    numberElement.style.willChange = 'auto';
                }
            });
        });
        
        // Optimized click animation
        card.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Subtle feedback animation
            this.style.transform = 'translateY(-10px) scale(1.01)';
            
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
}

// Enhanced Intersection Observer for Process Section - Professional UX
function initIntersectionObserver() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -5% 0px'
    };
    
    // Professional staggered entrance animations
    const processObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const card = entry.target;
                const cardIndex = Array.from(document.querySelectorAll('.enhanced-card')).indexOf(card);
                
                // Smooth entrance animation with proper timing
                setTimeout(() => {
                    card.classList.add('animate-in');
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, cardIndex * 150);
                
                // Progressive progress line animation
                const progressLine = card.querySelector('.progress-line');
                if (progressLine) {
                    setTimeout(() => {
                        progressLine.style.transform = 'scaleX(1)';
                    }, cardIndex * 200 + 400);
                }
                
                // Floating icon activation
                const icon = card.querySelector('.floating-animation');
                if (icon) {
                    setTimeout(() => {
                        icon.style.animation = 'iconFloat 3s ease-in-out infinite';
                        icon.style.animationDelay = `${cardIndex * 0.3}s`;
                    }, cardIndex * 100 + 600);
                }
                
                // Number pulse activation
                const numberElement = card.querySelector('.process-number');
                if (numberElement) {
                    setTimeout(() => {
                        numberElement.style.animation = 'numberPulse 2.5s ease-in-out infinite';
                        numberElement.style.animationDelay = `${cardIndex * 0.2}s`;
                    }, 300);
                }
                
                processObserver.unobserve(card);
            }
        });
    }, observerOptions);
    
    // Initialize cards with hidden state
    document.querySelectorAll('.enhanced-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        processObserver.observe(card);
    });
    
    // Professional title animation
    const processTitle = document.querySelector('.process-section .modern-section-title');
    if (processTitle) {
        const titleObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'gradientShift 8s ease-in-out infinite';
                    titleObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        titleObserver.observe(processTitle);
    }
    
    // Section badge enhancement
    const sectionBadge = document.querySelector('.process-section .section-badge');
    if (sectionBadge) {
        const badgeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.transform = 'translateY(0) scale(1)';
                        entry.target.style.opacity = '1';
                    }, 100);
                    badgeObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        // Initialize badge
        sectionBadge.style.opacity = '0';
        sectionBadge.style.transform = 'translateY(-20px) scale(0.9)';
        sectionBadge.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        badgeObserver.observe(sectionBadge);
    }
    
    // Enhanced accessibility
    document.querySelectorAll('.enhanced-card').forEach(card => {
        card.setAttribute('tabindex', '0');
        card.setAttribute('role', 'button');
        card.setAttribute('aria-label', 'Process step: ' + card.querySelector('h4').textContent);
        
        // Keyboard interaction
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
}

// Simple Horizontal Newsletter Form (No Validation Messages)
function initHorizontalNewsletterValidation() {
    const form = document.querySelector('.horizontal-form');
    if (!form) return;

    const emailInput = form.querySelector('.horizontal-input');
    const checkbox = form.querySelector('.custom-checkbox');
    const submitBtn = form.querySelector('.horizontal-submit-btn');
    const inputContainer = form.querySelector('.input-container');

    // Simple input interactions
    emailInput.addEventListener('focus', () => {
        inputContainer.style.transform = 'translateY(-2px)';
    });

    emailInput.addEventListener('blur', () => {
        inputContainer.style.transform = 'translateY(0)';
    });

    emailInput.addEventListener('input', () => {
        if (emailInput.value && isValidEmail(emailInput.value)) {
            inputContainer.style.borderColor = 'rgba(16, 185, 129, 0.4)';
        } else {
            inputContainer.style.borderColor = 'rgba(255,255,255,0.3)';
        }
    });

    // Form submission - simple success flow
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const email = emailInput.value.trim();
        const isChecked = checkbox.checked;
        
        // Basic validation without showing error messages
        if (email && isValidEmail(email) && isChecked) {
            // Success animation
            submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Welcome!';
            submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            inputContainer.style.borderColor = 'rgba(16, 185, 129, 0.5)';
            
            // Reset after delay
            setTimeout(() => {
                emailInput.value = '';
                checkbox.checked = false;
                submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Subscribe';
                inputContainer.style.borderColor = 'rgba(255,255,255,0.3)';
                
                // Simple success indication
                showSimpleSuccess();
            }, 1500);
        }
    });

    function showSimpleSuccess() {
        // Brief success feedback without persistent message
        const originalBg = form.parentElement.style.background;
        form.parentElement.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        
        setTimeout(() => {
            form.parentElement.style.background = originalBg;
        }, 2000);
    }
}

// Optimized Back to Top Button Implementation - Instant Response
function initBackToTopButton() {
    const backToTopButton = document.getElementById('backToTop');
    if (!backToTopButton) return;
    
    const progressRing = backToTopButton.querySelector('.progress-ring-circle');
    const showThreshold = 200; // Reduced threshold for faster appearance
    const pulseThreshold = 800; // Reduced for earlier visual feedback
    
    // Calculate circle circumference for progress indicator
    const radius = progressRing ? progressRing.r.baseVal.value : 28;
    const circumference = radius * 2 * Math.PI;
    
    if (progressRing) {
        progressRing.style.strokeDasharray = `${circumference} ${circumference}`;
        progressRing.style.strokeDashoffset = circumference;
    }
    
    // Optimized scroll handler with immediate response
    function handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrollProgress = scrollTop / scrollHeight;
        
        // Instant show/hide with no delays
        if (scrollTop > showThreshold) {
            if (!backToTopButton.classList.contains('show')) {
                backToTopButton.classList.add('show');
            }
            
            // Add pulse effect for long pages
            if (scrollTop > pulseThreshold) {
                backToTopButton.classList.add('pulse');
            } else {
                backToTopButton.classList.remove('pulse');
            }
        } else {
            backToTopButton.classList.remove('show', 'pulse');
        }
        
        // Update progress ring instantly
        if (progressRing && scrollHeight > 0) {
            const offset = circumference - (scrollProgress * circumference);
            progressRing.style.strokeDashoffset = offset;
        }
    }
    
    // Ultra-smooth and fast scroll to top with multiple options
    function scrollToTop() {
        const startPosition = window.pageYOffset;
        
        // For very short distances, use instant scroll
        if (startPosition < 500) {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            
            // Immediate visual feedback
            backToTopButton.style.transform = 'scale(0.95)';
            setTimeout(() => {
                backToTopButton.style.transform = 'scale(1)';
                
                // Brief success feedback
                backToTopButton.style.background = 'linear-gradient(135deg, #27ae60, #2ecc71)';
                setTimeout(() => {
                    backToTopButton.style.background = '';
                }, 150);
            }, 100);
            return;
        }
        
        // For longer distances, use optimized custom animation
        const duration = Math.min(500, Math.max(250, startPosition / 8));
        const startTime = performance.now();
        
        // Immediate visual feedback
        backToTopButton.style.transform = 'scale(0.95)';
        const icon = backToTopButton.querySelector('i');
        if (icon) {
            icon.style.transform = 'rotate(180deg)';
        }
        
        function animateScroll(currentTime) {
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            
            // Ultra-smooth easing (ease-out-quart for speed + smoothness)
            const ease = 1 - Math.pow(1 - progress, 4);
            const currentPosition = startPosition * (1 - ease);
            
            window.scrollTo(0, Math.max(0, currentPosition));
            
            if (progress < 1) {
                requestAnimationFrame(animateScroll);
            } else {
                // Immediate reset
                backToTopButton.style.transform = 'scale(1)';
                if (icon) {
                    icon.style.transform = '';
                }
                
                // Brief success feedback
                backToTopButton.style.background = 'linear-gradient(135deg, #27ae60, #2ecc71)';
                setTimeout(() => {
                    backToTopButton.style.background = '';
                }, 150);
            }
        }
        
        requestAnimationFrame(animateScroll);
    }
    
    // Event listeners with instant response
    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        scrollToTop();
        
        // Track analytics (if available)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'scroll_to_top', {
                event_category: 'engagement',
                event_label: 'back_to_top_button'
            });
        }
    });
    
    // Keyboard accessibility with instant response
    backToTopButton.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            scrollToTop();
        }
    });
    
    // Immediate hover effects
    backToTopButton.addEventListener('mouseenter', () => {
        if (backToTopButton.classList.contains('show')) {
            backToTopButton.style.transform = 'translateY(-2px) scale(1.05)';
        }
    });
    
    backToTopButton.addEventListener('mouseleave', () => {
        backToTopButton.style.transform = '';
    });
    
    // Optimized scroll listener - direct call for instant updates
    window.addEventListener('scroll', handleScroll, { passive: true });
    
    // Initial check
    handleScroll();
    
    // Enhanced visibility for long content pages
    setTimeout(() => {
        const contentHeight = document.documentElement.scrollHeight;
        const viewportHeight = window.innerHeight;
        
        if (contentHeight > viewportHeight * 3) {
            // Add extra visual cue for very long pages
            backToTopButton.style.boxShadow = '0 8px 25px rgba(231, 76, 60, 0.4), 0 0 0 0 rgba(231, 76, 60, 0.2)';
        }
    }, 1000);
    
    // Page visibility API for performance optimization
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            // Pause animations when tab is not visible
            backToTopButton.style.animationPlayState = 'paused';
        } else {
            backToTopButton.style.animationPlayState = 'running';
        }
    });
}
