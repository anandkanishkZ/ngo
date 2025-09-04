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
                'title' => 'Education',
                'description' => 'Providing quality education and learning opportunities to underserved communities, building brighter futures for children worldwide.',
                'icon' => 'fa-solid fa-graduation-cap',
                'color' => '#3498db',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Healthcare', 
                'description' => 'Delivering essential medical care and health education to communities lacking access to basic healthcare services.',
                'icon' => 'fa-solid fa-heartbeat',
                'color' => '#e74c3c',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Environment',
                'description' => 'Protecting our planet through conservation efforts, sustainable practices, and environmental education programs.',
                'icon' => 'fa-solid fa-leaf',
                'color' => '#27ae60',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Housing',
                'description' => 'Building safe, affordable housing solutions and supporting families in creating stable, secure homes.',
                'icon' => 'fa-solid fa-home',
                'color' => '#17a2b8',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Nutrition',
                'description' => 'Fighting hunger and malnutrition by providing nutritious meals and teaching sustainable food production methods.',
                'icon' => 'fa-solid fa-utensils',
                'color' => '#f39c12',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'title' => 'Community',
                'description' => 'Strengthening communities through capacity building, leadership development, and collaborative partnerships.',
                'icon' => 'fa-solid fa-users',
                'color' => '#6c757d',
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
