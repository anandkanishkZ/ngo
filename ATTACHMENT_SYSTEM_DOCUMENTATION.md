# File Attachment System for Rich Text Editor

## Overview
The file attachment system allows users to upload and embed files (images, PDFs, documents) directly into rich text content. Files are stored in the database with proper tracking and cleanup functionality.

## Features
- **Drag & Drop Upload**: Intuitive file upload interface
- **Multiple File Types**: Support for images (JPG, PNG, GIF, WebP), PDFs, and Word documents
- **File Size Validation**: Maximum 5MB per file
- **Database Storage**: Files tracked in database with metadata
- **Automatic Cleanup**: Unused files are automatically removed after 24 hours
- **Inline Embedding**: Images embedded directly, other files as downloadable links

## How It Works

### 1. File Upload Process
1. User clicks the attachment button (📎) in the rich text editor toolbar
2. File upload modal opens with drag & drop area
3. Files are uploaded to `/storage/attachments/` directory
4. File metadata is stored in the `attachments` table
5. Files appear in the uploaded files list

### 2. File Insertion
1. User selects files from the uploaded list
2. Clicks "Insert Selected Files" button
3. **Images**: Inserted as `<img>` tags directly in content
4. **PDFs/Documents**: Inserted as downloadable links with icons

### 3. File Management
- **Database Table**: `attachments`
- **Storage Location**: `storage/app/public/attachments/`
- **Public Access**: Files accessible via `/storage/attachments/filename`

## Database Schema

```sql
attachments:
- id (UUID, primary key)
- original_name (string) - Original filename
- file_name (string) - Stored filename (randomized)
- file_path (string) - Full storage path
- file_size (bigint) - File size in bytes
- mime_type (string) - File MIME type
- file_type (string) - Simplified type: image, pdf, document
- url (text) - Public URL to access file
- context (string) - Where used: content, notice, blog
- context_id (string) - ID of related model
- is_used (boolean) - Whether file is actually used
- uploaded_at (timestamp) - Upload time
- created_at/updated_at (timestamps)
```

## API Endpoints

### Upload File
```
POST /dashboard/upload-attachment
Content-Type: multipart/form-data

Parameters:
- file: File to upload (max 5MB)

Response:
{
  "success": true,
  "file": {
    "id": "uuid",
    "original_name": "document.pdf",
    "url": "/storage/attachments/random-name.pdf",
    "file_type": "pdf",
    "formatted_size": "1.5 MB"
  }
}
```

### Remove File
```
DELETE /dashboard/remove-attachment/{fileId}

Response:
{
  "success": true,
  "message": "File removed successfully"
}
```

### List Files
```
GET /dashboard/list-attachments

Response:
{
  "success": true,
  "files": [...]
}
```

### Cleanup Old Files
```
POST /dashboard/cleanup-attachments

Response:
{
  "success": true,
  "message": "Cleanup completed. Removed 5 unused files."
}
```

## Usage in Content

### Rich Text Editor Integration
The attachment system is automatically integrated into the rich text editor component:

```blade
<x-rich-text-editor 
    name="content"
    label="Content"
    toolbar="full"
    :required="true"
/>
```

### Content Output
When files are embedded, they appear as:

**Images:**
```html
<img src="/storage/attachments/image.jpg" alt="" class="embedded-image">
```

**PDFs/Documents:**
```html
<a href="/storage/attachments/document.pdf" class="embedded-file" target="_blank">
    <span class="file-icon-small pdf">
        <i class="fas fa-file-pdf"></i>
    </span>
    <span>document.pdf</span>
</a>
```

## File Cleanup

### Automatic Cleanup
- Files are marked as `is_used = false` when uploaded
- Files older than 24 hours and unused are automatically removed
- Cleanup can be triggered manually via API endpoint

### Manual Cleanup
You can set up a scheduled task to run cleanup:

```php
// In app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        \App\Models\Attachment::cleanupUnused(24);
    })->daily();
}
```

## Security Features

### File Validation
- File type validation via MIME type checking
- File size limits (5MB maximum)
- Randomized filenames to prevent conflicts
- Secure storage in Laravel's storage system

### Access Control
- Files are stored in public storage for direct access
- All uploads go through authenticated dashboard routes
- File paths are randomized for security

## Styling

The attachment system includes comprehensive CSS styling:
- Modern upload interface with drag & drop
- File type icons and formatting
- Responsive design for all screen sizes
- Consistent with rich text editor theme

## Browser Support
- Chrome 60+
- Firefox 55+
- Safari 11+
- Edge 79+
- Mobile browsers with drag & drop support

## Troubleshooting

### Common Issues
1. **Upload fails**: Check file size and type restrictions
2. **Files not appearing**: Verify storage symlink is created
3. **Permission errors**: Check storage directory permissions

### Storage Symlink
Ensure the storage symlink is created:
```bash
php artisan storage:link
```

This creates a symbolic link from `public/storage` to `storage/app/public`.
