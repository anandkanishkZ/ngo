@extends('layouts.app')

@section('title', 'Vacancy - JIDS Nepal')

@section('content')
<div class="page-header" style="background: linear-gradient(135deg, #2c5f2d 0%, #97bc62 100%); padding: 60px 0;">
    <div class="container">
        <h1 class="text-white mb-3">Career Opportunities</h1>
        <p class="text-white-50 mb-0">Join our team and make a difference</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-briefcase me-2"></i>
                Career vacancy announcements will be posted here. Check back soon for job opportunities.
            </div>
        </div>
    </div>
    
    <!-- Placeholder for future vacancies -->
    <div class="row g-4 mt-3">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title mb-2">
                                <i class="fas fa-user-tie me-2 text-primary"></i>
                                Sample Position
                            </h5>
                            <p class="text-muted mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>Udayapur, Nepal
                            </p>
                        </div>
                        <span class="badge bg-secondary">Coming Soon</span>
                    </div>
                    <p class="card-text mb-3">
                        Job descriptions and requirements will be posted here when positions become available.
                    </p>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge bg-light text-dark">
                            <i class="far fa-clock me-1"></i>Full Time
                        </span>
                        <span class="badge bg-light text-dark">
                            <i class="far fa-calendar me-1"></i>TBD
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 mt-4">
            <div class="card bg-light">
                <div class="card-body text-center py-5">
                    <i class="fas fa-user-plus fa-3x text-muted mb-3"></i>
                    <h4>No Current Openings</h4>
                    <p class="text-muted">
                        We currently have no open positions. Please check back later or contact us to learn about future opportunities.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
