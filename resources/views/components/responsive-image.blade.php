@props([
    'src',
    'alt' => '',
    'class' => 'img-fluid',
    'style' => '',
    'loading' => 'lazy',
    'fetchpriority' => null,
    'sizes' => '100vw',
    'widths' => [400, 800, 1200, 1600]
])

@php
    $pathInfo = pathinfo($src);
    $dirname = $pathInfo['dirname'] ?? '';
    $filename = $pathInfo['filename'] ?? '';
    $extension = $pathInfo['extension'] ?? '';
    
    // Generate srcset for different widths
    $srcsetWebP = [];
    $srcsetOriginal = [];
    
    foreach ($widths as $width) {
        $srcsetWebP[] = asset("{$dirname}/{$filename}.webp") . " {$width}w";
        $srcsetOriginal[] = asset("{$dirname}/{$filename}.{$extension}") . " {$width}w";
    }
    
    $srcsetWebPString = implode(', ', $srcsetWebP);
    $srcsetOriginalString = implode(', ', $srcsetOriginal);
@endphp

<picture>
    <source 
        type="image/webp" 
        srcset="{{ $srcsetWebPString }}" 
        sizes="{{ $sizes }}"
    >
    <source 
        type="image/{{ $extension === 'jpg' ? 'jpeg' : $extension }}" 
        srcset="{{ $srcsetOriginalString }}" 
        sizes="{{ $sizes }}"
    >
    <img 
        src="{{ asset($src) }}" 
        alt="{{ $alt }}" 
        class="{{ $class }}" 
        @if($style) style="{{ $style }}" @endif
        loading="{{ $loading }}"
        @if($fetchpriority) fetchpriority="{{ $fetchpriority }}" @endif
        decoding="async"
        {{ $attributes }}
    >
</picture>
