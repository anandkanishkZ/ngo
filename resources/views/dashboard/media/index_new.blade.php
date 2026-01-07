@extends('layouts.dashboard')

@section('title', 'Media Library | Hope Foundation')

@section('content')
<div class="container-fluid">
  <!-- Header -->
  <div class="row mb-4">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1 class="h3 mb-1">Media Library</h1>
          <p class="text-muted">Manage your media files and assets</p>
        </div>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-outline-success" onclick="syncFiles()">
            <i class="fa-solid fa-sync me-1"></i>
            Sync Files
          </button>
          <button type="button" class="btn btn-outline-primary" onclick="showCreateFolderModal()">
            <i class="fa-solid fa-folder-plus me-1"></i>
            New Folder
          </button>
          <button type="button" class="btn btn-primary" onclick="showUploadModal()">
            <i class="fa-solid fa-upload me-1"></i>
            Upload Files
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Alert Messages -->
  <div id="alertContainer"></div>

  <!-- Debug Section -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="alert alert-info">
        <strong>Debug Mode:</strong>
        <button type="button" class="btn btn-sm btn-outline-info ms-2" onclick="debugTest()">Test Upload Function</button>
        <button type="button" class="btn btn-sm btn-outline-info ms-2" onclick="debugSelectedFiles()">Check Selected Files</button>
        <button type="button" class="btn btn-sm btn-outline-info ms-2" onclick="debugFormElements()">Check Form Elements</button>
      </div>
    </div>
  </div>

  <!-- Stats Row -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="ds-card metric">
        <div class="icon blue"><i class="fa-solid fa-file"></i></div>
        <div>
          <div class="muted">Total Files</div>
          <div class="h4 mb-0" id="totalFiles">{{ $media->total() }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="ds-card metric">
        <div class="icon green"><i class="fa-solid fa-image"></i></div>
        <div>
          <div class="muted">Images</div>
          <div class="h4 mb-0" id="totalImages">{{ $media->where('is_image', true)->count() }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="ds-card metric">
        <div class="icon orange"><i class="fa-solid fa-folder"></i></div>
        <div>
          <div class="muted">Folders</div>
          <div class="h4 mb-0" id="totalFolders">{{ count($allFolders) }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="ds-card metric">
        <div class="icon red"><i class="fa-solid fa-clock"></i></div>
        <div>
          <div class="muted">Recent (7d)</div>
          <div class="h4 mb-0" id="recentUploads">{{ $media->where('created_at', '>=', now()->subWeek())->count() }}</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="ds-card">
        <div class="card-body">
          <form method="GET" class="row g-3">
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-search"></i></span>
                <input type="text" class="form-control" name="search" placeholder="Search files..." value="{{ request('search') }}">
              </div>
            </div>
            <div class="col-md-2">
              <select name="folder" class="form-select">
                <option value="">All Folders</option>
                @foreach($allFolders as $folder)
                  <option value="{{ $folder }}" {{ request('folder') === $folder ? 'selected' : '' }}>
                    {{ ucfirst(str_replace(['_', '/'], [' ', ' / '], $folder)) }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <select name="type" class="form-select">
                <option value="">All Types</option>
                <option value="images" {{ request('type') === 'images' ? 'selected' : '' }}>Images</option>
                <option value="documents" {{ request('type') === 'documents' ? 'selected' : '' }}>Documents</option>
              </select>
            </div>
            <div class="col-md-2">
              <select name="orderby" class="form-select">
                <option value="latest" {{ request('orderby', 'latest') === 'latest' ? 'selected' : '' }}>Latest First</option>
                <option value="oldest" {{ request('orderby') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                <option value="alphabetical" {{ request('orderby') === 'alphabetical' ? 'selected' : '' }}>Alphabetical</option>
                <option value="size_desc" {{ request('orderby') === 'size_desc' ? 'selected' : '' }}>Largest Size</option>
                <option value="size_asc" {{ request('orderby') === 'size_asc' ? 'selected' : '' }}>Smallest Size</option>
              </select>
            </div>
            <div class="col-md-2">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary">
                  <i class="fa-solid fa-filter me-1"></i>Filter
                </button>
                <a href="{{ route('dashboard.media.index') }}" class="btn btn-outline-secondary">
                  <i class="fa-solid fa-times me-1"></i>Clear
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Media Grid -->
  <div class="row">
    <div class="col-12">
      <div class="ds-card">
        <div class="card-body">
          @if($media->count() > 0)
            <div class="media-grid">
              @foreach($media as $item)
                <div class="media-item" data-id="{{ $item->id }}">
                  <div class="media-item-inner">
                    <div class="media-checkbox">
                      <input type="checkbox" class="form-check-input media-select" value="{{ $item->id }}" onchange="updateBulkActions()">
                    </div>
                    
                    <div class="media-preview">
                      @if($item->is_image)
                        <img src="{{ $item->full_url }}" alt="{{ $item->alt_text ?: $item->title }}" loading="lazy">
                      @else
                        <div class="file-icon">
                          <i class="fa-solid {{ $item->getFileTypeIcon() }}"></i>
                          <span class="file-ext">{{ strtoupper(pathinfo($item->filename, PATHINFO_EXTENSION)) }}</span>
                        </div>
                      @endif
                    </div>
                    
                    <div class="media-info">
                      <div class="media-title">{{ Str::limit($item->title, 20) }}</div>
                      <div class="media-meta text-muted">
                        <small>{{ $item->size_formatted }} • {{ $item->created_at->format('M j, Y') }}</small>
                      </div>
                      @if($item->folder)
                        <div class="media-folder">
                          <i class="fa-solid fa-folder me-1"></i>{{ $item->folder }}
                        </div>
                      @endif
                    </div>
                    
                    <div class="media-actions">
                      <button type="button" class="btn btn-sm btn-outline-primary" onclick="editMedia({{ $item->id }})" title="Edit">
                        <i class="fa-solid fa-edit"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteMedia({{ $item->id }})" title="Delete">
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
              {{ $media->appends(request()->query())->links() }}
            </div>

            <!-- Bulk Actions -->
            <div id="bulkActionsBar" class="bulk-actions-bar" style="display: none;">
              <div class="d-flex align-items-center justify-content-between">
                <span id="selectedCount">0 items selected</span>
                <button type="button" class="btn btn-danger btn-sm" onclick="bulkDelete()">
                  <i class="fa-solid fa-trash me-1"></i>Delete Selected
                </button>
              </div>
            </div>
          @else
            <div class="text-center py-5">
              <i class="fa-solid fa-file fa-4x text-muted mb-3"></i>
              <h4>No media files found</h4>
              <p class="text-muted">Upload your first file to get started</p>
              <button type="button" class="btn btn-primary" onclick="showUploadModal()">
                <i class="fa-solid fa-upload me-1"></i>Upload Files
              </button>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Files</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="uploadForm" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label">Folder (Optional)</label>
            <input type="text" class="form-control" name="folder" placeholder="e.g., hero-images, event-photos">
            <div class="form-text">Leave empty to upload to root folder</div>
          </div>
          
          <div class="mb-3">
            <div class="upload-zone" onclick="document.getElementById('fileInput').click()">
              <div class="upload-zone-content">
                <i class="fa-solid fa-cloud-upload fa-3x text-primary mb-3"></i>
                <h5>Drag & Drop Files Here</h5>
                <p class="text-muted">or click to browse files</p>
                <input type="file" id="fileInput" name="files[]" multiple style="display: none;" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,.txt,.csv" onchange="handleFileSelect(this)">
              </div>
            </div>
          </div>
          
          <div id="fileList"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="uploadSubmit" onclick="uploadFiles()" disabled>Upload Files</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editForm">
          @csrf
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="media_id" id="editMediaId">
          
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="editTitle" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Alt Text (for images)</label>
            <input type="text" class="form-control" name="alt_text" id="editAltText">
          </div>
          <div class="mb-3">
            <label class="form-label">Folder</label>
            <input type="text" class="form-control" name="folder" id="editFolder">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="updateMedia()">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Folder Modal -->
<div class="modal fade" id="createFolderModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create New Folder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createFolderForm">
          @csrf
          <div class="mb-3">
            <label class="form-label">Folder Name</label>
            <input type="text" class="form-control" name="name" required placeholder="e.g., hero-images">
            <div class="form-text">Use lowercase letters, numbers, hyphens, and underscores only</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="createFolder()">Create Folder</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<style>
.ds-card {
  background: var(--ds-card);
  border: 1px solid var(--ds-border);
  border-radius: 12px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.ds-card .card-body {
  padding: 1.5rem;
}

.metric {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1.5rem;
}

.metric .icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: white;
}

.metric .icon.blue { background: #3b82f6; }
.metric .icon.green { background: #10b981; }
.metric .icon.orange { background: #f59e0b; }
.metric .icon.red { background: #ef4444; }

.media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1rem;
}

.media-item {
  background: var(--ds-card);
  border: 1px solid var(--ds-border);
  border-radius: 8px;
  overflow: hidden;
  transition: all 0.2s ease;
  position: relative;
}

.media-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.media-item.selected {
  border-color: var(--ds-primary);
  box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
}

.media-item-inner {
  position: relative;
  height: 100%;
}

.media-checkbox {
  position: absolute;
  top: 8px;
  left: 8px;
  z-index: 2;
}

.media-preview {
  aspect-ratio: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--ds-soft);
  position: relative;
}

.media-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.file-icon {
  text-align: center;
  color: var(--ds-muted);
}

.file-icon i {
  font-size: 3rem;
  margin-bottom: 0.5rem;
}

.file-ext {
  display: block;
  font-weight: 600;
  font-size: 0.8rem;
}

.media-info {
  padding: 0.75rem;
}

.media-title {
  font-weight: 600;
  margin-bottom: 0.25rem;
}

.media-folder {
  font-size: 0.75rem;
  color: var(--ds-primary);
  margin-top: 0.25rem;
}

.media-actions {
  position: absolute;
  top: 8px;
  right: 8px;
  display: flex;
  gap: 0.25rem;
  opacity: 0;
  transition: opacity 0.2s ease;
}

.media-item:hover .media-actions {
  opacity: 1;
}

.upload-zone {
  border: 2px dashed var(--ds-border);
  border-radius: 12px;
  padding: 3rem 1rem;
  text-align: center;
  transition: all 0.2s ease;
  cursor: pointer;
}

.upload-zone:hover {
  border-color: var(--ds-primary);
  background: var(--ds-active-bg);
}

.bulk-actions-bar {
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--ds-card);
  border: 1px solid var(--ds-border);
  border-radius: 8px;
  padding: 1rem 1.5rem;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
  z-index: 1000;
}

.alert {
  border-radius: 8px;
  border: none;
  padding: 1rem 1.5rem;
}

.alert-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
.alert-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
.alert-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
.alert-info { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }

#fileList {
  max-height: 200px;
  overflow-y: auto;
}

.file-preview {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem;
  background: var(--ds-soft);
  border-radius: 8px;
  margin-bottom: 0.5rem;
}

.file-preview img {
  width: 50px;
  height: 50px;
  object-fit: cover;
  border-radius: 6px;
}
</style>
@endpush

@push('scripts')
<script>
// Global variables
let selectedFiles = [];
let currentEditId = null;
let uploadModal = null;

// Initialize everything when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('Media Library loaded');
    
    // Initialize upload modal
    const uploadModalElement = document.getElementById('uploadModal');
    if (uploadModalElement) {
        uploadModal = new bootstrap.Modal(uploadModalElement);
        
        // Setup drag and drop when modal is shown
        uploadModalElement.addEventListener('shown.bs.modal', function() {
            setTimeout(setupDragAndDrop, 100);
        });
    }
});

// Show upload modal
function showUploadModal() {
    console.log('Showing upload modal');
    selectedFiles = [];
    
    // Reset form
    const uploadForm = document.getElementById('uploadForm');
    if (uploadForm) {
        uploadForm.reset();
    }
    
    // Clear file list and disable upload button
    document.getElementById('fileList').innerHTML = '';
    document.getElementById('uploadSubmit').disabled = true;
    
    // Show modal
    if (uploadModal) {
        uploadModal.show();
    } else {
        uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
        uploadModal.show();
    }
}

// Handle file selection
function handleFileSelect(input) {
    console.log('handleFileSelect called');
    console.log('input:', input);
    console.log('input.files:', input.files);
    
    if (!input.files || input.files.length === 0) {
        console.log('No files selected');
        selectedFiles = [];
        document.getElementById('uploadSubmit').disabled = true;
        return;
    }
    
    selectedFiles = Array.from(input.files);
    console.log('Files selected:', selectedFiles.length);
    console.log('Selected files details:', selectedFiles.map(f => ({name: f.name, size: f.size, type: f.type})));
    
    displayFileList();
    
    const uploadBtn = document.getElementById('uploadSubmit');
    uploadBtn.disabled = selectedFiles.length === 0;
    console.log('Upload button disabled:', uploadBtn.disabled);
}

// Display selected files
function displayFileList() {
    const fileList = document.getElementById('fileList');
    fileList.innerHTML = '';

    selectedFiles.forEach((file, index) => {
        const div = document.createElement('div');
        div.className = 'file-preview';
        div.innerHTML = `
            <div style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background: var(--ds-soft); border-radius: 6px;">
                ${file.type.startsWith('image/') ? 
                    `<img src="${URL.createObjectURL(file)}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">` :
                    '<i class="fa-solid fa-file"></i>'
                }
            </div>
            <div style="flex: 1;">
                <div style="font-weight: 600; font-size: 0.9rem;">${file.name}</div>
                <div style="font-size: 0.8rem; color: var(--ds-muted);">${formatFileSize(file.size)}</div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${index})">
                <i class="fa-solid fa-times"></i>
            </button>
        `;
        fileList.appendChild(div);
    });
}

// Remove file from selection
function removeFile(index) {
    selectedFiles.splice(index, 1);
    displayFileList();
    document.getElementById('uploadSubmit').disabled = selectedFiles.length === 0;
}

// Format file size
function formatFileSize(bytes) {
    const units = ['B', 'KB', 'MB', 'GB'];
    let size = bytes;
    let unitIndex = 0;
    
    while (size >= 1024 && unitIndex < units.length - 1) {
        size /= 1024;
        unitIndex++;
    }
    
    return Math.round(size * 100) / 100 + ' ' + units[unitIndex];
}

// Upload files
function uploadFiles() {
    console.log('uploadFiles() called');
    console.log('selectedFiles:', selectedFiles);
    console.log('selectedFiles.length:', selectedFiles.length);
    
    if (selectedFiles.length === 0) {
        console.log('No files selected, returning');
        return;
    }

    console.log('Starting upload...');
    const formData = new FormData();
    const folderInput = document.querySelector('#uploadForm input[name="folder"]');
    const tokenInput = document.querySelector('#uploadForm input[name="_token"]');
    
    console.log('folderInput:', folderInput);
    console.log('tokenInput:', tokenInput);
    
    if (!tokenInput) {
        console.error('CSRF token input not found!');
        showAlert('danger', 'CSRF token not found. Please refresh the page.');
        return;
    }
    
    const folder = folderInput ? folderInput.value : '';
    const token = tokenInput.value;
    
    console.log('folder:', folder);
    console.log('token:', token);
    
    // Add CSRF token
    formData.append('_token', token);
    
    // Add files
    selectedFiles.forEach((file, index) => {
        console.log(`Adding file ${index}:`, file.name, 'Size:', file.size, 'Type:', file.type);
        formData.append('files[]', file);
    });
    
    // Add folder if specified
    if (folder) {
        formData.append('folder', folder);
        console.log('Added folder to formData:', folder);
    }

    const uploadBtn = document.getElementById('uploadSubmit');
    uploadBtn.disabled = true;
    uploadBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i>Uploading...';

    const uploadUrl = '{{ route("dashboard.media.store") }}';
    console.log('Upload URL:', uploadUrl);

    fetch(uploadUrl, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        return response.json();
    })
    .then(data => {
        console.log('Upload response:', data);
        if (data.success) {
            showAlert('success', data.message);
            bootstrap.Modal.getInstance(document.getElementById('uploadModal')).hide();
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert('danger', data.message || 'Upload failed');
            if (data.errors) {
                console.error('Upload errors:', data.errors);
            }
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        showAlert('danger', 'Upload failed: ' + error.message);
    })
    .finally(() => {
        uploadBtn.disabled = false;
        uploadBtn.innerHTML = '<i class="fa-solid fa-upload me-1"></i>Upload Files';
    });
}

// Edit media
function editMedia(id) {
    console.log('Editing media:', id);
    currentEditId = id;
    
    fetch(`{{ route('dashboard.media.index') }}/${id}`)
        .then(response => response.json())
        .then(media => {
            document.getElementById('editMediaId').value = media.id;
            document.getElementById('editTitle').value = media.title;
            document.getElementById('editAltText').value = media.alt_text || '';
            document.getElementById('editFolder').value = media.folder || '';
            
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error fetching media:', error);
            showAlert('danger', 'Failed to load media details');
        });
}

// Update media
function updateMedia() {
    if (!currentEditId) return;

    const formData = new FormData(document.getElementById('editForm'));
    
    fetch(`{{ route('dashboard.media.index') }}/${currentEditId}`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert('danger', data.message || 'Update failed');
        }
    })
    .catch(error => {
        console.error('Update error:', error);
        showAlert('danger', 'Update failed');
    });
}

// Delete media
function deleteMedia(id) {
    if (!confirm('Are you sure you want to delete this file? This action cannot be undone.')) {
        return;
    }

    fetch(`{{ route('dashboard.media.index') }}/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert('danger', data.message || 'Delete failed');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        showAlert('danger', 'Delete failed');
    });
}

// Update bulk actions
function updateBulkActions() {
    const selectedItems = document.querySelectorAll('.media-select:checked');
    const bulkBar = document.getElementById('bulkActionsBar');
    const countSpan = document.getElementById('selectedCount');
    
    if (selectedItems.length > 0) {
        bulkBar.style.display = 'block';
        countSpan.textContent = `${selectedItems.length} item${selectedItems.length > 1 ? 's' : ''} selected`;
        
        // Update visual state
        selectedItems.forEach(checkbox => {
            checkbox.closest('.media-item').classList.add('selected');
        });
        
        document.querySelectorAll('.media-select:not(:checked)').forEach(checkbox => {
            checkbox.closest('.media-item').classList.remove('selected');
        });
    } else {
        bulkBar.style.display = 'none';
        document.querySelectorAll('.media-item').forEach(item => {
            item.classList.remove('selected');
        });
    }
}

// Bulk delete
function bulkDelete() {
    const selectedIds = Array.from(document.querySelectorAll('.media-select:checked')).map(cb => cb.value);
    
    if (selectedIds.length === 0) return;
    
    if (!confirm(`Are you sure you want to delete ${selectedIds.length} file(s)? This action cannot be undone.`)) {
        return;
    }

    fetch('{{ route("dashboard.media.bulk-delete") }}', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ids: selectedIds })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert('danger', data.message || 'Delete failed');
        }
    })
    .catch(error => {
        console.error('Bulk delete error:', error);
        showAlert('danger', 'Delete failed');
    });
}

// Sync files
function syncFiles() {
    const syncBtn = document.querySelector('button[onclick="syncFiles()"]');
    const originalContent = syncBtn.innerHTML;
    
    syncBtn.disabled = true;
    syncBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i>Syncing...';

    fetch('{{ route("dashboard.media.sync") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            setTimeout(() => location.reload(), 2000);
        } else {
            showAlert('danger', data.message || 'Sync failed');
        }
    })
    .catch(error => {
        console.error('Sync error:', error);
        showAlert('danger', 'Sync failed');
    })
    .finally(() => {
        syncBtn.disabled = false;
        syncBtn.innerHTML = originalContent;
    });
}

// Show create folder modal
function showCreateFolderModal() {
    const modal = new bootstrap.Modal(document.getElementById('createFolderModal'));
    modal.show();
}

// Create folder
function createFolder() {
    const formData = new FormData(document.getElementById('createFolderForm'));

    fetch('{{ route("dashboard.media.folders.create") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            bootstrap.Modal.getInstance(document.getElementById('createFolderModal')).hide();
            setTimeout(() => location.reload(), 1000);
        } else {
            showAlert('danger', data.message || 'Folder creation failed');
        }
    })
    .catch(error => {
        console.error('Create folder error:', error);
        showAlert('danger', 'Folder creation failed');
    });
}

// Setup drag and drop
function setupDragAndDrop() {
    const uploadZone = document.querySelector('.upload-zone');
    console.log('Setting up drag and drop for:', uploadZone);
    
    if (!uploadZone) {
        console.warn('Upload zone not found');
        return;
    }

    // Remove existing listeners first
    uploadZone.removeEventListener('dragenter', preventDefaults);
    uploadZone.removeEventListener('dragover', preventDefaults);
    uploadZone.removeEventListener('dragleave', preventDefaults);
    uploadZone.removeEventListener('drop', preventDefaults);

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, unhighlight, false);
    });

    uploadZone.addEventListener('drop', handleDrop, false);
    
    console.log('Drag and drop setup complete');

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        uploadZone.style.borderColor = 'var(--ds-primary)';
        uploadZone.style.backgroundColor = 'var(--ds-active-bg)';
    }

    function unhighlight() {
        uploadZone.style.borderColor = 'var(--ds-border)';
        uploadZone.style.backgroundColor = 'transparent';
    }

    function handleDrop(e) {
        console.log('Files dropped:', e.dataTransfer.files);
        const files = e.dataTransfer.files;
        selectedFiles = Array.from(files);
        
        // Also update the file input
        const fileInput = document.getElementById('fileInput');
        if (fileInput) {
            // Create a new FileList-like object
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }
        
        displayFileList();
        document.getElementById('uploadSubmit').disabled = selectedFiles.length === 0;
        console.log('Drop handled, selectedFiles:', selectedFiles.length);
    }
}

// Show alert
function showAlert(type, message) {
    const alertContainer = document.getElementById('alertContainer');
    const alertId = 'alert_' + Date.now();
    
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" id="${alertId}" role="alert">
            <i class="fa-solid fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    alertContainer.innerHTML = alertHtml;
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.remove();
        }
    }, 5000);
}

// Debug functions
function debugTest() {
    console.log('=== DEBUG TEST ===');
    console.log('selectedFiles:', selectedFiles);
    console.log('selectedFiles length:', selectedFiles ? selectedFiles.length : 'undefined');
    
    const uploadForm = document.getElementById('uploadForm');
    console.log('uploadForm:', uploadForm);
    
    const tokenInput = document.querySelector('#uploadForm input[name="_token"]');
    console.log('tokenInput:', tokenInput);
    console.log('token value:', tokenInput ? tokenInput.value : 'not found');
    
    const folderInput = document.querySelector('#uploadForm input[name="folder"]');
    console.log('folderInput:', folderInput);
    console.log('folder value:', folderInput ? folderInput.value : 'not found');
    
    const fileInput = document.getElementById('fileInput');
    console.log('fileInput:', fileInput);
    console.log('fileInput files:', fileInput ? fileInput.files : 'not found');
    
    showAlert('info', 'Debug info logged to console');
    
    // Test a simple upload if we have files
    if (fileInput && fileInput.files && fileInput.files.length > 0) {
        console.log('Attempting test upload...');
        testDirectUpload();
    }
}

function testDirectUpload() {
    console.log('=== DIRECT UPLOAD TEST ===');
    
    const fileInput = document.getElementById('fileInput');
    const tokenInput = document.querySelector('#uploadForm input[name="_token"]');
    
    if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
        showAlert('warning', 'Please select files first');
        return;
    }
    
    if (!tokenInput) {
        showAlert('danger', 'CSRF token not found');
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', tokenInput.value);
    
    // Add files
    for (let i = 0; i < fileInput.files.length; i++) {
        formData.append('files[]', fileInput.files[i]);
        console.log('Added file:', fileInput.files[i].name);
    }
    
    console.log('Sending direct upload request...');
    
    fetch('{{ route("dashboard.media.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response ok:', response.ok);
        return response.json();
    })
    .then(data => {
        console.log('Direct upload response:', data);
        if (data.success) {
            showAlert('success', 'Direct upload successful: ' + data.message);
        } else {
            showAlert('danger', 'Direct upload failed: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Direct upload error:', error);
        showAlert('danger', 'Direct upload error: ' + error.message);
    });
}

function debugSelectedFiles() {
    console.log('=== SELECTED FILES DEBUG ===');
    console.log('selectedFiles variable:', selectedFiles);
    if (selectedFiles && selectedFiles.length > 0) {
        selectedFiles.forEach((file, index) => {
            console.log(`File ${index}:`, {
                name: file.name,
                size: file.size,
                type: file.type,
                lastModified: file.lastModified
            });
        });
    } else {
        console.log('No files selected');
    }
    showAlert('info', `${selectedFiles ? selectedFiles.length : 0} files in selectedFiles array`);
}

function debugFormElements() {
    console.log('=== FORM ELEMENTS DEBUG ===');
    
    const uploadModal = document.getElementById('uploadModal');
    console.log('uploadModal:', uploadModal);
    
    const uploadForm = document.getElementById('uploadForm');
    console.log('uploadForm:', uploadForm);
    
    const formElements = uploadForm ? uploadForm.elements : null;
    console.log('form elements:', formElements);
    
    if (formElements) {
        for (let i = 0; i < formElements.length; i++) {
            const element = formElements[i];
            console.log(`Element ${i}:`, {
                name: element.name,
                type: element.type,
                value: element.value,
                tagName: element.tagName
            });
        }
    }
    
    showAlert('info', 'Form elements logged to console');
}
</script>
@endpush
