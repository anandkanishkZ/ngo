<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class AppearanceController extends Controller
{
    public function edit()
    {
        $colors = Setting::colors();
        return view('dashboard.appearance.edit', compact('colors'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'primary_color' => 'required|string|max:20',
            'secondary_color' => 'required|string|max:20',
            'accent_color' => 'required|string|max:20',
            'success_color' => 'required|string|max:20',
            'light_bg' => 'required|string|max:20',
            'dark_bg' => 'required|string|max:20',
        ]);
        Setting::putValue('site_colors', json_encode($data));
        return redirect()->route('dashboard.appearance.edit')->with('status','Colors updated');
    }
}
