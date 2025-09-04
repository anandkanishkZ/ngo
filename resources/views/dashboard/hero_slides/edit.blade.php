@extends('layouts.dashboard')
@section('title','Edit Hero Slide')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <h6><i class="fas fa-exclamation-triangle me-2"></i>Validation Errors:</h6>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

<form id="hero-slide-form" action="{{ route('dashboard.hero.update',$slide) }}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @include('dashboard.hero_slides.form')
</form>
@endsection
