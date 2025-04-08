<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Events\EventsList;
use App\Livewire\Admin\Events\EventForm;
use App\Livewire\Admin\Events\EventShow;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Admin\AboutUs\AboutUsList;
use App\Livewire\Admin\AboutUs\AboutUsEdit;
use App\Livewire\Admin\AboutUs\MemberEdit;
use App\Livewire\Admin\TimelineManager; // Add this import

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
    // View a single gallery image
    Route::get('/admin/gallery/{galleryId}', App\Livewire\Admin\Gallery\GalleryShow::class)->name('admin.gallery.show');
});

// 3. About Us 
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Main About Us page
    Route::get('/aboutus', AboutUsList::class)->name('aboutus');

    // About Us edit page
    Route::get('/aboutus/edit', AboutUsEdit::class)->name('aboutus.edit');

    // Members management
    Route::get('/aboutus/members/create', MemberEdit::class)->name('aboutus.members.create');
    Route::get('/aboutus/members/edit/{memberId}', MemberEdit::class)->name('aboutus.members.edit');

    // Timeline management - added here
    Route::get('/timeline', TimelineManager::class)->name('timeline');
});