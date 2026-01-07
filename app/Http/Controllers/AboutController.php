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
        // Hardcoded team members from directory structure
        $hardcodedTeam = [
            // Admin and Finance Officer
            [
                'name' => 'Laxmi Prasad Danuwar',
                'position' => 'Admin and Finance Officer',
                'department' => 'Administration',
                'image' => 'images/uploads/team/Admin and Finiance officer/Laxmi Prasad Danuwar.jpg',
                'featured' => true,
            ],
            
            // Project Coordinator
            [
                'name' => 'Janga Bahadur Dhimal',
                'position' => 'Project Coordinator',
                'department' => 'Management',
                'image' => 'images/uploads/team/Project Coordinator/Janga Bahadur Dhimal.jpg',
                'featured' => true,
            ],
            
            // Sponsorship Correspondence Assistance
            [
                'name' => 'Prabin Thapa',
                'position' => 'Sponsorship Correspondence Assistance',
                'department' => 'Sponsorship',
                'image' => 'images/uploads/team/Sponsorship Correspondance Assistance/Prabin Thapa.jpg',
                'featured' => false,
            ],
            
            // Sponsorship Quality Control Officers
            [
                'name' => 'Gesh Bahadur Ale Magar',
                'position' => 'Sponsorship Quality Control Officer',
                'department' => 'Quality Control',
                'image' => 'images/uploads/team/Sponsorship Quality Control Officers/Gesh Bahadur Ale Magar.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Rudra Prasad Pokharel',
                'position' => 'Sponsorship Quality Control Officer',
                'department' => 'Quality Control',
                'image' => 'images/uploads/team/Sponsorship Quality Control Officers/Rudra Prasad Pokharel.jpg',
                'featured' => false,
            ],
            
            // Office Helper
            [
                'name' => 'Dhak Bahadur Magar',
                'position' => 'Office Helper',
                'department' => 'Support',
                'image' => 'images/uploads/team/Office helper/Dhak Bahadur Magar.jpg',
                'featured' => false,
            ],
            
            // Field Mobilizers
            [
                'name' => 'Ashok Rai',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Ashok Rai.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Dhan Bahadur Magar',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Dhan bdr Magar.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Giri Bahadur BK',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Giri Bahadur BK.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Indra Narayan Shrestha',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Indra Narayan Shrestha.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Keshab Kumar Raya',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Keshab Kumar Raya.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Khadga Khatri',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Khadga Khatri.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Nabaraj Rana Magar',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Nabaraj Rana Magar.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Pabana Khadka',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Pabana Khadka.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Pralad Khatri',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Pralad Khatri.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Pramila Pudasaini',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Pramila Pudasaini.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Santosh Kumar Rai',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Santosh Kumar Rai.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Saroj Hamal',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Saroj Hamal.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Shankar Bahadur Rikham',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Shankar Bahadur Rikham.jpg',
                'featured' => false,
            ],
            [
                'name' => 'Thaman Bahadur Thapa Magar',
                'position' => 'Field Mobilizer',
                'department' => 'Field Operations',
                'image' => 'images/uploads/team/Field Mobilizers/Thaman Bahadur Thapa Magar.jpg',
                'featured' => false,
            ],
        ];
        
        // Convert hardcoded array to collection with objects for consistency with view
        $hardcodedMembers = collect($hardcodedTeam)->map(function($member) {
            return (object) array_merge([
                'bio' => null,
                'email' => null,
                'phone' => null,
                'linkedin_url' => null,
                'twitter_url' => null,
                'facebook_url' => null,
                'achievements' => null,
                'image_url' => asset($member['image']),
            ], $member);
        });
        
        // Get dynamic team members from database
        $dynamicMembers = TeamMember::getActiveMembers();
        
        // Merge both collections
        $teamMembers = $hardcodedMembers->merge($dynamicMembers);
        
        return view('about.team', compact('teamMembers'));
    }
}
