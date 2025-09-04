<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Statistic;

class TestAdminPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:admin-panel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test admin panel functionality for statistics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing admin panel workflow...');
        
        // 1. Test retrieving all statistics (index page)
        $this->info('1. Testing index page...');
        $statistics = Statistic::orderBy('sort_order')->get();
        $this->line("   Found {$statistics->count()} statistics");
        
        // 2. Test updating a specific statistic (simulating form submission)
        $this->info('2. Testing update functionality...');
        $stat = Statistic::where('key', 'lives_impacted')->first();
        
        if ($stat) {
            $this->line("   Current value: {$stat->value}");
            
            // Simulate form data
            $formData = [
                'key' => $stat->key,
                'label' => $stat->label,
                'value' => 2000,  // New value
                'icon' => $stat->icon,
                'color' => $stat->color,
                'sort_order' => $stat->sort_order,
                'is_active' => $stat->is_active,
                'description' => $stat->description
            ];
            
            // Update the statistic
            $stat->update($formData);
            $this->line("   Updated to: {$stat->value}");
            
            // Check if it persists
            $freshStat = Statistic::where('key', 'lives_impacted')->first();
            $this->line("   Fresh from DB: {$freshStat->value}");
            
            if ($freshStat->value == 2000) {
                $this->info('   ✅ Update persisted correctly!');
            } else {
                $this->error('   ❌ Update did not persist!');
            }
            
            // Test cache
            $this->info('3. Testing cache behavior...');
            $cachedStats = Statistic::getActiveStats();
            $cachedStat = $cachedStats->where('key', 'lives_impacted')->first();
            
            if ($cachedStat && $cachedStat->value == 2000) {
                $this->info('   ✅ Cache updated correctly!');
            } else {
                $this->error('   ❌ Cache not updated! Value: ' . ($cachedStat ? $cachedStat->value : 'Not found'));
            }
            
            // Reset to original value
            $stat->update(['value' => 1250]);
            $this->info('   Reset to original value');
            
        } else {
            $this->error('   Lives impacted statistic not found');
        }
        
        // 4. Test creating a new statistic
        $this->info('4. Testing create functionality...');
        $testKey = 'test_statistic_' . time();
        
        $newStat = Statistic::create([
            'key' => $testKey,
            'label' => 'Test Statistic',
            'value' => 999,
            'icon' => 'fa-solid fa-test',
            'color' => '#FF0000',
            'sort_order' => 999,
            'is_active' => true,
            'description' => 'Test statistic for debugging'
        ]);
        
        $this->line("   Created test statistic with ID: {$newStat->id}");
        
        // Verify it exists
        $exists = Statistic::where('key', $testKey)->exists();
        if ($exists) {
            $this->info('   ✅ Create functionality working!');
            
            // Clean up
            Statistic::where('key', $testKey)->delete();
            $this->line('   Cleaned up test statistic');
        } else {
            $this->error('   ❌ Create functionality failed!');
        }
        
        $this->info('Admin panel test completed!');
    }
}
