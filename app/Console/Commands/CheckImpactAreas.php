<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ImpactArea;
use Illuminate\Support\Str;

class CheckImpactAreas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:impact-areas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check impact areas in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Impact Areas in database:');
        
        $impactAreas = ImpactArea::orderBy('sort_order')->get();
        
        if ($impactAreas->isEmpty()) {
            $this->warn('No impact areas found in database.');
            return;
        }
        
        foreach ($impactAreas as $area) {
            $this->line("Title: {$area->title}");
            $this->line("Description: " . Str::limit($area->description, 60));
            $this->line("Icon: {$area->icon}");
            $this->line("Color: {$area->color}");
            $this->line("Sort Order: {$area->sort_order}");
            $this->line("Active: " . ($area->is_active ? 'Yes' : 'No'));
            $this->line("---");
        }
        
        $this->info("Total impact areas: " . $impactAreas->count());
        
        // Test cache functionality
        $this->info("Testing cache...");
        $cachedAreas = ImpactArea::getActiveAreas();
        $this->info("Active areas from cache: " . $cachedAreas->count());
    }
}
