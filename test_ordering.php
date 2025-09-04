<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔍 Testing Media Ordering Scopes...\n\n";

try {
    // Test latestFirst scope
    echo "1. Testing latestFirst() scope:\n";
    $latestMedia = App\Models\Media::latestFirst()->take(3)->get(['id', 'filename', 'created_at']);
    foreach ($latestMedia as $media) {
        echo "   - {$media->filename} (ID: {$media->id}, Created: {$media->created_at})\n";
    }

    echo "\n2. Testing oldestFirst() scope:\n";
    $oldestMedia = App\Models\Media::oldestFirst()->take(3)->get(['id', 'filename', 'created_at']);
    foreach ($oldestMedia as $media) {
        echo "   - {$media->filename} (ID: {$media->id}, Created: {$media->created_at})\n";
    }

    echo "\n3. Testing alphabetical() scope:\n";
    $alphabeticalMedia = App\Models\Media::alphabetical()->take(3)->get(['id', 'filename']);
    foreach ($alphabeticalMedia as $media) {
        echo "   - {$media->filename} (ID: {$media->id})\n";
    }

    echo "\n4. Testing bySize('desc') scope:\n";
    $largestMedia = App\Models\Media::bySize('desc')->take(3)->get(['id', 'filename', 'file_size']);
    foreach ($largestMedia as $media) {
        $sizeFormatted = $media->size_formatted;
        echo "   - {$media->filename} (ID: {$media->id}, Size: {$sizeFormatted})\n";
    }

    echo "\n✅ All ordering scopes working correctly!\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
