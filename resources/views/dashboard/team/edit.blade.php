@extends('layouts.dashboard')

@section('title', 'Edit Team Member')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Edit Team Member</h2>
        <div>
            <a href="{{ route('dashboard.team.show', $team) }}" class="btn btn-outline-info me-2">
                <i class="fas fa-eye me-1"></i> View
            </a>
            <a href="{{ route('dashboard.team.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Team
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dashboard.team.update', $team) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-md-8">
                        <h5 class="mb-3">Basic Information</h5>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $team->name) }}" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position *</label>
                                    <input type="text" class="form-control" id="position" name="position" 
                                           value="{{ old('position', $team->position) }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio *</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4" required>{{ old('bio', $team->bio) }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <select class="form-select" id="department" name="department">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept }}" {{ old('department', $team->department) === $dept ? 'selected' : '' }}>
                                                {{ ucfirst($dept) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="joined_date" class="form-label">Joined Date</label>
                                    <input type="date" class="form-control" id="joined_date" name="joined_date" 
                                           value="{{ old('joined_date', $team->joined_date ? $team->joined_date->format('Y-m-d') : '') }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="achievements" class="form-label">Achievements & Awards</label>
                            <textarea class="form-control" id="achievements" name="achievements" rows="3">{{ old('achievements', $team->achievements) }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Photo & Settings -->
                    <div class="col-md-4">
                        <h5 class="mb-3">Photo & Settings</h5>
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Photo</label>
                            
                            @if($team->image)
                                <div class="current-image mb-2">
                                    <img src="{{ $team->image_url }}" 
                                         alt="{{ $team->name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                    <div class="mt-2">
                                        <small class="text-muted">Current photo</small>
                                    </div>
                                </div>
                            @endif
                            
                            <input type="file" class="form-control" id="image" name="image" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                            <small class="text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF, WebP</small>
                            
                            <div class="mt-2" id="imagePreview" style="display: none;">
                                <img id="previewImg" src="" class="img-thumbnail" style="max-width: 200px;">
                                <div class="mt-2">
                                    <small class="text-muted">New photo preview</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Display Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                   value="{{ old('sort_order', $team->sort_order) }}" min="0">
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" 
                                       name="is_active" value="1" {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="featured" 
                                       name="featured" value="1" {{ old('featured', $team->featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">Featured Member</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <hr class="my-4">
                <h5 class="mb-3">Contact Information</h5>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $team->email) }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" 
                                   value="{{ old('phone', $team->phone) }}">
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <hr class="my-4">
                <h5 class="mb-3">Social Media Links</h5>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="linkedin_url" class="form-label">
                                <i class="fab fa-linkedin text-primary me-1"></i> LinkedIn
                            </label>
                            <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" 
                                   value="{{ old('linkedin_url', $team->linkedin_url) }}" placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="twitter_url" class="form-label">
                                <i class="fab fa-twitter text-info me-1"></i> Twitter
                            </label>
                            <input type="url" class="form-control" id="twitter_url" name="twitter_url" 
                                   value="{{ old('twitter_url', $team->twitter_url) }}" placeholder="https://twitter.com/username">
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="facebook_url" class="form-label">
                                <i class="fab fa-facebook text-primary me-1"></i> Facebook
                            </label>
                            <input type="url" class="form-control" id="facebook_url" name="facebook_url" 
                                   value="{{ old('facebook_url', $team->facebook_url) }}" placeholder="https://facebook.com/username">
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <div>
                        <small class="text-muted">
                            Created: {{ $team->created_at->format('M d, Y g:i A') }}
                            @if($team->updated_at != $team->created_at)
                                | Updated: {{ $team->updated_at->format('M d, Y g:i A') }}
                            @endif
                        </small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('dashboard.team.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Team Member
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Image Preview
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
                $('#imagePreview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#imagePreview').hide();
        }
    });
});
</script>
@endpush
