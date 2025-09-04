# Media Library System Documentation

## 🎯 Overview

The Media Library system provides WordPress-like media management functionality for your Laravel nonprofit website. It includes a comprehensive media library interface and reusable media picker components that can be integrated anywhere in your admin panel.

## ✨ Key Features

### 📁 Media Library Management
- **File Upload**: Drag & drop or click to upload multiple files
- **Folder Organization**: Create and manage folders for better organization
- **File Types**: Support for images, documents, videos, and more
- **Search & Filter**: Find files by name, folder, or file type
- **Bulk Operations**: Select multiple files for batch deletion
- **File Details**: Edit title, alt text, and folder assignments

### 🖼️ Media Picker Component
- **Reusable Component**: Easy integration into any form
- **Modal Interface**: Clean, user-friendly selection interface
- **Type Filtering**: Filter by images or all file types
- **Live Preview**: Visual preview of selected media
- **Upload Integration**: Upload new files directly from picker

### 📊 Statistics & Analytics
- **Storage Tracking**: Monitor total storage usage
- **File Counts**: Track total files and images
- **Recent Activity**: View recent upload activity
- **Performance Metrics**: Usage insights

## 🏗️ System Architecture

### Models
- **Media**: Core model for file metadata and relationships
- **HeroSlide**: Updated to integrate with Media library
- **User**: Tracks who uploaded files

### Controllers
- **MediaController**: Handles all media operations (CRUD, upload, picker)
- **HeroSlideController**: Updated to work with media picker

### Views
- **dashboard/media/index**: Main media library interface
- **dashboard/media/picker**: Modal picker content
- **components/media-picker**: Reusable picker component

### Database Tables
- **media**: Stores file metadata, dimensions, relationships
- **hero_slides**: Updated with bg_image_id for media integration

## 🚀 Usage Guide

### Accessing Media Library
1. Login to the admin dashboard
2. Navigate to "Media Library" in the sidebar
3. Upload, organize, and manage your media files

### Using the Media Picker

#### Basic Integration
```html
<!-- Include the component in your blade template -->
@include('components.media-picker')

<!-- Create input fields -->
<input type="hidden" name="featured_image_id" id="featuredImageInput">
<div id="featuredImagePreview">No image selected</div>

<!-- Initialize the picker -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    createMediaInput('featuredImageInput', 'featuredImagePreview', { type: 'image' });
});
</script>
```

#### Advanced Usage
```javascript
// Open picker programmatically
openMediaPicker(function(media) {
    console.log('Selected media:', media);
    // Handle selected media
}, 'image'); // Optional type filter

// Custom callback handling
function handleMediaSelection(media) {
    document.getElementById('myInput').value = media.id;
    document.getElementById('myPreview').innerHTML = 
        `<img src="${media.url}" alt="${media.title}" class="img-thumbnail">`;
}
```

### Hero Slides Integration Example

The Hero Slides module has been updated to use the media picker:

```php
// In the form
<input type="hidden" name="bg_image_id" id="bgImageInput" 
       value="{{ old('bg_image_id', $slide->bg_image_id ?? '') }}">
<div id="bgImagePreview"></div>

// JavaScript initialization
createMediaInput('bgImageInput', 'bgImagePreview', { type: 'image' });
```

## 🛠️ Technical Implementation

### File Upload Processing
- **Security**: File type validation and size limits
- **Storage**: Files stored in `storage/app/public/media`
- **Organization**: Optional folder-based organization
- **Metadata**: Automatic extraction of image dimensions

### Database Schema
```sql
CREATE TABLE `media` (
    `id` bigint PRIMARY KEY AUTO_INCREMENT,
    `title` varchar(255) NOT NULL,
    `alt_text` varchar(255),
    `filename` varchar(255) NOT NULL,
    `original_filename` varchar(255) NOT NULL,
    `mime_type` varchar(255) NOT NULL,
    `file_size` bigint NOT NULL,
    `path` varchar(255) NOT NULL,
    `url` varchar(255),
    `width` int,
    `height` int,
    `folder` varchar(255),
    `is_image` boolean DEFAULT FALSE,
    `uploaded_by` bigint NOT NULL,
    `created_at` timestamp,
    `updated_at` timestamp,
    FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`)
);
```

### API Endpoints
- `GET /dashboard/media` - Media library interface
- `POST /dashboard/media` - Upload files
- `GET /dashboard/media/picker` - Picker modal content
- `GET /dashboard/media/stats` - Usage statistics
- `PUT /dashboard/media/{id}` - Update media details
- `DELETE /dashboard/media/{id}` - Delete single file
- `DELETE /dashboard/media` - Bulk delete files

## 🎨 Styling System

### CSS Classes
- `.media-grid` - Grid layout for media items
- `.media-item` - Individual media file container
- `.media-picker-grid` - Picker modal grid layout
- `.upload-zone` - Drag & drop upload area

### Responsive Design
- Grid automatically adjusts to screen size
- Mobile-optimized touch interactions
- Responsive modal dialogs

## 🔧 Configuration

### File Upload Limits
```php
// In MediaController
$request->validate([
    'files.*' => 'file|max:10240', // 10MB max per file
]);
```

### Allowed File Types
```php
// In blade template
accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,.txt,.csv"
```

### Storage Configuration
Files are stored using Laravel's filesystem configuration in `storage/app/public/media`.

## 🔐 Security Features

### Upload Security
- **File Type Validation**: Only allowed file types accepted
- **File Size Limits**: Configurable upload size limits
- **Authentication**: All operations require authentication
- **CSRF Protection**: All forms protected against CSRF attacks

### Access Control
- **User Tracking**: All uploads tracked by user
- **Permission Checks**: Admin-only access to media management
- **File Isolation**: Files stored outside web root by default

## 📈 Performance Features

### Optimization
- **Lazy Loading**: Images loaded on demand
- **Pagination**: Large media libraries paginated
- **AJAX Operations**: Smooth user experience without page reloads
- **Thumbnail Support**: Ready for thumbnail generation integration

### Caching
- **Browser Caching**: Proper cache headers for media files
- **CDN Ready**: Easy integration with CDN services

## 🚀 Deployment Checklist

1. **Run Migrations**: `php artisan migrate`
2. **Storage Link**: `php artisan storage:link`
3. **Permissions**: Ensure `storage/app/public` is writable
4. **Upload Limits**: Configure `php.ini` for desired upload sizes
5. **Disk Space**: Monitor storage usage

## 🔄 Integration Examples

### Blog Posts
```php
// Add to BlogPost model
public function featuredImage()
{
    return $this->belongsTo(Media::class, 'featured_image_id');
}

// In create form
<input type="hidden" name="featured_image_id" id="featuredImageInput">
<div id="featuredImagePreview"></div>
<script>
    createMediaInput('featuredImageInput', 'featuredImagePreview', { type: 'image' });
</script>
```

### Event Banners
```php
// Add to Event model
public function bannerImage()
{
    return $this->belongsTo(Media::class, 'banner_image_id');
}
```

### Partner Logos
```php
// Add to Partner model
public function logoImage()
{
    return $this->belongsTo(Media::class, 'logo_image_id');
}
```

## 🎯 Future Enhancements

### Planned Features
- **Image Editing**: Basic crop/resize functionality
- **Thumbnail Generation**: Automatic thumbnail creation
- **CDN Integration**: Amazon S3/CloudFront support
- **Advanced Search**: Full-text search capabilities
- **Batch Processing**: Bulk image optimization
- **Usage Tracking**: See where media files are used

### Enhancement Ideas
- **Image Optimization**: Automatic compression
- **Version Control**: Keep multiple versions of files
- **Metadata Extraction**: EXIF data for images
- **Duplicate Detection**: Prevent duplicate uploads
- **Backup Integration**: Automatic backups to cloud storage

## 💡 Tips for Content Creators

### Best Practices
1. **Organize Early**: Create folders before uploading
2. **Descriptive Names**: Use clear, descriptive filenames
3. **Alt Text**: Always add alt text for images
4. **File Sizes**: Optimize images before upload
5. **Consistent Naming**: Use consistent naming conventions

### Folder Structure Suggestions
- `hero-images/` - Homepage hero/banner images
- `blog-images/` - Blog post featured images
- `event-photos/` - Event documentation
- `partner-logos/` - Partner/sponsor logos
- `documents/` - PDF files and documents
- `team-photos/` - Staff and volunteer photos

## 🆘 Troubleshooting

### Common Issues
1. **Upload Fails**: Check PHP upload limits
2. **Images Not Displaying**: Verify storage:link exists
3. **Permissions Error**: Check directory permissions
4. **Large Files**: Increase upload_max_filesize and post_max_size

### Debug Commands
```bash
# Check storage link
ls -la public/storage

# Create storage link
php artisan storage:link

# Check disk space
df -h storage/

# View logs
tail -f storage/logs/laravel.log
```

This media library system provides a professional, WordPress-like media management experience that can be easily extended and customized for your specific needs.
