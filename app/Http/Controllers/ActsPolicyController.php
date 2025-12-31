<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActsPolicyController extends Controller
{
    /**
     * Display a listing of acts and policies.
     */
    public function index()
    {
        return view('acts-policy.index');
    }

    /**
     * Display the specified act or policy.
     */
    public function show($id)
    {
        return view('acts-policy.show', compact('id'));
    }
}
