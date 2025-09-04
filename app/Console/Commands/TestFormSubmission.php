<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Statistic;

class TestFormSubmission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:form-submission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test form submission like the admin panel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing form submission scenario...');
        
        // Get the lives_impacted statistic
        $stat = Statistic::where('key', 'lives_impacted')->first();
        
        if (!$stat) {
            $this->error('Statistic not found!');
            return;
        }
        
        $this->line("Original value: {$stat->value}");
        
        // Simulate form data exactly as it would come from the web form
        $formData = [
            'key' => 'lives_impacted',
            'label' => 'Lives Impacted', 
            'value' => '1200',  // The value you tried to set
            'icon' => 'fa-solid fa-heart',
            'color' => '#f39c12',
            'sort_order' => '1',
            'description' => 'Total number of lives directly impacted by our programs and initiatives.',
            'is_active' => true  // Checkbox checked
        ];
        
        $this->info('Simulating form submission with value: 1200');
        
        // Update using the same logic as the controller
        $stat->update([
            'key' => $formData['key'],
            'label' => $formData['label'],
            'value' => (int)$formData['value'],
            'icon' => $formData['icon'],
            'color' => $formData['color'],
            'sort_order' => (int)$formData['sort_order'],
            'is_active' => $formData['is_active'],
            'description' => $formData['description']
        ]);
        
        $this->line("Updated value: {$stat->value}");
        
        // Clear cache
        \Cache::forget('statistics_active');
        
        // Verify the change persisted
        $freshStat = Statistic::where('key', 'lives_impacted')->first();
        $this->line("Fresh from database: {$freshStat->value}");
        
        // Test cached version
        $cachedStats = Statistic::getActiveStats();
        $cachedStat = $cachedStats->where('key', 'lives_impacted')->first();
        $this->line("From cache: {$cachedStat->value}");
        
        if ($freshStat->value == 1200 && $cachedStat->value == 1200) {
            $this->info('✅ Form submission test PASSED!');
            $this->info('✅ The value now persists correctly at 1200');
        } else {
            $this->error('❌ Form submission test FAILED!');
        }
        
        // Show all current statistics
        $this->info('Current statistics in database:');
        $allStats = Statistic::orderBy('sort_order')->get();
        foreach ($allStats as $s) {
            $this->line("  {$s->key}: {$s->value} ({$s->label})");
        }
    }
}
