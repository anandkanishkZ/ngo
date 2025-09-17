@extends('layouts.dashboard')

@section('title', 'Contact Message Details - Dashboard')

@section('content')
<div class="container-fluid px-4">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Contact Message Details</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left fa-sm"></i> Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Message Details Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Message Details</h6>
                <span class="badge {{ $contactMessage->status_badge_class }}">
                    {{ ucfirst($contactMessage->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-gray-800 font-weight-bold">Name:</h6>
                        <p class="mb-0">{{ $contactMessage->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-gray-800 font-weight-bold">Email:</h6>
                        <p class="mb-0">
                            <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
                        </p>
                    </div>
                </div>

                @if($contactMessage->phone)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-gray-800 font-weight-bold">Phone:</h6>
                        <p class="mb-0">
                            <a href="tel:{{ $contactMessage->phone }}">{{ $contactMessage->phone }}</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-gray-800 font-weight-bold">Inquiry Type:</h6>
                        <p class="mb-0">
                            <span class="badge bg-info">{{ $contactMessage->inquiry_type_formatted }}</span>
                        </p>
                    </div>
                </div>
                @else
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-gray-800 font-weight-bold">Inquiry Type:</h6>
                        <p class="mb-0">
                            <span class="badge bg-info">{{ $contactMessage->inquiry_type_formatted }}</span>
                        </p>
                    </div>
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-gray-800 font-weight-bold">Subject:</h6>
                        <p class="mb-0">{{ $contactMessage->subject }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <h6 class="text-gray-800 font-weight-bold">Message:</h6>
                        <div class="p-3 bg-light border rounded">
                            {!! nl2br(e($contactMessage->message)) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-gray-800 font-weight-bold">Submitted:</h6>
                        <p class="mb-0">
                            {{ $contactMessage->created_at->format('M d, Y \a\t h:i A') }}
                            <small class="text-muted">({{ $contactMessage->time_ago }})</small>
                        </p>
                    </div>
                    @if($contactMessage->read_at)
                    <div class="col-md-6">
                        <h6 class="text-gray-800 font-weight-bold">Read At:</h6>
                        <p class="mb-0">
                            {{ $contactMessage->read_at->format('M d, Y \a\t h:i A') }}
                        </p>
                    </div>
                    @endif
                </div>

                @if($contactMessage->ip_address)
                <div class="row mt-3">
                    <div class="col-12">
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt"></i> IP Address: {{ $contactMessage->ip_address }}
                        </small>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Admin Notes Card -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admin Notes</h6>
            </div>
            <div class="card-body">
                @if($contactMessage->admin_notes)
                    <div class="p-3 bg-light border rounded mb-3">
                        {!! nl2br(e($contactMessage->admin_notes)) !!}
                    </div>
                @endif

                <form method="POST" action="{{ route('dashboard.contact-messages.update-status', $contactMessage) }}">
                    @csrf
                    @method('PATCH')
                    
                    <div class="form-group">
                        <label for="admin_notes">Add/Update Notes:</label>
                        <textarea name="admin_notes" id="admin_notes" class="form-control" rows="4" 
                                  placeholder="Add internal notes about this contact message...">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="unread" {{ $contactMessage->status === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                            <option value="archived" {{ $contactMessage->status === 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Status & Notes
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions Card -->
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}" 
                       class="btn btn-success btn-block">
                        <i class="fas fa-reply"></i> Reply via Email
                    </a>
                    
                    @if($contactMessage->phone)
                    <a href="tel:{{ $contactMessage->phone }}" class="btn btn-info btn-block">
                        <i class="fas fa-phone"></i> Call {{ $contactMessage->phone }}
                    </a>
                    @endif
                    
                    <button type="button" class="btn btn-warning btn-block" 
                            onclick="markAs('{{ $contactMessage->status === 'read' ? 'unread' : 'read' }}')">
                        <i class="fas fa-eye{{ $contactMessage->status === 'read' ? '-slash' : '' }}"></i> 
                        Mark as {{ $contactMessage->status === 'read' ? 'Unread' : 'Read' }}
                    </button>
                    
                    <button type="button" class="btn btn-secondary btn-block" 
                            onclick="markAs('archived')">
                        <i class="fas fa-archive"></i> Archive Message
                    </button>
                    
                    <hr>
                    
                    <button type="button" class="btn btn-danger btn-block" 
                            onclick="deleteMessage()">
                        <i class="fas fa-trash"></i> Delete Message
                    </button>
                </div>
            </div>
        </div>

        <!-- Contact Info Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact Information</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="avatar-circle mb-3">
                        <i class="fas fa-user fa-2x text-gray-400"></i>
                    </div>
                    <h5 class="font-weight-bold">{{ $contactMessage->name }}</h5>
                    <p class="text-muted mb-2">{{ $contactMessage->email }}</p>
                    @if($contactMessage->phone)
                    <p class="text-muted mb-2">{{ $contactMessage->phone }}</p>
                    @endif
                    
                    <hr>
                    
                    <div class="row text-center">
                        <div class="col-12">
                            <h6 class="text-gray-800">Previous Messages</h6>
                            @php
                                $previousMessages = \App\Models\ContactMessage::where('email', $contactMessage->email)
                                    ->where('id', '!=', $contactMessage->id)
                                    ->count();
                            @endphp
                            
                            @if($previousMessages > 0)
                                <p class="text-success">
                                    <i class="fas fa-envelope"></i> 
                                    {{ $previousMessages }} previous {{ Str::plural('message', $previousMessages) }}
                                </p>
                                <a href="{{ route('dashboard.contact-messages.index', ['search' => $contactMessage->email]) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    View All Messages
                                </a>
                            @else
                                <p class="text-muted">
                                    <i class="fas fa-envelope"></i> First-time contact
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this contact message from <strong>{{ $contactMessage->name }}</strong>? 
                This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="{{ route('dashboard.contact-messages.destroy', $contactMessage) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Message</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection

@push('styles')
<style>
.avatar-circle {
    width: 60px;
    height: 60px;
    background-color: #f8f9fc;
    border: 2px solid #e3e6f0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.d-grid {
    display: grid;
}

.gap-2 {
    gap: 0.5rem;
}

.btn-block {
    width: 100%;
    margin-bottom: 0.5rem;
}
</style>
@endpush

@push('scripts')
<script>
function markAs(status) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("dashboard.contact-messages.update-status", $contactMessage) }}';
    
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    
    const methodField = document.createElement('input');
    methodField.type = 'hidden';
    methodField.name = '_method';
    methodField.value = 'PATCH';
    
    const statusField = document.createElement('input');
    statusField.type = 'hidden';
    statusField.name = 'status';
    statusField.value = status;
    
    form.appendChild(csrfToken);
    form.appendChild(methodField);
    form.appendChild(statusField);
    
    document.body.appendChild(form);
    form.submit();
}

function deleteMessage() {
    const modalEl = document.getElementById('deleteModal');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}
</script>
@endpush
