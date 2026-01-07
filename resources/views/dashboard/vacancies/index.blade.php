@extends('layouts.dashboard')

@section('title', 'Manage Vacancies')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-briefcase me-2"></i>Manage Vacancies</h2>
                    <p class="text-muted mb-0">Post and manage job vacancies</p>
                </div>
                <a href="{{ route('dashboard.vacancies.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Post New Vacancy
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('dashboard.vacancies.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search vacancies..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                    <a href="{{ route('dashboard.vacancies.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Vacancies List -->
    <div class="card shadow-sm">
        <div class="card-body">
            @if($vacancies->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vacancies as $vacancy)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <strong>{{ $vacancy->title }}</strong>
                                                <div class="small text-muted">{{ $vacancy->position }}</div>
                                                @if($vacancy->is_featured)
                                                    <span class="badge bg-warning text-dark">Featured</span>
                                                @endif
                                                @if($vacancy->is_urgent)
                                                    <span class="badge bg-danger">Urgent</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $vacancy->location }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $vacancy->employment_type }}</span>
                                    </td>
                                    <td>
                                        <div>{{ $vacancy->formatted_deadline }}</div>
                                        @if($vacancy->isExpired())
                                            <span class="badge bg-danger">Expired</span>
                                        @elseif($vacancy->isDeadlineApproaching())
                                            <span class="badge bg-warning text-dark">{{ $vacancy->getDaysRemaining() }} days left</span>
                                        @else
                                            <span class="badge bg-success">{{ $vacancy->getDaysRemaining() }} days left</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('dashboard.vacancies.toggle-status', $vacancy) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $vacancy->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                {{ $vacancy->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <i class="fas fa-eye text-muted me-1"></i>{{ $vacancy->views_count }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('careers.show', $vacancy->id) }}" class="btn btn-sm btn-info" title="View" target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.vacancies.edit', $vacancy) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('dashboard.vacancies.destroy', $vacancy) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this vacancy?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $vacancies->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No vacancies found</h5>
                    <p class="text-muted">Start by posting your first job vacancy.</p>
                    <a href="{{ route('dashboard.vacancies.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus me-2"></i>Post New Vacancy
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
