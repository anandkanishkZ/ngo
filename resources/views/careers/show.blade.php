@extends('layouts.app')

@section('title', $vacancy->title . ' - Career Opportunities')

@section('content')
<div class="page-header bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <a href="{{ route('careers.vacancy') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Back to Vacancies
                    </a>
                </div>
                <h1 class="display-5 fw-bold mb-3">{{ $vacancy->title }}</h1>
                <p class="lead mb-4">{{ $vacancy->position }}</p>
                
                <div class="d-flex flex-wrap gap-3">
                    <span class="badge bg-light text-dark py-2 px-3">
                        <i class="fas fa-map-marker-alt me-2"></i>{{ $vacancy->location }}
                    </span>
                    <span class="badge bg-light text-dark py-2 px-3">
                        <i class="far fa-clock me-2"></i>{{ $vacancy->employment_type }}
                    </span>
                    @if($vacancy->number_of_positions > 1)
                        <span class="badge bg-light text-dark py-2 px-3">
                            <i class="fas fa-users me-2"></i>{{ $vacancy->number_of_positions }} Positions
                        </span>
                    @endif
                    @if($vacancy->is_urgent)
                        <span class="badge bg-danger py-2 px-3">
                            <i class="fas fa-exclamation-circle me-2"></i>Urgent Hiring
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="bg-white text-dark rounded p-4">
                    <p class="mb-2 text-muted small">Application Deadline</p>
                    <h3 class="mb-3 text-primary">{{ $vacancy->formatted_deadline }}</h3>
                    @if($vacancy->isDeadlineApproaching())
                        <p class="text-danger mb-0 fw-bold">
                            <i class="fas fa-clock me-1"></i>{{ $vacancy->getDaysRemaining() }} days remaining
                        </p>
                    @else
                        <p class="text-success mb-0">
                            <i class="fas fa-clock me-1"></i>{{ $vacancy->getDaysRemaining() }} days remaining
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Job Description -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h3 class="mb-4"><i class="fas fa-file-alt text-primary me-2"></i>Job Description</h3>
                    <p class="text-muted" style="white-space: pre-line;">{{ $vacancy->description }}</p>
                </div>
            </div>

            @if($vacancy->responsibilities)
                <!-- Responsibilities -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-4"><i class="fas fa-tasks text-primary me-2"></i>Key Responsibilities</h3>
                        <div class="text-muted" style="white-space: pre-line;">{{ $vacancy->responsibilities }}</div>
                    </div>
                </div>
            @endif

            @if($vacancy->requirements)
                <!-- Requirements -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-4"><i class="fas fa-check-circle text-primary me-2"></i>Requirements</h3>
                        <div class="text-muted" style="white-space: pre-line;">{{ $vacancy->requirements }}</div>
                    </div>
                </div>
            @endif

            @if($vacancy->skills && count($vacancy->skills_array) > 0)
                <!-- Skills -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-4"><i class="fas fa-star text-primary me-2"></i>Required Skills</h3>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($vacancy->skills_array as $skill)
                                <span class="badge bg-primary py-2 px-3">{{ $skill }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            @if($vacancy->benefits)
                <!-- Benefits -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h3 class="mb-4"><i class="fas fa-gift text-primary me-2"></i>Benefits</h3>
                        <div class="text-muted" style="white-space: pre-line;">{{ $vacancy->benefits }}</div>
                    </div>
                </div>
            @endif

            <!-- How to Apply -->
            <div class="card shadow-sm border-success mb-4">
                <div class="card-body p-4 bg-light">
                    <h3 class="mb-4 text-success"><i class="fas fa-paper-plane me-2"></i>How to Apply</h3>
                    @if($vacancy->how_to_apply)
                        <p class="mb-4" style="white-space: pre-line;">{{ $vacancy->how_to_apply }}</p>
                    @endif
                    
                    @if($vacancy->application_email || $vacancy->application_phone)
                        <div class="row g-3">
                            @if($vacancy->application_email)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-primary me-3 fs-4"></i>
                                        <div>
                                            <p class="mb-0 small text-muted">Email your application to:</p>
                                            <a href="mailto:{{ $vacancy->application_email }}" class="fw-bold">{{ $vacancy->application_email }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($vacancy->application_phone)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-phone text-primary me-3 fs-4"></i>
                                        <div>
                                            <p class="mb-0 small text-muted">Contact us at:</p>
                                            <a href="tel:{{ $vacancy->application_phone }}" class="fw-bold">{{ $vacancy->application_phone }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-4">Position Details</h5>
                    
                    <div class="mb-3">
                        <p class="mb-1 text-muted small"><i class="fas fa-map-marker-alt me-2"></i>Location</p>
                        <p class="mb-0 fw-bold">{{ $vacancy->location }}</p>
                    </div>
                    
                    <div class="mb-3">
                        <p class="mb-1 text-muted small"><i class="far fa-clock me-2"></i>Employment Type</p>
                        <p class="mb-0 fw-bold">{{ $vacancy->employment_type }}</p>
                    </div>
                    
                    @if($vacancy->experience_required)
                        <div class="mb-3">
                            <p class="mb-1 text-muted small"><i class="fas fa-chart-line me-2"></i>Experience</p>
                            <p class="mb-0 fw-bold">{{ $vacancy->experience_required }}</p>
                        </div>
                    @endif
                    
                    @if($vacancy->education_level)
                        <div class="mb-3">
                            <p class="mb-1 text-muted small"><i class="fas fa-graduation-cap me-2"></i>Education</p>
                            <p class="mb-0 fw-bold">{{ $vacancy->education_level }}</p>
                        </div>
                    @endif
                    
                    @if($vacancy->salary_range)
                        <div class="mb-3">
                            <p class="mb-1 text-muted small"><i class="fas fa-dollar-sign me-2"></i>Salary Range</p>
                            <p class="mb-0 fw-bold">{{ $vacancy->salary_range }}</p>
                        </div>
                    @endif
                    
                    @if($vacancy->department)
                        <div class="mb-3">
                            <p class="mb-1 text-muted small"><i class="fas fa-building me-2"></i>Department</p>
                            <p class="mb-0 fw-bold">{{ $vacancy->department }}</p>
                        </div>
                    @endif
                    
                    @if($vacancy->category)
                        <div class="mb-3">
                            <p class="mb-1 text-muted small"><i class="fas fa-tag me-2"></i>Category</p>
                            <p class="mb-0 fw-bold">{{ $vacancy->category }}</p>
                        </div>
                    @endif
                    
                    <div class="mb-0">
                        <p class="mb-1 text-muted small"><i class="far fa-calendar me-2"></i>Posted On</p>
                        <p class="mb-0 fw-bold">{{ $vacancy->formatted_published_date ?? $vacancy->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            @if(isset($relatedVacancies) && $relatedVacancies->count() > 0)
                <!-- Related Vacancies -->
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Other Open Positions</h5>
                        @foreach($relatedVacancies as $related)
                            <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                <h6 class="mb-2">
                                    <a href="{{ route('careers.show', $related->id) }}" class="text-decoration-none">
                                        {{ $related->title }}
                                    </a>
                                </h6>
                                <p class="mb-1 small text-muted">{{ $related->position }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $related->location }}
                                    </small>
                                    <span class="badge bg-light text-dark">{{ $related->employment_type }}</span>
                                </div>
                            </div>
                        @endforeach
                        <a href="{{ route('careers.vacancy') }}" class="btn btn-outline-primary btn-sm w-100 mt-2">
                            View All Vacancies
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
