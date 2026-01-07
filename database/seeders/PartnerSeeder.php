<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing partners
        Partner::truncate();

        // Get the three images we have
        $images = [
            'partners/EAkVNGTZ3djVRm4h6E3DX9VgdY6PpU6mnMK2Yn5R.png',
            'partners/IxHeSsYzn7U92TXJIOA0rdQTFtLEY7hOd5S0c8YD.webp',
            'partners/Q3jKwK6hRZZAelsm3GMZJTUrhpn0ooN3cbT6gja3.png',
        ];

        Partner::create([
            'name' => 'World Vision International',
            'logo' => $images[0],
            'website_url' => 'https://www.worldvision.org',
            'description' => 'Global humanitarian organization dedicated to working with children, families, and communities to overcome poverty and injustice.',
            'background_color' => '#ffffff',
            'featured' => true,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'UNICEF',
            'logo' => $images[1],
            'website_url' => 'https://www.unicef.org',
            'description' => 'United Nations Children\'s Fund working for the rights and wellbeing of every child.',
            'background_color' => '#ffffff',
            'featured' => true,
            'is_active' => true,
        ]);

        Partner::create([
            'name' => 'UNESCO',
            'logo' => $images[2],
            'website_url' => 'https://www.unesco.org',
            'description' => 'Building peace through education, culture, and science.',
            'background_color' => '#ffffff',
            'featured' => false,
            'is_active' => true,
        ]);

        echo "Partners seeded successfully!\n";
    }
}
