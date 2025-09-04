<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MediaController;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TestMediaLibrary extends Command
{
    protected $signature = 'test:media-library';
    protected $description = 'Test media library functionality';

    public function handle()
    {
        $this->info('🔍 Testing Media Library System...');
        $this->newLine();

        // Set a user for testing
        $user = User::first();
        if ($user) {
            Auth::login($user);
            $this->info("✓ Logged in as: {$user->email}");
        } else {
            $this->warn("⚠ No users found, creating test user...");
            $user = User::create([
                'name' => 'Test Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('password'),
            ]);
            Auth::login($user);
            $this->info("✓ Created and logged in as: {$user->email}");
        }

        // Test 1: Check storage directory
        $this->info('1. Checking storage directory...');
        $storagePath = storage_path('app/public');
        if (is_dir($storagePath)) {
            $this->info("   ✓ Storage directory exists: {$storagePath}");
            
            // Count files in storage
            $fileCount = $this->countFiles($storagePath);
            $this->info("   ✓ Found {$fileCount} files in storage");
        } else {
            $this->error("   ✗ Storage directory not found: {$storagePath}");
            return;
        }

        // Test 2: Check database
        $this->info('2. Checking database...');
        $dbCount = Media::count();
        $this->info("   ✓ Found {$dbCount} media records in database");

        // Test 3: Test sync functionality
        $this->info('3. Testing sync functionality...');
        try {
            $controller = new MediaController();
            $result = $controller->syncStorageFiles();
            
            if ($result->getData()->success) {
                $this->info("   ✓ Sync completed successfully");
                $this->info("   ✓ Synced: " . $result->getData()->synced . " files");
                
                if (!empty($result->getData()->errors)) {
                    $this->warn("   ⚠ Sync errors: " . count($result->getData()->errors));
                    foreach ($result->getData()->errors as $error) {
                        $this->line("     - {$error}");
                    }
                }
            } else {
                $this->error("   ✗ Sync failed: " . $result->getData()->message);
            }
        } catch (\Exception $e) {
            $this->error("   ✗ Sync error: " . $e->getMessage());
        }

        // Test 4: Check database after sync
        $this->info('4. Checking database after sync...');
        $newDbCount = Media::count();
        $this->info("   ✓ Media records after sync: {$newDbCount}");
        if ($newDbCount > $dbCount) {
            $this->info("   ✓ Added " . ($newDbCount - $dbCount) . " new records");
        }

        // Test 5: Show some sample media
        $this->info('5. Sample media files:');
        $sampleMedia = Media::take(5)->get();
        foreach ($sampleMedia as $media) {
            $this->line("   - {$media->title} ({$media->filename}) - {$media->size_formatted}");
        }

        // Test 6: Check folders
        $this->info('6. Available folders:');
        $folders = Media::distinct('folder')->pluck('folder')->filter();
        foreach ($folders as $folder) {
            $count = Media::where('folder', $folder)->count();
            $this->line("   - {$folder}: {$count} files");
        }

        $this->newLine();
        $this->info('🎉 Media Library Test Completed!');
        $this->info('You can now access the media library at: /dashboard/media');
    }

    private function countFiles($dir)
    {
        $count = 0;
        if (is_dir($dir)) {
            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS)
            );
            foreach ($iterator as $file) {
                if ($file->isFile() && !str_starts_with($file->getFilename(), '.')) {
                    $count++;
                }
            }
        }
        return $count;
    }
}
