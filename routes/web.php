<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

//Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

//Events Page
Route::get('/events', function () {
    return view('events', ['events' => \App\Models\Event::all()]);
});
Route::redirect('event', 'event')->name('events');

//Fetch Events for Landing Page
Route::get('/', [GuestController::class, 'index'])->name('home');



