<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | JIDS Nepal Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* Professional Login Page Styles */
:root {
    --login-primary: #2563eb;
    --login-success: #059669;
    --login-warning: #d97706;
    --login-info: #0891b2;
    --login-danger: #dc2626;
    --login-neutral: #64748b;
    
    --bg-primary: #ffffff;
    --bg-secondary: #f8fafc;
    --bg-light: #e0f2fe;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
    --border-light: #f1f5f9;
    
    --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.08);
    --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.1);
    --shadow-card: 0 1px 3px rgba(0, 0, 0, 0.05);
}

body {
    margin: 0;
    padding: 0;
}

.login-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 50%, #ffffff 100%);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Modern Background Pattern */
.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 25% 25%, rgba(37, 99, 235, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(5, 150, 105, 0.05) 0%, transparent 50%);
    z-index: 1;
}

.login-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

/* Professional Login Card */
.login-card {
    background: #ffffff;
    border-radius: 24px;
    padding: 3rem 2.5rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    border: 1px solid #e2e8f0;
    position: relative;
    backdrop-filter: blur(10px);
    max-width: 480px;
    margin: 0 auto;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.login-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 25px 70px rgba(0, 0, 0, 0.2);
}

/* Brand Section */
.brand-section {
    text-align: center;
    margin-bottom: 2.5rem;
}

.brand-logo {
    width: 80px;
    height: 80px;
    background: var(--login-primary);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.25);
    position: relative;
    overflow: hidden;
}

.brand-logo::before {
    content: '';
    position: absolute;
    top: -20px;
    right: -20px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.brand-logo i {
    color: white;
    font-size: 2rem;
    z-index: 2;
    position: relative;
}

.brand-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
    letter-spacing: -0.025em;
}

.brand-subtitle {
    color: #1e293b;
    font-size: 1rem;
    font-weight: 500;
}

/* Form Styling */
.login-form {
    margin-bottom: 0;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-label {
    display: block;
    font-weight: 600;
    font-size: 0.875rem;
    color: #0f172a;
    margin-bottom: 0.5rem;
    letter-spacing: 0.025em;
}

.form-control {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 500;
    color: #0f172a;
    background: #ffffff;
    transition: all 0.3s ease;
    position: relative;
}

.form-control:focus {
    outline: none;
    border-color: var(--login-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

.form-control::placeholder {
    color: #64748b;
    font-weight: 400;
}

/* Password Toggle */
.password-group {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #475569;
    cursor: pointer;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    z-index: 3;
}

.password-toggle:hover {
    color: var(--login-primary);
}

/* Remember & Forgot Section */
.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #cbd5e1;
    border-radius: 6px;
    background: #ffffff;
    transition: all 0.3s ease;
}

.form-check-input:checked {
    background: var(--login-primary);
    border-color: var(--login-primary);
}

.form-check-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #0f172a;
    cursor: pointer;
}

.forgot-link {
    color: var(--login-primary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.forgot-link:hover {
    color: var(--login-info);
    text-decoration: underline;
}

/* Professional Submit Button */
.btn-login {
    width: 100%;
    padding: 1rem 1.5rem;
    background: var(--login-primary);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-login::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.6s ease;
}

.btn-login:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
}

.btn-login:hover::before {
    left: 100%;
}

.btn-login:active {
    transform: translateY(0);
}

.btn-login:disabled {
    background: var(--text-muted);
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Alert Styling */
.alert-danger {
    background: rgba(220, 38, 38, 0.1);
    border: 1px solid rgba(220, 38, 38, 0.2);
    border-radius: 12px;
    color: #991b1b;
    padding: 1rem;
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Loading Animation */
.loading-spinner {
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 576px) {
    .login-card {
        margin: 1rem;
        padding: 2rem 1.5rem;
        border-radius: 20px;
    }
    
    .brand-logo {
        width: 70px;
        height: 70px;
    }
    
    .brand-title {
        font-size: 1.625rem;
    }
    
    .form-control {
        padding: 0.75rem;
    }
    
    .btn-login {
        padding: 0.875rem 1.25rem;
    }
}

/* Accessibility Improvements */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Focus Indicators */
.form-control:focus,
.btn-login:focus,
.form-check-input:focus,
.forgot-link:focus {
    outline: 2px solid var(--login-primary);
    outline-offset: 2px;
}

/* Dark Mode Support (for future) */
@media (prefers-color-scheme: dark) {
    :root {
        --bg-primary: #0f172a;
        --bg-secondary: #1e293b;
        --bg-light: #334155;
        --text-primary: #f8fafc;
        --text-secondary: #cbd5e1;
        --text-muted: #94a3b8;
        --border-color: #334155;
        --border-light: #475569;
    }
}
</style>
</head>
<body>
<div class="login-container">
    <div class="login-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="login-card">
                        <!-- Brand Section -->
                        <div class="brand-section">
                            <div class="brand-logo">
                                <i class="fas fa-shield-heart"></i>
                            </div>
                            <h1 class="brand-title">Welcome back</h1>
                            <p class="brand-subtitle">Sign in to access your JIDS Nepal dashboard</p>
                        </div>

                        <!-- Error Messages -->
                        @if($errors->any())
                            <div class="alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login.post') }}" class="login-form" id="loginForm">
                            @csrf
                            
                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-control" 
                                    placeholder="admin@jidsnepal.org" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email"
                                    autofocus
                                >
                            </div>

                            <!-- Password Field -->
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <div class="password-group">
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        class="form-control" 
                                        placeholder="Enter your password" 
                                        required 
                                        autocomplete="current-password"
                                    >
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword()"></i>
                                </div>
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="form-options">
                                <div class="form-check">
                                    <input 
                                        type="checkbox" 
                                        id="remember" 
                                        name="remember" 
                                        class="form-check-input"
                                    >
                                    <label for="remember" class="form-check-label">
                                        Remember me
                                    </label>
                                </div>
                                <a href="#" class="forgot-link">
                                    Forgot password?
                                </a>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-login" id="loginBtn">
                                <i class="fas fa-sign-in-alt"></i>
                                <span class="btn-text">Sign in</span>
                                <div class="loading-spinner" style="display: none;"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Password Toggle Functionality
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Form Enhancement
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const btnText = loginBtn.querySelector('.btn-text');
    const spinner = loginBtn.querySelector('.loading-spinner');
    
    form.addEventListener('submit', function() {
        loginBtn.disabled = true;
        btnText.style.display = 'none';
        spinner.style.display = 'block';
    });
    
    // Auto-focus enhancement
    const emailInput = document.getElementById('email');
    if (emailInput.value === '') {
        emailInput.focus();
    } else {
        document.getElementById('password').focus();
    }
});
</script>
</body>
</html>
