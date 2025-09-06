<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        // Get dynamic partners for the about page
        $partners = Partner::getActivePartners();
        
        return view('about.index', compact('partners'));
    }
    
    public function team()
    {
        $teamMembers = TeamMember::getActiveMembers();
        
        return view('about.team', compact('teamMembers'));
    }
}
