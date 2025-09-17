<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Statistic;

class TestStatisticUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:statistic-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test updating a statistic value';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing statistic update...');
        
        // Find the lives_impacted statistic
        $stat = Statistic::where('key', 'lives_impacted')->first();
        
        if (!$stat) {
            $this->error('lives_impacted statistic not found.');
            return;
        }
        
        $originalValue = $stat->value;
        $this->info("Original value: {$originalValue}");
        
        // Update the value
        $newValue = $originalValue + 100;
        $stat->value = $newValue;
        $stat->save();
        
        $this->info("Updated value to: {$newValue}");
        
        // Verify the update
        $updatedStat = Statistic::where('key', 'lives_impacted')->first();
        $this->info("Value in database: {$updatedStat->value}");
        
        if ($updatedStat->value == $newValue) {
            $this->info('✅ Update successful!');
        } else {
            $this->error('❌ Update failed!');
        }
        
        // Test cache clearing
        $this->info('Testing cached statistics...');
        $cachedStats = Statistic::getActiveStats();
        $cachedLivesImpacted = $cachedStats->where('key', 'lives_impacted')->first();
        
        if ($cachedLivesImpacted && $cachedLivesImpacted->value == $newValue) {
            $this->info('✅ Cache updated correctly!');
        } else {
            $this->warn('⚠️ Cache may not be updated. Value: ' . ($cachedLivesImpacted ? $cachedLivesImpacted->value : 'Not found'));
        }
        
        // Reset to original value
        $stat->value = $originalValue;
        $stat->save();
        $this->info("Reset value back to: {$originalValue}");
    }
}
