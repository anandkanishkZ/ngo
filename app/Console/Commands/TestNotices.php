<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notice;

class TestNotices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:notices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create test notices for debugging';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating test notices...');

        // Clear existing notices first (optional)
        $existingCount = Notice::count();
        $this->info("Found {$existingCount} existing notices");

        // Create sample notices
        $notices = [
            [
                'title' => 'Important: Annual General Meeting 2025',
                'content' => '<p>We are pleased to announce our Annual General Meeting will be held on September 20, 2025.</p><p>All members are invited to attend and participate in the planning of our future activities.</p>',
                'excerpt' => 'Join us for our Annual General Meeting on September 20, 2025. Your participation matters!',
                'author' => 'JIDS Nepal Admin',
                'priority' => 'high',
                'status' => 'published',
                'category' => 'Meetings',
                'is_featured' => true,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'New Community Water Project Launched',
                'content' => '<p>We are excited to announce the launch of our new community water project in rural Udayapur.</p><p>This project will provide clean drinking water to over 500 families in the region.</p>',
                'excerpt' => 'New water project will provide clean drinking water to over 500 families in Udayapur.',
                'author' => 'Project Team',
                'priority' => 'medium',
                'status' => 'published',
                'category' => 'Projects',
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Volunteer Training Program - Registration Open',
                'content' => '<p>Registration is now open for our comprehensive volunteer training program.</p><p>Learn skills in community development, project management, and social work.</p>',
                'excerpt' => 'Join our volunteer training program and learn valuable community development skills.',
                'author' => 'Training Coordinator',
                'priority' => 'medium',
                'status' => 'published',
                'category' => 'Training',
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Urgent: Flood Relief Emergency Response',
                'content' => '<p>Due to recent flooding in the region, we are mobilizing emergency relief efforts.</p><p>Immediate assistance needed for affected families. Donations and volunteers welcome.</p>',
                'excerpt' => 'Emergency flood relief response - immediate assistance needed for affected families.',
                'author' => 'Emergency Response Team',
                'priority' => 'urgent',
                'status' => 'published',
                'category' => 'Emergency',
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now()->subHours(6),
            ],
        ];

        foreach ($notices as $noticeData) {
            $notice = Notice::create($noticeData);
            $this->info("Created notice: {$notice->title}");
        }

        $totalNotices = Notice::count();
        $activePublished = Notice::active()->published()->count();
        
        $this->info("Total notices in database: {$totalNotices}");
        $this->info("Active & published notices: {$activePublished}");
        $this->info('Test notices created successfully!');
    }
}
