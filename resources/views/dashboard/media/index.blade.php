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
          <button type="button" class="btn btn-outline-success" id="syncBtn" title="Sync with storage directory">
            <i class="fa-solid fa-sync me-1"></i>
            Sync Files
          </button>
          <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createFolderModal">
            <i class="fa-solid fa-folder-plus me-1"></i>
            New Folder
          </button>
          <button type="button" class="btn btn-primary" id="uploadBtn">
            <i class="fa-solid fa-upload me-1"></i>
            Upload Files
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Sync Alert -->
  <div id="syncAlert" class="alert alert-info alert-dismissible fade" role="alert" style="display: none;">
    <i class="fa-solid fa-info-circle me-2"></i>
    <span id="syncAlertText">Files found in storage that aren't in the database. Click "Sync Files" to import them.</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
          <div class="h4 mb-0" id="totalImages">-</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="ds-card metric">
        <div class="icon amber"><i class="fa-solid fa-hdd"></i></div>
        <div>
          <div class="muted">Storage Used</div>
          <div class="h4 mb-0" id="totalSize">-</div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="ds-card metric">
        <div class="icon red"><i class="fa-solid fa-clock"></i></div>
        <div>
          <div class="muted">Recent (7d)</div>
          <div class="h4 mb-0" id="recentUploads">-</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Filters and Actions -->
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
            <div class="col-md-3">
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
            <div class="col-md-1">
              <div class="d-flex gap-1">
                <button type="submit" class="btn btn-outline-primary">
                  <i class="fa-solid fa-filter me-1"></i>Filter
                </button>
                <a href="{{ route('dashboard.media.index') }}" class="btn btn-outline-secondary">
                  <i class="fa-solid fa-times me-1"></i>Clear
                </a>
                <button type="button" class="btn btn-outline-danger" id="bulkDeleteBtn" style="display: none;">
                  <i class="fa-solid fa-trash me-1"></i>Delete Selected
                </button>
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
                      <input type="checkbox" class="form-check-input media-select" value="{{ $item->id }}">
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
                      <div class="media-title" title="{{ $item->title }}">{{ Str::limit($item->title, 20) }}</div>
                      <div class="media-meta">
                        <small class="text-muted">
                          {{ $item->size_formatted }} • 
                          {{ $item->created_at->format('M j, Y') }}
                          @if($item->folder)
                            <br><i class="fa-solid fa-folder me-1"></i>{{ $item->folder }}
                          @endif
                        </small>
                      </div>
                    </div>
                    
                    <div class="media-actions">
                      <button class="btn btn-sm btn-outline-primary" onclick="editMedia({{ $item->id }})">
                        <i class="fa-solid fa-edit"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-danger" onclick="deleteMedia({{ $item->id }})">
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
          @else
            <div class="text-center py-5">
              <i class="fa-solid fa-images fa-3x text-muted mb-3"></i>
              <h4>No media files found</h4>
              <p class="text-muted">Upload your first file to get started</p>
              <button type="button" class="btn btn-primary" id="uploadBtnEmpty">
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
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Upload Files</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <div class="upload-zone" id="uploadZone">
              <div class="upload-zone-content">
                <i class="fa-solid fa-cloud-upload fa-3x text-primary mb-3"></i>
                <h5>Drag & Drop Files Here</h5>
                <p class="text-muted">or <button type="button" class="btn btn-link p-0" id="browseFilesBtn">browse files</button></p>
                <input type="file" id="fileInput" name="files[]" multiple class="d-none" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,.txt,.csv">
              </div>
            </div>
          </div>
          
          <div id="fileList"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="uploadSubmit" disabled>Upload Files</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Media Modal -->
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
          @method('PUT')
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Alt Text (for images)</label>
            <input type="text" class="form-control" name="alt_text">
          </div>
          <div class="mb-3">
            <label class="form-label">Folder</label>
            <input type="text" class="form-control" name="folder">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="editSubmit">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- Create Folder Modal -->
<div class="modal fade" id="createFolderModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Folder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="createFolderForm">
          @csrf
          <div class="mb-3">
            <label class="form-label">Folder Name</label>
            <input type="text" class="form-control" name="name" required placeholder="e.g., Hero Images">
            <div class="form-text">Use letters, numbers, spaces, hyphens, and underscores only</div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="createFolderSubmit">Create</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('styles')
<style>
.media-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1rem;
}

.media-item {
  background: var(--ds-card);
  border: 1px solid var(--ds-border);
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.2s ease;
  position: relative;
}

.media-item:hover {
  border-color: var(--ds-primary);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.media-item.selected {
  border-color: var(--ds-primary);
  background: var(--ds-active-bg);
}

.media-item-inner {
  position: relative;
  height: 100%;
}

.media-checkbox {
  position: absolute;
  top: 8px;
  left: 8px;
  z-index: 10;
}

.media-preview {
  width: 100%;
  height: 150px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: var(--ds-soft);
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
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.file-ext {
  display: block;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
}

.media-info {
  padding: 0.75rem;
}

.media-title {
  font-weight: 600;
  font-size: 0.9rem;
  margin-bottom: 0.25rem;
}

.media-meta {
  font-size: 0.8rem;
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
  transition: border-color 0.2s ease;
  cursor: pointer;
}

.upload-zone:hover,
.upload-zone.dragover {
  border-color: var(--ds-primary);
  background: var(--ds-active-bg);
}

.upload-zone-content h5 {
  margin-bottom: 0.5rem;
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

.file-preview .file-icon-small {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--ds-card);
  border-radius: 6px;
  font-size: 1.5rem;
  color: var(--ds-muted);
}

.file-info {
  flex: 1;
}

.file-name {
  font-weight: 600;
  font-size: 0.9rem;
}

.file-size {
  font-size: 0.8rem;
  color: var(--ds-muted);
}

.progress {
  height: 4px;
  margin-top: 0.5rem;
}

/* Modal z-index fix to ensure it appears above sidebar */
.modal {
  z-index: 1070 !important;
}

.modal-backdrop {
  z-index: 1065 !important;
}

/* Override Bootstrap modal defaults to fix interaction */
.modal.show .modal-dialog {
  pointer-events: auto !important;
}

.modal-content {
  pointer-events: auto !important;
  position: relative;
  z-index: 1;
}

/* Ensure all modal interactive elements work */
.modal-header,
.modal-body,
.modal-footer {
  pointer-events: auto !important;
}

.modal-header .btn-close {
  pointer-events: auto !important;
}

/* Fix upload zone interaction specifically */
.upload-zone {
  position: relative;
  z-index: 1;
  pointer-events: auto !important;
}

.upload-zone * {
  pointer-events: auto !important;
}

/* File input must be accessible */
#fileInput {
  pointer-events: auto !important;
}

/* All buttons in modal must work */
.modal .btn {
  pointer-events: auto !important;
}

.modal .form-control {
  pointer-events: auto !important;
}

/* Force modal to be above everything */
.modal-open .modal {
  z-index: 1070 !important;
}

.modal-open .modal-backdrop {
  z-index: 1065 !important;
}

/* Critical fix for layout interference */
body.modal-open {
  padding-right: 0 !important;
  overflow: hidden;
}

.ds-layout.modal-open {
  contain: none !important;
}

/* Prevent any layout containment from blocking modal */
.ds-sidebar,
.ds-content,
.ds-topbar {
  contain: none !important;
}

/* Ensure modal renders in correct stacking context */
.modal {
  position: fixed !important;
  top: 0 !important;
  left: 0 !important;
  width: 100% !important;
  height: 100% !important;
  outline: 0 !important;
  contain: none !important;
}

/* Force modal dialog to center properly */
.modal-dialog {
  margin: 1.75rem auto !important;
  pointer-events: none !important;
}

.modal-dialog .modal-content {
  pointer-events: auto !important;
}
</style>
@endpush

@push('scripts')
<script>
// Load stats on page load
document.addEventListener('DOMContentLoaded', function() {
  console.log('DOM Content Loaded');
  loadStats();
  initializeEventListeners();
  
  // Debug button for testing modal
  const debugBtn = document.createElement('button');
  debugBtn.innerHTML = 'Test Modal';
  debugBtn.className = 'btn btn-warning btn-sm position-fixed';
  debugBtn.style.cssText = 'top: 10px; right: 10px; z-index: 9999;';
  debugBtn.onclick = function() {
    console.log('Debug modal test');
    const modal = document.getElementById('uploadModal');
    modal.style.display = 'block';
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');
    
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.style.zIndex = '1065';
    document.body.appendChild(backdrop);
  };
  document.body.appendChild(debugBtn);
});

function loadStats() {
  fetch('{{ route("dashboard.media.stats") }}')
    .then(response => response.json())
    .then(data => {
      document.getElementById('totalFiles').textContent = data.total_files;
      document.getElementById('totalImages').textContent = data.total_images;
      document.getElementById('totalSize').textContent = data.total_size_formatted;
      document.getElementById('recentUploads').textContent = data.recent_uploads;
      
      // Show sync alert if needed
      if (data.sync_needed) {
        const syncAlert = document.getElementById('syncAlert');
        const syncAlertText = document.getElementById('syncAlertText');
        syncAlertText.textContent = `Found ${data.storage_files} files in storage, but only ${data.total_files} in database. Click "Sync Files" to import missing files.`;
        syncAlert.style.display = 'block';
        syncAlert.classList.add('show');
      }
    })
    .catch(error => {
      console.error('Error loading stats:', error);
    });
}

function syncFiles() {
  const syncBtn = document.getElementById('syncBtn');
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
      
      // Hide sync alert
      const syncAlert = document.getElementById('syncAlert');
      if (syncAlert) {
        syncAlert.classList.remove('show');
        setTimeout(() => {
          syncAlert.style.display = 'none';
        }, 500);
      }
      
      // Reload stats and page
      loadStats();
      setTimeout(() => location.reload(), 2000);
    } else {
      showAlert('error', data.message || 'Sync failed');
    }
    
    if (data.errors && data.errors.length > 0) {
      console.warn('Sync errors:', data.errors);
    }
  })
  .catch(error => {
    showAlert('error', 'Sync failed: ' + error.message);
    console.error('Sync error:', error);
  })
  .finally(() => {
    syncBtn.disabled = false;
    syncBtn.innerHTML = originalContent;
  });
}

function initializeEventListeners() {
  // Upload button clicks with bulletproof modal handling
  const uploadBtn = document.getElementById('uploadBtn');
  const uploadBtnEmpty = document.getElementById('uploadBtnEmpty');
  const uploadModal = document.getElementById('uploadModal');
  
  if (uploadBtn) {
    uploadBtn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      console.log('Upload button clicked');
      showUploadModal();
    });
  }
  
  if (uploadBtnEmpty) {
    uploadBtnEmpty.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      console.log('Upload button (empty) clicked');
      showUploadModal();
    });
  }

  // Modal event handlers
  if (uploadModal) {
    uploadModal.addEventListener('shown.bs.modal', function() {
      console.log('Upload modal shown');
      // Clear any previous selections
      selectedFiles = [];
      displayFileList();
      document.getElementById('uploadSubmit').disabled = true;
      
      // Ensure modal is fully interactive
      setTimeout(() => {
        const modalContent = uploadModal.querySelector('.modal-content');
        if (modalContent) {
          modalContent.style.pointerEvents = 'auto';
          modalContent.click(); // Force focus
        }
      }, 100);
    });

    uploadModal.addEventListener('hidden.bs.modal', function() {
      console.log('Upload modal hidden');
      resetUploadForm();
    });
  }

  // Initialize upload zone with enhanced handling
  initializeUploadZone();
  
  // Other event listeners...
  initializeOtherEventListeners();
}

function showUploadModal() {
  const uploadModal = document.getElementById('uploadModal');
  
  // Force remove any existing modal instances
  const existingModal = bootstrap.Modal.getInstance(uploadModal);
  if (existingModal) {
    existingModal.dispose();
  }
  
  // Create new modal with specific options
  const modal = new bootstrap.Modal(uploadModal, {
    backdrop: 'static', // Prevent closing by clicking backdrop
    keyboard: true,
    focus: true
  });
  
  // Force show the modal
  modal.show();
  
  // Additional safeguard
  setTimeout(() => {
    uploadModal.classList.add('show');
    uploadModal.style.display = 'block';
    document.body.classList.add('modal-open');
  }, 50);
}

function resetUploadForm() {
  const uploadForm = document.getElementById('uploadForm');
  const fileInput = document.getElementById('fileInput');
  
  if (uploadForm) uploadForm.reset();
  if (fileInput) fileInput.value = '';
  
  selectedFiles = [];
  displayFileList();
}

function initializeUploadZone() {
  const uploadZone = document.getElementById('uploadZone');
  const fileInput = document.getElementById('fileInput');
  const browseFilesBtn = document.getElementById('browseFilesBtn');
  
  if (uploadZone) {
    // Clear any existing event listeners
    uploadZone.replaceWith(uploadZone.cloneNode(true));
    const newUploadZone = document.getElementById('uploadZone');
    
    newUploadZone.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      console.log('Upload zone clicked');
      if (fileInput) {
        fileInput.click();
      }
    });

    newUploadZone.addEventListener('dragover', (e) => {
      e.preventDefault();
      e.stopPropagation();
      newUploadZone.classList.add('dragover');
    });

    newUploadZone.addEventListener('dragleave', (e) => {
      e.preventDefault();
      e.stopPropagation();
      newUploadZone.classList.remove('dragover');
    });

    newUploadZone.addEventListener('drop', (e) => {
      e.preventDefault();
      e.stopPropagation();
      newUploadZone.classList.remove('dragover');
      console.log('Files dropped:', e.dataTransfer.files.length);
      const files = Array.from(e.dataTransfer.files);
      handleFiles({ target: { files } });
    });
  }
  
  if (fileInput) {
    fileInput.addEventListener('change', handleFiles);
  }

  if (browseFilesBtn) {
    browseFilesBtn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      console.log('Browse files button clicked');
      if (fileInput) {
        fileInput.click();
      }
    });
  }
}

function initializeOtherEventListeners() {
  // Sync button
  const syncBtn = document.getElementById('syncBtn');
  if (syncBtn) {
    syncBtn.addEventListener('click', syncFiles);
  }

  // Upload submit
  const uploadSubmit = document.getElementById('uploadSubmit');
  if (uploadSubmit) {
    uploadSubmit.addEventListener('click', uploadFiles);
  }

  // Media selection
  document.addEventListener('change', function(e) {
    if (e.target.classList.contains('media-select')) {
      updateBulkActions();
    }
  });

  // Bulk delete
  const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
  if (bulkDeleteBtn) {
    bulkDeleteBtn.addEventListener('click', bulkDelete);
  }

  // Create folder
  const createFolderSubmit = document.getElementById('createFolderSubmit');
  if (createFolderSubmit) {
    createFolderSubmit.addEventListener('click', createFolder);
  }

  // Edit submit
  const editSubmit = document.getElementById('editSubmit');
  if (editSubmit) {
    editSubmit.addEventListener('click', updateMedia);
  }
}

  // Media selection
  document.addEventListener('change', function(e) {
    if (e.target.classList.contains('media-select')) {
      updateBulkActions();
    }
  });

  // Bulk delete
  document.getElementById('bulkDeleteBtn').addEventListener('click', bulkDelete);

  // Create folder
  document.getElementById('createFolderSubmit').addEventListener('click', createFolder);

  // Edit submit
  document.getElementById('editSubmit').addEventListener('click', updateMedia);
}

let selectedFiles = [];

function handleFiles(event) {
  selectedFiles = Array.from(event.target.files);
  console.log('Files selected:', selectedFiles.length);
  
  // Filter valid files
  const allowedTypes = [
    'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'application/pdf',
    'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    'application/zip', 'application/x-rar-compressed', 'text/plain', 'text/csv',
    'video/mp4', 'video/avi', 'video/quicktime', 'audio/mpeg', 'audio/wav'
  ];
  
  selectedFiles = selectedFiles.filter(file => {
    if (!allowedTypes.includes(file.type)) {
      console.warn('File type not allowed:', file.name, file.type);
      showAlert('warning', `File "${file.name}" has unsupported type: ${file.type}`);
      return false;
    }
    if (file.size > 20 * 1024 * 1024) { // 20MB
      console.warn('File too large:', file.name, file.size);
      showAlert('warning', `File "${file.name}" is too large (${formatFileSize(file.size)}). Maximum size is 20MB.`);
      return false;
    }
    return true;
  });
  
  console.log('Valid files after filtering:', selectedFiles.length);
  displayFileList();
  document.getElementById('uploadSubmit').disabled = selectedFiles.length === 0;
}

function displayFileList() {
  const fileList = document.getElementById('fileList');
  fileList.innerHTML = '';

  selectedFiles.forEach((file, index) => {
    const div = document.createElement('div');
    div.className = 'file-preview';
    div.innerHTML = `
      <div class="file-preview-image">
        ${file.type.startsWith('image/') ? 
          `<img src="${URL.createObjectURL(file)}" alt="Preview">` :
          `<div class="file-icon-small"><i class="fa-solid fa-file"></i></div>`
        }
      </div>
      <div class="file-info">
        <div class="file-name">${file.name}</div>
        <div class="file-size">${formatFileSize(file.size)}</div>
      </div>
      <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile(${index})">
        <i class="fa-solid fa-times"></i>
      </button>
    `;
    fileList.appendChild(div);
  });
}

function removeFile(index) {
  selectedFiles.splice(index, 1);
  displayFileList();
  document.getElementById('uploadSubmit').disabled = selectedFiles.length === 0;
}

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

function uploadFiles() {
  if (selectedFiles.length === 0) return;

  console.log('Starting upload with files:', selectedFiles.length);

  const formData = new FormData();
  const folder = document.querySelector('#uploadForm input[name="folder"]').value;
  
  // Add CSRF token from the form
  const csrfToken = document.querySelector('#uploadForm input[name="_token"]').value;
  console.log('CSRF token found:', csrfToken ? 'Yes' : 'No');
  
  selectedFiles.forEach((file, index) => {
    console.log(`Adding file ${index + 1}:`, file.name, file.type, file.size);
    formData.append('files[]', file);
  });
  
  if (folder) {
    formData.append('folder', folder);
    console.log('Folder:', folder);
  }
  
  formData.append('_token', csrfToken);

  const uploadBtn = document.getElementById('uploadSubmit');
  uploadBtn.disabled = true;
  uploadBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i>Uploading...';

  console.log('Sending upload request to:', '{{ route("dashboard.media.store") }}');

  fetch('{{ route("dashboard.media.store") }}', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    console.log('Response status:', response.status);
    if (!response.ok) {
      return response.text().then(text => {
        console.error('Response error:', text);
        throw new Error(`HTTP ${response.status}: ${text}`);
      });
    }
    return response.json();
  })
  .then(data => {
    console.log('Upload response:', data);
    if (data.success) {
      let message = data.message;
      if (data.errors && data.errors.length > 0) {
        message += ' Errors: ' + data.errors.join(', ');
        showAlert('warning', message);
      } else {
        showAlert('success', message);
      }
      
      bootstrap.Modal.getInstance(document.getElementById('uploadModal')).hide();
      loadStats();
      setTimeout(() => location.reload(), 1000);
    } else {
      let errorMessage = 'Upload failed';
      if (data.errors && data.errors.length > 0) {
        errorMessage += ': ' + data.errors.join(', ');
      } else if (data.message) {
        errorMessage += ': ' + data.message;
      }
      console.error('Upload failed:', data);
      showAlert('error', errorMessage);
    }
  })
  .catch(error => {
    console.error('Upload error:', error);
    showAlert('error', 'Upload failed: ' + error.message);
  })
  .finally(() => {
    uploadBtn.disabled = false;
    uploadBtn.innerHTML = '<i class="fa-solid fa-upload me-1"></i>Upload Files';
  });
}

function updateBulkActions() {
  const selected = document.querySelectorAll('.media-select:checked');
  const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
  
  if (selected.length > 0) {
    bulkDeleteBtn.style.display = 'inline-block';
    bulkDeleteBtn.textContent = `Delete Selected (${selected.length})`;
  } else {
    bulkDeleteBtn.style.display = 'none';
  }

  // Update media item visual state
  document.querySelectorAll('.media-item').forEach(item => {
    const checkbox = item.querySelector('.media-select');
    if (checkbox.checked) {
      item.classList.add('selected');
    } else {
      item.classList.remove('selected');
    }
  });
}

function bulkDelete() {
  const selected = Array.from(document.querySelectorAll('.media-select:checked')).map(cb => cb.value);
  
  if (selected.length === 0) return;

  if (confirm(`Are you sure you want to delete ${selected.length} file(s)? This action cannot be undone.`)) {
    fetch('{{ route("dashboard.media.bulk-delete") }}', {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({ ids: selected })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showAlert('success', data.message);
        setTimeout(() => location.reload(), 1000);
      }
    });
  }
}

function editMedia(id) {
  fetch(`{{ route('dashboard.media.index') }}/${id}`)
    .then(response => response.json())
    .then(media => {
      const form = document.getElementById('editForm');
      form.querySelector('input[name="title"]').value = media.title;
      form.querySelector('input[name="alt_text"]').value = media.alt_text || '';
      form.querySelector('input[name="folder"]').value = media.folder || '';
      
      form.setAttribute('data-id', id);
      new bootstrap.Modal(document.getElementById('editModal')).show();
    });
}

function updateMedia() {
  const form = document.getElementById('editForm');
  const id = form.getAttribute('data-id');
  const formData = new FormData(form);

  fetch(`{{ route('dashboard.media.index') }}/${id}`, {
    method: 'POST',
    body: formData,
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'X-HTTP-Method-Override': 'PUT'
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showAlert('success', data.message);
      bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
      setTimeout(() => location.reload(), 1000);
    }
  });
}

function deleteMedia(id) {
  if (confirm('Are you sure you want to delete this file? This action cannot be undone.')) {
    fetch(`{{ route('dashboard.media.index') }}/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showAlert('success', data.message);
        setTimeout(() => location.reload(), 1000);
      }
    });
  }
}

function createFolder() {
  const form = document.getElementById('createFolderForm');
  const formData = new FormData(form);

  fetch('{{ route("dashboard.media.folders.create") }}', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showAlert('success', data.message);
      bootstrap.Modal.getInstance(document.getElementById('createFolderModal')).hide();
      // Add to folder filter
      const folderSelect = document.querySelector('select[name="folder"]');
      const option = new Option(data.folder.replace('_', ' '), data.folder);
      folderSelect.add(option);
    }
  });
}

function showAlert(type, message) {
  const alertHtml = `
    <div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `;
  
  const container = document.querySelector('.container-fluid');
  container.insertAdjacentHTML('afterbegin', alertHtml);
  
  setTimeout(() => {
    document.querySelector('.alert')?.remove();
  }, 5000);
}
</script>
@endpush
