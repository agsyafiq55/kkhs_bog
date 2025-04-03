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

// 1. Events Manager 
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

// 2. Gallery Manager
Route::middleware(['auth'])->group(function () {
    // List all gallery images
    Route::get('/admin/gallery', App\Livewire\Admin\Gallery\GalleryList::class)->name('admin.gallery');
    // Create/edit a gallery image
    Route::get('/admin/gallery/edit/{galleryId?}', App\Livewire\Admin\Gallery\GalleryEdit::class)->name('admin.gallery.edit');
    // View a single gallery image (detailed view)
    Route::get('/admin/gallery/{galleryId}', App\Livewire\Admin\Gallery\GalleryShow::class)->name('admin.gallery.show');
});