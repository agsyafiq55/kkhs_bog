<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\ManageEvents;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

Route::view('/admin/dashboard', '/admin/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

// Add this route as a simple alias
Route::redirect('/dashboard', '/admin/dashboard')->name('dashboard');

//Settings for Admin
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

//Events Manager
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/events', ManageEvents::class)->name('admin.events');
});