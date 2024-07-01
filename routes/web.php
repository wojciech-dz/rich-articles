<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ArticleController::class, 'index'])
    ->middleware(['auth', 'verified', SetLocale::class])
    ->name('dashboard');

Route::get('/admindashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admindashboard');

Route::post('/admindashboard/send-notification', [AdminDashboardController::class, 'sendNotification'])
    ->middleware(['auth', 'verified'])
    ->name('sendNotification');

Route::get('/contact', function () {
    return view('contact.form');
})->middleware(['auth', 'verified', SetLocale::class])->name('contact');
Route::get('/contact/success', function () {
    return view('contact.success');
})->middleware(['auth', 'verified', SetLocale::class])->name('contact.success');
Route::post('/contact/send', ContactController::class)->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::delete('/profile/user-delete', [ProfileController::class, 'deleteUser'])->name('profile.delete');
    Route::post('/profile/toggle-admin', [ProfileController::class, 'toggleAdmin'])->name('profile.toggleAdmin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/article/delete', [ArticleController::class, 'deleteArticle'])->name('article.delete');
    Route::resource('article', ArticleController::class);
});

Route::get('/setlocale/{locale}', SetLocaleController::class)->name('setlocale');

require __DIR__.'/auth.php';
