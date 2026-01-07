<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing hero slides
        HeroSlide::truncate();

        // Create hero slides with professional content
        HeroSlide::create([
            'title' => 'Inclusive Growth, Lasting Impact',
            'subtitle' => 'Fostering resilience and equity by transforming the lives of those most vulnerable in our society.',
            'title_color' => '#ffffff',
            'subtitle_color' => '#f8f9fa',
            'title_size' => '3.8rem',
            'subtitle_size' => '1.4rem',
            'button1_text' => 'Get Involved',
            'button1_url' => '/contact',
            'button1_style' => 'primary',
            'button2_text' => 'Learn More',
            'button2_url' => '/about',
            'button2_style' => 'outline',
            'bg_image' => null, // Will be uploaded via admin
            'overlay_from' => '#1a202c',
            'overlay_to' => '#2d3748',
            'overlay_opacity' => 0.75,
            'content_x' => 'left',
            'content_y' => 'center',
            'is_active' => true,
            'position' => 1,
        ]);

        HeroSlide::create([
            'title' => 'Making a Difference Together',
            'subtitle' => 'Join us in creating positive change in communities around the world through compassion, dedication, and meaningful action.',
            'title_color' => '#ffffff',
            'subtitle_color' => '#f8f9fa',
            'title_size' => '3.5rem',
            'subtitle_size' => '1.25rem',
            'button1_text' => 'Donate Now',
            'button1_url' => '/donate',
            'button1_style' => 'primary',
            'button2_text' => 'Our Impact',
            'button2_url' => '/about',
            'button2_style' => 'outline',
            'bg_image' => null,
            'overlay_from' => '#2c3e50',
            'overlay_to' => '#e74c3c',
            'overlay_opacity' => 0.55,
            'content_x' => 'center',
            'content_y' => 'center',
            'is_active' => true,
            'position' => 2,
        ]);

        HeroSlide::create([
            'title' => 'Empowering Communities Worldwide',
            'subtitle' => 'Through education, healthcare, and sustainable development, we build stronger communities for a brighter future.',
            'title_color' => '#ffffff',
            'subtitle_color' => '#e2e8f0',
            'title_size' => '3.2rem',
            'subtitle_size' => '1.3rem',
            'button1_text' => 'See Our Work',
            'button1_url' => '/about',
            'button1_style' => 'primary',
            'button2_text' => 'Support Us',
            'button2_url' => '/donate',
            'button2_style' => 'outline',
            'bg_image' => null,
            'overlay_from' => '#4c1d95',
            'overlay_to' => '#7c3aed',
            'overlay_opacity' => 0.65,
            'content_x' => 'right',
            'content_y' => 'center',
            'is_active' => true,
            'position' => 3,
        ]);

        HeroSlide::create([
            'title' => 'Every Action Counts',
            'subtitle' => 'Small acts of kindness create ripples of change. Be part of our mission to transform lives and build hope.',
            'title_color' => '#ffffff',
            'subtitle_color' => '#cbd5e0',
            'title_size' => '3.6rem',
            'subtitle_size' => '1.35rem',
            'button1_text' => 'Take Action',
            'button1_url' => '/contact',
            'button1_style' => 'primary',
            'button2_text' => 'Contact Us',
            'button2_url' => '/contact',
            'button2_style' => 'outline',
            'bg_image' => null,
            'overlay_from' => '#065f46',
            'overlay_to' => '#047857',
            'overlay_opacity' => 0.70,
            'content_x' => 'left',
            'content_y' => 'center',
            'is_active' => true,
            'position' => 4,
        ]);
    }
}
