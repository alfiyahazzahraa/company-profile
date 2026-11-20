<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;

// Homepage
Route::get('/', [HomeController::class, 'index']);

// Kontak
Route::get('/kontak', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/kontak', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

// Login Admin
Route::get('/admin/login', [LoginController::class, 'index'])
    ->name('admin.login');

Route::post('/admin/login', [LoginController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('admin.login.store');

Route::post('/admin/logout', [LoginController::class, 'logout'])
    ->name('admin.logout');

// Admin Dashboard dan Inbox (dilindungi login)
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Inbox Admin
    Route::get('/admin/messages', [ContactMessageController::class, 'index'])
        ->name('admin.messages.index');

    Route::patch('/admin/messages/{message}', [ContactMessageController::class, 'update'])
        ->name('admin.messages.update');

    Route::delete('/admin/messages/{message}', [ContactMessageController::class, 'destroy'])
        ->name('admin.messages.destroy');

});