@extends('layouts.app')

@section('title', 'Photo Gallery - JIDS Nepal')

@section('content')
<!-- Header -->
<div class="page-header" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); padding: 80px 0;">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-images me-3"></i>Photo Gallery
            </h1>
            <p class="lead mb-0">Capturing moments of impact and transformation in our community</p>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Featured Photos Section -->
    @if($featuredPhotos && $featuredPhotos->count() > 0)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-4">
                <div class="bg-warning" style="width: 4px; height: 32px; margin-right: 16px;"></div>
                <h2 class="mb-0">Featured Photos</h2>
            </div>
            <div class="row g-4">
                @foreach($featuredPhotos as $photo)
                    <div class="col-md-4">
                        <div class="gallery-card featured-card">
                            <a href="{{ route('gallery.show', $photo->id) }}" class="text-decoration-none">
                                <div class="gallery-image-wrapper">
                                    <img src="{{ $photo->media->full_url }}" alt="{{ $photo->title }}" class="gallery-image">
                                    <div class="gallery-overlay">
                                        <div class="gallery-overlay-content">
                                            <i class="fas fa-search-plus fa-2x mb-2"></i>
                                            <p class="mb-0">View Photo</p>
                                        </div>
                                    </div>
                                    <div class="position-absolute top-0 start-0 p-3">
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star me-1"></i>Featured
                                        </span>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h5 class="mb-2 text-dark">{{ $photo->title }}</h5>
                                    <p class="text-muted small mb-2">{{ Str::limit($photo->description, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-primary">{{ $photo->category_label }}</span>
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i>{{ $photo->views_count }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Filter and Search Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('gallery.photos') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Search Photos</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Search by title, description, tags..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small text-muted">Category</label>
                            <select name="category" class="form-select">
                                <option value="all">All Categories</option>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>
                                        {{ $label }} @if(isset($categoryCounts[$key]))({{ $categoryCounts[$key] }})@endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small text-muted">Sort By</label>
                            <select name="sort" class="form-select">
                                <option value="default" {{ request('sort') === 'default' ? 'selected' : '' }}>Default</option>
                                <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Most Recent</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Viewed</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <a href="{{ route('gallery.photos') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Photos Grid -->
    @if($photos->count() > 0)
        <div class="row g-4">
            @foreach($photos as $photo)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="gallery-card">
                        <a href="{{ route('gallery.show', $photo->id) }}" class="text-decoration-none">
                            <div class="gallery-image-wrapper">
                                <img src="{{ $photo->media->full_url }}" alt="{{ $photo->title }}" class="gallery-image">
                                <div class="gallery-overlay">
                                    <div class="gallery-overlay-content">
                                        <i class="fas fa-search-plus fa-2x"></i>
                                    </div>
                                </div>
                                @if($photo->is_featured)
                                    <div class="position-absolute top-0 start-0 p-2">
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star"></i>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3">
                                <h6 class="mb-2 text-dark">{{ Str::limit($photo->title, 40) }}</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-{{ $photo->category_badge_color }}">{{ $photo->category_label }}</span>
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i>{{ $photo->views_count }}
                                    </small>
                                </div>
                                @if($photo->location)
                                    <p class="text-muted small mb-0 mt-2">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $photo->location }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $photos->links() }}
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body text-center py-5">
                <i class="fas fa-images fa-4x text-muted mb-4"></i>
                <h4 class="mb-3">No Photos Found</h4>
                <p class="text-muted mb-4">
                    @if(request('search') || request('category') !== 'all')
                        No photos match your search criteria. Try adjusting your filters.
                    @else
                        Our photo gallery is currently being updated. Please check back soon!
                    @endif
                </p>
                @if(request('search') || request('category') !== 'all')
                    <a href="{{ route('gallery.photos') }}" class="btn btn-primary">
                        <i class="fas fa-times me-2"></i>Clear Filters
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>

<style>
.page-header {
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}

.gallery-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.gallery-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

.featured-card {
    border: 2px solid #f59e0b;
}

.gallery-image-wrapper {
    position: relative;
    padding-top: 75%; /* 4:3 aspect ratio */
    overflow: hidden;
}

.gallery-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-card:hover .gallery-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay-content {
    color: white;
    text-align: center;
    transform: translateY(20px);
    transition: transform 0.3s ease;
}

.gallery-card:hover .gallery-overlay-content {
    transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .page-header {
        padding: 60px 0 !important;
    }
    
    .page-header h1 {
        font-size: 2rem !important;
    }
}
</style>
@endsection
