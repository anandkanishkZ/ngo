<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Statistic;

class CheckStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check statistics in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Statistics in database:');
        
        $statistics = Statistic::all();
        
        if ($statistics->isEmpty()) {
            $this->warn('No statistics found in database.');
            return;
        }
        
        foreach ($statistics as $stat) {
            $this->line("Key: {$stat->key}");
            $this->line("Label: {$stat->label}");
            $this->line("Value: {$stat->value}");
            $this->line("Active: " . ($stat->is_active ? 'Yes' : 'No'));
            $this->line("---");
        }
        
        $this->info("Total statistics: " . $statistics->count());
    }
}
