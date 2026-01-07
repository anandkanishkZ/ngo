@extends('layouts.app')

@section('title', $photo->title . ' - Photo Gallery - JIDS Nepal')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('gallery.photos') }}">Gallery</a></li>
            <li class="breadcrumb-item active">{{ Str::limit($photo->title, 40) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Photo -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <img src="{{ $photo->media->full_url }}" alt="{{ $photo->title }}" class="img-fluid w-100" style="border-radius: 12px;">
                </div>
            </div>

            <!-- Photo Details -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="h3 mb-2">{{ $photo->title }}</h1>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-{{ $photo->category_badge_color }}">{{ $photo->category_label }}</span>
                                @if($photo->is_featured)
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-eye me-1"></i>{{ $photo->views_count }} views
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($photo->description)
                        <div class="mb-4">
                            <h5 class="mb-2">Description</h5>
                            <p class="text-muted">{{ $photo->description }}</p>
                        </div>
                    @endif

                    <!-- Tags -->
                    @if($photo->tags)
                        <div class="mb-4">
                            <h6 class="mb-2">Tags:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($photo->tags_array as $tag)
                                    <a href="{{ route('gallery.photos', ['search' => $tag]) }}" class="badge bg-secondary text-decoration-none">
                                        <i class="fas fa-tag me-1"></i>{{ $tag }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Metadata -->
                    <div class="border-top pt-3">
                        <div class="row g-3 small text-muted">
                            @if($photo->location)
                                <div class="col-md-6">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <strong>Location:</strong> {{ $photo->location }}
                                </div>
                            @endif
                            @if($photo->photo_date)
                                <div class="col-md-6">
                                    <i class="far fa-calendar me-2"></i>
                                    <strong>Date:</strong> {{ $photo->formatted_photo_date }}
                                </div>
                            @endif
                            @if($photo->photographer)
                                <div class="col-md-6">
                                    <i class="fas fa-camera me-2"></i>
                                    <strong>Photographer:</strong> {{ $photo->photographer }}
                                </div>
                            @endif
                            <div class="col-md-6">
                                <i class="fas fa-clock me-2"></i>
                                <strong>Added:</strong> {{ $photo->created_at->format('M j, Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Image Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Image Information</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Dimensions:</span>
                        <span>{{ $photo->media->width }} × {{ $photo->media->height }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">File Size:</span>
                        <span>{{ $photo->media->size_formatted }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Format:</span>
                        <span>{{ strtoupper(pathinfo($photo->media->filename, PATHINFO_EXTENSION)) }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <a href="{{ $photo->media->full_url }}" target="_blank" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-external-link-alt me-2"></i>View Full Size
                    </a>
                    <a href="{{ route('gallery.photos', ['category' => $photo->category]) }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-folder me-2"></i>View {{ $photo->category_label }}
                    </a>
                </div>
            </div>

            <!-- Similar Photos -->
            @if($similarPhotos && $similarPhotos->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Similar Photos</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($similarPhotos as $similar)
                                <div class="col-6">
                                    <a href="{{ route('gallery.show', $similar->id) }}" class="text-decoration-none">
                                        <div class="similar-photo-card">
                                            <img src="{{ $similar->media->full_url }}" alt="{{ $similar->title }}" class="img-fluid rounded">
                                            <p class="small text-dark mt-2 mb-0">{{ Str::limit($similar->title, 30) }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.similar-photo-card {
    transition: transform 0.2s ease;
}

.similar-photo-card:hover {
    transform: translateY(-4px);
}

.similar-photo-card img {
    aspect-ratio: 1;
    object-fit: cover;
    transition: opacity 0.2s ease;
}

.similar-photo-card:hover img {
    opacity: 0.9;
}
</style>
@endsection
