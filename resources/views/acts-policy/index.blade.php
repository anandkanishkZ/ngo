@extends('layouts.app')

@section('title', 'Acts & Policy - JIDS Nepal')

@section('content')
<div class="page-header" style="background: linear-gradient(135deg, #2c5f2d 0%, #97bc62 100%); padding: 60px 0;">
    <div class="container">
        <h1 class="text-white mb-3">Acts & Policy</h1>
        <p class="text-white-50 mb-0">Legal framework and organizational policies</p>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-gavel me-2"></i>
                Acts and policy documents will be added soon. This section will contain important legal and organizational policy information.
            </div>
        </div>
    </div>
    
    <!-- Placeholder for future acts and policies -->
    <div class="row g-4 mt-3">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-file-contract me-2 text-primary"></i>
                        Organizational Policies
                    </h5>
                    <p class="card-text">Internal policies and guidelines governing our operations.</p>
                    <p class="text-muted small">
                        <i class="far fa-calendar me-2"></i>Coming Soon
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-balance-scale me-2 text-primary"></i>
                        Legal Acts & Regulations
                    </h5>
                    <p class="card-text">Relevant legal acts and regulations we comply with.</p>
                    <p class="text-muted small">
                        <i class="far fa-calendar me-2"></i>Coming Soon
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
