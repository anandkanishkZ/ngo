@extends('layouts.dashboard')

@section('title', 'Partner Details - ' . $partner->name)

@section('content')
<div class="container-fluid px-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-gray-800">Partner Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.partners.index') }}">Partners</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $partner->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('dashboard.partners.edit', $partner) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Partner
            </a>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash"></i> Delete
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Main Partner Information -->
        <div class="col-lg-8">
            <!-- Partner Overview Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-handshake"></i> Partner Overview
                    </h6>
                    <div class="d-flex gap-2">
                        <button type="button" 
                                class="btn btn-sm btn-{{ $partner->is_active ? 'success' : 'secondary' }} toggle-active" 
                                data-partner-id="{{ $partner->id }}">
                            <i class="fas fa-{{ $partner->is_active ? 'check' : 'times' }}"></i>
                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                        </button>
                        <button type="button" 
                                class="btn btn-sm btn-{{ $partner->featured ? 'warning' : 'outline-warning' }} toggle-featured" 
                                data-partner-id="{{ $partner->id }}">
                            <i class="fas fa-star"></i>
                            {{ $partner->featured ? 'Featured' : 'Not Featured' }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-4">
                            <!-- Logo Display -->
                            <div class="partner-logo-display mb-3" 
                                 style="width: 120px; height: 120px; 
                                        background: {{ $partner->background_color ?? '#f8f9fa' }}; 
                                        border-radius: 12px; 
                                        display: flex; 
                                        align-items: center; 
                                        justify-content: center;
                                        margin: 0 auto;
                                        border: 2px solid #dee2e6;
                                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                @if($partner->logo_url)
                                    <img src="{{ $partner->logo_url }}" 
                                         alt="{{ $partner->name }}" 
                                         class="img-fluid"
                                         style="max-width: 100px; max-height: 100px; object-fit: contain;">
                                @else
                                    <i class="fas fa-handshake fa-3x text-muted"></i>
                                @endif
                            </div>
                            
                            <!-- Partner Type Badge -->
                            <span class="badge bg-{{ 
                                $partner->type === 'sponsor' ? 'success' : 
                                ($partner->type === 'partner' ? 'primary' : 'info') 
                            }} fs-6 mb-2">
                                {{ ucfirst($partner->type) }}
                            </span>
                        </div>
                        
                        <div class="col-md-9">
                            <h2 class="h4 mb-3">{{ $partner->name }}</h2>
                            
                            @if($partner->description)
                                <div class="mb-4">
                                    <h6 class="text-muted mb-2">Description</h6>
                                    <p class="text-dark">{{ $partner->description }}</p>
                                </div>
                            @endif
                            
                            <div class="row">
                                @if($partner->website_url)
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted mb-2">Website</h6>
                                        <a href="{{ $partner->website_url }}" 
                                           target="_blank" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-external-link-alt"></i>
                                            Visit Website
                                        </a>
                                    </div>
                                @endif
                                
                                <div class="col-md-6 mb-3">
                                    <h6 class="text-muted mb-2">Sort Order</h6>
                                    <span class="badge bg-light text-dark fs-6">{{ $partner->sort_order ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Details Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cogs"></i> Technical Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-muted"><strong>Partner ID:</strong></td>
                                    <td>{{ $partner->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Type:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $partner->type === 'sponsor' ? 'success' : 
                                            ($partner->type === 'partner' ? 'primary' : 'info') 
                                        }}">
                                            {{ ucfirst($partner->type) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge bg-{{ $partner->is_active ? 'success' : 'secondary' }}">
                                            {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Featured:</strong></td>
                                    <td>
                                        @if($partner->featured)
                                            <span class="badge bg-warning">
                                                <i class="fas fa-star"></i> Yes
                                            </span>
                                        @else
                                            <span class="badge bg-light text-dark">No</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-muted"><strong>Sort Order:</strong></td>
                                    <td>{{ $partner->sort_order ?? 0 }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Background Color:</strong></td>
                                    <td>
                                        @if($partner->background_color)
                                            <span class="d-inline-flex align-items-center">
                                                <span class="color-swatch me-2" 
                                                      style="width: 20px; height: 20px; 
                                                             background: {{ $partner->background_color }}; 
                                                             border: 1px solid #dee2e6; 
                                                             border-radius: 4px;"></span>
                                                <code>{{ $partner->background_color }}</code>
                                            </span>
                                        @else
                                            <span class="text-muted">Default</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Created:</strong></td>
                                    <td>{{ $partner->created_at->format('M d, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted"><strong>Last Updated:</strong></td>
                                    <td>{{ $partner->updated_at->format('M d, Y g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt"></i> Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('dashboard.partners.edit', $partner) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Partner
                        </a>
                        
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" class="btn btn-outline-info">
                                <i class="fas fa-external-link-alt"></i> Visit Website
                            </a>
                        @endif
                        
                        <button type="button" 
                                class="btn btn-outline-{{ $partner->is_active ? 'secondary' : 'success' }} toggle-active" 
                                data-partner-id="{{ $partner->id }}">
                            <i class="fas fa-{{ $partner->is_active ? 'times' : 'check' }}"></i>
                            {{ $partner->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                        
                        <button type="button" 
                                class="btn btn-outline-warning toggle-featured" 
                                data-partner-id="{{ $partner->id }}">
                            <i class="fas fa-star"></i>
                            {{ $partner->featured ? 'Remove from Featured' : 'Mark as Featured' }}
                        </button>
                        
                        <hr>
                        
                        <button type="button" 
                                class="btn btn-outline-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal">
                            <i class="fas fa-trash"></i> Delete Partner
                        </button>
                    </div>
                </div>
            </div>

            <!-- Logo Information -->
            @if($partner->logo_url)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-image"></i> Logo Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="{{ $partner->logo_url }}" 
                                 alt="{{ $partner->name }}" 
                                 class="img-fluid"
                                 style="max-width: 150px; max-height: 150px; object-fit: contain;">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted">Background:</small><br>
                                <span class="d-inline-flex align-items-center">
                                    <span class="color-swatch me-1" 
                                          style="width: 16px; height: 16px; 
                                                 background: {{ $partner->background_color ?? '#f8f9fa' }}; 
                                                 border: 1px solid #dee2e6; 
                                                 border-radius: 2px;"></span>
                                    <code style="font-size: 0.75rem;">{{ $partner->background_color ?? '#f8f9fa' }}</code>
                                </span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Logo URL:</small><br>
                                <a href="{{ $partner->logo_url }}" target="_blank" class="text-truncate d-block" style="font-size: 0.75rem;">
                                    View Original
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                </div>
                <p class="text-center">Are you sure you want to delete <strong>{{ $partner->name }}</strong>?</p>
                <div class="alert alert-danger">
                    <h6><i class="fas fa-exclamation-triangle"></i> Warning</h6>
                    <ul class="mb-0">
                        <li>This action cannot be undone</li>
                        <li>The partner will be permanently removed from the website</li>
                        @if($partner->logo_url && !filter_var($partner->logo_url, FILTER_VALIDATE_URL))
                            <li>The partner's logo file will be permanently deleted</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <form method="POST" action="{{ route('dashboard.partners.destroy', $partner) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete Partner
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .partner-logo-display img {
        transition: transform 0.3s ease;
    }
    
    .partner-logo-display:hover img {
        transform: scale(1.05);
    }
    
    .color-swatch {
        box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }
    
    .card {
        border: none;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    }
    
    .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
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

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle Active Status
    $('.toggle-active').click(function() {
        const partnerId = $(this).data('partner-id');
        const button = $(this);
        
        $.ajax({
            url: '/dashboard/partners/' + partnerId + '/toggle-active',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Reload page to update all status displays
                    window.location.reload();
                }
            },
            error: function() {
                showToast('error', 'Failed to update partner status');
            }
        });
    });

    // Toggle Featured Status
    $('.toggle-featured').click(function() {
        const partnerId = $(this).data('partner-id');
        const button = $(this);
        
        $.ajax({
            url: '/dashboard/partners/' + partnerId + '/toggle-featured',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    // Reload page to update all featured displays
                    window.location.reload();
                }
            },
            error: function() {
                showToast('error', 'Failed to update featured status');
            }
        });
    });

    // Toast notification function
    function showToast(type, message) {
        const toastHtml = `
            <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        // Add toast container if it doesn't exist
        if (!$('.toast-container').length) {
            $('body').append('<div class="toast-container position-fixed top-0 end-0 p-3"></div>');
        }
        
        const $toast = $(toastHtml);
        $('.toast-container').append($toast);
        
        const toast = new bootstrap.Toast($toast[0]);
        toast.show();
        
        // Remove toast after it's hidden
        $toast.on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }
});
</script>
@endpush
