@extends('layouts.dashboard')

@section('title','Hero Slides')

@section('content')
<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Hero Slides</h4>
    <a href="{{ route('dashboard.hero.create') }}" class="btn btn-primary"><i class="fa fa-plus me-2"></i>Add Slide</a>
  </div>
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  <div class="ds-card p-0">
    <div class="table-responsive">
      <table class="table mb-0 align-middle">
        <thead>
          <tr>
            <th>Order</th>
            <th>Preview</th>
            <th>Title</th>
            <th>Active</th>
            <th>Updated</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($slides as $slide)
            <tr>
              <td>{{ $slide->sort_order }}</td>
              <td>
                @if($slide->bg_image)
                  <img src="{{ asset('storage/'.$slide->bg_image) }}" alt="bg" style="width:120px;height:60px;object-fit:cover;border-radius:.5rem;border:1px solid var(--ds-border)">
                @endif
              </td>
              <td>{{ $slide->title }}</td>
              <td>
                @if($slide->is_active)
                  <span class="badge bg-success">Active</span>
                @else
                  <span class="badge bg-secondary">Hidden</span>
                @endif
              </td>
              <td>{{ $slide->updated_at->diffForHumans() }}</td>
              <td class="text-end">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('dashboard.hero.edit',$slide) }}">Edit</a>
                <form action="{{ route('dashboard.hero.destroy',$slide) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this slide?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center text-muted p-4">No slides yet. Click "Add Slide" to create one.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
