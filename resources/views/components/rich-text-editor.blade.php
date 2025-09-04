@props([
    'id' => 'richTextEditor',
    'name' => 'content',
    'value' => '',
    'placeholder' => 'Start writing...',
    'height' => '300px',
    'required' => false,
    'toolbar' => 'full', // 'full', 'basic', 'minimal'
    'label' => null,
    'error' => null
])

<div class="rich-text-editor-wrapper">
    @if($label)
        <label for="{{ $id }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <div class="rich-text-editor-container">
        <!-- File Upload Section -->
        <div id="file-upload-section" class="mb-3" style="display: none;">
            <div class="upload-zone" id="upload-zone">
                <div class="upload-content">
                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                    <p class="upload-text">Drag & drop files here or click to browse</p>
                    <p class="upload-subtext">Supports PDF, images (JPG, PNG, GIF) up to 10MB</p>
                </div>
                <input type="file" id="file-input" multiple accept=".pdf,.jpg,.jpeg,.png,.gif" style="display: none;">
            </div>
            
            <!-- File List -->
            <div id="uploaded-files" class="uploaded-files"></div>
        </div>

        <!-- Rich Text Editor -->
        <div id="{{ $id }}" class="rich-text-editor" style="height: {{ $height }};">
            {!! $value !!}
        </div>
        
        <!-- Hidden Input -->
        <input type="hidden" name="{{ $name }}" id="{{ $id }}_input" value="{{ $value }}">
        
        <!-- Attachments Input -->
        <input type="hidden" name="attachments" id="attachments_input" value="">
    </div>

    @if($error)
        <div class="invalid-feedback d-block">{{ $error }}</div>
    @endif
</div>

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
/* Rich Text Editor Base Styles */
.rich-text-editor-wrapper {
    margin-bottom: 1rem;
}

.rich-text-editor-container {
    position: relative;
}

.rich-text-editor-container .ql-toolbar {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-bottom: none;
    border-radius: 6px 6px 0 0;
    padding: 8px;
}

.rich-text-editor-container .ql-container {
    border: 1px solid #e2e8f0;
    border-top: none;
    border-radius: 0 0 6px 6px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 14px;
    line-height: 1.6;
}

.rich-text-editor-container .ql-editor {
    padding: 12px 15px;
    min-height: 150px;
    color: #374151;
}

.rich-text-editor-container .ql-editor.ql-blank::before {
    color: #9ca3af;
    font-style: normal;
    left: 15px;
}

/* Toolbar Button Styles */
.rich-text-editor-container .ql-toolbar button {
    background: transparent;
    border: none;
    color: #6b7280;
    padding: 6px 8px;
    border-radius: 4px;
    margin: 1px;
    transition: all 0.2s ease;
}

.rich-text-editor-container .ql-toolbar button:hover {
    background: #e5e7eb;
    color: #374151;
}

.rich-text-editor-container .ql-toolbar button.ql-active {
    background: #dbeafe;
    color: #1d4ed8;
}

.rich-text-editor-container .ql-toolbar .ql-picker {
    color: #6b7280;
}

.rich-text-editor-container .ql-toolbar .ql-picker:hover {
    color: #374151;
}

.rich-text-editor-container .ql-toolbar .ql-picker.ql-expanded {
    color: #1d4ed8;
}

/* Dropdown Styles */
.rich-text-editor-container .ql-toolbar .ql-picker-options {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    padding: 4px 0;
}

.rich-text-editor-container .ql-toolbar .ql-picker-item {
    padding: 6px 12px;
    color: #374151;
}

.rich-text-editor-container .ql-toolbar .ql-picker-item:hover {
    background: #f3f4f6;
}

/* Format Styles */
.rich-text-editor-container .ql-editor strong {
    font-weight: 600;
}

.rich-text-editor-container .ql-editor em {
    font-style: italic;
}

.rich-text-editor-container .ql-editor u {
    text-decoration: underline;
}

.rich-text-editor-container .ql-editor s {
    text-decoration: line-through;
}

.rich-text-editor-container .ql-editor h1 {
    font-size: 2rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1rem;
    color: #1f2937;
}

.rich-text-editor-container .ql-editor h2 {
    font-size: 1.5rem;
    font-weight: 600;
    line-height: 1.3;
    margin-bottom: 0.75rem;
    color: #1f2937;
}

.rich-text-editor-container .ql-editor h3 {
    font-size: 1.25rem;
    font-weight: 600;
    line-height: 1.4;
    margin-bottom: 0.5rem;
    color: #374151;
}

.rich-text-editor-container .ql-editor ul,
.rich-text-editor-container .ql-editor ol {
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.rich-text-editor-container .ql-editor li {
    margin-bottom: 0.25rem;
}

.rich-text-editor-container .ql-editor blockquote {
    border-left: 4px solid #6366f1;
    padding-left: 1rem;
    margin: 1rem 0;
    background: #f8fafc;
    padding: 0.75rem 1rem;
    border-radius: 0 4px 4px 0;
    font-style: italic;
    color: #4b5563;
}

.rich-text-editor-container .ql-editor a {
    color: #3b82f6;
    text-decoration: none;
}

.rich-text-editor-container .ql-editor a:hover {
    text-decoration: underline;
}

/* Focus States */
.rich-text-editor-container.focused .ql-toolbar {
    border-color: #3b82f6;
}

.rich-text-editor-container.focused .ql-container {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Focus ring for accessibility */
.rich-text-editor-container .ql-toolbar button:focus,
.rich-text-editor-container .ql-toolbar .ql-picker:focus {
    outline: 2px solid #3b82f6;
    outline-offset: 2px;
}

/* File Attachment Button */
.rich-text-editor-container .ql-toolbar .attach-file-btn {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    color: #6366f1;
}

.rich-text-editor-container .ql-toolbar .attach-file-btn:hover {
    background: #f0f9ff;
    border-color: #6366f1;
    color: #4338ca;
}

/* File Upload Modal Styles */
.upload-zone {
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    background: #f9fafb;
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-zone:hover,
.upload-zone.dragover {
    border-color: #6366f1;
    background: #f0f9ff;
}

.upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.upload-icon {
    font-size: 3rem;
    color: #9ca3af;
    margin-bottom: 0.5rem;
}

.upload-zone:hover .upload-icon,
.upload-zone.dragover .upload-icon {
    color: #6366f1;
}

.upload-text {
    font-size: 1.1rem;
    font-weight: 500;
    color: #374151;
    margin: 0;
}

.upload-subtext {
    font-size: 0.875rem;
    color: #6b7280;
    margin: 0;
}

/* Uploaded Files List */
.uploaded-files {
    margin-top: 1rem;
}

.file-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    margin-bottom: 0.5rem;
}

.file-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.file-icon {
    width: 2rem;
    height: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 0.875rem;
    color: #6b7280;
}

.file-details h4 {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin: 0;
}

.file-details p {
    font-size: 0.75rem;
    color: #6b7280;
    margin: 0;
}

.file-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-danger {
    background: #ef4444;
    color: white;
}

.btn-danger:hover {
    background: #dc2626;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background: #2563eb;
}

/* Progress Bar */
.progress {
    width: 100%;
    height: 4px;
    background: #e2e8f0;
    border-radius: 2px;
    overflow: hidden;
    margin-top: 0.5rem;
}

.progress-bar {
    width: 100%;
    height: 100%;
    background: #3b82f6;
    transition: width 0.3s ease;
}

/* File Type Specific Colors */
.file-icon.pdf {
    background: #fef2f2;
    color: #dc2626;
    border-color: #fecaca;
}

.file-icon.image {
    background: #f0f9ff;
    color: #2563eb;
    border-color: #bfdbfe;
}

.file-icon.doc {
    background: #f0fdf4;
    color: #16a34a;
    border-color: #bbf7d0;
}

/* Error States */
.file-item.error {
    border-color: #ef4444;
    background: #fef2f2;
}

.file-item.error .file-details h4 {
    color: #dc2626;
}

/* Success Animation */
.file-item.success {
    animation: successPulse 0.5s ease-in-out;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .rich-text-editor-container .ql-toolbar {
        padding: 6px;
    }
    
    .rich-text-editor-container .ql-toolbar button {
        padding: 4px 6px;
        font-size: 0.875rem;
    }
    
    .upload-zone {
        padding: 1.5rem 1rem;
    }
    
    .upload-icon {
        font-size: 2rem;
    }
    
    .file-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .file-actions {
        align-self: flex-end;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editorId = '{{ $id }}';
    const toolbarType = '{{ $toolbar }}';
    const inputName = '{{ $name }}';
    
    // Define toolbar configurations
    const toolbarConfigs = {
        full: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'align': [] }],
            ['blockquote', 'code-block'],
            ['link', 'image'],
            ['clean'],
            [{ 'attach': 'file' }]
        ],
        basic: [
            [{ 'header': [2, 3, false] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link'],
            ['clean'],
            [{ 'attach': 'file' }]
        ],
        minimal: [
            ['bold', 'italic'],
            [{ 'list': 'bullet' }],
            [{ 'attach': 'file' }]
        ]
    };

    // Custom toolbar handler for file attachments
    const attachHandler = function() {
        const fileSection = document.getElementById('file-upload-section');
        if (fileSection.style.display === 'none') {
            fileSection.style.display = 'block';
        } else {
            fileSection.style.display = 'none';
        }
    };

    // Initialize Quill editor
    const quill = new Quill('#' + editorId, {
        theme: 'snow',
        modules: {
            toolbar: {
                container: toolbarConfigs[toolbarType] || toolbarConfigs.full,
                handlers: {
                    'attach': attachHandler
                }
            }
        },
        placeholder: '{{ $placeholder }}'
    });

    // Add custom button styling
    const attachButton = document.querySelector('.ql-attach');
    if (attachButton) {
        attachButton.innerHTML = '<i class="fas fa-paperclip"></i>';
        attachButton.classList.add('attach-file-btn');
        attachButton.title = 'Attach Files';
    }

    // Sync editor content with hidden input
    quill.on('text-change', function() {
        const content = quill.root.innerHTML;
        document.getElementById(editorId + '_input').value = content;
    });

    // Focus management
    const container = document.querySelector('#' + editorId).closest('.rich-text-editor-container');
    
    quill.on('selection-change', function(range) {
        if (range) {
            container.classList.add('focused');
        } else {
            container.classList.remove('focused');
        }
    });

    // File Upload Functionality
    const uploadZone = document.getElementById('upload-zone');
    const fileInput = document.getElementById('file-input');
    const uploadedFiles = document.getElementById('uploaded-files');
    const attachmentsInput = document.getElementById('attachments_input');
    
    let attachedFiles = [];

    // Check if elements exist before adding event listeners
    if (uploadZone && fileInput && uploadedFiles && attachmentsInput) {
        
        // Drag and drop handlers
        uploadZone.addEventListener('click', () => {
            fileInput.click();
        });

        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('dragover');
            const files = Array.from(e.dataTransfer.files);
            handleFiles(files);
        });

        fileInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);
            handleFiles(files);
        });
    }

    // File handling functions
    function handleFiles(files) {
        files.forEach(file => {
            if (validateFile(file)) {
                uploadFile(file);
            }
        });
    }

    function validateFile(file) {
        const maxSize = 10 * 1024 * 1024; // 10MB
        const allowedTypes = [
            'application/pdf',
            'image/jpeg',
            'image/jpg', 
            'image/png',
            'image/gif'
        ];

        if (file.size > maxSize) {
            alert('File ' + file.name + ' is too large. Maximum size is 10MB.');
            return false;
        }

        if (!allowedTypes.includes(file.type)) {
            alert('File ' + file.name + ' is not supported. Please upload PDF or image files.');
            return false;
        }

        return true;
    }

    function uploadFile(file) {
        const fileId = 'file_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        
        // Create file item element
        const fileItem = createFileItem(file, fileId);
        uploadedFiles.appendChild(fileItem);

        // Create FormData and upload
        const formData = new FormData();
        formData.append('file', file);

        // Check if CSRF token exists
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const headers = {};
        if (csrfToken) {
            headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
        }

        fetch('/api/attachments/upload', {
            method: 'POST',
            body: formData,
            headers: headers
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update file item with server response
                updateFileItem(fileId, data.data);
                
                // Add to attached files array
                attachedFiles.push({
                    id: data.data.id,
                    filename: data.data.filename,
                    original_name: data.data.original_name,
                    size: data.data.size,
                    type: data.data.type
                });
                
                // Update hidden input
                updateAttachmentsInput();
                
                // Mark as success
                fileItem.classList.add('success');
            } else {
                // Mark as error
                fileItem.classList.add('error');
                showFileError(fileId, data.message || 'Upload failed');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            fileItem.classList.add('error');
            showFileError(fileId, 'Network error occurred');
        });
    }

    function createFileItem(file, fileId) {
        const fileItem = document.createElement('div');
        fileItem.className = 'file-item';
        fileItem.dataset.fileId = fileId;

        const fileType = getFileType(file.type);
        const fileSize = formatFileSize(file.size);

        fileItem.innerHTML = `
            <div class="file-info">
                <div class="file-icon ${fileType}">
                    <i class="fas fa-${getFileIcon(file.type)}"></i>
                </div>
                <div class="file-details">
                    <h4>${file.name}</h4>
                    <p>${fileSize}</p>
                </div>
            </div>
            <div class="file-actions">
                <button type="button" class="btn btn-sm btn-danger" onclick="removeFile('${fileId}')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="progress">
                <div class="progress-bar" style="width: 100%;"></div>
            </div>
        `;

        return fileItem;
    }

    function updateFileItem(fileId, fileData) {
        const fileItem = document.querySelector(`[data-file-id="${fileId}"]`);
        if (fileItem) {
            // Update file details with server data
            const fileDetails = fileItem.querySelector('.file-details h4');
            if (fileDetails) {
                fileDetails.textContent = fileData.original_name;
            }
            
            // Add download button
            const fileActions = fileItem.querySelector('.file-actions');
            const downloadBtn = document.createElement('button');
            downloadBtn.type = 'button';
            downloadBtn.className = 'btn btn-sm btn-primary me-2';
            downloadBtn.innerHTML = '<i class="fas fa-download"></i>';
            downloadBtn.onclick = () => downloadFile(fileData.id);
            fileActions.insertBefore(downloadBtn, fileActions.firstChild);
            
            // Store server file data
            fileItem.dataset.serverId = fileData.id;
        }
    }

    function showFileError(fileId, message) {
        const fileItem = document.querySelector(`[data-file-id="${fileId}"]`);
        if (fileItem) {
            const fileDetails = fileItem.querySelector('.file-details');
            const errorMsg = document.createElement('p');
            errorMsg.style.color = '#dc2626';
            errorMsg.textContent = message;
            fileDetails.appendChild(errorMsg);
        }
    }

    function getFileType(mimeType) {
        if (mimeType === 'application/pdf') return 'pdf';
        if (mimeType.startsWith('image/')) return 'image';
        return 'doc';
    }

    function getFileIcon(mimeType) {
        if (mimeType === 'application/pdf') return 'file-pdf';
        if (mimeType.startsWith('image/')) return 'image';
        return 'file';
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function updateAttachmentsInput() {
        attachmentsInput.value = JSON.stringify(attachedFiles);
    }

    // Global functions for file actions
    window.removeFile = function(fileId) {
        const fileItem = document.querySelector(`[data-file-id="${fileId}"]`);
        if (fileItem) {
            const serverId = fileItem.dataset.serverId;
            
            if (serverId) {
                // Check if CSRF token exists
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                const headers = {};
                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
                }

                // Remove from server
                fetch('/api/attachments/' + serverId, {
                    method: 'DELETE',
                    headers: headers
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove from attached files array
                        attachedFiles = attachedFiles.filter(file => file.id !== serverId);
                        updateAttachmentsInput();
                    }
                })
                .catch(error => {
                    console.error('Remove error:', error);
                });
            }
            
            // Remove from DOM
            fileItem.remove();
        }
    };

    window.downloadFile = function(fileId) {
        window.open('/api/attachments/' + fileId + '/download', '_blank');
    };
});
</script>
@endpush
