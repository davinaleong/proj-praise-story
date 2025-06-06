<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Livewire\Admin\Auth\Login;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\User\Index as UserIndex;
use App\Livewire\Admin\User\Show as UserShow;

$prefix = config('admin.prefix', '/admins');

Route::prefix($prefix)->name('admins.')->group(function () use ($prefix) {
    Route::redirect('/', $prefix . '/login')->name('home');

    Route::get('/login', Login::class)->name('login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/protected-test', function () {
            return 'You are authenticated as an admin.';
        })->name('protected.test');

        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        Route::post('/logout', LogoutController::class)->name('logout');

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', UserIndex::class)->name('index');
            Route::get('/{uuid}', UserShow::class)->name('show');
        });

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

