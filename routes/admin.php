<?php

use App\Livewire\Admin\Members\MembersList;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Events\EventsList;
use App\Livewire\Admin\Events\EventForm;
use App\Livewire\Admin\Events\EventShow;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Admin\AboutUs\AboutUsList;
use App\Livewire\Admin\AboutUs\AboutUsEdit;
use App\Livewire\Admin\AboutUs\Members\MemberList;
use App\Livewire\Admin\AboutUs\Members\MemberEdit;
use App\Livewire\Admin\AboutUs\Timeline\TimelineList;
use App\Livewire\Admin\AboutUs\Timeline\TimelineEdit;
use App\Livewire\Admin\Announcements\AnnouncementsList;
use App\Livewire\Admin\Announcements\AnnouncementForm;
use App\Livewire\Admin\Announcements\AnnouncementShow;

// Apply web and auth middleware to ALL admin routes
Route::middleware(['web', 'auth'])->group(function () {

    // Dashboard
    Route::view('/admin/dashboard', '/admin/dashboard')
        ->name('admin.dashboard');

    Route::redirect('/dashboard', '/admin/dashboard')
        ->name('dashboard');

    // Settings
    Route::prefix('settings')->group(function () {
        Route::redirect('', 'profile');
        Route::get('profile', Profile::class)->name('settings.profile');
        Route::get('password', Password::class)->name('settings.password');
        Route::get('appearance', Appearance::class)->name('settings.appearance');
    });

    // Events Manager
    Route::prefix('admin/events')->name('admin.events.')->group(function () {
        Route::get('/', EventsList::class)->name('index');
        Route::get('create', EventForm::class)->name('create');
        Route::get('edit/{eventId}', EventForm::class)->name('edit');
        Route::get('show/{eventId}', EventShow::class)->name('show');
    });

    // Gallery Manager
    Route::prefix('admin/gallery')->name('admin.gallery.')->group(function () {
        Route::get('/', App\Livewire\Admin\Gallery\GalleryList::class)->name('index');
        Route::get('edit/{galleryId?}', App\Livewire\Admin\Gallery\GalleryEdit::class)->name('edit');
        Route::get('{galleryId}', App\Livewire\Admin\Gallery\GalleryShow::class)->name('show');
    });

    // About Us
    Route::prefix('admin/aboutus')->name('admin.aboutus.')->group(function () {
        Route::get('/', AboutUsList::class)->name('index');
        Route::get('create', AboutUsEdit::class)->name('create');
        Route::get('edit/{aboutUsId}', AboutUsEdit::class)->name('edit');

        // Members management
        Route::prefix('members')->name('members.')->group(function () {
            Route::get('/', MemberList::class)->name('index');
            Route::get('create', MemberEdit::class)->name('create');
            Route::get('edit/{memberId}', MemberEdit::class)->name('edit');
        });

        // Timeline management
        Route::prefix('timeline')->name('timeline.')->group(function () {
            Route::get('/', TimelineList::class)->name('index');
            Route::get('create', TimelineEdit::class)->name('create');
            Route::get('edit/{cardId}', TimelineEdit::class)->name('edit');
        });
    });

    // Achievements
    Route::prefix('admin/achievements')->name('admin.achievements.')->group(function () {
        // Academic Achievements
        Route::prefix('academic')->name('academic.')->group(function () {
            Route::get('/', App\Livewire\Admin\Achievements\AcademicAchievementsList::class)->name('index');
            Route::get('create', App\Livewire\Admin\Achievements\AcademicAchievementForm::class)->name('create');
            Route::get('{id}/edit', App\Livewire\Admin\Achievements\AcademicAchievementForm::class)->name('edit');
        });

        // Co-curricular Achievements
        Route::prefix('cocurricular')->name('cocurricular.')->group(function () {
            Route::get('/', App\Livewire\Admin\Achievements\CocurricularAchievementsList::class)->name('index');
            Route::get('create', App\Livewire\Admin\Achievements\CocurricularAchievementForm::class)->name('create');
            Route::get('{id}/edit', App\Livewire\Admin\Achievements\CocurricularAchievementForm::class)->name('edit');
        });
    });

    // Announcements
    Route::prefix('admin/announcements')->name('admin.announcements.')->group(function () {
        Route::get('/', AnnouncementsList::class)->name('index');
        Route::get('create', AnnouncementForm::class)->name('create');
        Route::get('edit/{announcementId}', AnnouncementForm::class)->name('edit');
        Route::get('show/{announcementId}', AnnouncementShow::class)->name('show');
    });

    // Contact Us Management
    Route::prefix('admin/contactus')->name('admin.contactus.')->group(function () {
        Route::get('/', App\Livewire\Admin\ContactUs\ContactUsDisplay::class)->name('index');
        Route::get('edit/{contactUsId?}', App\Livewire\Admin\ContactUs\ContactUsForm::class)->name('edit');
    });
});