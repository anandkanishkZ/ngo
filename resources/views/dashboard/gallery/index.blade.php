@extends('layouts.dashboard')

@section('title', 'Gallery Photos - Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2">Gallery Photos</h1>
            <p class="text-muted mb-0">Manage photos displayed in the public gallery</p>
        </div>
        <a href="{{ route('dashboard.gallery.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Photo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.gallery.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label small text-muted">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Search photos..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted">Category</label>
                    <select name="category" class="form-select">
                        <option value="all">All Categories</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted">Status</label>
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="featured" {{ request('status') === 'featured' ? 'selected' : '' }}>Featured</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small text-muted">Sort By</label>
                    <select name="sort_by" class="form-select">
                        <option value="display_order" {{ request('sort_by') === 'display_order' ? 'selected' : '' }}>Display Order</option>
                        <option value="recent" {{ request('sort_by') === 'recent' ? 'selected' : '' }}>Most Recent</option>
                        <option value="views" {{ request('sort_by') === 'views' ? 'selected' : '' }}>Most Viewed</option>
                        <option value="photo_date" {{ request('sort_by') === 'photo_date' ? 'selected' : '' }}>Photo Date</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <a href="{{ route('dashboard.gallery.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Photos Grid -->
    @if($photos->count() > 0)
        <div class="row g-4">
            @foreach($photos as $photo)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100 gallery-card">
                        <div class="position-relative">
                            <img src="{{ $photo->media->full_url }}" class="card-img-top" alt="{{ $photo->title }}" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 p-2">
                                @if($photo->is_featured)
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                                @if(!$photo->is_active)
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title mb-2">{{ Str::limit($photo->title, 40) }}</h6>
                            <p class="card-text small text-muted mb-3">
                                {{ Str::limit($photo->description, 60) }}
                            </p>
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                <span class="badge bg-{{ $photo->category_badge_color }}">{{ $photo->category_label }}</span>
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-eye me-1"></i>{{ $photo->views_count }}
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('dashboard.gallery.edit', $photo) }}" class="btn btn-sm btn-outline-primary flex-fill" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dashboard.gallery.toggle-status', $photo) }}" method="POST" class="flex-fill">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $photo->is_active ? 'success' : 'secondary' }} w-100" title="Toggle Status">
                                        <i class="fas fa-{{ $photo->is_active ? 'eye' : 'eye-slash' }}"></i>
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.gallery.toggle-featured', $photo) }}" method="POST" class="flex-fill">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $photo->is_featured ? 'warning' : 'secondary' }} w-100" title="Toggle Featured">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </form>
                                <form action="{{ route('dashboard.gallery.destroy', $photo) }}" method="POST" class="flex-fill" onsubmit="return confirm('Remove this photo from gallery?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer bg-light small text-muted">
                            <i class="fas fa-sort me-1"></i>Order: {{ $photo->display_order }}
                            @if($photo->photo_date)
                                | <i class="far fa-calendar ms-2 me-1"></i>{{ $photo->formatted_photo_date }}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $photos->links() }}
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-images fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">No Gallery Photos Found</h5>
                <p class="text-muted">Start by adding photos to your gallery.</p>
                <a href="{{ route('dashboard.gallery.create') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-plus me-2"></i>Add First Photo
                </a>
            </div>
        </div>
    @endif
</div>

<style>
.gallery-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.gallery-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.card-img-top {
    transition: opacity 0.2s ease;
}

.gallery-card:hover .card-img-top {
    opacity: 0.9;
}
</style>
@endsection
