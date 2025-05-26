<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Livewire\Admin\Auth\Login;

Route::prefix(config('admin.prefix', '/admin'))->name('admin.')->group(function () {
    Route::redirect('/', config('admin.prefix', '/admin') . '/login')->name('home');

    Route::get('/login', Login::class)->name('login');

    // Protected routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/protected-test', function () {
            return 'You are authenticated as an admin.';
        })->name('protected.test');

        Route::post('/logout', LogoutController::class)->name('logout');
    });
});
