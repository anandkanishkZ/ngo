<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Project;
use App\Models\Report;
use App\Models\GalleryPhoto;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= view('sitemap.index')->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function pages()
    {
        $pages = [
            [
                'url' => route('home'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '1.0'
            ],
            [
                'url' => route('about'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('team'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'url' => route('impact-areas.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.9'
            ],
            [
                'url' => route('projects.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.9'
            ],
            [
                'url' => route('projects.ongoing'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'url' => route('projects.completed'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'url' => route('notices.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'daily',
                'priority' => '0.8'
            ],
            [
                'url' => route('acts-policy.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.7'
            ],
            [
                'url' => route('reports.index'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'url' => route('gallery.photos'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ],
            [
                'url' => route('gallery.videos'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.7'
            ],
            [
                'url' => route('careers.vacancy'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8'
            ],
            [
                'url' => route('contact'),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.6'
            ],
        ];

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= view('sitemap.pages', compact('pages'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function notices()
    {
        $notices = Notice::where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= view('sitemap.notices', compact('notices'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function projects()
    {
        $projects = Project::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= view('sitemap.projects', compact('projects'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function reports()
    {
        $reports = Report::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= view('sitemap.reports', compact('reports'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function gallery()
    {
        $photos = GalleryPhoto::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= view('sitemap.gallery', compact('photos'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function vacancies()
    {
        $vacancies = Vacancy::where('status', 'published')
            ->where('deadline', '>=', now())
            ->orderBy('updated_at', 'desc')
            ->get();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $content .= view('sitemap.vacancies', compact('vacancies'))->render();
        
        return response($content, 200)
            ->header('Content-Type', 'text/xml');
    }
}
