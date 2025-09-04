<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notice;
use Carbon\Carbon;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notices = [
            [
                'title' => 'Important: Annual Fundraising Gala 2025',
                'excerpt' => 'Join us for our biggest fundraising event of the year. Your support makes a difference in countless lives.',
                'content' => "We are excited to announce our Annual Fundraising Gala 2025! This prestigious event will be held on December 15th, 2025, at the Grand Ballroom downtown.\n\nThis year's theme is 'Building Hope Together' and we're expecting over 500 distinguished guests including community leaders, philanthropists, and supporters like you.\n\nWhat to expect:\n• Inspirational speeches from beneficiaries\n• Live auction with exclusive items\n• Networking opportunities\n• Gourmet dinner and entertainment\n• Recognition of major donors\n\nTickets are now available at our website or through the registration link. Early bird pricing is available until November 1st.\n\nYour attendance and support help us continue our mission of transforming lives and building stronger communities. Together, we can make an even greater impact in 2026.\n\nFor sponsorship opportunities or more information, please contact our events team.",
                'author' => 'Events Committee',
                'priority' => 'high',
                'status' => 'published',
                'category' => 'Events',
                'expires_at' => Carbon::parse('2025-12-20'),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 10,
                'published_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'New Education Program Launch',
                'excerpt' => 'We are launching a new scholarship program for underprivileged students. Applications are now open.',
                'content' => "Hope Foundation is proud to announce the launch of our new 'Bright Futures' scholarship program, designed to provide educational opportunities for underprivileged students.\n\nProgram Details:\n• Full tuition coverage for eligible students\n• Monthly stipends for books and supplies\n• Mentorship support throughout the academic journey\n• Career guidance and internship opportunities\n• Limited to 50 scholarships per year\n\nEligibility Criteria:\n• Family income below $30,000 annually\n• Academic excellence (minimum 3.5 GPA)\n• Community service involvement\n• Age between 16-25 years\n\nApplication Process:\n1. Complete the online application form\n2. Submit academic transcripts\n3. Provide two recommendation letters\n4. Write a 500-word essay on your goals\n5. Attend an interview (if shortlisted)\n\nApplication deadline is November 30th, 2025. Selected students will be notified by January 15th, 2026.\n\nThis program is made possible by our generous donors and partners who believe in the power of education to transform lives.",
                'author' => 'Education Team',
                'priority' => 'high',
                'status' => 'published',
                'category' => 'Education',
                'expires_at' => Carbon::parse('2025-12-01'),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 9,
                'published_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => 'Volunteer Training Workshop - October 2025',
                'excerpt' => 'Join our comprehensive volunteer training program. Learn skills that will help you make a meaningful impact.',
                'content' => "Are you passionate about making a difference? Join our comprehensive Volunteer Training Workshop happening throughout October 2025.\n\nWorkshop Schedule:\n• October 5th: Orientation and Foundation Overview\n• October 12th: Community Outreach Strategies\n• October 19th: Working with Vulnerable Populations\n• October 26th: Project Management and Leadership\n\nWhat You'll Learn:\n• Our mission, vision, and values\n• Effective communication techniques\n• Cultural sensitivity and diversity\n• Safety protocols and emergency procedures\n• Data collection and reporting methods\n• Team collaboration skills\n\nWorkshop Benefits:\n• Certificate of completion\n• Priority placement in volunteer programs\n• Access to exclusive volunteer events\n• Professional development opportunities\n• Networking with like-minded individuals\n\nRequirements:\n• Minimum age of 18 years\n• Commitment to volunteer for at least 6 months\n• Attendance at all 4 sessions\n• Background check (we'll assist with this)\n\nRegistration is free but spaces are limited to 30 participants. Light refreshments will be provided.\n\nTo register, please visit our website or call our volunteer coordinator at (555) 123-4567.",
                'author' => 'Volunteer Coordinator',
                'priority' => 'medium',
                'status' => 'published',
                'category' => 'Volunteer',
                'expires_at' => Carbon::parse('2025-10-30'),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 7,
                'published_at' => Carbon::now()->subDays(8),
            ],
            [
                'title' => 'Monthly Update: September 2025 Impact Report',
                'excerpt' => 'See the amazing impact we made together in September through our various programs and initiatives.',
                'content' => "Dear supporters and friends,\n\nWe're excited to share our September 2025 impact report, highlighting the incredible difference we've made together in our communities.\n\nEducation Program:\n• 150 students received scholarships\n• 25 new computers donated to rural schools\n• 500 books distributed to community libraries\n• 12 teachers trained in modern teaching methods\n\nHealthcare Initiative:\n• 2,000+ medical consultations provided\n• 500 children vaccinated\n• 50 pregnant mothers received prenatal care\n• 3 health camps organized in remote areas\n\nCommunity Development:\n• 2 new water wells completed\n• 100 families received food packages\n• 25 women trained in vocational skills\n• 1 community center renovated\n\nEnvironmental Projects:\n• 1,000 trees planted\n• 50 solar panels installed\n• 200 families educated on sustainable practices\n• 5 tons of waste recycled\n\nFinancial Summary:\n• Total funds utilized: $85,000\n• 89% directly to programs\n• 8% operational costs\n• 3% fundraising expenses\n\nLooking Ahead:\nOctober will focus on our annual winter preparation drive, ensuring vulnerable families have warm clothing and heating supplies.\n\nThank you for your continued support. Together, we're building a better tomorrow.",
                'author' => 'Executive Director',
                'priority' => 'medium',
                'status' => 'published',
                'category' => 'Updates',
                'expires_at' => null,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
                'published_at' => Carbon::now()->subDays(12),
            ],
            [
                'title' => 'Emergency Response: Flood Relief Operations',
                'excerpt' => 'We are actively responding to flood emergencies in the northern regions. Your urgent support is needed.',
                'content' => "URGENT: Hope Foundation is responding to severe flooding in the northern regions that has affected over 5,000 families.\n\nCurrent Situation:\n• 15 villages completely submerged\n• 3,000 people evacuated to relief camps\n• Urgent need for food, water, and medical supplies\n• Many homes and crops destroyed\n• Children and elderly most vulnerable\n\nOur Response:\n• Mobile medical units deployed\n• Emergency food and water distribution\n• Temporary shelter setup\n• Rescue operations ongoing\n• Coordination with local authorities\n\nImmediate Needs:\n• Clean drinking water\n• Ready-to-eat meals\n• Medical supplies and first aid kits\n• Blankets and warm clothing\n• Baby food and formula\n• Hygiene products\n\nHow You Can Help:\n1. Make an emergency donation\n2. Donate supplies at our collection centers\n3. Volunteer for relief operations\n4. Share this notice to spread awareness\n5. Pray for the affected families\n\nCollection Centers:\n• Main Office: 123 Hope Street\n• Community Center: 456 Care Avenue\n• Mall Entrance: Downtown Shopping Complex\n\nAll donations are tax-deductible. 100% of emergency donations go directly to relief efforts.\n\nFor volunteer opportunities, call our emergency hotline: (555) HELP-NOW\n\nTogether, we can help these families rebuild their lives.",
                'author' => 'Emergency Response Team',
                'priority' => 'urgent',
                'status' => 'published',
                'category' => 'Emergency',
                'expires_at' => Carbon::parse('2025-12-31'),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 15,
                'published_at' => Carbon::now()->subHours(6),
            ],
            [
                'title' => 'Holiday Gift Drive 2025 - Bringing Joy to Children',
                'excerpt' => 'Help us bring holiday cheer to underprivileged children. Donate toys, clothes, and gifts for our annual drive.',
                'content' => "The holiday season is approaching, and we need your help to bring joy to hundreds of underprivileged children in our community.\n\nOur Holiday Gift Drive 2025 aims to provide:\n• Toys for children ages 0-16\n• Warm winter clothing\n• Educational books and supplies\n• Holiday meal packages for families\n• Special treats and sweets\n\nDonation Guidelines:\n• New, unwrapped items only\n• Age-appropriate toys and games\n• Sizes: newborn to teen\n• No violent or weapon-like toys\n• No food items (except sealed, non-perishable)\n\nSuggested Items:\n• Board games and puzzles\n• Art supplies and coloring books\n• Dolls and action figures\n• Sports equipment\n• Winter coats, gloves, and hats\n• Books for all reading levels\n• STEM toys and educational games\n\nDrop-off Locations:\n• Hope Foundation Office (Monday-Friday, 9 AM - 5 PM)\n• Partner stores throughout the city\n• Weekend collection events at local malls\n• School collection boxes (participating schools)\n\nImportant Dates:\n• Collection Period: October 1 - December 15\n• Sorting Volunteer Day: December 16-17\n• Distribution Event: December 20-22\n\nVolunteer Opportunities:\n• Collection drive coordination\n• Gift sorting and packaging\n• Distribution event assistance\n• Event setup and cleanup\n\nLast year, we provided gifts to over 800 children. This year, we hope to reach 1,000!\n\nFor more information or to organize a collection drive at your workplace, contact our community outreach coordinator.",
                'author' => 'Community Outreach',
                'priority' => 'medium',
                'status' => 'published',
                'category' => 'Community',
                'expires_at' => Carbon::parse('2025-12-25'),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 6,
                'published_at' => Carbon::now()->subDays(15),
            ]
        ];

        foreach ($notices as $notice) {
            Notice::create($notice);
        }
    }
}
