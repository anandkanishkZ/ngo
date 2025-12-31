@extends('layouts.app')

@section('title', 'Vacancy Details - JIDS Nepal')

@section('content')
<div class="page-header" style="background: linear-gradient(135deg, #2c5f2d 0%, #97bc62 100%); padding: 60px 0;">
    <div class="container">
        <h1 class="text-white mb-3">Vacancy Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('careers.vacancy') }}" class="text-white">Careers</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Vacancy Details</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="mb-4">Job Position Details</h2>
                    <p class="text-muted">Vacancy ID: {{ $id }}</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Detailed vacancy information will be displayed here including job description, requirements, and application process.
                    </div>
                    <a href="{{ route('careers.vacancy') }}" class="btn btn-secondary mt-3">
                        <i class="fas fa-arrow-left me-2"></i>Back to Vacancies
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
