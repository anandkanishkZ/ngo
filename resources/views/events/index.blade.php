@extends('layouts.app')

@section('title', 'Events | Hope Foundation')

@section('content')
<section class="section-padding">
  <div class="container">
    <h1 class="section-title">Upcoming Events</h1>
    <div class="row">
      @forelse($events as $event)
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="custom-card h-100">
          <img class="card-img-top" src="{{ $event->image ? asset('images/'.$event->image) : 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $event->title }}">
          <div class="card-body d-flex flex-column">
            <small class="text-muted mb-2"><i class="fas fa-calendar-alt me-1"></i>{{ $event->date->format('M d, Y') }}</small>
            <h5>{{ $event->title }}</h5>
            <p class="flex-grow-1">{{ Str::limit($event->description, 120) }}</p>
            <a class="btn btn-outline-primary mt-auto" href="{{ route('events.show', $event->id) }}">Details</a>
          </div>
        </div>
      </div>
      @empty
      <p>No events available.</p>
      @endforelse
    </div>
    <div>
      {{ $events->links() }}
    </div>
  </div>
</section>
@endsection
