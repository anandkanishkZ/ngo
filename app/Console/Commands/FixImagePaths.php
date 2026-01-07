<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FixImagePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:fix-paths {--dry-run : Show what would be changed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix image paths in database and migrate files from storage_link to proper Laravel storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->warn('🔍 DRY RUN MODE - No changes will be made');
            $this->newLine();
        }

        $this->info('🚀 Starting Image Path Fixes...');
        $this->newLine();

        // Check if storage link exists
        $this->checkStorageLink();

        // Migrate files from storage_link if it exists
        if (File::exists(base_path('storage_link'))) {
            $this->migrateFilesFromStorageLink($dryRun);
        }

        // Fix database paths
        $this->fixNoticePaths($dryRun);
        $this->fixTeamMemberPaths($dryRun);
        $this->fixPartnerPaths($dryRun);
        $this->fixHeroSlidePaths($dryRun);
        $this->fixReportPaths($dryRun);

        $this->newLine();
        if ($dryRun) {
            $this->info('✅ Dry run completed. Run without --dry-run to apply changes.');
        } else {
            $this->info('✅ All image paths have been fixed!');
        }

        // Show recommendations
        $this->showRecommendations();
    }

    /**
     * Check if storage link exists and is valid
     */
    protected function checkStorageLink()
    {
        $this->info('Checking storage symlink...');
        
        $linkPath = public_path('storage');
        
        if (!File::exists($linkPath)) {
            $this->error('❌ Storage symlink does not exist!');
            $this->warn('   Run: php artisan storage:link');
        } elseif (!is_link($linkPath)) {
            $this->warn('⚠️  public/storage exists but is not a symlink!');
            $this->warn('   This might cause issues. Consider removing it and running:');
            $this->warn('   php artisan storage:link');
        } else {
            $this->info('✅ Storage symlink exists');
        }
        
        $this->newLine();
    }

    /**
     * Migrate files from old storage_link to proper Laravel storage
     */
    protected function migrateFilesFromStorageLink($dryRun)
    {
        $this->info('📁 Migrating files from storage_link...');
        
        $sourcePath = base_path('storage_link');
        $destPath = storage_path('app/public');
        
        $folders = ['notices', 'team', 'partners', 'hero', 'reports'];
        
        foreach ($folders as $folder) {
            $source = $sourcePath . '/' . $folder;
            $dest = $destPath . '/' . $folder;
            
            if (File::exists($source)) {
                $files = File::files($source);
                $count = count($files);
                
                if ($count > 0) {
                    if ($dryRun) {
                        $this->line("   Would migrate {$count} files from {$folder}/");
                    } else {
                        if (!File::exists($dest)) {
                            File::makeDirectory($dest, 0755, true);
                        }
                        
                        foreach ($files as $file) {
                            $filename = $file->getFilename();
                            $destFile = $dest . '/' . $filename;
                            
                            if (!File::exists($destFile)) {
                                File::copy($file->getPathname(), $destFile);
                            }
                        }
                        
                        $this->info("   ✅ Migrated {$count} files from {$folder}/");
                    }
                }
            }
        }
        
        $this->newLine();
    }

    /**
     * Fix notice image paths
     */
    protected function fixNoticePaths($dryRun)
    {
        $this->info('Fixing Notice image paths...');
        
        if (!DB::getSchemaBuilder()->hasTable('notices')) {
            $this->warn('   ⊘ notices table not found, skipping');
            return;
        }

        $updates = 0;
        
        // Remove storage_link/ prefix
        $query = "UPDATE notices SET image = REPLACE(image, 'storage_link/', '') WHERE image LIKE '%storage_link%'";
        $count = DB::table('notices')->where('image', 'like', '%storage_link%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
            $this->line("   - Removed storage_link/ from {$count} records");
        }
        
        // Remove leading /notices/
        $query = "UPDATE notices SET image = REPLACE(image, '/notices/', '') WHERE image LIKE '/notices/%'";
        $count = DB::table('notices')->where('image', 'like', '/notices/%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
            $this->line("   - Removed /notices/ prefix from {$count} records");
        }
        
        // Add notices/ prefix if missing
        $query = "UPDATE notices SET image = CONCAT('notices/', image) WHERE image NOT LIKE 'notices/%' AND image NOT LIKE 'http%' AND image IS NOT NULL AND image != ''";
        $count = DB::table('notices')
            ->where('image', 'not like', 'notices/%')
            ->where('image', 'not like', 'http%')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
            $this->line("   - Added notices/ prefix to {$count} records");
        }
        
        if ($updates > 0) {
            $this->info("   ✅ Fixed {$updates} notice paths");
        } else {
            $this->line('   ✓ No fixes needed');
        }
    }

    /**
     * Fix team member image paths
     */
    protected function fixTeamMemberPaths($dryRun)
    {
        $this->info('Fixing Team Member image paths...');
        
        if (!DB::getSchemaBuilder()->hasTable('team_members')) {
            $this->warn('   ⊘ team_members table not found, skipping');
            return;
        }

        $updates = 0;
        
        $query = "UPDATE team_members SET image = REPLACE(image, 'storage_link/', '') WHERE image LIKE '%storage_link%'";
        $count = DB::table('team_members')->where('image', 'like', '%storage_link%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE team_members SET image = REPLACE(image, '/team/', '') WHERE image LIKE '/team/%'";
        $count = DB::table('team_members')->where('image', 'like', '/team/%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE team_members SET image = CONCAT('team/', image) WHERE image NOT LIKE 'team/%' AND image NOT LIKE 'http%' AND image IS NOT NULL AND image != ''";
        $count = DB::table('team_members')
            ->where('image', 'not like', 'team/%')
            ->where('image', 'not like', 'http%')
            ->whereNotNull('image')
            ->where('image', '!=', '')
            ->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        if ($updates > 0) {
            $this->info("   ✅ Fixed {$updates} team member paths");
        } else {
            $this->line('   ✓ No fixes needed');
        }
    }

    /**
     * Fix partner logo paths
     */
    protected function fixPartnerPaths($dryRun)
    {
        $this->info('Fixing Partner logo paths...');
        
        if (!DB::getSchemaBuilder()->hasTable('partners')) {
            $this->warn('   ⊘ partners table not found, skipping');
            return;
        }

        $updates = 0;
        
        $query = "UPDATE partners SET logo = REPLACE(logo, 'storage_link/', '') WHERE logo LIKE '%storage_link%'";
        $count = DB::table('partners')->where('logo', 'like', '%storage_link%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE partners SET logo = REPLACE(logo, '/partners/', '') WHERE logo LIKE '/partners/%'";
        $count = DB::table('partners')->where('logo', 'like', '/partners/%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE partners SET logo = CONCAT('partners/', logo) WHERE logo NOT LIKE 'partners/%' AND logo NOT LIKE 'http%' AND logo IS NOT NULL AND logo != ''";
        $count = DB::table('partners')
            ->where('logo', 'not like', 'partners/%')
            ->where('logo', 'not like', 'http%')
            ->whereNotNull('logo')
            ->where('logo', '!=', '')
            ->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        if ($updates > 0) {
            $this->info("   ✅ Fixed {$updates} partner paths");
        } else {
            $this->line('   ✓ No fixes needed');
        }
    }

    /**
     * Fix hero slide image paths
     */
    protected function fixHeroSlidePaths($dryRun)
    {
        $this->info('Fixing Hero Slide image paths...');
        
        if (!DB::getSchemaBuilder()->hasTable('hero_slides')) {
            $this->warn('   ⊘ hero_slides table not found, skipping');
            return;
        }

        $updates = 0;
        
        $query = "UPDATE hero_slides SET bg_image = REPLACE(bg_image, 'storage_link/', '') WHERE bg_image LIKE '%storage_link%'";
        $count = DB::table('hero_slides')->where('bg_image', 'like', '%storage_link%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE hero_slides SET bg_image = REPLACE(bg_image, '/hero/', '') WHERE bg_image LIKE '/hero/%'";
        $count = DB::table('hero_slides')->where('bg_image', 'like', '/hero/%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE hero_slides SET bg_image = CONCAT('hero/', bg_image) WHERE bg_image NOT LIKE 'hero/%' AND bg_image NOT LIKE 'http%' AND bg_image IS NOT NULL AND bg_image != ''";
        $count = DB::table('hero_slides')
            ->where('bg_image', 'not like', 'hero/%')
            ->where('bg_image', 'not like', 'http%')
            ->whereNotNull('bg_image')
            ->where('bg_image', '!=', '')
            ->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        if ($updates > 0) {
            $this->info("   ✅ Fixed {$updates} hero slide paths");
        } else {
            $this->line('   ✓ No fixes needed');
        }
    }

    /**
     * Fix report image/pdf paths
     */
    protected function fixReportPaths($dryRun)
    {
        $this->info('Fixing Report paths...');
        
        if (!DB::getSchemaBuilder()->hasTable('reports')) {
            $this->warn('   ⊘ reports table not found, skipping');
            return;
        }

        $updates = 0;
        
        // Fix cover images
        $query = "UPDATE reports SET cover_image = REPLACE(cover_image, 'storage_link/', '') WHERE cover_image LIKE '%storage_link%'";
        $count = DB::table('reports')->where('cover_image', 'like', '%storage_link%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE reports SET cover_image = CONCAT('reports/', cover_image) WHERE cover_image NOT LIKE 'reports/%' AND cover_image NOT LIKE 'http%' AND cover_image IS NOT NULL AND cover_image != ''";
        $count = DB::table('reports')
            ->where('cover_image', 'not like', 'reports/%')
            ->where('cover_image', 'not like', 'http%')
            ->whereNotNull('cover_image')
            ->where('cover_image', '!=', '')
            ->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        // Fix PDF files
        $query = "UPDATE reports SET pdf_file = REPLACE(pdf_file, 'storage_link/', '') WHERE pdf_file LIKE '%storage_link%'";
        $count = DB::table('reports')->where('pdf_file', 'like', '%storage_link%')->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        $query = "UPDATE reports SET pdf_file = CONCAT('reports/', pdf_file) WHERE pdf_file NOT LIKE 'reports/%' AND pdf_file NOT LIKE 'http%' AND pdf_file IS NOT NULL AND pdf_file != ''";
        $count = DB::table('reports')
            ->where('pdf_file', 'not like', 'reports/%')
            ->where('pdf_file', 'not like', 'http%')
            ->whereNotNull('pdf_file')
            ->where('pdf_file', '!=', '')
            ->count();
        if ($count > 0) {
            if (!$dryRun) DB::statement($query);
            $updates += $count;
        }
        
        if ($updates > 0) {
            $this->info("   ✅ Fixed {$updates} report paths");
        } else {
            $this->line('   ✓ No fixes needed');
        }
    }

    /**
     * Show recommendations after fixes
     */
    protected function showRecommendations()
    {
        $this->newLine();
        $this->info('📋 Recommendations:');
        $this->line('');
        
        if (File::exists(base_path('storage_link'))) {
            $this->warn('1. Backup and remove old storage_link folder:');
            $this->line('   mv storage_link storage_link_backup');
            $this->line('');
        }
        
        if (!File::exists(public_path('storage')) || !is_link(public_path('storage'))) {
            $this->warn('2. Create storage symlink:');
            $this->line('   php artisan storage:link');
            $this->line('');
        }
        
        $this->info('3. Clear caches:');
        $this->line('   php artisan cache:clear');
        $this->line('   php artisan config:clear');
        $this->line('   php artisan view:clear');
        $this->line('');
        
        $this->info('4. Test images on all pages:');
        $this->line('   - Homepage (hero slides, partners)');
        $this->line('   - Notices');
        $this->line('   - Team members');
        $this->line('   - Reports');
        $this->line('');
        
        $this->info('5. Check browser console for 404 errors');
    }
}
