<div class="modal fade" id="mediaPickerModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Media</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- Search and Filters -->
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-search"></i></span>
              <input type="text" class="form-control" id="mediaPickerSearch" placeholder="Search files...">
            </div>
          </div>
          <div class="col-md-3">
            <select id="mediaPickerType" class="form-select">
              <option value="">All Types</option>
              <option value="image">Images Only</option>
            </select>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-primary w-100" onclick="openMediaUploader()">
              <i class="fa-solid fa-upload me-1"></i>Upload New
            </button>
          </div>
        </div>

        <!-- Media Grid -->
        <div id="mediaPickerContent" class="media-picker-grid">
          <div class="text-center py-4">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div id="mediaPickerPagination" class="d-flex justify-content-center mt-3">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="selectMediaBtn" disabled>Select Media</button>
      </div>
    </div>
  </div>
</div>

<style>
.media-picker-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 1rem;
  max-height: 400px;
  overflow-y: auto;
}

.media-picker-item {
  border: 2px solid var(--ds-border);
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.2s ease;
  background: var(--ds-card);
}

.media-picker-item:hover {
  border-color: var(--ds-primary);
  transform: translateY(-2px);
}

.media-picker-item.selected {
  border-color: var(--ds-primary);
  background: var(--ds-active-bg);
}

.media-picker-item.selected::after {
  content: '✓';
  position: absolute;
  top: 5px;
  right: 5px;
  background: var(--ds-primary);
  color: white;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  font-weight: bold;
}

.media-picker-preview {
  position: relative;
  width: 100%;
  height: 120px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  background: var(--ds-soft);
}

.media-picker-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.media-picker-file-icon {
  text-align: center;
  color: var(--ds-muted);
}

.media-picker-file-icon i {
  font-size: 2rem;
  margin-bottom: 0.5rem;
}

.media-picker-info {
  padding: 0.5rem;
  text-align: center;
}

.media-picker-title {
  font-size: 0.8rem;
  font-weight: 500;
  margin-bottom: 0.25rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.media-picker-meta {
  font-size: 0.7rem;
  color: var(--ds-muted);
}
</style>

<script>
let mediaPickerModal;
let mediaPickerCallback;
let selectedMedia = null;

function initMediaPicker() {
  mediaPickerModal = new bootstrap.Modal(document.getElementById('mediaPickerModal'));
  
  // Search functionality
  let searchTimeout;
  document.getElementById('mediaPickerSearch').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
      loadMediaPickerContent();
    }, 500);
  });

  // Type filter
  document.getElementById('mediaPickerType').addEventListener('change', function() {
    loadMediaPickerContent();
  });

  // Select button
  document.getElementById('selectMediaBtn').addEventListener('click', function() {
    if (selectedMedia && mediaPickerCallback) {
      mediaPickerCallback(selectedMedia);
      mediaPickerModal.hide();
    }
  });
}

function openMediaPicker(callback, type = null) {
  mediaPickerCallback = callback;
  selectedMedia = null;
  
  // Set type filter if specified
  if (type) {
    document.getElementById('mediaPickerType').value = type;
  }
  
  // Load content and show modal
  loadMediaPickerContent();
  mediaPickerModal.show();
  
  // Update select button state
  document.getElementById('selectMediaBtn').disabled = true;
}

function loadMediaPickerContent() {
  const search = document.getElementById('mediaPickerSearch').value;
  const type = document.getElementById('mediaPickerType').value;
  
  const params = new URLSearchParams();
  if (search) params.append('search', search);
  if (type) params.append('type', type);
  
  const url = `{{ route('dashboard.media.picker') }}?${params.toString()}`;
  
  document.getElementById('mediaPickerContent').innerHTML = `
    <div class="text-center py-4">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  `;
  
  fetch(url)
    .then(response => response.text())
    .then(html => {
      document.getElementById('mediaPickerContent').innerHTML = html;
      attachMediaPickerEvents();
    })
    .catch(error => {
      document.getElementById('mediaPickerContent').innerHTML = `
        <div class="text-center py-4 text-danger">
          <i class="fa-solid fa-exclamation-triangle fa-2x mb-2"></i>
          <div>Error loading media files</div>
        </div>
      `;
    });
}

function attachMediaPickerEvents() {
  document.querySelectorAll('.media-picker-item').forEach(item => {
    item.addEventListener('click', function() {
      // Remove previous selection
      document.querySelectorAll('.media-picker-item').forEach(i => i.classList.remove('selected'));
      
      // Select current item
      this.classList.add('selected');
      
      // Store selected media data
      selectedMedia = {
        id: this.dataset.id,
        title: this.dataset.title,
        url: this.dataset.url,
        alt_text: this.dataset.altText,
        is_image: this.dataset.isImage === '1',
        filename: this.dataset.filename
      };
      
      // Enable select button
      document.getElementById('selectMediaBtn').disabled = false;
    });
  });
}

function openMediaUploader() {
  mediaPickerModal.hide();
  document.getElementById('uploadBtn').click();
}

// Initialize on document ready
document.addEventListener('DOMContentLoaded', function() {
  initMediaPicker();
});

// Media Picker Helper Functions
function createMediaInput(inputId, previewId, options = {}) {
  const input = document.getElementById(inputId);
  const preview = document.getElementById(previewId);
  
  if (!input || !preview) {
    console.error('Media input or preview element not found');
    return;
  }

  // Create picker button
  const pickerBtn = document.createElement('button');
  pickerBtn.type = 'button';
  pickerBtn.className = 'btn btn-outline-primary';
  pickerBtn.innerHTML = '<i class="fa-solid fa-images me-1"></i>Select Media';
  
  // Create remove button
  const removeBtn = document.createElement('button');
  removeBtn.type = 'button';
  removeBtn.className = 'btn btn-outline-danger ms-2';
  removeBtn.innerHTML = '<i class="fa-solid fa-times"></i>';
  removeBtn.style.display = 'none';

  // Insert buttons after input
  input.insertAdjacentElement('afterend', removeBtn);
  input.insertAdjacentElement('afterend', pickerBtn);

  pickerBtn.addEventListener('click', function() {
    openMediaPicker(function(media) {
      input.value = media.id;
      input.setAttribute('data-url', media.url);
      input.setAttribute('data-title', media.title);
      updatePreview();
      removeBtn.style.display = 'inline-block';
    }, options.type);
  });

  removeBtn.addEventListener('click', function() {
    input.value = '';
    input.removeAttribute('data-url');
    input.removeAttribute('data-title');
    updatePreview();
    removeBtn.style.display = 'none';
  });

  function updatePreview() {
    const url = input.getAttribute('data-url');
    const title = input.getAttribute('data-title');
    
    if (url) {
      if (options.type === 'image' || url.match(/\.(jpg|jpeg|png|gif|webp)$/i)) {
        preview.innerHTML = `<img src="${url}" alt="${title}" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">`;
      } else {
        preview.innerHTML = `<div class="file-preview-item"><i class="fa-solid fa-file me-2"></i>${title}</div>`;
      }
      removeBtn.style.display = 'inline-block';
    } else {
      preview.innerHTML = '<div class="text-muted">No media selected</div>';
      removeBtn.style.display = 'none';
    }
  }

  // Initialize preview if input has value
  if (input.value) {
    updatePreview();
  }
}
</script>
