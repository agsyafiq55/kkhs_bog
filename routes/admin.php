<?php

use Illuminate\Support\Facades\Route;

Route::view('/admin/dashboard', '/admin/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

// Add this route as a simple alias
Route::redirect('/dashboard', '/admin/dashboard')->name('dashboard');