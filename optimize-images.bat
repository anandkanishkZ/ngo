@echo off
REM Image Optimization Script for JIDS Nepal
REM This script helps prepare images for WebP conversion
REM Run this on your production server with ImageMagick or similar tools installed

echo ================================================
echo JIDS Nepal - Image Optimization Guide
echo ================================================
echo.
echo This script will guide you through optimizing images.
echo You need to have ImageMagick or similar tools installed.
echo.
echo MANUAL OPTIMIZATION STEPS:
echo.
echo 1. For Windows (using online tools):
echo    - Visit: https://squoosh.app/ or https://tinypng.com/
echo    - Upload hero slide images from: public/uploads/hero/
echo    - Upload photo-jids.jpg from: public/images/
echo    - Convert to WebP format
echo    - Set quality to 85%%
echo    - Download and replace original files
echo.
echo 2. For Linux/Production Server (using ImageMagick):
echo    Run these commands:
echo.
echo    # Convert hero slides to WebP
echo    for file in public/uploads/hero/*.{jpg,jpeg,png}; do
echo        cwebp -q 85 "$file" -o "${file%%.*}.webp"
echo    done
echo.
echo    # Convert main images to WebP
echo    for file in public/images/*.{jpg,jpeg,png}; do
echo        cwebp -q 85 "$file" -o "${file%%.*}.webp"
echo    done
echo.
echo    # Resize large images to max 1600px width
echo    for file in public/uploads/hero/*.{jpg,jpeg,png}; do
echo        convert "$file" -resize '1600x^' -quality 85 "$file"
echo    done
echo.
echo 3. Expected Results:
echo    - Each JPG/PNG will have a .webp version
echo    - File sizes reduced by 60-80%%
echo    - Total savings: ~1.3MB
echo.
echo 4. Specific files to optimize (from PageSpeed report):
echo    - public/images/photo-jids.jpg (728KB → ~36KB with WebP + resize)
echo    - public/uploads/hero/*_695948b0cbcef.jpg (720KB → ~142KB with WebP)
echo    - public/uploads/hero/*_69594917c078e.jpeg (191KB → ~163KB with WebP)
echo    - public/uploads/hero/*_695948cd800b3.jpg (128KB → ~103KB with WebP)
echo.
echo ================================================
echo.
pause

REM If you have ImageMagick installed, uncomment the following lines:
REM cd /d "%~dp0"
REM magick mogrify -path public/images -format webp -quality 85 public/images/*.jpg
REM magick mogrify -path public/uploads/hero -format webp -quality 85 public/uploads/hero/*.jpg
REM magick mogrify -resize "1600x>" -quality 85 public/images/*.jpg
REM magick mogrify -resize "1600x>" -quality 85 public/uploads/hero/*.jpg
REM echo Done! WebP versions created.
REM pause
