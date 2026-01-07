@extends('layouts.dashboard')

@section('title', 'Post New Vacancy')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1"><i class="fas fa-plus-circle me-2"></i>Post New Vacancy</h2>
                    <p class="text-muted mb-0">Fill in the details to post a new job vacancy</p>
                </div>
                <a href="{{ route('dashboard.vacancies.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('dashboard.vacancies.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-lg-8">
                <!-- Basic Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Job Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Position <span class="text-danger">*</span></label>
                                <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}" required>
                                @error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Location <span class="text-danger">*</span></label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', 'Udayapur, Nepal') }}" required>
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employment Type <span class="text-danger">*</span></label>
                                <select name="employment_type" class="form-select @error('employment_type') is-invalid @enderror" required>
                                    <option value="">Select Type</option>
                                    <option value="Full Time" {{ old('employment_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="Part Time" {{ old('employment_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="Contract" {{ old('employment_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                                    <option value="Temporary" {{ old('employment_type') == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                </select>
                                @error('employment_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Number of Positions <span class="text-danger">*</span></label>
                                <input type="number" name="number_of_positions" class="form-control @error('number_of_positions') is-invalid @enderror" value="{{ old('number_of_positions', 1) }}" min="1" required>
                                @error('number_of_positions')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Experience Required</label>
                                <input type="text" name="experience_required" class="form-control @error('experience_required') is-invalid @enderror" value="{{ old('experience_required') }}" placeholder="e.g., 2-3 years">
                                @error('experience_required')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Education Level</label>
                                <input type="text" name="education_level" class="form-control @error('education_level') is-invalid @enderror" value="{{ old('education_level') }}" placeholder="e.g., Bachelor's Degree">
                                @error('education_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}" placeholder="e.g., Development, Management">
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department') }}" placeholder="e.g., Field Operations">
                                @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Salary Range</label>
                            <input type="text" name="salary_range" class="form-control @error('salary_range') is-invalid @enderror" value="{{ old('salary_range') }}" placeholder="e.g., As per organization rules">
                            @error('salary_range')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Job Details -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Job Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Job Description <span class="text-danger">*</span></label>
                            <textarea name="description" rows="6" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Responsibilities</label>
                            <textarea name="responsibilities" rows="6" class="form-control @error('responsibilities') is-invalid @enderror" placeholder="List key responsibilities (one per line)">{{ old('responsibilities') }}</textarea>
                            @error('responsibilities')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Requirements</label>
                            <textarea name="requirements" rows="6" class="form-control @error('requirements') is-invalid @enderror" placeholder="List requirements (one per line)">{{ old('requirements') }}</textarea>
                            @error('requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Required Skills</label>
                            <textarea name="skills" rows="4" class="form-control @error('skills') is-invalid @enderror" placeholder="Comma-separated skills">{{ old('skills') }}</textarea>
                            @error('skills')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Benefits</label>
                            <textarea name="benefits" rows="4" class="form-control @error('benefits') is-invalid @enderror" placeholder="List benefits offered">{{ old('benefits') }}</textarea>
                            @error('benefits')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Application Details -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Application Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">How to Apply</label>
                            <textarea name="how_to_apply" rows="4" class="form-control @error('how_to_apply') is-invalid @enderror" placeholder="Instructions for applying">{{ old('how_to_apply') }}</textarea>
                            @error('how_to_apply')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Application Email</label>
                                <input type="email" name="application_email" class="form-control @error('application_email') is-invalid @enderror" value="{{ old('application_email') }}">
                                @error('application_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Application Phone</label>
                                <input type="text" name="application_phone" class="form-control @error('application_phone') is-invalid @enderror" value="{{ old('application_phone') }}">
                                @error('application_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Publishing Options -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Publishing</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Application Deadline <span class="text-danger">*</span></label>
                            <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}" required>
                            @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Published Date</label>
                            <input type="date" name="published_date" class="form-control @error('published_date') is-invalid @enderror" value="{{ old('published_date', date('Y-m-d')) }}">
                            @error('published_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <hr>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <strong>Active</strong>
                                <small class="d-block text-muted">Vacancy will be visible to public</small>
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                <strong>Featured</strong>
                                <small class="d-block text-muted">Show in featured section</small>
                            </label>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_urgent" value="1" class="form-check-input" id="is_urgent" {{ old('is_urgent') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_urgent">
                                <strong>Urgent</strong>
                                <small class="d-block text-muted">Mark as urgent hiring</small>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-check me-2"></i>Post Vacancy
                        </button>
                        <a href="{{ route('dashboard.vacancies.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
