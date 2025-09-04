# Rich Text Editor Component

## Overview
The `rich-text-editor` component is a reusable Quill.js-based WYSIWYG editor that can be used across the application for content creation and editing.

## Features
- **Modern Interface**: Clean, professional design with responsive toolbar
- **Multiple Toolbar Options**: Full, basic, and minimal toolbar configurations
- **Form Integration**: Seamless integration with Laravel forms and validation
- **Keyboard Shortcuts**: Standard shortcuts (Ctrl+B for bold, Ctrl+I for italic, etc.)
- **Responsive Design**: Works perfectly on desktop, tablet, and mobile devices
- **Dark Mode Support**: Automatically adapts to system dark mode preferences
- **Accessibility**: Proper ARIA labels and keyboard navigation support

## Usage

### Basic Usage
```blade
<x-rich-text-editor 
    name="content" 
    label="Content" 
    :required="true" 
/>
```

### Full Configuration
```blade
<x-rich-text-editor 
    id="myEditor"
    name="description"
    label="Description"
    :value="old('description', $model->description ?? '')"
    placeholder="Start writing your content..."
    height="400px"
    toolbar="full"
    :required="true"
    :error="$errors->first('description')"
/>
```

## Parameters

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `id` | string | `'richTextEditor'` | Unique identifier for the editor |
| `name` | string | `'content'` | Form field name |
| `value` | string | `''` | Initial content value |
| `placeholder` | string | `'Start writing...'` | Placeholder text |
| `height` | string | `'300px'` | Minimum height of the editor |
| `required` | boolean | `false` | Whether the field is required |
| `toolbar` | string | `'full'` | Toolbar type: `'full'`, `'basic'`, or `'minimal'` |
| `label` | string | `null` | Field label (optional) |
| `error` | string | `null` | Validation error message |

## Toolbar Options

### Full Toolbar
Includes all formatting options:
- Text formatting (bold, italic, underline, strikethrough)
- Text and background colors
- Headers (H1, H2, H3)
- Lists (ordered and bullet)
- Text alignment
- Links, blockquotes, code blocks
- Clear formatting

### Basic Toolbar
Essential formatting options:
- Text formatting (bold, italic, underline, strikethrough)
- Colors and headers
- Lists

### Minimal Toolbar
Only essential options:
- Bold, italic, and links

## Examples

### Blog Post Editor
```blade
<x-rich-text-editor 
    name="content"
    label="Post Content"
    :value="old('content', $post->content ?? '')"
    height="500px"
    toolbar="full"
    :required="true"
    :error="$errors->first('content')"
/>
```

### Comment Editor
```blade
<x-rich-text-editor 
    name="comment"
    placeholder="Write your comment..."
    height="200px"
    toolbar="minimal"
    :required="true"
/>
```

### Newsletter Editor
```blade
<x-rich-text-editor 
    id="newsletter-content"
    name="body"
    label="Newsletter Content"
    height="450px"
    toolbar="full"
    placeholder="Create your newsletter content..."
/>
```

## Form Integration

The component automatically:
- Syncs content with a hidden input field for form submission
- Handles Laravel validation errors
- Supports `old()` input helper for form repopulation
- Validates required fields on form submission

## Styling

The component includes comprehensive CSS that:
- Matches Bootstrap form styling
- Provides hover and focus states
- Includes responsive breakpoints
- Supports dark mode
- Maintains accessibility standards

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 11+
- Edge 79+
- Mobile browsers (iOS Safari, Chrome Mobile)

## Dependencies

- **Quill.js 1.3.6**: Loaded from CDN
- **Bootstrap 5**: For form styling (should already be included in your project)

## Notes

- The component uses `@push('styles')` and `@push('scripts')` directives
- Make sure your layout includes `@stack('styles')` and `@stack('scripts')`
- Content is stored as HTML in the database
- For security, consider sanitizing HTML content before displaying it publicly
