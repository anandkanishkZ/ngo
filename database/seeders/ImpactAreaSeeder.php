<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImpactArea;

class ImpactAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $impactAreas = [
            [
                'title' => 'Child Protection',
                'description' => 'JIDS works to safeguard children from abuse, neglect, exploitation, and violence while promoting their rights, participation, and well-being.',
                'icon' => 'fa-solid fa-shield-alt',
                'color' => '#e74c3c',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Education',
                'description' => 'The organization supports access to quality, inclusive education to enhance learning outcomes and reduce disparities among marginalized children.',
                'icon' => 'fa-solid fa-graduation-cap',
                'color' => '#3498db',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Health',
                'description' => 'JIDS promotes improved health and nutrition practices to ensure the physical and mental well-being of children, families, and communities.',
                'icon' => 'fa-solid fa-heartbeat',
                'color' => '#27ae60',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Water, Sanitation, and Hygiene (WASH)',
                'description' => 'JIDS improves access to safe drinking water, sanitation facilities, and hygiene practices to enhance public health and dignity.',
                'icon' => 'fa-solid fa-tint',
                'color' => '#1abc9c',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Livelihoods',
                'description' => 'The organization strengthens sustainable livelihood opportunities to increase household income, resilience, and economic security for vulnerable families.',
                'icon' => 'fa-solid fa-coins',
                'color' => '#f39c12',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'title' => 'Disaster Risk Reduction (DRR)',
                'description' => 'JIDS works to reduce community vulnerability to disasters by strengthening preparedness, mitigation, and resilience against natural and climate-induced hazards.',
                'icon' => 'fa-solid fa-exclamation-triangle',
                'color' => '#e67e22',
                'sort_order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($impactAreas as $area) {
            ImpactArea::updateOrCreate(
                ['title' => $area['title']],
                $area
            );
        }
    }
}
