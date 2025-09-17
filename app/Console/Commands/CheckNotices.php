<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;

class CheckNotices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:notices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check notice data and scopes';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Checking notices data...');

        // Get all notices
        $allNotices = Notice::all();
        $this->info("Total notices: " . $allNotices->count());

        // Check each notice
        foreach ($allNotices as $notice) {
            $this->info("Notice: {$notice->title}");
            $this->info("  - Status: {$notice->status}");
            $this->info("  - Is Active: " . ($notice->is_active ? 'Yes' : 'No'));
            $this->info("  - Published At: " . ($notice->published_at ? $notice->published_at->format('Y-m-d H:i:s') : 'NULL'));
            $this->info("  - Expires At: " . ($notice->expires_at ? $notice->expires_at->format('Y-m-d') : 'NULL'));
            $this->info("  - Is Featured: " . ($notice->is_featured ? 'Yes' : 'No'));
            $this->info("---");
        }

        // Test scopes individually
        $this->info("\nTesting scopes:");
        
        $activeCount = Notice::active()->count();
        $this->info("Active notices: {$activeCount}");
        
        $publishedCount = Notice::published()->count();
        $this->info("Published notices: {$publishedCount}");
        
        $notExpiredCount = Notice::notExpired()->count();
        $this->info("Not expired notices: {$notExpiredCount}");
        
        $activePublishedCount = Notice::active()->published()->count();
        $this->info("Active + Published notices: {$activePublishedCount}");
        
        $activePublishedNotExpiredCount = Notice::active()->published()->notExpired()->count();
        $this->info("Active + Published + Not Expired notices: {$activePublishedNotExpiredCount}");

        // Get the final query result
        $finalNotices = Notice::active()
                              ->published()
                              ->notExpired()
                              ->orderBy('sort_order')
                              ->orderBy('published_at', 'desc')
                              ->get();
                              
        $this->info("\nFinal query result: " . $finalNotices->count() . " notices");
        foreach ($finalNotices as $notice) {
            $this->info("  - {$notice->title}");
        }
    }
}
