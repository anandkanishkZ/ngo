@extends('layouts.app')

@section('title', 'Career Opportunities - JIDS Nepal')

@section('content')
<div class="page-header" style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); padding: 80px 0;">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bold mb-3">
                <i class="fas fa-briefcase me-3"></i>Career Opportunities
            </h1>
            <p class="lead mb-0">Join our team and make a meaningful difference in people's lives</p>
        </div>
    </div>
</div>

<div class="container py-5">
    @if($featuredVacancies && $featuredVacancies->count() > 0)
        <!-- Featured Vacancies -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-warning" style="width: 4px; height: 32px; margin-right: 16px;"></div>
                    <h2 class="mb-0">Featured Positions</h2>
                </div>
            </div>
            @foreach($featuredVacancies as $vacancy)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-warning border-2 vacancy-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="badge bg-warning text-dark mb-2">Featured</span>
                                    @if($vacancy->is_urgent)
                                        <span class="badge bg-danger mb-2">Urgent</span>
                                    @endif
                                </div>
                                @if($vacancy->isDeadlineApproaching())
                                    <span class="badge bg-danger">{{ $vacancy->getDaysRemaining() }} days left</span>
                                @endif
                            </div>
                            <h5 class="card-title fw-bold mb-2">
                                <i class="fas fa-user-tie me-2 text-primary"></i>{{ $vacancy->title }}
                            </h5>
                            <p class="text-muted mb-3">
                                <i class="fas fa-briefcase me-2"></i>{{ $vacancy->position }}
                            </p>
                            <p class="card-text text-muted mb-3">
                                {{ Str::limit($vacancy->description, 120) }}
                            </p>
                            <div class="mb-3">
                                <span class="badge bg-light text-dark me-2">
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $vacancy->location }}
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="far fa-clock me-1"></i>{{ $vacancy->employment_type }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="far fa-calendar me-1"></i>Deadline: {{ $vacancy->formatted_deadline }}
                                </small>
                                <a href="{{ route('careers.show', $vacancy->id) }}" class="btn btn-primary btn-sm">
                                    View Details <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- All Vacancies -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <div class="bg-primary" style="width: 4px; height: 32px; margin-right: 16px;"></div>
                    <h2 class="mb-0">All Open Positions ({{ $vacancies->count() }})</h2>
                </div>
            </div>
        </div>
    </div>

    @if($vacancies->count() > 0)
        <div class="row g-4">
            @foreach($vacancies as $vacancy)
                <div class="col-12">
                    <div class="card shadow-sm vacancy-card">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-grow-1">
                                            <div class="mb-2">
                                                @if($vacancy->is_featured)
                                                    <span class="badge bg-warning text-dark me-2">Featured</span>
                                                @endif
                                                @if($vacancy->is_urgent)
                                                    <span class="badge bg-danger me-2">Urgent</span>
                                                @endif
                                                @if($vacancy->category)
                                                    <span class="badge bg-info me-2">{{ $vacancy->category }}</span>
                                                @endif
                                                @if($vacancy->isDeadlineApproaching())
                                                    <span class="badge bg-danger">{{ $vacancy->getDaysRemaining() }} days left</span>
                                                @endif
                                            </div>
                                            <h4 class="mb-2">
                                                <i class="fas fa-user-tie me-2 text-primary"></i>{{ $vacancy->title }}
                                            </h4>
                                            <p class="text-muted mb-2">
                                                <i class="fas fa-briefcase me-2"></i>{{ $vacancy->position }}
                                            </p>
                                            <p class="mb-3">{{ Str::limit($vacancy->description, 200) }}</p>
                                            
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $vacancy->location }}
                                                </span>
                                                <span class="badge bg-light text-dark">
                                                    <i class="far fa-clock me-1"></i>{{ $vacancy->employment_type }}
                                                </span>
                                                @if($vacancy->number_of_positions > 1)
                                                    <span class="badge bg-light text-dark">
                                                        <i class="fas fa-users me-1"></i>{{ $vacancy->number_of_positions }} Positions
                                                    </span>
                                                @endif
                                                @if($vacancy->experience_required)
                                                    <span class="badge bg-light text-dark">
                                                        <i class="fas fa-chart-line me-1"></i>{{ $vacancy->experience_required }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 text-lg-end">
                                    <div class="mb-3">
                                        <p class="mb-1 text-muted small">
                                            <i class="far fa-calendar me-1"></i>Application Deadline
                                        </p>
                                        <p class="mb-0 fw-bold">{{ $vacancy->formatted_deadline }}</p>
                                    </div>
                                    <a href="{{ route('careers.show', $vacancy->id) }}" class="btn btn-primary">
                                        View Full Details <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-briefcase fa-4x text-muted mb-4"></i>
                        <h4 class="mb-3">No Vacancies Available Currently</h4>
                        <p class="text-muted mb-4">
                            We don't have any open positions at the moment. Please check back later for new opportunities.
                        </p>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                            <i class="fas fa-envelope me-2"></i>Contact Us for Future Opportunities
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.vacancy-card {
    transition: all 0.3s ease;
}

.vacancy-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

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
</style>
@endsection
