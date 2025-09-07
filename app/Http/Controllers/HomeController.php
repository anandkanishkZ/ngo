<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSlide;
use App\Models\Statistic;
use App\Models\ImpactArea;
use App\Models\Partner;

class HomeController extends Controller
{
    public function index()
    {
    // Events feature removed
        
        $heroSlides = HeroSlide::where('is_active', true)->orderBy('position')->get();
        
        // Get dynamic statistics
        $statistics = Statistic::getActiveStats();
        
        // Get dynamic impact areas
        $impactAreas = ImpactArea::getActiveAreas();
        
        // Get dynamic partners
        $partners = Partner::getActivePartners();
        
    return view('home', compact('heroSlides', 'statistics', 'impactAreas', 'partners'));
    }
}
