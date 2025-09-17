@if($media->count() > 0)
  @foreach($media as $item)
    <div class="media-picker-item" 
         data-id="{{ $item->id }}" 
         data-title="{{ $item->title }}"
         data-url="{{ $item->full_url }}"
         data-alt-text="{{ $item->alt_text }}"
         data-is-image="{{ $item->is_image ? '1' : '0' }}"
         data-filename="{{ $item->filename }}">
      
      <div class="media-picker-preview">
        @if($item->is_image)
          <img src="{{ $item->full_url }}" alt="{{ $item->alt_text ?: $item->title }}" loading="lazy">
        @else
          <div class="media-picker-file-icon">
            <i class="fa-solid {{ $item->getFileTypeIcon() }}"></i>
            <div>{{ strtoupper(pathinfo($item->filename, PATHINFO_EXTENSION)) }}</div>
          </div>
        @endif
      </div>
      
      <div class="media-picker-info">
        <div class="media-picker-title" title="{{ $item->title }}">{{ Str::limit($item->title, 15) }}</div>
        <div class="media-picker-meta">
          {{ $item->size_formatted }}
          @if($item->is_image && $item->width && $item->height)
            <br>{{ $item->width }}x{{ $item->height }}
          @endif
        </div>
      </div>
    </div>
  @endforeach
@else
  <div class="col-12">
    <div class="text-center py-4">
      <i class="fa-solid fa-images fa-3x text-muted mb-3"></i>
      <h5>No media files found</h5>
      <p class="text-muted">Try adjusting your search or upload new files</p>
    </div>
  </div>
@endif
