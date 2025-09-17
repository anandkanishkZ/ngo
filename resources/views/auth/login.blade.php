@extends('layouts.app')

@section('title', 'Sign In | Hope Foundation')

@section('content')
<section class="section-padding" style="min-height:80vh;background:linear-gradient(135deg,var(--primary-color),var(--secondary-color));display:flex;align-items:center;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="custom-card p-4" style="border-radius:20px;overflow:hidden;">
          <div class="text-center mb-3">
            <div class="rounded-circle" style="width:70px;height:70px;background:rgba(243,156,18,.15);display:flex;align-items:center;justify-content:center;margin:0 auto;">
              <i class="fas fa-user-shield" style="color:var(--accent-color);font-size:28px;"></i>
            </div>
            <h2 class="mt-3 mb-1">Welcome back</h2>
            <p class="text-muted">Access your dashboard</p>
          </div>
          @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
          @endif
          <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" name="email" class="form-control" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
              </div>
              <a class="text-decoration-none" href="#">Forgot password?</a>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">
              <i class="fas fa-right-to-bracket me-2"></i>Sign in
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
