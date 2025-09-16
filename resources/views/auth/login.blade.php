@extends('layouts.app')

@section('title', 'Sign In | Hope Foundation')

@section('content')
<style>
.login-container {
  min-height: 100vh;
  background: #f8fafb;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.login-card {
  background: #ffffff;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  border: 1px solid #e5e7eb;
  padding: 3rem;
  width: 100%;
  max-width: 420px;
}

.login-header {
  text-align: center;
  margin-bottom: 2.5rem;
}

.login-icon {
  width: 64px;
  height: 64px;
  background: #374151;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
}

.login-title {
  font-size: 2rem;
  font-weight: 600;
  color: #111827;
  margin-bottom: 0.5rem;
}

.login-subtitle {
  color: #6b7280;
  font-size: 1rem;
  font-weight: 400;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #374151;
  font-size: 0.875rem;
}

.form-input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.2s ease;
  background: #ffffff;
}

.form-input:focus {
  outline: none;
  border-color: #374151;
  box-shadow: 0 0 0 3px rgba(55, 65, 81, 0.1);
}

.password-container {
  position: relative;
}

.password-toggle {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #9ca3af;
  cursor: pointer;
  padding: 5px;
  transition: color 0.2s ease;
}

.password-toggle:hover {
  color: #374151;
}

.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.checkbox-container {
  display: flex;
  align-items: center;
}

.checkbox-input {
  margin-right: 0.5rem;
}

.checkbox-label {
  color: #374151;
  font-size: 0.875rem;
}

.forgot-link {
  color: #374151;
  text-decoration: none;
  font-size: 0.875rem;
  font-weight: 500;
  transition: color 0.2s ease;
}

.forgot-link:hover {
  color: #111827;
}

.login-btn {
  width: 100%;
  padding: 0.875rem;
  background: #374151;
  border: none;
  border-radius: 8px;
  color: white;
  font-size: 1rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s ease;
}

.login-btn:hover {
  background: #111827;
}

.error-alert {
  background: #fef2f2;
  border: 1px solid #fecaca;
  color: #dc2626;
  padding: 0.75rem 1rem;
  border-radius: 8px;
  margin-bottom: 1.5rem;
  font-size: 0.875rem;
}
</style>

<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <div class="login-icon">
        <i class="fas fa-lock" style="color: white; font-size: 1.5rem;"></i>
      </div>
      <h1 class="login-title">Welcome Back</h1>
      <p class="login-subtitle">Please sign in to your account</p>
    </div>
    
    @if($errors->any())
      <div class="error-alert">{{ $errors->first() }}</div>
    @endif
    
    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-input" placeholder="Enter your email" value="{{ old('email') }}" required>
      </div>
      
      <div class="form-group">
        <label class="form-label">Password</label>
        <div class="password-container">
          <input type="password" name="password" id="password" class="form-input" placeholder="Enter your password" required>
          <button type="button" id="togglePassword" class="password-toggle">
            <i class="fas fa-eye" id="eyeIcon"></i>
          </button>
        </div>
      </div>
      
      <div class="form-options">
        <div class="checkbox-container">
          <input class="checkbox-input" type="checkbox" name="remember" id="remember">
          <label class="checkbox-label" for="remember">Remember me</label>
        </div>
        <a class="forgot-link" href="#">Forgot Password?</a>
      </div>
      
      <button class="login-btn" type="submit">
        <i class="fas fa-sign-in-alt" style="margin-right: 0.5rem;"></i>
        Sign In
      </button>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');
  
  if (togglePassword) {
    togglePassword.addEventListener('click', function() {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    });
  }
});
</script>
@endsection
