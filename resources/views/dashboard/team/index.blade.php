@extends('layouts.dashboard')

@section('title', 'Team Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Team Management</h2>
        <a href="{{ route('dashboard.team.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Team Member
        </a>
        <button type="button" class="btn btn-info ms-2" id="testFunctions">
            <i class="fas fa-cog me-1"></i> Test Functions
        </button>
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
                                <img src="{{ asset('storage/' . $member->image) }}" 
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

    <!-- Pagination -->
    @if($teamMembers->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $teamMembers->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<style>
/* Team member card styling */
.team-member-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.team-member-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.card-inactive {
    opacity: 0.7;
}

.member-photo {
    width: 80px;
    height: 80px;
    object-fit: cover;
}

.member-photo-placeholder {
    width: 80px;
    height: 80px;
    background-color: #f8f9fa;
    border: 2px dashed #dee2e6;
}

.social-links a {
    text-decoration: none;
    font-size: 1.1em;
}

.social-links a:hover {
    transform: scale(1.1);
}
</style>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    console.log('jQuery loaded:', typeof $ !== 'undefined');
    console.log('Bootstrap loaded:', typeof bootstrap !== 'undefined');
    
    // Test Functions Button
    $('#testFunctions').click(function() {
        console.log('Testing all functions...');
        
        // Test CSRF token
        console.log('CSRF Token:', '{{ csrf_token() }}');
        
        // Test jQuery selectors
        console.log('Delete member buttons found:', $('.delete-member').length);
        console.log('Toggle status buttons found:', $('.toggle-status').length);
        console.log('Delete form found:', $('#deleteForm').length);
        console.log('Delete modal found:', $('#deleteModal').length);
        
        // Test modal functionality
        $('#deleteModal').modal('show');
        setTimeout(() => {
            $('#deleteModal').modal('hide');
        }, 1000);
        
        alert('Function test complete! Check console for results.');
    });
    
    // Toggle Status/Featured
    $('.toggle-status').click(function(e) {
        e.preventDefault();
        const memberId = $(this).data('id');
        const type = $(this).data('type');
        const baseUrl = '{{ url("dashboard/team") }}';
        const url = type === 'status' 
            ? baseUrl + '/' + memberId + '/toggle-status'
            : baseUrl + '/' + memberId + '/toggle-featured';
        
        console.log('Toggle request:', { memberId, type, url });
        
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Toggle response:', response);
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
    
    // Delete Member - Simple Browser Confirmation
    $('.delete-member').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const memberId = $(this).data('id');
        const memberName = $(this).data('name');
        
        console.log('Delete member clicked:', { memberId, memberName });
        
        // Simple browser confirmation dialog
        const confirmDelete = confirm(`Are you sure you want to delete "${memberName}"?\n\nThis action cannot be undone.`);
        
        if (confirmDelete) {
            console.log('User confirmed deletion');
            
            // Create a form and submit it directly
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
            
            console.log('Delete form submitted directly');
        } else {
            console.log('User cancelled deletion');
        }
    });
    
    // Auto-hide alerts
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
}); // <-- Added missing closing parenthesis and semicolon for $(document).ready()
</script>
@endpush
