@extends('layouts.dashboard')

@section('title', 'Partners Management')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Partners Management</h1>
        <a href="{{ route('dashboard.partners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Partner
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Partners ({{ $partners->count() }})</h6>
        </div>
        <div class="card-body">
            @if($partners->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="partnersTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th width="80">Logo</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Website</th>
                                <th width="100">Status</th>
                                <th width="100">Featured</th>
                                <th width="80">Order</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partners as $partner)
                                <tr>
                                    <td class="text-center">
                                        <div class="partner-logo-container" style="width: 60px; height: 60px; 
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
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $partner->name }}</strong>
                                            @if($partner->description)
                                                <br><small class="text-muted">{{ Str::limit($partner->description, 50) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $partner->type === 'sponsor' ? 'success' : 
                                            ($partner->type === 'partner' ? 'primary' : 'info') 
                                        }}">
                                            {{ ucfirst($partner->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" class="text-decoration-none">
                                                <i class="fas fa-external-link-alt"></i>
                                                {{ Str::limit(parse_url($partner->website_url, PHP_URL_HOST), 20) }}
                                            </a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" 
                                                class="btn btn-sm btn-{{ $partner->is_active ? 'success' : 'secondary' }} toggle-active" 
                                                data-partner-id="{{ $partner->id }}"
                                                data-bs-toggle="tooltip" 
                                                title="Click to {{ $partner->is_active ? 'deactivate' : 'activate' }}">
                                            <i class="fas fa-{{ $partner->is_active ? 'check' : 'times' }}"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" 
                                                class="btn btn-sm btn-{{ $partner->featured ? 'warning' : 'outline-warning' }} toggle-featured" 
                                                data-partner-id="{{ $partner->id }}"
                                                data-bs-toggle="tooltip" 
                                                title="Click to {{ $partner->featured ? 'unfeature' : 'feature' }}">
                                            <i class="fas fa-star"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">{{ $partner->sort_order ?? 0 }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('dashboard.partners.show', $partner) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               data-bs-toggle="tooltip" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.partners.edit', $partner) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger delete-btn" 
                                                    data-partner-id="{{ $partner->id }}"
                                                    data-partner-name="{{ $partner->name }}"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-handshake fa-4x text-muted"></i>
                    </div>
                    <h5 class="text-muted">No Partners Found</h5>
                    <p class="text-muted mb-4">Start by adding your first partner to showcase your collaborations and sponsorships.</p>
                    <a href="{{ route('dashboard.partners.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add First Partner
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>



@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<style>
    .partner-logo-container img {
        transition: transform 0.2s ease;
    }
    .partner-logo-container:hover img {
        transform: scale(1.1);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#partnersTable').DataTable({
        "order": [[ 5, "desc" ], [ 6, "asc" ], [ 1, "asc" ]], // Featured desc, Sort order asc, Name asc
        "pageLength": 25,
        "responsive": true,
        "language": {
            "search": "Search Partners:",
            "lengthMenu": "Show _MENU_ partners per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ partners"
        }
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

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
                    // Update button appearance
                    if (response.is_active) {
                        button.removeClass('btn-secondary').addClass('btn-success');
                        button.find('i').removeClass('fa-times').addClass('fa-check');
                        button.attr('title', 'Click to deactivate');
                    } else {
                        button.removeClass('btn-success').addClass('btn-secondary');
                        button.find('i').removeClass('fa-check').addClass('fa-times');
                        button.attr('title', 'Click to activate');
                    }
                    
                    // Show toast notification
                    showToast('success', response.message);
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
                    // Update button appearance
                    if (response.featured) {
                        button.removeClass('btn-outline-warning').addClass('btn-warning');
                        button.attr('title', 'Click to unfeature');
                    } else {
                        button.removeClass('btn-warning').addClass('btn-outline-warning');
                        button.attr('title', 'Click to feature');
                    }
                    
                    // Show toast notification
                    showToast('success', response.message);
                }
            },
            error: function() {
                showToast('error', 'Failed to update featured status');
            }
        });
    });

    // Delete Partner
    $('.delete-btn').click(function() {
        const partnerId = $(this).data('partner-id');
        const partnerName = $(this).data('partner-name');
        
        // Use browser confirmation dialog
        const confirmed = confirm(
            `Are you sure you want to delete the partner "${partnerName}"?\n\n` +
            `This action cannot be undone and will permanently remove the partner and its logo.`
        );
        
        if (confirmed) {
            // Create and submit delete form
            const form = $(`
                <form method="POST" action="/dashboard/partners/${partnerId}" style="display: none;">
                    <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            `);
            
            $('body').append(form);
            form.submit();
        }
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
