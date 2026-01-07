#!/bin/bash
# Image Optimization Script for JIDS Nepal Production Server
# Run this on your Linux production server with ImageMagick/cwebp installed

echo "================================================"
echo "JIDS Nepal - Image Optimization Script"
echo "================================================"
echo ""
echo "This script will:"
echo "1. Convert images to WebP format"
echo "2. Resize large images to max 1600px width"
echo "3. Optimize JPEG quality to 85%"
echo ""
echo "Estimated savings: 1,324 KiB"
echo ""

# Check if required tools are installed
if ! command -v cwebp &> /dev/null; then
    echo "ERROR: cwebp is not installed!"
    echo "Install with: sudo apt-get install webp"
    exit 1
fi

if ! command -v convert &> /dev/null; then
    echo "ERROR: ImageMagick is not installed!"
    echo "Install with: sudo apt-get install imagemagick"
    exit 1
fi

echo "Starting optimization..."
echo ""

# Navigate to script directory
cd "$(dirname "$0")"

# Create backup directory
mkdir -p backups/images_backup_$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="backups/images_backup_$(date +%Y%m%d_%H%M%S)"

# Function to optimize image
optimize_image() {
    local file="$1"
    local quality="${2:-85}"
    
    if [ ! -f "$file" ]; then
        echo "Skipping $file (not found)"
        return
    fi
    
    echo "Processing: $file"
    
    # Backup original
    cp "$file" "$BACKUP_DIR/"
    
    # Get image width
    width=$(identify -format "%w" "$file")
    
    # Resize if larger than 1600px
    if [ "$width" -gt 1600 ]; then
        echo "  → Resizing from ${width}px to 1600px"
        convert "$file" -resize '1600x>' -quality $quality "$file"
    else
        echo "  → Optimizing quality to ${quality}%"
        convert "$file" -quality $quality "$file"
    fi
    
    # Create WebP version
    echo "  → Creating WebP version"
    cwebp -q $quality "$file" -o "${file%.*}.webp" 2>/dev/null
    
    # Show file sizes
    original_size=$(du -h "$file" | cut -f1)
    webp_size=$(du -h "${file%.*}.webp" | cut -f1)
    echo "  ✓ Original: $original_size | WebP: $webp_size"
    echo ""
}

echo "Optimizing hero slide images..."
echo "================================"
for file in public/uploads/hero/*.{jpg,jpeg,png,JPG,JPEG,PNG}; do
    [ -e "$file" ] || continue
    optimize_image "$file" 85
done

echo ""
echo "Optimizing main images..."
echo "================================"
for file in public/images/*.{jpg,jpeg,png,JPG,JPEG,PNG}; do
    [ -e "$file" ] || continue
    optimize_image "$file" 85
done

echo ""
echo "================================================"
echo "Optimization complete!"
echo "================================================"
echo ""
echo "Backups saved to: $BACKUP_DIR"
echo ""
echo "Summary:"
find public/uploads/hero public/images -name "*.webp" 2>/dev/null | wc -l | xargs echo "  - WebP files created:"
echo ""
echo "Next steps:"
echo "1. Clear Laravel cache: php artisan cache:clear"
echo "2. Test website to verify images load correctly"
echo "3. Run PageSpeed test to verify improvements"
echo ""
