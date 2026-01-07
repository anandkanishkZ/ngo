@extends('layouts.dashboard')

@section('title', 'Manage Notices')

@section('content')
<div class="dashboard-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Manage Notices</h1>
        <div class="dashboard-actions">
            <a href="{{ route('dashboard.notices.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Notice
            </a>
        </div>
    </div>
</div>

<div class="dashboard-content">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">All Notices ({{ $notices->total() }})</h5>
                <div class="d-flex gap-2">
                    <select class="form-select form-select-sm" id="bulkAction" style="width: auto;">
                        <option value="">Bulk Actions</option>
                        <option value="activate">Activate</option>
                        <option value="deactivate">Deactivate</option>
                        <option value="publish">Publish</option>
                        <option value="archive">Archive</option>
                        <option value="delete">Delete</option>
                    </select>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="applyBulkAction()">
                        Apply
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($notices->count() > 0)
                <form id="bulkActionForm" method="POST" action="{{ route('dashboard.notices.bulk-action') }}">
                    @csrf
                    <input type="hidden" name="action" id="bulkActionInput">
                    
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="40">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th width="60">Image</th>
                                    <th>Title</th>
                                    <th width="100">Priority</th>
                                    <th width="100">Status</th>
                                    <th width="100">Category</th>
                                    <th width="120">Published</th>
                                    <th width="80">Featured</th>
                                    <th width="80">Active</th>
                                    <th width="140">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notices as $notice)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="notices[]" value="{{ $notice->id }}" class="form-check-input notice-checkbox">
                                    </td>
                                    <td>
                                        @if($notice->image_url)
                                            <img src="{{ $notice->image_url }}" 
                                                 alt="Notice Image" 
                                                 class="rounded" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="mb-1">{{ \Str::limit($notice->title, 50) }}</h6>
                                            <small class="text-muted">{{ \Str::limit($notice->excerpt, 80) }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $notice->priority === 'urgent' ? 'danger' : ($notice->priority === 'high' ? 'warning' : ($notice->priority === 'medium' ? 'info' : 'secondary')) }}">
                                            {{ ucfirst($notice->priority) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $notice->status === 'published' ? 'success' : ($notice->status === 'draft' ? 'secondary' : 'dark') }}">
                                            {{ ucfirst($notice->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $notice->category ?? '-' }}</small>
                                    </td>
                                    <td>
                                        @if($notice->published_at)
                                            <small>{{ $notice->published_at->format('M d, Y') }}</small>
                                        @else
                                            <small class="text-muted">Not published</small>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('dashboard.notices.toggle-featured', $notice->id) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $notice->is_featured ? 'btn-warning' : 'btn-outline-warning' }}" title="Toggle Featured">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('dashboard.notices.toggle-status', $notice->id) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ $notice->is_active ? 'btn-success' : 'btn-outline-success' }}" title="Toggle Status">
                                                <i class="fas fa-{{ $notice->is_active ? 'check' : 'times' }}"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('dashboard.notices.show', $notice->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('dashboard.notices.edit', $notice->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($notice->status === 'draft')
                                                <form method="POST" action="{{ route('dashboard.notices.quick-publish', $notice->id) }}" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Quick Publish">
                                                        <i class="fas fa-upload"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                    onclick="confirmDelete('{{ route('dashboard.notices.destroy', $notice->id) }}')" 
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing {{ $notices->firstItem() }} to {{ $notices->lastItem() }} of {{ $notices->total() }} notices
                        </div>
                        {{ $notices->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No notices found</h5>
                    <p class="text-muted mb-4">Start by creating your first notice.</p>
                    <a href="{{ route('dashboard.notices.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create Notice
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Select All functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.notice-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Bulk action functionality
function applyBulkAction() {
    const action = document.getElementById('bulkAction').value;
    const checkedBoxes = document.querySelectorAll('.notice-checkbox:checked');
    
    if (!action) {
        alert('Please select an action');
        return;
    }
    
    if (checkedBoxes.length === 0) {
        alert('Please select at least one notice');
        return;
    }
    
    if (action === 'delete') {
        if (!confirm('Are you sure you want to delete the selected notices? This action cannot be undone.')) {
            return;
        }
    }
    
    document.getElementById('bulkActionInput').value = action;
    document.getElementById('bulkActionForm').submit();
}

// Delete confirmation
function confirmDelete(url) {
    if (confirm('Are you sure you want to delete this notice? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
