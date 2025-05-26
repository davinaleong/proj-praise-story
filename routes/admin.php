<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard;

$prefix = config('admin.prefix', '/admin');

Route::prefix($prefix)->name('admin.')->group(function () use ($prefix) {
    Route::redirect('/', $prefix . '/login')->name('home');

    Route::get('/login', Login::class)->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/protected-test', function () {
            return 'You are authenticated as an admin.';
        })->name('protected.test');

        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        Route::post('/logout', LogoutController::class)->name('logout');

        Route::redirect('/settings', '/settings/profile');
        Route::get('/settings/profile', action: function () {
            return 'TODO: Profile';
        })->name('settings.profile');
        Route::get('/settings/password', function () {
            return 'TODO: Password';
        })->name('settings.password');
        Route::get('/settings/appearance', function () {
            return 'TODO: Appearance';
        })->name('settings.appearance');
    });
});

