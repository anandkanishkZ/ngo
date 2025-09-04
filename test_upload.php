<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔍 Testing Upload Functionality...\n\n";

try {
    // Test storage configuration
    echo "1. Testing Storage Configuration:\n";
    $disk = Storage::disk('public');
    echo "   - Storage disk 'public' loaded: ✅\n";
    
    $storagePath = storage_path('app/public');
    echo "   - Storage path: {$storagePath}\n";
    echo "   - Storage path exists: " . (is_dir($storagePath) ? '✅' : '❌') . "\n";
    
    $publicPath = public_path('storage');
    echo "   - Public symlink path: {$publicPath}\n";
    echo "   - Public symlink exists: " . (is_link($publicPath) || is_dir($publicPath) ? '✅' : '❌') . "\n";
    
    // Test directory creation
    echo "\n2. Testing Directory Creation:\n";
    $testDir = 'media/test';
    $disk->makeDirectory($testDir);
    echo "   - Test directory created: " . ($disk->exists($testDir) ? '✅' : '❌') . "\n";
    
    // Test file write
    echo "\n3. Testing File Write:\n";
    $testFile = 'media/test/test.txt';
    $disk->put($testFile, 'Test content');
    echo "   - Test file written: " . ($disk->exists($testFile) ? '✅' : '❌') . "\n";
    
    // Clean up
    $disk->delete($testFile);
    $disk->deleteDirectory($testDir);
    
    // Test Media model
    echo "\n4. Testing Media Model:\n";
    $mediaCount = App\Models\Media::count();
    echo "   - Media records in database: {$mediaCount}\n";
    
    // Test upload limits
    echo "\n5. Testing PHP Upload Limits:\n";
    echo "   - Max file size: " . ini_get('upload_max_filesize') . "\n";
    echo "   - Max post size: " . ini_get('post_max_size') . "\n";
    echo "   - Memory limit: " . ini_get('memory_limit') . "\n";
    echo "   - Max execution time: " . ini_get('max_execution_time') . "s\n";
    
    echo "\n✅ All storage tests passed!\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
