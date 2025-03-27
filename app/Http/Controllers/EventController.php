<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController
{
    // Display a listing of events.
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->get();
        return view('events.index', compact('events'));
    }

    // Display the specified event.
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }
}
