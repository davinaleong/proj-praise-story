<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\IndexController;

Route::name('index.')->controller(IndexController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/{uuid}', 'show')->name('show');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('/testimonies')->name('testimonies.')->controller(TestimonyController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{uuid}', 'show')->name('show');
        Route::get('/{uuid}/edit', 'edit')->name('edit');
        Route::put('/{uuid}', 'update')->name('update');
        Route::delete('/{uuid}', 'destroy')->name('destroy');
    });
});

require __DIR__.'/auth.php';
