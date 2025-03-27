<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Events\EventsList;
use App\Livewire\Admin\Events\EventForm;
use App\Livewire\Admin\Events\EventShow;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

Route::view('/admin/dashboard', '/admin/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

// Add this route as a simple alias
Route::redirect('/dashboard', '/admin/dashboard')->name('dashboard');

// Settings for Admin
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Events Manager (New)
Route::middleware(['auth'])->group(function () {
    // List all events
    Route::get('/admin/events', EventsList::class)->name('admin.events');
    // Create a new event
    Route::get('/admin/events/create', EventForm::class)->name('admin.events.create');
    // Edit an existing event
    Route::get('/admin/events/edit/{eventId}', EventForm::class)->name('admin.events.edit');
    // View a single event (detailed view)
    Route::get('/admin/events/show/{eventId}', EventShow::class)->name('admin.events.show');
});

// //Events Manager (OLD LATER DELETE)
// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/events', ManageEvents::class)->name('admin.events');
// });