<?php


use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FeedbackController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SettingController;


// Public Routes (No Authentication Required) - Using FrontendController
Route::get('/', [MenuController::class, 'index'])->name('menu.index');
// Contact form submission (public)
Route::post('/contact', [MenuController::class, 'submitContact'])->name('contact.submit');
// Persist language selection (AJAX)
Route::post('/language', [MenuController::class, 'changeLanguage'])->name('language.change');

// NOTE: debug route removed. Use application flow to create feedback.



Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->name('home');

// Admin Routes (Authentication Required)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
    Route::delete('/profile/avatar', [ProfileController::class, 'clearAvatar'])->name('profile.clear-avatar');

    // Categories Routes


    // Items Routes
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::post('/items/{item}/toggle-status', [ItemController::class, 'toggleStatus'])->name('items.toggle-status');


      Route::get('/slides', [SlideController::class, 'index'])->name('slides.index');
    Route::get('/slides/create', [SlideController::class, 'create'])->name('slides.create');
    Route::post('/slides', [SlideController::class, 'store'])->name('slides.store');
    Route::get('/slides/{slide}/edit', [SlideController::class, 'edit'])->name('slides.edit');
    Route::put('/slides/{slide}', [SlideController::class, 'update'])->name('slides.update');
    Route::delete('/slides/{slide}', [SlideController::class, 'destroy'])->name('slides.destroy');
    Route::post('/slides/{slide}/toggle-status', [SlideController::class, 'toggleStatus'])->name('slides.toggle-status');
    Route::post('/slides/update-order', [SlideController::class, 'updateOrder'])->name('slides.update-order');
// Feedback Routes
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');


    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
Route::post('/partners', [PartnerController::class, 'store'])->name('partners.store');
Route::get('/partners/{partner}', [PartnerController::class, 'show'])->name('partners.show');
Route::get('/partners/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
Route::put('/partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
Route::delete('/partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
Route::post('/partners/{partner}/toggle-status', [PartnerController::class, 'toggleStatus'])->name('partners.toggle-status');
Route::post('/partners/update-order', [PartnerController::class, 'updateOrder'])->name('partners.update-order');
    // Settings Routes

     Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings/bulk-update', [SettingController::class, 'bulkUpdate'])->name('settings.bulk-update');
});

// Auth Routes (Laravel Default)
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
