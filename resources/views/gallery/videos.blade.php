@extends('layouts.app')

@section('title', 'Video Gallery - JIDS Nepal')

@section('content')
<div class="page-header" style="background: linear-gradient(135deg, #2c5f2d 0%, #97bc62 100%); padding: 60px 0;">
    <div class="container">
        <h1 class="text-white mb-3">Video Gallery</h1>
        <p class="text-white-50 mb-0">Watch our journey through videos</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-video me-2"></i>
                Video gallery content will be added soon. This page will feature videos showcasing our work and impact.
            </div>
        </div>
    </div>
    
    <!-- Placeholder for future video gallery -->
    <div class="row g-4 mt-3">
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-play-circle fa-3x text-muted mb-3"></i>
                    <h5 class="card-title">Project Video 1</h5>
                    <p class="card-text text-muted">Coming Soon</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-play-circle fa-3x text-muted mb-3"></i>
                    <h5 class="card-title">Project Video 2</h5>
                    <p class="card-text text-muted">Coming Soon</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-play-circle fa-3x text-muted mb-3"></i>
                    <h5 class="card-title">Project Video 3</h5>
                    <p class="card-text text-muted">Coming Soon</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
