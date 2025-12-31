@extends('layouts.app')

@section('title', 'Photo Gallery - JIDS Nepal')

@section('content')
<div class="page-header" style="background: linear-gradient(135deg, #2c5f2d 0%, #97bc62 100%); padding: 60px 0;">
    <div class="container">
        <h1 class="text-white mb-3">Photo Gallery</h1>
        <p class="text-white-50 mb-0">Capturing moments of change and transformation</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-images me-2"></i>
                Photo gallery content will be added soon. This page will showcase images from our projects and activities.
            </div>
        </div>
    </div>
    
    <!-- Placeholder for future photo gallery -->
    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-camera fa-3x text-muted mb-3"></i>
                    <h5 class="card-title">Photo Album 1</h5>
                    <p class="card-text text-muted">Coming Soon</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-camera fa-3x text-muted mb-3"></i>
                    <h5 class="card-title">Photo Album 2</h5>
                    <p class="card-text text-muted">Coming Soon</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-camera fa-3x text-muted mb-3"></i>
                    <h5 class="card-title">Photo Album 3</h5>
                    <p class="card-text text-muted">Coming Soon</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
