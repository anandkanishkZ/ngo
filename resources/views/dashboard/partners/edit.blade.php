@extends('layouts.dashboard')

@section('title', 'Edit Partner - ' . $partner->name)

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">Edit Partner</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.partners.index') }}">Partners</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.partners.show', $partner) }}">{{ $partner->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('dashboard.partners.show', $partner) }}" class="btn btn-outline-info">
                <i class="fas fa-eye"></i> View Partner
            </a>
            <a href="{{ route('dashboard.partners.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-list"></i> All Partners
            </a>
        </div>
    </div>

    <!-- Partner Status Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-{{ $partner->is_active ? 'success' : 'secondary' }}">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="partner-logo-container" 
                                 style="width: 60px; height: 60px; 
                                        background: {{ $partner->background_color ?? '#f8f9fa' }}; 
                                        border-radius: 8px; 
                                        display: flex; 
                                        align-items: center; 
                                        justify-content: center;
                                        border: 1px solid #dee2e6;">
                                @if($partner->logo_url)
                                    <img src="{{ $partner->logo_url }}" 
                                         alt="{{ $partner->name }}" 
                                         class="img-fluid"
                                         style="max-width: 50px; max-height: 50px; object-fit: contain;">
                                @else
                                    <i class="fas fa-handshake text-muted"></i>
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">{{ $partner->name }}</h5>
                                    <div class="mb-2">
                                        <span class="badge bg-{{ 
                                            $partner->type === 'sponsor' ? 'success' : 
                                            ($partner->type === 'partner' ? 'primary' : 'info') 
                                        }} me-2">
                                            {{ ucfirst($partner->type) }}
                                        </span>
                                        <span class="badge bg-{{ $partner->is_active ? 'success' : 'secondary' }} me-2">
                                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        @if($partner->featured)
                                            <span class="badge bg-warning">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                    </div>
                                    @if($partner->description)
                                        <p class="text-muted mb-0">{{ Str::limit($partner->description, 100) }}</p>
                                    @endif
                                </div>
                                <div class="text-end">
                                    @if($partner->website_url)
                                        <a href="{{ $partner->website_url }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-primary mb-2">
                                            <i class="fas fa-external-link-alt"></i> Visit Website
                                        </a>
                                    @endif
                                    <div class="text-muted">
                                        <small>
                                            Sort Order: {{ $partner->sort_order ?? 0 }}<br>
                                            Last Updated: {{ $partner->updated_at->format('M d, Y') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="alert-heading">
                <i class="fas fa-exclamation-triangle"></i> Please fix the following errors:
            </h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Partner Form -->
    @include('dashboard.partners.form')
</div>

@endsection

@push('styles')
<style>
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .form-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .form-check-input:checked {
        background-color: #4e73df;
        border-color: #4e73df;
    }
    
    .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    
    .border-left-secondary {
        border-left: 0.25rem solid #858796 !important;
    }
    
    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        color: #858796;
    }
    
    .breadcrumb-item a {
        color: #5a5c69;
        text-decoration: none;
    }
    
    .breadcrumb-item a:hover {
        color: #4e73df;
    }
    
    .form-control-color {
        max-width: 50px;
        padding: 0.375rem 0.25rem;
    }
    
    .partner-logo-container img {
        transition: transform 0.2s ease;
    }
    
    .partner-logo-container:hover img {
        transform: scale(1.1);
    }
    
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-group {
            width: 100%;
        }
        
        .btn-group .btn {
            flex: 1;
        }
    }
</style>
@endpush
