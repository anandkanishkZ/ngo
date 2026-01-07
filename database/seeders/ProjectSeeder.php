<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            // Ongoing Projects
            [
                'title' => 'Education for All Initiative',
                'description' => 'Providing quality education access to underprivileged children in rural communities through mobile learning centers and digital literacy programs.',
                'detailed_description' => 'Our Education for All Initiative is a comprehensive program designed to bridge the educational gap in rural communities. Through innovative mobile learning centers equipped with digital tools and qualified teachers, we bring quality education directly to children who lack access to traditional schools. The program includes basic literacy, numeracy, digital skills, and life skills training. We also provide educational materials, school supplies, and nutritious meals to support holistic child development.',
                'status' => 'ongoing',
                'category' => 'education',
                'start_date' => '2024-01-15',
                'end_date' => null,
                'budget' => 150000.00,
                'funds_raised' => 98000.00,
                'location' => 'Rural Nepal',
                'beneficiaries' => 1200,
                'goals' => "1. Establish 5 mobile learning centers across remote villages\n2. Provide quality education to 1200+ children\n3. Train 50 local teachers in modern teaching methods\n4. Achieve 90% literacy rate in target communities\n5. Create sustainable educational infrastructure",
                'achievements' => "✓ 3 mobile learning centers successfully established\n✓ 850+ children currently enrolled in programs\n✓ 35 local teachers trained and certified\n✓ Digital literacy program implemented\n✓ Community engagement rate increased by 80%",
                'partners' => json_encode(['UNESCO', 'Local Education Department', 'Community Leaders']),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'slug' => Str::slug('Education for All Initiative')
            ],
            [
                'title' => 'Clean Water Access Project',
                'description' => 'Installing sustainable water filtration systems and building wells to provide clean drinking water to remote villages.',
                'detailed_description' => 'Access to clean water is a fundamental human right, yet millions lack this basic necessity. Our Clean Water Access Project focuses on implementing sustainable water solutions in remote communities. We install advanced filtration systems, build wells with solar-powered pumps, and establish water management committees to ensure long-term sustainability. The project also includes hygiene education and sanitation facility construction.',
                'status' => 'ongoing',
                'category' => 'healthcare',
                'start_date' => '2024-03-01',
                'end_date' => null,
                'budget' => 200000.00,
                'funds_raised' => 145000.00,
                'location' => 'Rural India',
                'beneficiaries' => 2500,
                'goals' => "1. Install 15 water filtration systems\n2. Build 8 community wells with solar pumps\n3. Train 100 community members in water management\n4. Reduce waterborne diseases by 70%\n5. Establish sustainable maintenance protocols",
                'achievements' => "✓ 10 water filtration systems installed and operational\n✓ 5 community wells constructed\n✓ 65 community members trained\n✓ Water quality testing program established\n✓ 40% reduction in waterborne illnesses reported",
                'partners' => json_encode(['WHO', 'Local Health Ministry', 'Engineering Corps']),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'slug' => Str::slug('Clean Water Access Project')
            ],
            [
                'title' => 'Sustainable Agriculture Training',
                'description' => 'Teaching modern farming techniques and providing resources to help farmers increase crop yields and income.',
                'detailed_description' => 'Our Sustainable Agriculture Training program empowers rural farmers with modern, eco-friendly farming techniques that increase productivity while preserving the environment. We provide training on crop rotation, organic farming, water conservation, and modern equipment usage. The program includes seed distribution, tool provision, and market linkage support to ensure farmers can sell their produce at fair prices.',
                'status' => 'ongoing',
                'category' => 'community',
                'start_date' => '2024-02-10',
                'end_date' => null,
                'budget' => 120000.00,
                'funds_raised' => 85000.00,
                'location' => 'Rural Bangladesh',
                'beneficiaries' => 800,
                'goals' => "1. Train 800 farmers in sustainable agriculture\n2. Increase crop yields by 40%\n3. Establish farmer cooperatives\n4. Create market linkage networks\n5. Promote organic farming practices",
                'achievements' => "✓ 520 farmers trained in sustainable practices\n✓ 25% increase in crop yields achieved\n✓ 3 farmer cooperatives established\n✓ Organic certification program launched\n✓ Direct market connections created",
                'partners' => json_encode(['Agriculture Ministry', 'Farmers Union', 'Organic Certification Body']),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
                'slug' => Str::slug('Sustainable Agriculture Training')
            ],
            
            // Completed Projects
            [
                'title' => 'Community Health Center Establishment',
                'description' => 'Successfully built and equipped a modern healthcare facility serving 5000+ community members with quality medical services.',
                'detailed_description' => 'The Community Health Center project was a flagship initiative to address healthcare accessibility in underserved regions. We constructed a state-of-the-art facility equipped with modern medical equipment, laboratory facilities, and emergency services. The center includes specialized departments for maternal health, pediatrics, and general medicine. We also trained local healthcare workers and established telemedicine connections with specialist doctors in urban centers.',
                'status' => 'completed',
                'category' => 'healthcare',
                'start_date' => '2022-06-15',
                'end_date' => '2023-12-20',
                'budget' => 300000.00,
                'funds_raised' => 300000.00,
                'location' => 'Rural Kenya',
                'beneficiaries' => 5200,
                'goals' => "1. Construct fully equipped healthcare facility\n2. Train 25 local healthcare workers\n3. Establish emergency medical services\n4. Provide maternal and child health services\n5. Create telemedicine connectivity",
                'achievements' => "✓ Modern healthcare facility completed and operational\n✓ 28 healthcare workers trained and certified\n✓ 24/7 emergency services established\n✓ 1200+ successful deliveries facilitated\n✓ 15,000+ patients treated in first year\n✓ Telemedicine network connecting 3 specialist hospitals\n✓ 60% reduction in maternal mortality rate",
                'partners' => json_encode(['Ministry of Health', 'Medical Equipment Suppliers', 'International Medical Corps']),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'slug' => Str::slug('Community Health Center Establishment')
            ],
            [
                'title' => 'Solar Energy for Schools Program',
                'description' => 'Installed solar power systems in 20 rural schools, providing reliable electricity for better learning environments.',
                'detailed_description' => 'The Solar Energy for Schools Program brought renewable energy solutions to remote educational institutions lacking reliable electricity. We installed comprehensive solar power systems including panels, batteries, and inverters to ensure consistent power supply. The project also included LED lighting installation, computer labs setup, and training for teachers on using digital educational tools.',
                'status' => 'completed',
                'category' => 'education',
                'start_date' => '2022-01-10',
                'end_date' => '2023-08-30',
                'budget' => 180000.00,
                'funds_raised' => 180000.00,
                'location' => 'Rural Philippines',
                'beneficiaries' => 3000,
                'goals' => "1. Install solar systems in 20 schools\n2. Provide reliable electricity for educational activities\n3. Set up computer labs and digital learning tools\n4. Train teachers in technology integration\n5. Create sustainable energy maintenance protocols",
                'achievements' => "✓ 20 schools fully powered by solar energy\n✓ 15 computer labs established and operational\n✓ 120 teachers trained in digital education tools\n✓ 100% improvement in study hours and productivity\n✓ Environmental education programs launched\n✓ 95% reduction in energy costs for schools\n✓ Model replicated in 5 additional regions",
                'partners' => json_encode(['Department of Education', 'Solar Technology Companies', 'Local Governments']),
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'slug' => Str::slug('Solar Energy for Schools Program')
            ],
            [
                'title' => 'Women Empowerment Microfinance',
                'description' => 'Provided microfinance opportunities to 500 women entrepreneurs, helping them start successful small businesses.',
                'detailed_description' => 'The Women Empowerment Microfinance project was designed to economically empower women in rural communities through access to capital and business training. We provided small loans, business development training, and ongoing mentorship to help women start and grow sustainable enterprises. The program included financial literacy education and market access support.',
                'status' => 'completed',
                'category' => 'community',
                'start_date' => '2021-09-15',
                'end_date' => '2023-06-30',
                'budget' => 250000.00,
                'funds_raised' => 250000.00,
                'location' => 'Rural Guatemala',
                'beneficiaries' => 500,
                'goals' => "1. Provide microfinance to 500 women\n2. Conduct business training workshops\n3. Establish women's business cooperatives\n4. Create market linkage opportunities\n5. Achieve 80% loan repayment rate",
                'achievements' => "✓ 500 women received microfinance loans\n✓ 15 business training workshops conducted\n✓ 8 women's cooperatives established\n✓ 420 successful small businesses launched\n✓ 92% loan repayment rate achieved\n✓ Average income increase of 150%\n✓ 1200 family members indirectly benefited",
                'partners' => json_encode(['Women\'s Development Bank', 'Business Training Institute', 'Local Cooperatives']),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
                'slug' => Str::slug('Women Empowerment Microfinance')
            ],
            [
                'title' => 'Reforestation and Climate Action',
                'description' => 'Successfully planted 50,000 trees and established forest conservation programs in degraded areas.',
                'detailed_description' => 'Our Reforestation and Climate Action project addressed environmental degradation and climate change through large-scale tree planting and forest conservation initiatives. We worked with local communities to plant native species, establish tree nurseries, and create sustainable forest management practices. The project included environmental education and livelihood alternatives for forest-dependent communities.',
                'status' => 'completed',
                'category' => 'environment',
                'start_date' => '2021-03-20',
                'end_date' => '2023-03-20',
                'budget' => 100000.00,
                'funds_raised' => 100000.00,
                'location' => 'Highland Ecuador',
                'beneficiaries' => 2000,
                'goals' => "1. Plant 50,000 native trees\n2. Establish 10 community tree nurseries\n3. Train local communities in forest management\n4. Create alternative livelihood programs\n5. Achieve 85% tree survival rate",
                'achievements' => "✓ 52,000 trees planted with 88% survival rate\n✓ 12 community nurseries established\n✓ 150 community members trained as forest guardians\n✓ 25 alternative livelihood programs created\n✓ 300 hectares of degraded land restored\n✓ Carbon sequestration of 2,500 tons achieved\n✓ Biodiversity restoration in 5 critical areas",
                'partners' => json_encode(['Forest Department', 'Environmental NGOs', 'Indigenous Communities']),
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
                'slug' => Str::slug('Reforestation and Climate Action')
            ]
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }
    }
}
