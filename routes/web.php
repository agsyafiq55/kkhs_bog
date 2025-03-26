<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Livewire\Admin\ManageEvents;
use App\Models\Event;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

// Landing Page
Route::get('/', [GuestController::class, 'index'])->name('home');

// Events Page
    // Index
Route::get('/events', function () {
    return view('events.index', ['events' => Event::all()]);
});
Route::redirect('events', 'events')->name('events');
    // Show
Route::get('/events/{id}', [ManageEvents::class, 'show'])->name('events.show');