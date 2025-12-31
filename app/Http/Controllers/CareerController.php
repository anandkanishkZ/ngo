<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display vacancy listings.
     */
    public function vacancy()
    {
        return view('careers.vacancy');
    }

    /**
     * Display specific vacancy details.
     */
    public function show($id)
    {
        return view('careers.show', compact('id'));
    }
}
