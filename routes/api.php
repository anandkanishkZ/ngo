<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\HeroSlide;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public, read-only hero slides (active only). Consider caching if needed.
Route::get('/hero-slides', function(){
    $slides = HeroSlide::where('is_active', true)->orderBy('sort_order')->get()->map(function($s){
        return [
            'title' => $s->title,
            'subtitle' => $s->subtitle,
            'title_color' => $s->title_color,
            'subtitle_color' => $s->subtitle_color,
            'title_size' => $s->title_size,
            'subtitle_size' => $s->subtitle_size,
            'button1' => [ 'text' => $s->button1_text, 'url' => $s->button1_url, 'style' => $s->button1_style ],
            'button2' => [ 'text' => $s->button2_text, 'url' => $s->button2_url, 'style' => $s->button2_style ],
            'bg_image_url' => $s->bg_image ? asset('storage/'.$s->bg_image) : null,
            'overlay_from' => $s->overlay_from,
            'overlay_to' => $s->overlay_to,
            'overlay_opacity' => $s->overlay_opacity,
            'content_x' => $s->content_x,
            'content_y' => $s->content_y,
        ];
    });
    return response()->json(['data' => $slides]);
})->middleware('throttle:60,1');
