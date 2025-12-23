<?php

use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'setlocale'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/services', [PageController::class, 'services'])->name('services');
Route::redirect('/products', '/shop', 301);

    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/shop/{product:slug}', [ShopController::class, 'show'])->name('shop.show');

    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

    // For Laravel's built-in `auth` middleware redirect target:
    Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

    Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

    // Admin Auth (no admin middleware here; only login)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::middleware(['auth', 'admin'])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
            Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
            Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
            Route::resource('categories', AdminCategoryController::class)->except(['show']);
            Route::resource('products', AdminProductController::class)->except(['show']);
        });
    });
});