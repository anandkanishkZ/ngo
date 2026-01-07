<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
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
use App\Http\Controllers\ImpactStoryController;
use App\Http\Controllers\ActsPolicyController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Dashboard\AttachmentController;
use App\Http\Controllers\Dashboard\NewsletterController as DashboardNewsletterController;
use App\Http\Controllers\Dashboard\ContactMessageController;

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


Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/our-team', [AboutController::class, 'team'])->name('team');

// Thematic Areas (Impact Areas public page)
Route::get('/thematic-areas', [ImpactAreaController::class, 'publicIndex'])->name('impact-areas.index');

// Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/ongoing', [ProjectController::class, 'ongoing'])->name('projects.ongoing');
Route::get('/projects/completed', [ProjectController::class, 'completed'])->name('projects.completed');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

// Events removed from the site

// Impact Stories
Route::get('/impact-stories', [ImpactStoryController::class, 'index'])->name('impact-stories.index');
Route::get('/impact-stories/{story}', [ImpactStoryController::class, 'show'])->name('impact-stories.show');

// Notices
Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
Route::get('/notices/{notice}', [NoticeController::class, 'show'])->name('notices.show');

// Acts/Policy
Route::get('/acts-policy', [ActsPolicyController::class, 'index'])->name('acts-policy.index');
Route::get('/acts-policy/{id}', [ActsPolicyController::class, 'show'])->name('acts-policy.show');

// Reports
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::get('/reports/{report}/download', [ReportController::class, 'download'])->name('reports.download');
Route::get('/reports/type/{type}', [ReportController::class, 'byType'])->name('reports.by-type');

// Gallery
Route::get('/gallery/photos', [GalleryController::class, 'photos'])->name('gallery.photos');
Route::get('/gallery/photos/{id}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/gallery/videos', [GalleryController::class, 'videos'])->name('gallery.videos');

// Careers
Route::get('/careers/vacancy', [CareerController::class, 'vacancy'])->name('careers.vacancy');
Route::get('/careers/{id}', [CareerController::class, 'show'])->name('careers.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');
Route::post('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');


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

    // Vacancy Management routes
    Route::prefix('dashboard/vacancies')->name('dashboard.vacancies.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Dashboard\VacancyController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Dashboard\VacancyController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Dashboard\VacancyController::class, 'store'])->name('store');
        Route::get('/{vacancy}', [\App\Http\Controllers\Dashboard\VacancyController::class, 'show'])->name('show');
        Route::get('/{vacancy}/edit', [\App\Http\Controllers\Dashboard\VacancyController::class, 'edit'])->name('edit');
        Route::put('/{vacancy}', [\App\Http\Controllers\Dashboard\VacancyController::class, 'update'])->name('update');
        Route::delete('/{vacancy}', [\App\Http\Controllers\Dashboard\VacancyController::class, 'destroy'])->name('destroy');
        Route::post('/{vacancy}/toggle-status', [\App\Http\Controllers\Dashboard\VacancyController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{vacancy}/toggle-featured', [\App\Http\Controllers\Dashboard\VacancyController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::post('/{vacancy}/toggle-urgent', [\App\Http\Controllers\Dashboard\VacancyController::class, 'toggleUrgent'])->name('toggle-urgent');
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

    // Contact Messages Management routes
    Route::prefix('dashboard/contact-messages')->name('dashboard.contact-messages.')->group(function(){
        Route::get('/', [ContactMessageController::class, 'index'])->name('index');
        Route::get('/{contactMessage}', [ContactMessageController::class, 'show'])->name('show');
        Route::patch('/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])->name('update-status');
        Route::delete('/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-update', [ContactMessageController::class, 'bulkUpdate'])->name('bulk-update');
        Route::get('/export/csv', [ContactMessageController::class, 'export'])->name('export');
    });

    // Gallery Photos Management routes
    Route::prefix('dashboard/gallery')->name('dashboard.gallery.')->group(function(){
        Route::get('/', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'store'])->name('store');
        Route::get('/{galleryPhoto}', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'show'])->name('show');
        Route::get('/{galleryPhoto}/edit', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'edit'])->name('edit');
        Route::put('/{galleryPhoto}', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'update'])->name('update');
        Route::delete('/{galleryPhoto}', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'destroy'])->name('destroy');
        Route::post('/{galleryPhoto}/toggle-status', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{galleryPhoto}/toggle-featured', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'toggleFeatured'])->name('toggle-featured');
        Route::post('/update-order', [\App\Http\Controllers\Dashboard\GalleryPhotoController::class, 'updateOrder'])->name('update-order');
    });
});

