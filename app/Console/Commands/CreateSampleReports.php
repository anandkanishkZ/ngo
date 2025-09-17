<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Report;

class CreateSampleReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:sample-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create sample reports for testing';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Creating sample reports...');

        $reports = [
            [
                'title' => 'JIDS Nepal Annual Report 2024-2025',
                'description' => 'Comprehensive annual report showcasing our achievements, impact, and financial performance for the fiscal year 2024-2025. This report highlights our major projects, community engagement initiatives, and strategic partnerships.',
                'executive_summary' => 'During 2024-2025, JIDS Nepal successfully implemented 15 community development projects, reaching over 5,000 beneficiaries across Udayapur district. Our focus areas included education, healthcare, water and sanitation, and livelihood development.',
                'content' => '<h2>Executive Summary</h2><p>JIDS Nepal has completed another successful year of community development work in Udayapur district. Our comprehensive approach to development has yielded significant results across all our program areas.</p><h3>Key Achievements</h3><ul><li>15 community development projects completed</li><li>5,000+ direct beneficiaries</li><li>12 new partnerships established</li><li>95% project success rate</li></ul><h3>Financial Highlights</h3><p>Total revenue: NPR 2,50,00,000<br>Program expenses: 85%<br>Administrative costs: 12%<br>Fundraising: 3%</p><h3>Looking Forward</h3><p>In the coming year, we plan to expand our reach and deepen our impact through strategic partnerships and innovative program delivery.</p>',
                'type' => 'annual',
                'category' => 'organizational',
                'fiscal_year' => '2024-2025',
                'report_date' => now()->subMonths(2),
                'period_start' => now()->subYear(),
                'period_end' => now()->subMonths(3),
                'author' => 'JIDS Nepal',
                'status' => 'published',
                'is_featured' => true,
                'is_public' => true,
                'sort_order' => 1,
                'published_at' => now()->subMonths(2),
            ],
            [
                'title' => 'Community Water Project Impact Assessment',
                'description' => 'Detailed assessment of our community water and sanitation project impact in rural Udayapur. This report evaluates the effectiveness of our WASH interventions and their long-term sustainability.',
                'executive_summary' => 'Our water and sanitation project has successfully provided clean drinking water access to 500 families and reduced waterborne diseases by 70% in target communities.',
                'content' => '<h2>Project Overview</h2><p>The Community Water Project was implemented to address critical water scarcity issues in remote villages of Udayapur district.</p><h3>Key Outcomes</h3><ul><li>500 families now have access to clean water</li><li>70% reduction in waterborne diseases</li><li>50% reduction in time spent collecting water</li><li>Improved school attendance, especially among girls</li></ul><h3>Methodology</h3><p>We conducted baseline and endline surveys to measure project impact. Data was collected through household surveys, focus group discussions, and key informant interviews.</p><h3>Sustainability Measures</h3><p>Community ownership and local capacity building have been central to ensuring project sustainability.</p>',
                'type' => 'project',
                'category' => 'impact',
                'fiscal_year' => '2024-2025',
                'report_date' => now()->subMonths(4),
                'period_start' => now()->subYear(),
                'period_end' => now()->subMonths(4),
                'author' => 'Project Team',
                'status' => 'published',
                'is_featured' => true,
                'is_public' => true,
                'sort_order' => 2,
                'published_at' => now()->subMonths(4),
            ],
            [
                'title' => 'Financial Transparency Report Q3 2024',
                'description' => 'Quarterly financial report providing detailed breakdown of income, expenditure, and fund utilization for the third quarter of 2024.',
                'executive_summary' => 'Q3 2024 saw strong financial performance with 88% of funds directed to program activities and maintaining healthy reserves for future projects.',
                'content' => '<h2>Financial Summary Q3 2024</h2><h3>Income</h3><ul><li>Grants and Donations: NPR 75,00,000</li><li>Government Funding: NPR 25,00,000</li><li>Partnership Contributions: NPR 15,00,000</li></ul><h3>Expenditure</h3><ul><li>Program Activities: NPR 88,00,000 (88%)</li><li>Administrative Costs: NPR 10,00,000 (10%)</li><li>Fundraising: NPR 2,00,000 (2%)</li></ul><h3>Fund Utilization</h3><p>Our commitment to transparency ensures that maximum resources reach the communities we serve.</p>',
                'type' => 'quarterly',
                'category' => 'financial',
                'fiscal_year' => '2024-2025',
                'report_date' => now()->subMonths(1),
                'period_start' => now()->subMonths(4),
                'period_end' => now()->subMonths(1),
                'author' => 'Finance Team',
                'status' => 'published',
                'is_featured' => false,
                'is_public' => true,
                'sort_order' => 3,
                'published_at' => now()->subMonths(1),
            ],
            [
                'title' => 'Education Program Monthly Update - August 2024',
                'description' => 'Monthly progress report on our education and scholarship programs, including student performance metrics and program expansion updates.',
                'executive_summary' => 'August 2024 marked significant progress in our education programs with 150 students supported through scholarships and tutorial programs.',
                'content' => '<h2>Education Program Highlights</h2><h3>Scholarship Program</h3><ul><li>150 students receiving scholarships</li><li>95% retention rate</li><li>Average grade improvement of 15%</li></ul><h3>Tutorial Centers</h3><ul><li>5 tutorial centers operational</li><li>200 students enrolled</li><li>20 volunteer teachers</li></ul><h3>Infrastructure Support</h3><ul><li>3 schools received learning materials</li><li>2 computer labs established</li><li>1 library renovated</li></ul>',
                'type' => 'monthly',
                'category' => 'program',
                'fiscal_year' => '2024-2025',
                'report_date' => now()->subMonth(),
                'period_start' => now()->subMonth()->startOfMonth(),
                'period_end' => now()->subMonth()->endOfMonth(),
                'author' => 'Education Team',
                'status' => 'published',
                'is_featured' => false,
                'is_public' => true,
                'sort_order' => 4,
                'published_at' => now()->subMonth(),
            ],
            [
                'title' => 'Climate Adaptation and Environmental Conservation Report',
                'description' => 'Comprehensive report on our environmental conservation initiatives and climate adaptation strategies implemented in partnership with local communities.',
                'executive_summary' => 'Our environmental programs have resulted in the plantation of 10,000 trees, establishment of 5 community forests, and training of 200 farmers in climate-smart agriculture.',
                'content' => '<h2>Environmental Impact</h2><h3>Reforestation Efforts</h3><ul><li>10,000 trees planted</li><li>90% survival rate</li><li>5 community forests established</li></ul><h3>Climate-Smart Agriculture</h3><ul><li>200 farmers trained</li><li>30% increase in crop yield</li><li>Reduced pesticide use by 40%</li></ul><h3>Waste Management</h3><ul><li>Community composting programs in 8 villages</li><li>Plastic reduction awareness campaigns</li><li>Clean-up drives covering 50 km of roads</li></ul>',
                'type' => 'impact',
                'category' => 'environmental',
                'fiscal_year' => '2024-2025',
                'report_date' => now()->subMonths(3),
                'period_start' => now()->subMonths(6),
                'period_end' => now()->subMonths(3),
                'author' => 'Environment Team',
                'status' => 'published',
                'is_featured' => true,
                'is_public' => true,
                'sort_order' => 5,
                'published_at' => now()->subMonths(3),
            ],
        ];

        foreach ($reports as $reportData) {
            $report = Report::create($reportData);
            $this->info("Created report: {$report->title}");
        }

        $this->info('Sample reports created successfully!');
        $this->info('Total reports in database: ' . Report::count());
        $this->info('Published reports: ' . Report::published()->count());
        $this->info('Featured reports: ' . Report::featured()->count());
    }
}
