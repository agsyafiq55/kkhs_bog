<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\EventController;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

// Landing Page
Route::get('/', [GuestController::class, 'index'])->name('home');

// 1. Events Page
// Index: List all events
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Show: Display a single event's details
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// 2. Gallery 
Route::get('/gallery', function () {
    return view('gallery.index');
})->name('gallery');

// About Us
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');
