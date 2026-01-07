<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statistics = [
            [
                'key' => 'lives_impacted',
                'label' => 'Lives Impacted',
                'value' => 1250,
                'icon' => 'fa-solid fa-heart',
                'color' => '#f39c12',
                'sort_order' => 1,
                'is_active' => true,
                'description' => 'Total number of lives directly impacted by our programs and initiatives.'
            ],
            [
                'key' => 'generous_donors',
                'label' => 'Generous Donors',
                'value' => 5,
                'icon' => 'fa-solid fa-hand-holding-heart',
                'color' => '#e74c3c',
                'sort_order' => 2,
                'is_active' => true,
                'description' => 'Number of generous donors supporting our mission.'
            ],
            [
                'key' => 'active_projects',
                'label' => 'Active Projects',
                'value' => 42,
                'icon' => 'fa-solid fa-project-diagram',
                'color' => '#3498db',
                'sort_order' => 3,
                'is_active' => true,
                'description' => 'Current active projects and programs running worldwide.'
            ],
            [
                'key' => 'countries_served',
                'label' => 'Countries Served',
                'value' => 15,
                'icon' => 'fa-solid fa-globe',
                'color' => '#27ae60',
                'sort_order' => 4,
                'is_active' => true,
                'description' => 'Number of countries where we have active programs and partnerships.'
            ]
        ];

        foreach ($statistics as $stat) {
            Statistic::updateOrCreate(
                ['key' => $stat['key']],
                $stat
            );
        }
    }
}
