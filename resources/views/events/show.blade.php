@extends('layouts.app')

@section('title', $event->title . ' | Events')

@section('content')
<section class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="custom-card p-4">
          <img class="img-fluid rounded mb-3" src="{{ $event->image ? asset('images/'.$event->image) : 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=1000&auto=format&fit=crop' }}" alt="{{ $event->title }}">
          <h1 class="mb-3">{{ $event->title }}</h1>
          <p class="text-muted"><i class="fas fa-calendar-alt me-2"></i>{{ $event->date->format('M d, Y') }} at {{ $event->time }}</p>
          <p class="text-muted"><i class="fas fa-map-marker-alt me-2"></i>{{ $event->location }}</p>
          <div class="mt-3">{!! nl2br(e($event->description)) !!}</div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
