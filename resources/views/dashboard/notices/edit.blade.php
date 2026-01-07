@extends('layouts.dashboard')

@section('title', 'Edit Notice')

@section('content')
<div class="dashboard-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Edit Notice</h1>
        <a href="{{ route('dashboard.notices.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Notices
        </a>
    </div>
</div>

<div class="dashboard-content">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">Notice Details</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.notices.update', $notice->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $notice->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                      id="excerpt" name="excerpt" rows="2" 
                                      placeholder="Brief summary of the notice...">{{ old('excerpt', $notice->excerpt) }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <x-rich-text-editor 
                                id="content"
                                name="content"
                                label="Content"
                                :value="old('content', $notice->content)"
                                placeholder="Write your notice content here..."
                                height="350px"
                                toolbar="full"
                                :required="true"
                                :error="$errors->first('content')"
                            />
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Featured Image</label>
                            @if($notice->image_url)
                                <div class="mb-2">
                                    <img src="{{ $notice->image_url }}" 
                                         alt="Current image" class="img-thumbnail" style="max-height: 100px;">
                                    <div class="form-text">Current image</div>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                Supported formats: JPEG, PNG, JPG, GIF, SVG, WebP. Max size: 2MB. Leave empty to keep current image.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                       id="author" name="author" value="{{ old('author', $notice->author) }}" required>
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                       id="category" name="category" value="{{ old('category', $notice->category) }}" 
                                       placeholder="e.g., General, Event, Update">
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                                <select class="form-select @error('priority') is-invalid @enderror" 
                                        id="priority" name="priority" required>
                                    <option value="low" {{ old('priority', $notice->priority) === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority', $notice->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority', $notice->priority) === 'high' ? 'selected' : '' }}>High</option>
                                    <option value="urgent" {{ old('priority', $notice->priority) === 'urgent' ? 'selected' : '' }}>Urgent</option>
                                </select>
                                @error('priority')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="draft" {{ old('status', $notice->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $notice->status) === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status', $notice->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="published_at" class="form-label">Publish Date</label>
                                <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                                       id="published_at" name="published_at" 
                                       value="{{ old('published_at', $notice->published_at ? $notice->published_at->format('Y-m-d\TH:i') : '') }}">
                                @error('published_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty to publish immediately when status is "Published"</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expires_at" class="form-label">Expires On</label>
                                <input type="date" class="form-control @error('expires_at') is-invalid @enderror" 
                                       id="expires_at" name="expires_at" 
                                       value="{{ old('expires_at', $notice->expires_at ? $notice->expires_at->format('Y-m-d') : '') }}">
                                @error('expires_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty for no expiration</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $notice->sort_order) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Higher numbers appear first</div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" 
                                       {{ old('is_featured', $notice->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <strong>Featured Notice</strong>
                                    <small class="text-muted d-block">This notice will be prominently displayed</small>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       {{ old('is_active', $notice->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    <strong>Active</strong>
                                    <small class="text-muted d-block">Only active notices are visible to users</small>
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Notice
                            </button>
                            <a href="{{ route('dashboard.notices.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="card-title mb-0">Quick Tips</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-lightbulb text-warning me-3 mt-1"></i>
                        <div>
                            <strong>Priority Levels</strong>
                            <ul class="small text-muted mb-0 mt-1">
                                <li><strong>Urgent:</strong> Critical announcements</li>
                                <li><strong>High:</strong> Important updates</li>
                                <li><strong>Medium:</strong> General notices</li>
                                <li><strong>Low:</strong> Informational content</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-eye text-info me-3 mt-1"></i>
                        <div>
                            <strong>Visibility</strong>
                            <p class="small text-muted mb-0 mt-1">
                                Only <strong>published</strong> and <strong>active</strong> notices are visible to website visitors.
                            </p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start">
                        <i class="fas fa-star text-warning me-3 mt-1"></i>
                        <div>
                            <strong>Featured</strong>
                            <p class="small text-muted mb-0 mt-1">
                                Featured notices appear prominently on the homepage and notices page.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
