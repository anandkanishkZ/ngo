<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'asc')->paginate(6);
        return view('events.index', compact('events'));
    }
    
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
}
