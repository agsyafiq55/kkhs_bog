<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Livewire\Admin\ManageEvents;
use App\Models\Event;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

// Landing Page
Route::get('/', [GuestController::class, 'index'])->name('home');

// 1. Events Page
// Index
Route::get('/events', function () {
    return view('events.index', ['events' => Event::all()]);
})->name('events');

// Show
Route::get('/events/{id}', [ManageEvents::class, 'show'])->name('events.show');

// 2. Gallery 
// Index
Route::get('/gallery', function () {
    return view('gallery.index');
})->name('gallery');


// About Us
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');
