@extends('layouts.dashboard')

@section('title', 'Team Management')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-1 text-gray-800">Team Management</h2>
            <p class="text-muted mb-0">
                <i class="fas fa-users me-1"></i> 
                Showing {{ $teamMembers->firstItem() ?? 0 }} to {{ $teamMembers->lastItem() ?? 0 }} of {{ $teamMembers->total() }} members
            </p>
        </div>
        <a href="{{ route('dashboard.team.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Team Member
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Members</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $teamMembers->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Members</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\TeamMember::where('is_active', true)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Featured</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ \App\Models\TeamMember::where('featured', true)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Departments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($departments) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.team.index') }}" class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, position..." 
                           value="{{ request('search') }}">
                </div>
                
                <div class="col-md-2">
                    <select name="department" class="form-select">
                        <option value="">All Departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') === $dept ? 'selected' : '' }}>
                                {{ ucfirst($dept) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <select name="orderby" class="form-select">
                        <option value="sort_order" {{ request('orderby', 'sort_order') === 'sort_order' ? 'selected' : '' }}>Order</option>
                        <option value="name" {{ request('orderby') === 'name' ? 'selected' : '' }}>Name</option>
                        <option value="position" {{ request('orderby') === 'position' ? 'selected' : '' }}>Position</option>
                        <option value="department" {{ request('orderby') === 'department' ? 'selected' : '' }}>Department</option>
                        <option value="created_at" {{ request('orderby') === 'created_at' ? 'selected' : '' }}>Date Added</option>
                    </select>
                </div>
                
                <div class="col-md-1">
                    <select name="orderdir" class="form-select">
                        <option value="asc" {{ request('orderdir', 'asc') === 'asc' ? 'selected' : '' }}>ASC</option>
                        <option value="desc" {{ request('orderdir') === 'desc' ? 'selected' : '' }}>DESC</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary me-2">Filter</button>
                    <a href="{{ route('dashboard.team.index') }}" class="btn btn-outline-secondary">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Team Members Grid -->
    <div class="row">
        @forelse($teamMembers as $member)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card team-member-card {{ !$member->is_active ? 'card-inactive' : '' }}">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if($member->featured)
                                <span class="badge bg-warning me-2">
                                    <i class="fas fa-star"></i> Featured
                                </span>
                            @endif
                            <span class="badge {{ $member->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $member->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard.team.show', $member) }}">
                                    <i class="fas fa-eye me-1"></i> View
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.team.edit', $member) }}">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item toggle-status" href="#" data-id="{{ $member->id }}" data-type="status">
                                    <i class="fas fa-toggle-{{ $member->is_active ? 'on' : 'off' }} me-1"></i> 
                                    {{ $member->is_active ? 'Deactivate' : 'Activate' }}
                                </a></li>
                                <li><a class="dropdown-item toggle-status" href="#" data-id="{{ $member->id }}" data-type="featured">
                                    <i class="fas fa-star me-1"></i> 
                                    {{ $member->featured ? 'Remove Featured' : 'Make Featured' }}
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger delete-member" href="#" data-id="{{ $member->id }}" data-name="{{ $member->name }}">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if($member->image)
                                <img src="{{ $member->image_url }}" 
                                     alt="{{ $member->name }}" 
                                     class="rounded-circle member-photo">
                            @else
                                <div class="member-photo-placeholder rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user fa-2x text-muted"></i>
                                </div>
                            @endif
                        </div>
                        
                        <h5 class="card-title text-center mb-1">{{ $member->name }}</h5>
                        <p class="text-muted text-center mb-2">{{ $member->position }}</p>
                        
                        @if($member->department)
                            <div class="text-center mb-3">
                                <span class="badge bg-info">{{ ucfirst($member->department) }}</span>
                            </div>
                        @endif
                        
                        <p class="card-text">{{ Str::limit($member->bio, 100) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Order: {{ $member->sort_order }}
                            </small>
                            <div class="social-links">
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="text-primary me-1">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                @endif
                                @if($member->twitter_url)
                                    <a href="{{ $member->twitter_url }}" target="_blank" class="text-info me-1">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if($member->facebook_url)
                                    <a href="{{ $member->facebook_url }}" target="_blank" class="text-primary">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5>No Team Members Found</h5>
                        <p class="text-muted">Start building your team by adding members.</p>
                        <a href="{{ route('dashboard.team.create') }}" class="btn btn-primary">Add First Team Member</a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination with Info -->
    @if($teamMembers->hasPages())
        <div class="card mt-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-2 mb-md-0">
                        <span class="text-muted">
                            Showing {{ $teamMembers->firstItem() ?? 0 }} to {{ $teamMembers->lastItem() ?? 0 }} 
                            of {{ $teamMembers->total() }} results
                        </span>
                    </div>
                    <div>
                        {{ $teamMembers->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
/* Team member card styling */
.team-member-card {
    transition: transform 0.2s, box-shadow 0.2s;
    height: 100%;
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
}

.team-member-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
}

.card-inactive {
    opacity: 0.65;
    background-color: #f8f9fa;
}

.member-photo {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 3px solid #f8f9fa;
}

.member-photo-placeholder {
    width: 100px;
    height: 100px;
    background-color: #f8f9fa;
    border: 2px dashed #dee2e6;
}

.social-links a {
    text-decoration: none;
    font-size: 1.1em;
    transition: transform 0.2s;
    display: inline-block;
}

.social-links a:hover {
    transform: scale(1.15);
}

/* Statistics Cards */
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.text-xs {
    font-size: 0.7rem;
}

/* Card enhancements */
.card {
    border-radius: 0.35rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

/* Pagination improvements */
.pagination {
    margin-bottom: 0;
}

.page-link {
    color: #4e73df;
}

.page-link:hover {
    color: #2e59d9;
    background-color: #eaecf4;
}

.page-item.active .page-link {
    background-color: #4e73df;
    border-color: #4e73df;
}
</style>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle Status/Featured
    $('.toggle-status').click(function(e) {
        e.preventDefault();
        const memberId = $(this).data('id');
        const type = $(this).data('type');
        const baseUrl = '{{ url("dashboard/team") }}';
        const url = type === 'status' 
            ? baseUrl + '/' + memberId + '/toggle-status'
            : baseUrl + '/' + memberId + '/toggle-featured';
        
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                console.error('Toggle error:', xhr);
                alert('An error occurred. Please try again.');
            }
        });
    });
    
    // Delete Member
    $('.delete-member').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const memberId = $(this).data('id');
        const memberName = $(this).data('name');
        
        // Browser confirmation dialog
        const confirmDelete = confirm(`Are you sure you want to delete "${memberName}"?\n\nThis action cannot be undone.`);
        
        if (confirmDelete) {
            // Create a form and submit it
            const form = $('<form>', {
                method: 'POST',
                action: '{{ url("dashboard/team") }}' + '/' + memberId
            });
            
            // Add CSRF token and DELETE method
            form.append($('<input>', {
                type: 'hidden',
                name: '_token',
                value: '{{ csrf_token() }}'
            }));
            
            form.append($('<input>', {
                type: 'hidden',
                name: '_method',
                value: 'DELETE'
            }));
            
            // Append form to body and submit
            $('body').append(form);
            form.submit();
        }
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
});
</script>
@endpush
