@extends('layouts.dashboard')

@section('title', 'Team Member Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Team Member Details</h2>
        <div>
            <a href="{{ route('dashboard.team.edit', $team) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('dashboard.team.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Team
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Profile -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            @if($team->image)
                                <img src="{{ $team->image_url }}" 
                                     alt="{{ $team->name }}" 
                                     class="img-fluid rounded-circle mb-3" 
                                     style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" 
                                     style="width: 200px; height: 200px; margin: 0 auto;">
                                    <i class="fas fa-user fa-4x text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="d-flex justify-content-center gap-3 mb-3">
                                @if($team->linkedin_url)
                                    <a href="{{ $team->linkedin_url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                @endif
                                @if($team->twitter_url)
                                    <a href="{{ $team->twitter_url }}" target="_blank" class="btn btn-outline-info btn-sm">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                @endif
                                @if($team->facebook_url)
                                    <a href="{{ $team->facebook_url }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="mb-1">{{ $team->name }}</h3>
                                    <h5 class="text-muted mb-2">{{ $team->position }}</h5>
                                    
                                    <div class="d-flex gap-2 mb-3">
                                        @if($team->featured)
                                            <span class="badge bg-warning">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                        <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $team->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        @if($team->department)
                                            <span class="badge bg-info">{{ ucfirst($team->department) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h6>Bio</h6>
                                <p class="text-muted">{{ $team->bio }}</p>
                            </div>
                            
                            @if($team->achievements)
                                <div class="mb-4">
                                    <h6>Achievements & Awards</h6>
                                    <p class="text-muted">{{ $team->achievements }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar Info -->
        <div class="col-lg-4">
            <!-- Contact Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Contact Information</h6>
                </div>
                <div class="card-body">
                    @if($team->email)
                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <div>
                                <a href="mailto:{{ $team->email }}" class="text-decoration-none">
                                    <i class="fas fa-envelope me-2"></i>{{ $team->email }}
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    @if($team->phone)
                        <div class="mb-3">
                            <label class="form-label text-muted">Phone</label>
                            <div>
                                <a href="tel:{{ $team->phone }}" class="text-decoration-none">
                                    <i class="fas fa-phone me-2"></i>{{ $team->phone }}
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    @if(!$team->email && !$team->phone)
                        <p class="text-muted">No contact information available</p>
                    @endif
                </div>
            </div>
            
            <!-- Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Details</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label text-muted">Department</label>
                            <div>{{ $team->department ? ucfirst($team->department) : 'Not specified' }}</div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label text-muted">Display Order</label>
                            <div>{{ $team->sort_order }}</div>
                        </div>
                    </div>
                    
                    @if($team->joined_date)
                        <div class="mb-3">
                            <label class="form-label text-muted">Joined Date</label>
                            <div>{{ $team->joined_date->format('F d, Y') }}</div>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label text-muted">Status</label>
                            <div>
                                <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $team->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label text-muted">Featured</label>
                            <div>
                                <span class="badge {{ $team->featured ? 'bg-warning' : 'bg-light text-dark' }}">
                                    {{ $team->featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-outline-primary toggle-status" 
                                data-id="{{ $team->id }}" data-type="status">
                            <i class="fas fa-toggle-{{ $team->is_active ? 'on' : 'off' }} me-1"></i>
                            {{ $team->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                        
                        <button type="button" class="btn btn-outline-warning toggle-status" 
                                data-id="{{ $team->id }}" data-type="featured">
                            <i class="fas fa-star me-1"></i>
                            {{ $team->featured ? 'Remove Featured' : 'Make Featured' }}
                        </button>
                        
                        <button type="button" class="btn btn-outline-danger delete-member" 
                                data-id="{{ $team->id }}" data-name="{{ $team->name }}">
                            <i class="fas fa-trash me-1"></i> Delete Member
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- System Info -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">System Information</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="form-label text-muted">Created</label>
                        <div>{{ $team->created_at->format('M d, Y g:i A') }}</div>
                    </div>
                    
                    @if($team->updated_at != $team->created_at)
                        <div class="mb-2">
                            <label class="form-label text-muted">Last Updated</label>
                            <div>{{ $team->updated_at->format('M d, Y g:i A') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="memberName"></strong>?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Toggle Status/Featured
    $('.toggle-status').click(function(e) {
        e.preventDefault();
        const memberId = $(this).data('id');
        const type = $(this).data('type');
        const url = type === 'status' 
            ? `{{ url('dashboard/team') }}/${memberId}/toggle-status`
            : `{{ url('dashboard/team') }}/${memberId}/toggle-featured`;
        
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
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
    
    // Delete Member
    $('.delete-member').click(function(e) {
        e.preventDefault();
        const memberId = $(this).data('id');
        const memberName = $(this).data('name');
        
        $('#memberName').text(memberName);
        $('#deleteForm').attr('action', `{{ url('dashboard/team') }}/${memberId}`);
        $('#deleteModal').modal('show');
    });
    
    // Handle delete form submission
    $('#deleteForm').submit(function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        
        $.ajax({
            url: $(form).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#deleteModal').modal('hide');
                window.location.href = '{{ route('dashboard.team.index') }}';
            },
            error: function() {
                alert('An error occurred while deleting. Please try again.');
                $('#deleteModal').modal('hide');
            }
        });
    });
});
</script>
@endpush
