<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // Events removed
            'time' => '14:00:00',
            'location' => 'Public Library, Main Branch',
            'image' => 'digital-literacy.jpg',
            'max_participants' => 30,
            'registration_required' => true,
        ]);

        // Admin user
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        // Call additional seeders
        $this->call([
            HeroSlidesSeeder::class,
            StatisticsSeeder::class,
            ImpactAreaSeeder::class,
        ]);

        // Create sample team members if none exist
        if (\App\Models\TeamMember::count() === 0) {
            \App\Models\TeamMember::create([
                'name' => 'Sarah Johnson',
                'position' => 'Executive Director',
                'department' => 'leadership',
                'bio' => 'Sarah has over 15 years of experience in nonprofit management and is passionate about creating sustainable change in communities worldwide.',
                'email' => 'sarah@hopefoundation.org',
                'linkedin_url' => 'https://linkedin.com/in/sarahjohnson',
                'twitter_url' => 'https://twitter.com/sarahjohnson',
                'achievements' => 'Led successful fundraising campaigns raising over $2M. Established partnerships with 50+ organizations.',
                'is_active' => true,
                'featured' => true,
                'sort_order' => 1
            ]);

            \App\Models\TeamMember::create([
                'name' => 'Michael Chen',
                'position' => 'Program Director',
                'department' => 'programs',
                'bio' => 'Michael oversees all our educational and community development programs, ensuring maximum impact for the communities we serve.',
                'email' => 'michael@hopefoundation.org',
                'linkedin_url' => 'https://linkedin.com/in/michaelchen',
                'achievements' => 'Launched 10+ successful community programs. Managed budgets exceeding $1M annually.',
                'is_active' => true,
                'featured' => true,
                'sort_order' => 2
            ]);

            \App\Models\TeamMember::create([
                'name' => 'Emily Rodriguez',
                'position' => 'Development Manager',
                'department' => 'fundraising',
                'bio' => 'Emily leads our fundraising efforts and donor relations, building meaningful partnerships that support our mission.',
                'email' => 'emily@hopefoundation.org',
                'facebook_url' => 'https://facebook.com/emilyrodriguez',
                'linkedin_url' => 'https://linkedin.com/in/emilyrodriguez',
                'achievements' => 'Increased annual donations by 200%. Built relationships with 500+ donors.',
                'is_active' => true,
                'featured' => false,
                'sort_order' => 3
            ]);

            \App\Models\TeamMember::create([
                'name' => 'David Williams',
                'position' => 'Operations Manager',
                'department' => 'operations',
                'bio' => 'David ensures smooth day-to-day operations and manages our logistics for maximum efficiency and impact.',
                'email' => 'david@hopefoundation.org',
                'linkedin_url' => 'https://linkedin.com/in/davidwilliams',
                'achievements' => 'Streamlined operations reducing costs by 30%. Improved program delivery efficiency by 40%.',
                'is_active' => true,
                'featured' => false,
                'sort_order' => 4
            ]);

            \App\Models\TeamMember::create([
                'name' => 'Lisa Thompson',
                'position' => 'Communications Director',
                'department' => 'communications',
                'bio' => 'Lisa manages our communications strategy, ensuring our message reaches the right audiences and creates meaningful engagement.',
                'email' => 'lisa@hopefoundation.org',
                'twitter_url' => 'https://twitter.com/lisathompson',
                'facebook_url' => 'https://facebook.com/lisathompson',
                'achievements' => 'Grew social media following by 300%. Secured media coverage in 20+ publications.',
                'is_active' => true,
                'featured' => false,
                'sort_order' => 5
            ]);

            \App\Models\TeamMember::create([
                'name' => 'Robert Kumar',
                'position' => 'Field Coordinator',
                'department' => 'programs',
                'bio' => 'Robert coordinates our field operations and ensures our programs are effectively implemented in target communities.',
                'email' => 'robert@hopefoundation.org',
                'linkedin_url' => 'https://linkedin.com/in/robertkumar',
                'achievements' => 'Coordinated programs across 25+ communities. Trained 100+ local coordinators.',
                'is_active' => true,
                'featured' => false,
                'sort_order' => 6
            ]);
        }
    }
}
