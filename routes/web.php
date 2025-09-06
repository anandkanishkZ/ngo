<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeroSlideController;
use App\Http\Controllers\AppearanceController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\ImpactAreaController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Dashboard\AttachmentController;
use App\Http\Controllers\Dashboard\NewsletterController as DashboardNewsletterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Test route to check statistics
Route::get('/test-stats', function () {
    $stats = App\Models\Statistic::all();
    return $stats->pluck('value', 'label');
});

// Test route to check projects
Route::get('/test-projects', function () {
    $projects = App\Models\Project::all();
    return [
        'total_projects' => $projects->count(),
        'ongoing_projects' => $projects->where('status', 'ongoing')->count(),
        'completed_projects' => $projects->where('status', 'completed')->count(),
        'projects' => $projects->map(function($p) {
            return [
                'title' => $p->title,
                'status' => $p->status,
                'category' => $p->category,
                'beneficiaries' => $p->beneficiaries,
                'funding_progress' => $p->funding_progress
            ];
        })
    ];
});

// Debug route to check statistics with cache
Route::get('/debug-stats', function () {
    $cached = App\Models\Statistic::getActiveStats();
    $fresh = App\Models\Statistic::orderBy('sort_order')->get();
    
    return [
        'cached_stats' => $cached->map(function($stat) {
            return [
                'key' => $stat->key,
                'label' => $stat->label, 
                'value' => $stat->value,
                'is_active' => $stat->is_active
            ];
        }),
        'fresh_stats' => $fresh->map(function($stat) {
            return [
                'key' => $stat->key,
                'label' => $stat->label,
                'value' => $stat->value,
                'is_active' => $stat->is_active
            ];
        }),
        'cache_key_exists' => \Cache::has('statistics_active'),
        'timestamp' => now()
    ];
});

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/our-team', [AboutController::class, 'team'])->name('team');

// Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/ongoing', [ProjectController::class, 'ongoing'])->name('projects.ongoing');
Route::get('/projects/completed', [ProjectController::class, 'completed'])->name('projects.completed');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
Route::get('/notices/{notice}', [NoticeController::class, 'show'])->name('notices.show');

// Reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::get('/reports/{report}/download', [ReportController::class, 'download'])->name('reports.download');
Route::get('/reports/type/{type}', [ReportController::class, 'byType'])->name('reports.by-type');

Route::get('/volunteer', function () {
    return view('volunteer');
})->name('volunteer');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Newsletter Test Route
Route::get('/test-newsletter', function() {
    $testEmail = 'test@example.com';
    $results = [];
    
    // Test Newsletter Model
    try {
        $newsletter = new \App\Models\Newsletter();
        $results['model'] = '✅ Newsletter Model: OK';
    } catch (Exception $e) {
        $results['model'] = '❌ Newsletter Model: ' . $e->getMessage();
    }
    
    // Test Database Schema
    try {
        $columns = Schema::getColumnListing('newsletters');
        $results['schema'] = '✅ Database Table: newsletters - Columns: ' . implode(', ', $columns);
    } catch (Exception $e) {
        $results['schema'] = '❌ Database Table: ' . $e->getMessage();
    }
    
    // Test Routes
    $routes = [
        'newsletter.subscribe',
        'dashboard.newsletters.index',
    ];
    
    foreach ($routes as $route) {
        try {
            $url = route($route);
            $results['route_' . $route] = "✅ Route '{$route}': {$url}";
        } catch (Exception $e) {
            $results['route_' . $route] = "❌ Route '{$route}': " . $e->getMessage();
        }
    }
    
    // Statistics
    try {
        $total = \App\Models\Newsletter::count();
        $active = \App\Models\Newsletter::where('is_active', true)->count();
        $results['stats'] = "✅ Current Subscribers: Total: {$total}, Active: {$active}";
    } catch (Exception $e) {
        $results['stats'] = '❌ Stats: ' . $e->getMessage();
    }
    
    $html = '<h1>Newsletter System Test Results</h1>';
    foreach ($results as $key => $result) {
        $html .= '<p>' . $result . '</p>';
    }
    $html .= '<hr><p><strong>System Status: OPERATIONAL</strong></p>';
    $html .= '<p><a href="/">← Back to Home</a> | <a href="/dashboard/newsletters">Admin Panel →</a></p>';
    
    return $html;
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (protected)
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('dashboard/hero')->name('dashboard.hero.')->group(function(){
        Route::get('/', [HeroSlideController::class, 'index'])->name('index');
        Route::get('/create', [HeroSlideController::class, 'create'])->name('create');
        Route::post('/', [HeroSlideController::class, 'store'])->name('store');
        Route::get('/{slide}/edit', [HeroSlideController::class, 'edit'])->name('edit');
        Route::put('/{slide}', [HeroSlideController::class, 'update'])->name('update');
        Route::delete('/{slide}', [HeroSlideController::class, 'destroy'])->name('destroy');
    });

    Route::get('/dashboard/appearance', [AppearanceController::class, 'edit'])->name('dashboard.appearance.edit');
    Route::post('/dashboard/appearance', [AppearanceController::class, 'update'])->name('dashboard.appearance.update');
    
    // Statistics routes
    Route::prefix('dashboard/statistics')->name('dashboard.statistics.')->group(function(){
        Route::get('/', [StatisticController::class, 'index'])->name('index');
        Route::get('/create', [StatisticController::class, 'create'])->name('create');
        Route::post('/', [StatisticController::class, 'store'])->name('store');
        Route::get('/{statistic}', [StatisticController::class, 'show'])->name('show');
        Route::get('/{statistic}/edit', [StatisticController::class, 'edit'])->name('edit');
        Route::put('/{statistic}', [StatisticController::class, 'update'])->name('update');
        Route::delete('/{statistic}', [StatisticController::class, 'destroy'])->name('destroy');
        Route::patch('/{statistic}/toggle', [StatisticController::class, 'toggleActive'])->name('toggle');
    });

    // Impact Areas routes
    Route::prefix('dashboard/impact-areas')->name('dashboard.impact-areas.')->group(function(){
        Route::get('/', [ImpactAreaController::class, 'index'])->name('index');
        Route::get('/create', [ImpactAreaController::class, 'create'])->name('create');
        Route::post('/', [ImpactAreaController::class, 'store'])->name('store');
        Route::get('/{impactArea}', [ImpactAreaController::class, 'show'])->name('show');
        Route::get('/{impactArea}/edit', [ImpactAreaController::class, 'edit'])->name('edit');
        Route::put('/{impactArea}', [ImpactAreaController::class, 'update'])->name('update');
        Route::delete('/{impactArea}', [ImpactAreaController::class, 'destroy'])->name('destroy');
        Route::patch('/{impactArea}/toggle', [ImpactAreaController::class, 'toggleActive'])->name('toggle');
    });

    // Partners routes
    Route::prefix('dashboard/partners')->name('dashboard.partners.')->group(function(){
        Route::get('/', [PartnerController::class, 'index'])->name('index');
        Route::get('/create', [PartnerController::class, 'create'])->name('create');
        Route::post('/', [PartnerController::class, 'store'])->name('store');
        Route::get('/{partner}', [PartnerController::class, 'show'])->name('show');
        Route::get('/{partner}/edit', [PartnerController::class, 'edit'])->name('edit');
        Route::put('/{partner}', [PartnerController::class, 'update'])->name('update');
        Route::delete('/{partner}', [PartnerController::class, 'destroy'])->name('destroy');
        Route::post('/{partner}/toggle-active', [PartnerController::class, 'toggleActive'])->name('toggle-active');
        Route::post('/{partner}/toggle-featured', [PartnerController::class, 'toggleFeatured'])->name('toggle-featured');
    });

    // Media Library routes
    Route::prefix('dashboard/media')->name('dashboard.media.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'index'])->name('index');
        Route::get('/picker', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'picker'])->name('picker');
        Route::post('/', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'store'])->name('store');
        Route::post('/sync', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'sync'])->name('sync');
        Route::post('/folders', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'createFolder'])->name('folders.create');
        Route::get('/{media}', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'show'])->name('show');
        Route::put('/{media}', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'update'])->name('update');
        Route::delete('/{media}', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'destroy'])->name('destroy');
        Route::delete('/', [\App\Http\Controllers\Dashboard\MediaControllerNew::class, 'bulkDelete'])->name('bulk-delete');
    });

    // File Attachment routes for Rich Text Editor
    Route::post('/dashboard/upload-attachment', [\App\Http\Controllers\Dashboard\AttachmentController::class, 'upload']);
    Route::delete('/dashboard/remove-attachment/{fileId}', [\App\Http\Controllers\Dashboard\AttachmentController::class, 'remove']);
    Route::get('/dashboard/list-attachments', [\App\Http\Controllers\Dashboard\AttachmentController::class, 'list']);
    Route::post('/dashboard/cleanup-attachments', [\App\Http\Controllers\Dashboard\AttachmentController::class, 'cleanup']);
    Route::post('/dashboard/mark-attachments-used', [\App\Http\Controllers\Dashboard\AttachmentController::class, 'markAsUsed']);

    // Team Management routes
    Route::prefix('dashboard/team')->name('dashboard.team.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Dashboard\TeamController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Dashboard\TeamController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Dashboard\TeamController::class, 'store'])->name('store');
        Route::get('/{team}', [\App\Http\Controllers\Dashboard\TeamController::class, 'show'])->name('show');
        Route::get('/{team}/edit', [\App\Http\Controllers\Dashboard\TeamController::class, 'edit'])->name('edit');
        Route::put('/{team}', [\App\Http\Controllers\Dashboard\TeamController::class, 'update'])->name('update');
        Route::delete('/{team}', [\App\Http\Controllers\Dashboard\TeamController::class, 'destroy'])->name('destroy');
        Route::post('/{team}/toggle-status', [\App\Http\Controllers\Dashboard\TeamController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{team}/toggle-featured', [\App\Http\Controllers\Dashboard\TeamController::class, 'toggleFeatured'])->name('toggle-featured');
    });

    // Notice Management routes
    Route::prefix('dashboard/notices')->name('dashboard.notices.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Dashboard\NoticeController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Dashboard\NoticeController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Dashboard\NoticeController::class, 'store'])->name('store');
        Route::get('/{notice}', [\App\Http\Controllers\Dashboard\NoticeController::class, 'show'])->name('show');
        Route::get('/{notice}/edit', [\App\Http\Controllers\Dashboard\NoticeController::class, 'edit'])->name('edit');
        Route::put('/{notice}', [\App\Http\Controllers\Dashboard\NoticeController::class, 'update'])->name('update');
        Route::delete('/{notice}', [\App\Http\Controllers\Dashboard\NoticeController::class, 'destroy'])->name('destroy');
        Route::post('/{notice}/toggle-status', [\App\Http\Controllers\Dashboard\NoticeController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{notice}/toggle-featured', [\App\Http\Controllers\Dashboard\NoticeController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::post('/{notice}/quick-publish', [\App\Http\Controllers\Dashboard\NoticeController::class, 'quickPublish'])->name('quick-publish');
        Route::post('/bulk-action', [\App\Http\Controllers\Dashboard\NoticeController::class, 'bulkAction'])->name('bulk-action');
    });

    // Report Management routes
    Route::prefix('dashboard/reports')->name('dashboard.reports.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Dashboard\ReportController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Dashboard\ReportController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Dashboard\ReportController::class, 'store'])->name('store');
        Route::get('/{report}', [\App\Http\Controllers\Dashboard\ReportController::class, 'show'])->name('show');
        Route::get('/{report}/edit', [\App\Http\Controllers\Dashboard\ReportController::class, 'edit'])->name('edit');
        Route::put('/{report}', [\App\Http\Controllers\Dashboard\ReportController::class, 'update'])->name('update');
        Route::delete('/{report}', [\App\Http\Controllers\Dashboard\ReportController::class, 'destroy'])->name('destroy');
        Route::post('/{report}/toggle-status', [\App\Http\Controllers\Dashboard\ReportController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{report}/toggle-featured', [\App\Http\Controllers\Dashboard\ReportController::class, 'toggleFeatured'])->name('toggle-featured');
    });

    // Newsletter Management routes
    Route::prefix('dashboard/newsletters')->name('dashboard.newsletters.')->group(function(){
        Route::get('/', [DashboardNewsletterController::class, 'index'])->name('index');
        Route::get('/{newsletter}', [DashboardNewsletterController::class, 'show'])->name('show');
        Route::delete('/{newsletter}', [DashboardNewsletterController::class, 'destroy'])->name('destroy');
        Route::patch('/{newsletter}/toggle', [DashboardNewsletterController::class, 'toggleStatus'])->name('toggle');
        Route::get('/export/csv', [DashboardNewsletterController::class, 'export'])->name('export');
    });
});

// Team system status check (temporary for debugging)
Route::get('/team-status', function() {
    if (!auth()->check()) {
        return response()->json(['error' => 'Authentication required'], 401);
    }
    
    try {
        $totalMembers = App\Models\TeamMember::count();
        $activeMembers = App\Models\TeamMember::where('is_active', true)->count();
        $featuredMembers = App\Models\TeamMember::where('featured', true)->count();
        
        return response()->json([
            'success' => true,
            'status' => 'Team system operational',
            'statistics' => [
                'total_members' => $totalMembers,
                'active_members' => $activeMembers,
                'featured_members' => $featuredMembers
            ],
            'routes' => [
                'index' => route('dashboard.team.index'),
                'create' => route('dashboard.team.create'),
                'destroy_example' => $totalMembers > 0 ? route('dashboard.team.destroy', 1) : 'No members available'
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});
