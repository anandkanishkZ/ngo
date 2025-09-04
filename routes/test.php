<?php

use Illuminate\Support\Facades\Route;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Log;

Route::get('/test-team-delete/{id}', function($id) {
    try {
        $member = TeamMember::find($id);
        if (!$member) {
            return response()->json(['error' => 'Team member not found'], 404);
        }
        
        Log::info('Testing team member delete', [
            'member_id' => $member->id,
            'member_name' => $member->name
        ]);
        
        return response()->json([
            'success' => true,
            'member' => [
                'id' => $member->id,
                'name' => $member->name,
                'position' => $member->position
            ]
        ]);
        
    } catch (\Exception $e) {
        Log::error('Test delete error: ' . $e->getMessage());
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
