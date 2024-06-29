<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\ArticleController::class, 'index'])
    ->middleware(['auth', 'verified', SetLocale::class])
    ->name('dashboard');

Route::get('/admindashboard/', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admindashboard');

Route::post('/article', [\App\Http\Controllers\ArticleController::class, 'store'])
    ->middleware(['auth', 'verified', SetLocale::class])
    ->name('article.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/setlocale/{locale}', SetLocaleController::class)->name('setlocale');

require __DIR__.'/auth.php';
