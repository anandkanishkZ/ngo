<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize {--path=public/images} {--quality=80}';
    protected $description = 'Optimize images and convert to WebP format';

    public function handle()
    {
        $path = public_path($this->option('path'));
        $quality = $this->option('quality');
        
        if (!File::exists($path)) {
            $this->error("Path does not exist: {$path}");
            return 1;
        }

        $manager = new ImageManager(new Driver());
        $files = File::allFiles($path);
        $bar = $this->output->createProgressBar(count($files));
        $optimized = 0;

        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());
            
            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                try {
                    $image = $manager->read($file->getRealPath());
                    
                    // Resize if too large
                    if ($image->width() > 1600) {
                        $image->scale(width: 1600);
                    }
                    
                    // Save optimized version
                    $image->save($file->getRealPath(), quality: $quality);
                    
                    // Create WebP version
                    $webpPath = $file->getPath() . '/' . $file->getFilenameWithoutExtension() . '.webp';
                    $image->toWebp(quality: $quality)->save($webpPath);
                    
                    $optimized++;
                } catch (\Exception $e) {
                    $this->error("Failed to optimize: {$file->getFilename()} - " . $e->getMessage());
                }
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info("Optimized {$optimized} images!");

        return 0;
    }
}
