@extends('layouts.dashboard')

@section('title', 'Contact Messages - Dashboard')

@push('styles')
<style>
.border-left-primary { border-left: 0.25rem solid #4e73df !important; }
.border-left-danger { border-left: 0.25rem solid #e74a3b !important; }
.border-left-warning { border-left: 0.25rem solid #f6c23e !important; }
.border-left-success { border-left: 0.25rem solid #1cc88a !important; }
.text-gray-800 { color: #5a5c69 !important; }
.text-gray-300 { color: #dddfeb !important; }
.font-weight-bold { font-weight: 700 !important; }
.text-xs { font-size: 0.7rem; }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Contact Messages</h1>
    <div class="d-flex gap-2">
      <a href="{{ route('dashboard.contact-messages.export', request()->query()) }}" class="btn btn-outline-primary">
        <i class="fas fa-download"></i> Export CSV
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Messages</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['total']) }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-envelope fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Unread</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['unread']) }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Read</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['read']) }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-eye fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Replied</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($stats['replied']) }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-reply fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Filter Messages</h6>
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('dashboard.contact-messages.index') }}" class="row g-3">
        <div class="col-md-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-control">
            <option value="">All Statuses</option>
            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
            <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
            <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="inquiry_type" class="form-label">Inquiry Type</label>
          <select name="inquiry_type" id="inquiry_type" class="form-control">
            <option value="">All Types</option>
            <option value="general" {{ request('inquiry_type') === 'general' ? 'selected' : '' }}>General</option>
            {{-- Volunteer removed --}}
            <option value="partnership" {{ request('inquiry_type') === 'partnership' ? 'selected' : '' }}>Partnership</option>
            <option value="media" {{ request('inquiry_type') === 'media' ? 'selected' : '' }}>Media</option>
            <option value="support" {{ request('inquiry_type') === 'support' ? 'selected' : '' }}>Support</option>
          </select>
        </div>
        <div class="col-md-4">
          <label for="search" class="form-label">Search</label>
          <input type="text" name="search" id="search" class="form-control" placeholder="Search by name, email, subject, or message..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
          <label class="form-label">&nbsp;</label>
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-outline-secondary">Clear</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Contact Messages ({{ $messages->total() }})</h6>
      @if($messages->count() > 0)
      <div class="d-flex gap-2">
        <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleSelectAll()">Select All</button>
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Bulk Actions</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="bulkAction('mark_read')">Mark as Read</a></li>
            <li><a class="dropdown-item" href="#" onclick="bulkAction('mark_replied')">Mark as Replied</a></li>
            <li><a class="dropdown-item" href="#" onclick="bulkAction('archive')">Archive</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="#" onclick="bulkAction('delete')">Delete</a></li>
          </ul>
        </div>
      </div>
      @endif
    </div>
    <div class="card-body">
      @if($messages->count() > 0)
      <form id="bulk-form" method="POST" action="{{ route('dashboard.contact-messages.bulk-update') }}">
        @csrf
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="30"><input type="checkbox" id="select-all"></th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Type</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($messages as $message)
              <tr class="{{ $message->status === 'unread' ? 'font-weight-bold' : '' }}">
                <td><input type="checkbox" name="messages[]" value="{{ $message->id }}" class="message-checkbox"></td>
                <td>
                  <a href="{{ route('dashboard.contact-messages.show', $message) }}" class="text-decoration-none">{{ $message->name }}</a>
                  @if($message->status === 'unread')
                    <span class="badge bg-danger ms-1">New</span>
                  @endif
                </td>
                <td>{{ $message->email }}</td>
                <td><a href="{{ route('dashboard.contact-messages.show', $message) }}" class="text-decoration-none">{{ Str::limit($message->subject, 40) }}</a></td>
                <td><span class="badge bg-info">{{ $message->inquiry_type_formatted }}</span></td>
                <td><span class="badge {{ $message->status_badge_class }}">{{ ucfirst($message->status) }}</span></td>
                <td><small>{{ $message->time_ago }}</small></td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('dashboard.contact-messages.show', $message) }}" class="btn btn-sm btn-outline-primary" title="View"><i class="fas fa-eye"></i></a>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteMessage({{ $message->id }})" title="Delete"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </form>
      <div class="d-flex justify-content-between align-items-center mt-3">
        <div><small class="text-muted">Showing {{ $messages->firstItem() ?? 0 }} to {{ $messages->lastItem() ?? 0 }} of {{ $messages->total() }} results</small></div>
        {{ $messages->appends(request()->query())->links() }}
      </div>
      @else
      <div class="text-center py-4">
        <i class="fas fa-envelope fa-3x text-gray-300 mb-3"></i>
        <h5 class="text-gray-600">No contact messages found</h5>
        <p class="text-gray-500">Contact messages will appear here when visitors submit the contact form.</p>
      </div>
      @endif
    </div>
  </div>

  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Are you sure you want to delete this contact message? This action cannot be undone.</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form id="delete-form" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
function toggleSelectAll(){const a=document.getElementById('select-all'),b=document.querySelectorAll('.message-checkbox');b.forEach(c=>{c.checked=a.checked})}
function bulkAction(a){const b=document.querySelectorAll('.message-checkbox:checked');if(0===b.length)return void alert('Please select at least one message.');if('delete'===a&&!confirm('Are you sure you want to delete the selected messages?'))return;const c=document.getElementById('bulk-form'),d=document.createElement('input');d.type='hidden',d.name='action',d.value=a,c.appendChild(d),c.submit()}
function deleteMessage(a){const b=document.getElementById('delete-form');b.action=`/dashboard/contact-messages/${a}`;const c=new bootstrap.Modal(document.getElementById('deleteModal'));c.show()}
document.addEventListener('DOMContentLoaded',function(){const a=document.getElementById('select-all'),b=document.querySelectorAll('.message-checkbox');b.forEach(c=>{c.addEventListener('change',function(){const d=Array.from(b).every(e=>e.checked),f=Array.from(b).every(e=>!e.checked);a.checked=d,a.indeterminate=!d&&!f})}),a.addEventListener('change',function(){b.forEach(c=>{c.checked=a.checked})})});
</script>
@endpush
