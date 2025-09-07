<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ContactMessage;
use App\Models\Newsletter;
use App\Models\Report;
use App\Models\Notice;
use App\Models\Partner;
use App\Models\TeamMember;
use App\Models\HeroSlide;
use App\Models\ImpactArea;
use App\Models\Statistic;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Real-time statistics
        $stats = [
            'contact_messages' => [
                'total' => ContactMessage::count(),
                'unread' => ContactMessage::unread()->count(),
                'today' => ContactMessage::whereDate('created_at', today())->count(),
                'this_week' => ContactMessage::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'growth' => $this->calculateGrowth(ContactMessage::class, 'monthly')
            ],
            'newsletter_subscribers' => [
                'total' => Newsletter::count(),
                'verified' => Newsletter::where('is_active', true)->count(),
                'today' => Newsletter::whereDate('created_at', today())->count(),
                'this_week' => Newsletter::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'growth' => $this->calculateGrowth(Newsletter::class, 'monthly')
            ],
            'reports' => [
                'total' => Report::count(),
                'published' => Report::where('status', 'published')->count(),
                'draft' => Report::where('status', 'draft')->count(),
                'this_month' => Report::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count(),
                'growth' => $this->calculateGrowth(Report::class, 'monthly')
            ],
            'content' => [
                'notices' => Notice::where('is_active', true)->count(),
                'partners' => Partner::count(),
                'team_members' => TeamMember::where('is_active', true)->count(),
                'hero_slides' => HeroSlide::where('is_active', true)->count(),
                'impact_areas' => ImpactArea::count()
            ]
        ];

        // Recent activities
        $recentActivities = $this->getRecentActivities();
        
        // Recent unread messages
        $recentMessages = ContactMessage::unread()
            ->with([])
            ->latest()
            ->limit(5)
            ->get();
        
        // Chart data
        $chartData = [
            'contact_messages' => $this->getChartData(ContactMessage::class, 'created_at'),
            'newsletter_signups' => $this->getChartData(Newsletter::class, 'created_at'),
            'reports' => $this->getChartData(Report::class, 'created_at')
        ];

        // Performance metrics
        $performance = [
            'response_rate' => $this->calculateResponseRate(),
            'engagement_score' => $this->calculateEngagementScore(),
            'content_health' => $this->calculateContentHealth()
        ];

        return view('dashboard.index', compact(
            'user', 
            'stats', 
            'recentMessages', 
            'recentActivities', 
            'chartData', 
            'performance'
        ));
    }

    private function calculateGrowth($model, $period = 'monthly', $dateColumn = 'created_at')
    {
        $current = $model::whereBetween($dateColumn, $this->getPeriodRange($period))->count();
        $previous = $model::whereBetween($dateColumn, $this->getPreviousPeriodRange($period))->count();
        
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return round((($current - $previous) / $previous) * 100, 1);
    }

    private function getPeriodRange($period)
    {
        switch ($period) {
            case 'daily':
                return [now()->startOfDay(), now()->endOfDay()];
            case 'weekly':
                return [now()->startOfWeek(), now()->endOfWeek()];
            case 'monthly':
                return [now()->startOfMonth(), now()->endOfMonth()];
            default:
                return [now()->startOfMonth(), now()->endOfMonth()];
        }
    }

    private function getPreviousPeriodRange($period)
    {
        switch ($period) {
            case 'daily':
                return [now()->subDay()->startOfDay(), now()->subDay()->endOfDay()];
            case 'weekly':
                return [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()];
            case 'monthly':
                return [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()];
            default:
                return [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()];
        }
    }

    private function getChartData($model, $dateColumn, $days = 30)
    {
        $data = [];
        $labels = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('M d');
            $count = $model::whereDate($dateColumn, $date)->count();
            $data[] = $count;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getRecentActivities()
    {
        $activities = collect();

        // Recent contact messages
        ContactMessage::latest()->limit(3)->get()->each(function($message) use ($activities) {
            $activities->push([
                'type' => 'contact_message',
                'title' => 'New contact message from ' . $message->name,
                'description' => 'Subject: ' . $message->subject,
                'time' => $message->created_at,
                'icon' => 'fas fa-envelope',
                'color' => 'primary',
                'url' => route('dashboard.contact-messages.show', $message)
            ]);
        });

        // Recent newsletter signups
        Newsletter::latest()->limit(2)->get()->each(function($subscriber) use ($activities) {
            $activities->push([
                'type' => 'newsletter_signup',
                'title' => 'New newsletter subscription',
                'description' => $subscriber->email,
                'time' => $subscriber->created_at,
                'icon' => 'fas fa-user-plus',
                'color' => 'success',
                'url' => route('dashboard.newsletters.index')
            ]);
        });

        // Recent reports
        Report::latest()->limit(2)->get()->each(function($report) use ($activities) {
            $activities->push([
                'type' => 'report',
                'title' => 'Report: ' . $report->title,
                'description' => 'Status: ' . ucfirst($report->status),
                'time' => $report->created_at,
                'icon' => 'fas fa-file-alt',
                'color' => 'info',
                'url' => route('dashboard.reports.show', $report)
            ]);
        });

        return $activities->sortByDesc('time')->take(8)->values();
    }

    private function calculateResponseRate()
    {
        $totalMessages = ContactMessage::count();
        $repliedMessages = ContactMessage::where('status', 'replied')->count();
        
        return $totalMessages > 0 ? round(($repliedMessages / $totalMessages) * 100, 1) : 0;
    }

    private function calculateEngagementScore()
    {
        $totalSubscribers = Newsletter::count();
        $verifiedSubscribers = Newsletter::where('is_active', true)->count();
        
        return $totalSubscribers > 0 ? round(($verifiedSubscribers / $totalSubscribers) * 100, 1) : 0;
    }

    private function calculateContentHealth()
    {
        $activeContent = 0;
        $totalContent = 0;

        // Check various content types
        $contentTypes = [
            ['model' => Notice::class, 'active_field' => 'is_active'],
            ['model' => HeroSlide::class, 'active_field' => 'is_active'],
            ['model' => TeamMember::class, 'active_field' => 'is_active']
        ];

        foreach ($contentTypes as $type) {
            $total = $type['model']::count();
            $active = $type['model']::where($type['active_field'], true)->count();
            
            $totalContent += $total;
            $activeContent += $active;
        }

        return $totalContent > 0 ? round(($activeContent / $totalContent) * 100, 1) : 100;
    }
}
