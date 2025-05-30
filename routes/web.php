<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AcademicController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Academics
Route::get('/academics', [AcademicController::class, 'index'])->name('academics');
Route::get('/academics/{id}', [AcademicController::class, 'show'])->name('academics.show');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');

// News
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');



// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes (tidak perlu middleware admin)
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

        // School management
        Route::get('/school', [App\Http\Controllers\Admin\SchoolController::class, 'index'])->name('school.index');
        Route::get('/school/edit', [App\Http\Controllers\Admin\SchoolController::class, 'edit'])->name('school.edit');
        Route::put('/school', [App\Http\Controllers\Admin\SchoolController::class, 'update'])->name('school.update');

        // News management
        Route::resource('news', App\Http\Controllers\Admin\NewsController::class);

        // Contacts management
        Route::get('/contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
        Route::patch('/contacts/{contact}/mark-read', [App\Http\Controllers\Admin\ContactController::class, 'markAsRead'])->name('contacts.mark-read');
        Route::delete('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'destroy'])->name('contacts.destroy');

        // Settings management
        Route::get('/settings/header', [App\Http\Controllers\Admin\SettingController::class, 'header'])->name('settings.header');
        Route::put('/settings/header', [App\Http\Controllers\Admin\SettingController::class, 'updateHeader'])->name('settings.header.update');
        Route::get('/settings/footer', [App\Http\Controllers\Admin\SettingController::class, 'footer'])->name('settings.footer');
        Route::put('/settings/footer', [App\Http\Controllers\Admin\SettingController::class, 'updateFooter'])->name('settings.footer.update');

        // Menu management
        Route::resource('menus', App\Http\Controllers\Admin\MenuController::class);
        Route::post('/menus/update-order', [App\Http\Controllers\Admin\MenuController::class, 'updateOrder'])->name('menus.update-order');

        // Academic management
        Route::resource('academics', App\Http\Controllers\Admin\AcademicController::class);

        // Academic Features management
        Route::resource('academic-features', App\Http\Controllers\Admin\AcademicFeatureController::class);
        Route::post('/academic-features/update-order', [App\Http\Controllers\Admin\AcademicFeatureController::class, 'updateOrder'])->name('academic-features.update-order');

        // Academic Levels management
        Route::resource('academic-levels', App\Http\Controllers\Admin\AcademicLevelController::class);
        Route::patch('/academic-levels/{academicLevel}/toggle-visibility', [App\Http\Controllers\Admin\AcademicLevelController::class, 'toggleVisibility'])->name('academic-levels.toggle-visibility');

        // Gallery management
        Route::resource('galleries', App\Http\Controllers\Admin\GalleryController::class);
        Route::patch('/galleries/{gallery}/toggle-featured', [App\Http\Controllers\Admin\GalleryController::class, 'toggleFeatured'])->name('galleries.toggle-featured');

        // Homepage management
        Route::get('/homepage', [App\Http\Controllers\Admin\HomepageController::class, 'index'])->name('homepage.index');
        Route::get('/homepage/edit', [App\Http\Controllers\Admin\HomepageController::class, 'edit'])->name('homepage.edit');
        Route::put('/homepage', [App\Http\Controllers\Admin\HomepageController::class, 'update'])->name('homepage.update');
        Route::post('/homepage/reset', [App\Http\Controllers\Admin\HomepageController::class, 'reset'])->name('homepage.reset');

        // Hero Images Management
        Route::resource('hero-images', App\Http\Controllers\Admin\HeroImageController::class);
        Route::post('/hero-images/update-order', [App\Http\Controllers\Admin\HeroImageController::class, 'updateOrder'])->name('hero-images.update-order');
        Route::post('/hero-images/{heroImage}/toggle-active', [App\Http\Controllers\Admin\HeroImageController::class, 'toggleActive'])->name('hero-images.toggle-active');
    });
});
